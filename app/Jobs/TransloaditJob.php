<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use transloadit\Transloadit;
use Auth;
use Storage;

class TransloaditJob implements ShouldQueue
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

  public function handle(){
    $imgId=$this->imgId;

    // DB::table('images')->where('id', $imgId)->update(
    //   [
    //     'is_approved' => $is_approved,
    //   ]
    // );
    // return;


    $img = Image::find($imgId);
    $transloadit = new Transloadit([
      'key'    => '83304bd5a09d4978a31cf3c4267a06c6',
      'secret' => 'f8a24a20a3d9de7b7491294335afeb196ea770f7',]);
    $response = $transloadit->createAssembly([
      'params' => [
        'steps' => [
          "imported"=> [
            "robot"=> "/http/import",
            "url"=> Storage::cloud()->url(config('app.storage_dir') . '/creator_images/'.$imgId.'/1000C.jpg')
          ],
          "optimized"=> [
            "robot"=> "/image/optimize",
            "use"=> 'imported',
            "progressive"=> true
          ],
          "watermarked"=> [
            "use"=> "optimized",
            "robot"=> "/image/resize",
            "watermark_url"=> 'https://ondema.s3-eu-west-1.amazonaws.com/dev/images/watermark-1500.png',
            "watermark_size"=> "20%",
            "watermark_position"=> "bottom-right",
            "imagemagick_stack"=> "v2.0.7"
          ],
          '1000' => [
            'robot' => '/image/resize',
            'use' => 'watermarked',
            'width' => 1000,
          ],
          '500' => [
            'use' => 'watermarked',
            'robot' => '/image/resize',
            'width' => 500,
          ],
          '300' => [
            'robot' => '/image/resize',
            'use' => '500',
            'width' => 300,
          ],
          '80' => [
            'robot' => '/image/resize',
            'use' => '300',
            'width' => 80,
          ],
          'exported' => [
            'robot' => '/s3/store',
            'use' => ['1000','500','300','80'],
            'credentials' => 's3_storage',
            'path'=> config('app.storage_dir') . '/creator_images/'.$imgId.'/${previous_step.name}.jpg'
          ],
        ],
        'notify_url' =>url('api/api/transloadit-results/' . $imgId),
      ],]);
    $response=json_decode(json_encode($response))->data;
    if (property_exists($response,'error')){
      DB::table('images')->where('id',$imgId)->update(['msg'=>$response->message]);
    }
  }

}
