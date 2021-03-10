<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Aws\Rekognition\RekognitionClient;
use App\Jobs\CreatePreviews;
use App\Models\ProductDetails;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Storage;


class TransloaditResults implements ShouldQueue
{
  use Dispatchable,
  InteractsWithQueue,
  Queueable,
  SerializesModels;

  private $imgId;
  public $tries = 1;
  public $timeout = 100;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($imgId)
  {
    $this->imgId = $imgId;
  }

  /**
  * Execute the job.
  *
  * @return void
  */

  public function handle()
  {
    $imgId=$this->imgId;
    $creator_id = Image::find($imgId)->creator_id;
    self::getImageApproval($imgId);
    self::create_shop($creator_id);
  }
  public function pushStatusUpdate(){
    $options = array(
     'cluster' => 'eu',
     'useTLS' => true
   );
   $pusher = new \Pusher\Pusher(
     '077407cb7b613f5fc323',
     'c9e2dfc71344fdbcc3c9',
     '1102563',
     $options
   );

   $data['message'] = 'hello world';
   $pusher->trigger('my-channel', 'my-event', $data);
  }
  public function getImageApproval($imgId)
  {
    $img_path= config('app.storage_dir') . '/creator_images/' . $imgId . '/1000C.jpg';
    $client = new RekognitionClient([
      'region'    => config('filesystems.disks.s3.region'),
      'version'   => 'latest',
      'credentials' => [
        'key'    => config('filesystems.disks.s3.key'),
        'secret' => config('filesystems.disks.s3.secret')
      ]
    ]);

    $is_approved = empty($client->detectModerationLabels(['Image' => ['Bytes' =>  Storage::cloud()->get($img_path)],'MinConfidence' => 50,'MaxLabels' => 10])['ModerationLabels']);
    $is_approved= $is_approved? 1 : 0;
    DB::table('images')->where('id', $imgId)->update(
      [
        'status' => $is_approved? 'approved' : 'autoNotApproved',
      ]
    );
  }
  public function create_shop($creator_id)
  {
    $imgId=$this->imgId;
    $img = Image::find($imgId);
    $imgPath= config('app.storage_dir') . '/creator_images/' . $imgId . '/1000C.jpg';
    $imgOrientation = 'square';
    if($img->ratio>1.1) $imgOrientation='landscape';
    if($img->ratio<0.9) $imgOrientation='portrait';
    $creator = $img->creator;
    foreach (ProductDetails::where('is_active',true)->get() as $productDetails) {
      // if(!in_array($productDetails->product_code,json_decode($creator->chosen_products))) continue;
      $distanceFromSquare=0.1;
      $isTheImageInTheRightOrientation=in_array($imgOrientation,json_decode($productDetails->optional_orientation));
      if (!$isTheImageInTheRightOrientation) continue;
      $product=Product::create(
        [
          'product_code' => $productDetails->product_code,
          'creator_id' => $creator->id,
          'image_id' => $img->id,
        ]
      );
      dispatch(new CreatePreviews($product));
    }
    self::pushStatusUpdate();
  }

}
