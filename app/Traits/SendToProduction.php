<?php

namespace App\Traits;

use App\Models\ProductTemplate;
use App\Models\Creator;
use App\Models\OrderItem;
use App\Models\Image;
use App\Jobs\TransloaditJob;
use App\Jobs\TransloaditResults;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use transloadit\Transloadit;
use Storage;

trait SendToProduction
{
  function sendToSupplier($orderItemId){
    $orderItem=OrderItem::find($orderItemId);
    $supplier=$orderItem->product->details->cur_sup->name;
    $this->$supplier($orderItem);
  }
  public function adjustImageToProduction($orderItem){
    if(Storage::cloud()->has(config('app.storage_dir') . '/production_images/' . $orderItem->id.'_'.date("dmy").'.png')){
      return Storage::cloud()->url(config('app.storage_dir') . '/production_images/' . $orderItem->id.'_'.date("dmy").'.png');
    }
    $product=$orderItem->product;
    $imgPath= config('app.storage_dir') . '/creator_images/' . $product->image_id . '/original.jpg';
    $img = new \Imagick();
    $img->readImageBlob(Storage::cloud()->get($imgPath));
    $resize_method="stretch";
    $imageWidth=$product->details->production_details->image_width;
    $imageHeight=$product->details->production_details->image_height;
    switch ($resize_method) {
      case 'bestFit':
      $img->thumbnailImage($imageWidth, $imageHeight, 1,1);
      break;
      case 'fit':
      $img->adaptiveResizeImage($imageWidth, $imageHeight, 1);
      break;
      case 'crop':
      $this->crop($img,$imageWidth, $imageHeight);
      break;
      case 'stretch':
      $img->adaptiveResizeImage($imageWidth, $imageHeight);
      break;
      default:
      $img->adaptiveResizeImage($imageWidth, $imageHeight, 1);
      break;
    }
    $img->setImageFormat('png');
    // $img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
    // $img->setImageResolution($resolution_requierd, $resolution_requierd);
    Storage::cloud()->put(config('app.storage_dir') . '/production_images/' . $orderItem->id.'_'.date("dmy").'.png', (string) $img, 'public');
    return Storage::cloud()->url(config('app.storage_dir') . '/production_images/' . $orderItem->id.'_'.date("dmy").'.png');
  }
  public function scalablepress($orderItem){
    $product = $orderItem->product;
    $username = $password = 'test_FyV2Sm3CjgkTD8MteZymYg';
    $productionDetails = $orderItem->product->details->production_details;
    $imgUrl=$this->adjustImageToProduction($orderItem);
    $other=json_decode($productionDetails->other);
    $response = Http::withBasicAuth($username, $password)
    ->post("https://api.scalablepress.com/v2/design",[
      "type" => $other->{'type'},
      "sides"=>[
        "front"=>[
          "artwork"=>$imgUrl,
          "dimensions"=>[
            "width"=>$other->{"sides[front][dimensions][width]"}
          ],
          "position"=>[
            "horizontal"=>$other->{"sides[front][position][horizontal]"},
            "offset"=>[
              "top"=>$other->{"sides[front][position][offset][top]"}
            ]
          ]
        ]
      ]
    ]);
    if($response->failed()){
      $orderItem->supplier_order_status="requestError";
      $orderItem->error_msg=$response->body();
      $orderItem->save();
      return;
    }
    $designId=$response->json()['designId'];
    $properties=["color"=>'white','size'=>'one'];
    if(isset($other->requireProperties)){
      foreach ($other->requireProperties as $property) {
        $properties[$property->name]=$property->options->{json_decode($orderItem->properties)->{$property->name}};
      }
    }
    $response = Http::withBasicAuth($username, $password)
    ->post("https://api.scalablepress.com/v2/quote",[
      "type" => $other->{'type'},
      "products"=>[
        [
          "id"=>$productionDetails->supplier_product_code,
          "color"=>$properties['color'],
          "quantity"=>$orderItem->quantity,
          "size"=>$properties['size'],
        ]
      ],
      "address"=>[
        "name" => $orderItem->order->first_name.' '.$orderItem->order->last_name,
        "address1" => $orderItem->order->address_1,
        "address2" => $orderItem->order->address_2,
        "city" => $orderItem->order->city,
        "state" => $orderItem->order->state,
        "zip" => $orderItem->order->post_code,
      ],
      "designId" => $designId,
    ]);
    if($response->failed()){
      $orderItem->supplier_order_status="requestError";
      $orderItem->error_msg=$response->body();
      $orderItem->save();
      return;
    }
    $response = Http::withBasicAuth($username, $password)
    ->post("https://api.scalablepress.com/v2/order",["orderToken" => $response->json()['orderToken']]);
    if($response->failed()){
      $orderItem->supplier_order_status="requestError";
      $orderItem->error_msg=$response->body();
      $orderItem->save();
      return;
    }
    dd($response->body());
    $orderItem->status="pending";
    $orderItem->supplier_order_status="new";
    $orderItem->supplier_order_id=$response->json()['orderId'];
    $orderItem->save();

  }
  public function gooten($orderItem){
    $recipeId = '26bea779-8ab3-443b-ade8-c445b56664a9';
    $PartnerBillingKey = 'MtOCCHxEAfKy60eu5RBQ+OXOcJ5c58Xb+r+0XDwlPRQ=';
    $productionDetails = $orderItem->product->details->production_details;
    $imgUrl=$this->adjustImageToProduction($orderItem);
    $productCode=$productionDetails->supplier_product_code;
    if(isset(json_decode($productionDetails->other)->requireProperties)){
      foreach (json_decode($productionDetails->other)->requireProperties as $property) {

        $productCode=str_replace('{'.$property->name.'}',$property->options->{json_decode($orderItem->properties)->{$property->name}},$productCode);
      }
    }
    $response = Http::post("https://api.print.io/api/v/5/source/api/orders/?recipeid=$recipeId", [
      "ShipToAddress" => [
        "FirstName" => $orderItem->order->first_name,
        "LastName" => $orderItem->order->last_name,
        "Line1" => $orderItem->order->address_1,
        "Line2" => $orderItem->order->address_2,
        "City" => $orderItem->order->city,
        "State" => $orderItem->order->state,
        "CountryCode" => $orderItem->order->country,
        "PostalCode" => $orderItem->order->post_code,
        "IsBusinessAddress" => false,
        // "Phone" => $orderItem->order->phone, // Intentional error
        "Phone" => $orderItem->order->phone==''? '0':$orderItem->order->phone,
        "Email" => $orderItem->order->email
      ],
      "BillingAddress" => [
        "FirstName" => $orderItem->order->first_name,
        "LastName" => $orderItem->order->last_name,
        "Line1" => $orderItem->order->address_1,
        "Line2" => $orderItem->order->address_2,
        "City" => $orderItem->order->city,
        "State" => $orderItem->order->state,
        "CountryCode" => $orderItem->order->country,
        "PostalCode" => $orderItem->order->post_code,
        "IsBusinessAddress" => false,
        "Phone" => $orderItem->order->phone,
        "Email" => $orderItem->order->email
      ],
      "IsInTestMode" => config('app.storage_dir')=='dev',
      "SourceId" => $orderItem->id,
      "Items" => [
        [
          "Quantity" => $orderItem->quantity,
          "SKU" => $productCode,
          "ShipCarrierMethodId" => 1,
          "Images" => [[
            "Url" => $imgUrl,
            "Index" => 0,
            "ThumbnailUrl" => $imgUrl,
            "ManipCommand" => "",
            "SpaceId" => "0"
            ]]
          ],
        ],
        "Payment" => [
          "PartnerBillingKey" => $PartnerBillingKey
        ],
        "Meta" => []
      ]);
      if($response->failed()){
        $orderItem->supplier_order_status="requestError";
        $orderItem->error_msg=$response->body();
        $orderItem->save();
      }else{
        $orderItem->status="pending";
        $orderItem->supplier_order_status="new";
        $orderItem->supplier_order_id=$response->json()['Id'];
        $orderItem->save();
      }
      dd($response->body());
    }
  }
