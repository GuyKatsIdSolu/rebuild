<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\BuildReadyShopByPid;
use App\Models\Order;
use App\Models\ProductTemplate;
use Auth;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\DB;


class CreateProduct implements ShouldQueue {

  use Dispatchable,
  InteractsWithQueue,
  Queueable,
  SerializesModels;

  private $request;
  private $product_id;
  private $request_arr;
  public $tries = 1;
  public $timeout = 3000;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($request,$request_arr,$product_id) {
    $this->request = $request;
    $this->request_arr = $request_arr;
    $this->product_id = $product_id;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle() {
    $request=$this->request;
    $get_preview = 1;
    $resize_method = 'stretch';
    $campaign_id = 0;
    $widget_id = 0;
    $store_id = 0;
    $which_previews = 0;
    $request_arr= $this->request_arr;

    if (isset($request_arr['which_previews'])) {
      $which_previews = $request->which_previews;
    }
    if (isset($request_arr['campaign_id'])) {
      $campaign_id = $request->campaign_id;
    }
    if (isset($request_arr['widget_id'])) {
      $widget_id = $request->widget_id;
    }
    if (isset($request_arr['products_list'])) {
      $store_id = $request->products_list;
    }
    if (isset($request_arr['store_id'])) {
      $store_id = $request->store_id;
    }
    if (isset($request_arr['resize_method'])) {
      $resize_method = $request->resize_method;
    }
    if (isset($request_arr['get_preview'])) {
      $get_preview = $request->get_preview;
    }
    if (!isset($request_arr['template_id'])) {
      return Response()->json(error_msg("template_id is required"), 400);
    }
    if (empty(ProductTemplate::where('id', $request_arr['template_id'])->get()->all())) {
      return Response()->json(error_msg("template_id is Not Found"), 404);
    }
    $basic_product;
    $custom_field = $variance = '';
    if (isset($request_arr['custom_field'])) {
      $custom_field = $request->custom_field;
    }
    $tags = $tags = '';
    if (isset($request_arr['tags'])) {
      $tags = json_encode($request->tags);
    }
    $template = ProductTemplate::find($request_arr['template_id']);
    $sup_template;
    //        $product_code = $sup_template->product_code;
    $upload_images_is_array = 0;
    if (isset($request_arr['upload_images'])) {
      if (is_array($request_arr['upload_images'])) {
        $upload_images_is_array = 1;
      }
    }
    if ($template->supplier_index) {
      $requiers = explode(',', $template->supplier_index->requiers);
      if ($requiers[0] != '') {
        foreach ($requiers as $requier) {
          if (!isset($request_arr['variance'][$requier])) {
            return Response()->json(error_msg("variance[$requier] is required"), 400);
          }
        }
        $variance = json_encode($request->variance);
      }
      $min = 1000;
    } else {
      $sup_template = $template;
    }
    $sup_template = $template->supplier_index->supplier;
    $resolution = 300;
    $texts_array = [];
    $images_array = [];


    if (isset($request_arr['resolution'])) {
      $resolution = $request_arr['resolution'];
    }


    for ($i = 1; $i < 10; $i++) {
      if (isset($request_arr['images_url'])) {
        if (isset($request_arr['images_url'][$i])) {
          $external_link = $request_arr['images_url'][$i];

          if (@getimagesize($external_link)) {
            $info = getimagesize($external_link);
            $extension = image_type_to_extension($info[2]);
            //                        $url_info = pathinfo($external_link);
            //                        $extension = $url_info['extension'];
            $uniqid = uniqid();
            $file_path = config('app.storage_dir') . '/uploads/' . $uniqid . $extension;
            Storage::cloud()->put($file_path, file_get_contents($external_link), 'public');
            $images_array[$i] = $file_path;
          } else {
            return Response()->json(error_msg("images[$i] url does not exists"), 400);
          }
        }
      }
    }
    $assets_id = DB::table('items_assets')->insertGetId([]);
    foreach ($images_array as $key => $value) {
      $key = 'image_' . $key;
      DB::table('items_assets')->where('id', $assets_id)->update([$key => $value]);
    }
    foreach ($texts_array as $key => $value) {
      $key = 'text_' . $key;
      DB::table('items_assets')->where('id', $assets_id)->update([$key => $value]);
    }
    $product_id = $this->product_id;
    DB::table('products')->where('id',$this->product_id)->update(
      [
        'template_id' => $sup_template->id,
        'assets_id' => $assets_id,
        'preview_url' => 'preview doesnt created',
        'custom_field' => $custom_field,
        'tags' => $tags,
        'variance' => $variance,
        'resize_method' => $resize_method,
        'campaign_id' => $campaign_id,
        'widget_id' => $widget_id,
        'store_id' => $store_id
      ]
    );
    if ($get_preview) {
      if ($sup_template->basic_template->supplier != '') {
        $preview = get_preview_image_external($template, $images_array, $texts_array, $resolution, $sup_template, $variance, null, $resize_method, $which_previews, $product_id);
      } else {
        $preview = get_preview_image($template, $images_array, $texts_array, $resolution);
      }
      DB::table('products')->where('id',$preview->id)->update(['preview_url' => $preview['url']]);
    }
    DB::table('stores')->where('id', $store_id)->update(['entries'=> DB::raw('entries+1')]);
    dispatch(new BuildReadyShopByPid($product_id));
  }

}
