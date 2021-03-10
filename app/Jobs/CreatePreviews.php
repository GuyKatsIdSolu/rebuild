<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

use Auth;
use Storage;


class CreatePreviews implements ShouldQueue {

  use Dispatchable,
  InteractsWithQueue,
  Queueable,
  SerializesModels;

  private $product;
  public $tries = 1;
  public $timeout = 3000;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($product) {
    $this->product = $product;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle() {
    $this->createPreviews($this->product);
  }
  function createPreviews($product){
    $this->product=$product;
    if(!$product || !$product->details) return;
    $overlayPath =  strtolower(config('app.storage_dir') . '/rebuild/overlays/'.$product->details->category->name.'/'.$product->product_code.'/');
    $imgPath= config('app.storage_dir') . '/creator_images/' . $product->image_id . '/1000C.jpg';
    $outFile=config('app.storage_dir') . '/creator_images/' . $this->product->image_id . '/previews/'.$this->product->product_code;
    $reso=1100;
    $img = new \Imagick();
    $img->readImageBlob(Storage::cloud()->get($imgPath));

    $resize_method="stretch";
    $imageWidth=1100;
    $imageHeight=1100;
    $imageRatio=1;
    $ratioName=$this->ratioToName($product->image->ratio);
    switch ($ratioName) {
      case 'portrait':
      $imageWidth=733;
      $imageHeight=1100;
      $imageRatio=0.66;
      break;
      case 'landscape':
      $imageWidth=1100;
      $imageHeight=733;
      $imageRatio=1.5;
      break;

      default:
      // code...
      break;
    }
    // $imageWidth=$product->details->image_width;
    // $imageHeight=$product->details->image_height;
    // $imageRatio=$product->details->image_ratio;

    switch ($resize_method) {
      case 'bestFit':
      $img->thumbnailImage($reso*$imageRatio,$reso, 1,1);
      break;
      case 'fit':
      $img->adaptiveResizeImage($reso*$imageRatio,$reso, 1);
      break;
      case 'crop':
      $this->crop($img,$reso*$imageRatio,$reso);
      break;
      case 'stretch':
      $img->adaptiveResizeImage($reso*$imageRatio,$reso);
      break;
      default:
      $img->adaptiveResizeImage($reso*$imageRatio,$reso, 1);
      break;
    }
    $toWrite=false;
    switch ($product->product_code) {
      case 'champion-hoodie-s700':
      switch ($ratioName) {
        case 'portrait':
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',275,$imageRatio,407,352);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',275,$imageRatio,430,370);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',275,$imageRatio,407,352,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'lane-seven-4001':
      switch ($ratioName) {
        case 'square':
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',260,$imageRatio,400,455);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',260,$imageRatio,400,455);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',260,$imageRatio,400,455,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',330,$imageRatio,363,462);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',330,$imageRatio,363,462);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',330,$imageRatio,363,462,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'gildan-18500b':
      switch ($ratioName) {
        case '':
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',260,$imageRatio,415,380);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',260,$imageRatio,415,380);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',260,$imageRatio,415,380,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'bella-canvas-ls14004':
      switch ($ratioName) {
        case 'portrait':
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',300,$imageRatio,410,300);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img,$overlayPath.'white.jpg',300,$imageRatio,410,300);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img,$overlayPath.'black.jpg',300,$imageRatio,410,300,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',300,$imageRatio,410,330);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img,$overlayPath.'white.jpg',300,$imageRatio,410,330);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img,$overlayPath.'black.jpg',300,$imageRatio,410,330,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }

      break;
      case 'champion-s600':
      switch ($ratioName) {
        case 'portrait':
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',360,$imageRatio,365,200);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',360,$imageRatio,365,200);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',360,$imageRatio,365,200,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',374,$imageRatio,357,240);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',374,$imageRatio,357,240);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',374,$imageRatio,357,240,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'champion-t-shirt':
      switch ($ratioName) {
        case 'portrait':
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',330,$imageRatio,395,250);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',330,$imageRatio,395,250);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',330,$imageRatio,395,250,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',352,$imageRatio,382,264);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',352,$imageRatio,382,264);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',352,$imageRatio,382,264,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'gildan-18000b':
      switch ($ratioName) {
        case 'portrait':
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',310,$imageRatio,400,250);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',310,$imageRatio,400,250);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',310,$imageRatio,400,250,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',352,$imageRatio,381,264);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',352,$imageRatio,381,264);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',352,$imageRatio,381,264,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'gildan-500':
      switch ($ratioName) {
        case '':
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',341,$imageRatio,363,275);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',341,$imageRatio,363,275);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',341,$imageRatio,363,275,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'gildan-500-kids':
      switch ($ratioName) {
        case '':
        break;
        default:
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white-g.jpg',264,$imageRatio,423,352);
        $this->prevForBanner($toWrite);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'white.jpg',264,$imageRatio,423,352);
        $this->saveMultipleSizes($toWrite,1);
        $toWrite = $this->displaceOverlay($img, $overlayPath.'black.jpg',264,$imageRatio,423,352,true);
        $this->saveMultipleSizes($toWrite,1,'black');
        break;
      }
      break;
      case 'canvas-30-20':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png', 960, 88,218);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 88,218);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 490, 328,240,true);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-36-24':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png', 960, 88,218);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 88,218);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 600, 272,235);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-18-12':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png', 960, 88,218);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 88,218);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 300, 418,305);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-12-12':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',952, 76,72);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 952, 76,72);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 201, 451,304);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-16-16':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',952, 76,72);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 952, 76,72);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 267, 418,270);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-20-20':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',952, 76,72);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 952, 76,72);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 335, 385,235);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-12-18':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',960, 252,64);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png', 960, 252,64);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 252,64);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 310, 465,250);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-24-36':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',960, 252,64);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 252,64);
      $this->saveMultipleSizes($toWrite,1);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 600, 355,73);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'canvas-20-30':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',960, 252,64);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 252,64);
      $this->saveMultipleSizes($toWrite,1);
      //tofix
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 505, 385,155);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'posters-36-24':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',950, 70,234);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 950, 70,234);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 618, 138,137);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'posters-48-32':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',950, 70,234);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 950, 70,234,1);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 815, 25,70);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'posters-24-36':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',960, 230,70);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 230,70);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 610, 203,175);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'posters-32-48':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',960, 230,70);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 960, 230,70);
      $this->saveMultipleSizes($toWrite,1);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'2.png', 807, 133,57);
      $this->saveMultipleSizes($toWrite,2);
      break;
      case 'aop-tote-bag':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',582, 265,440);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png', 582, 265,440);
      $this->saveMultipleSizes($toWrite,1);
      break;
      case 'face-mask-zuni-s0001':
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main-g.png',910, 100,318);
      $this->prevForBanner($toWrite);
      $toWrite = $this->putOverlay(clone $img, $overlayPath.'main.png',910, 100,318);
      $this->saveMultipleSizes($toWrite,1);
      break;
      default:
      return;
      dd($product->product_code.' not exists!' );
      break;
    }
    $firstProductOnCategory=Product::join("product_details","product_details.product_code","=","products.product_code")
    ->where('products.image_id',$product->image_id)
    ->where('product_details.category_id',$product->details->category_id)
    ->first();

    if($toWrite && $firstProductOnCategory->id==$product->id){
      $this->createSharePreviews($toWrite,$product);
    }
  }
  public function createSharePreviews($imgPreview,$product){
    $imgPreview->resizeImage(700, 700, \Imagick::FILTER_BOX, 1, 1);
    $post = $imgPreview;
    $story = clone $imgPreview ;
    $creatorImage=$product->image;
    $productDetails=$product->details;
    $pMask = new \Imagick();
    $pMask->readImageBlob(Storage::cloud()->get(config('app.storage_dir') . '/overlays/instagram-post-rubric.png'));
    $pMask->resizeImage(700, 700, \Imagick::FILTER_BOX, 1, 1);

    $sMask = new \Imagick();
    $sMask->readImageBlob(Storage::cloud()->get(config('app.storage_dir') . '/overlays/instagram-story-rubric.png'));
    $sMask->resizeImage(700, 1240, \Imagick::FILTER_BOX, 1, 1);

    $white_bg = new \Imagick();
    $white_bg->newImage(700, 1240, new \ImagickPixel('white'));
    $white_bg->setImageFormat("jpeg");

    $post->compositeImage($pMask, \Imagick::COMPOSITE_DEFAULT,0, 0);
    $white_bg->compositeImage($sMask, \Imagick::COMPOSITE_DEFAULT,0, 0);
    $white_bg->compositeImage($story, \Imagick::COMPOSITE_DEFAULT, 0, 0, \Imagick::CHANNEL_ALPHA);

    $text_obj = new \ImagickDraw();
    $text_obj->setFontSize(22);
    $text_obj->setFont(public_path() . '/fonts/OpenSans-Bold.ttf');
    $text_obj->setTextEncoding('UTF-8');
    $text_obj->setFillColor('#ffffff');
    $post->annotateImage($text_obj, 50 , 620, 0, 'Image '.$creatorImage->id.' on '.$productDetails->category->name);
    $text_obj->setFontSize(30);
    $white_bg->annotateImage($text_obj, 50 , 885, 0, 'Image '.$creatorImage->id.' on '.$productDetails->category->name);
    $text_obj->setFontSize(22);
    $text_obj->setFont(public_path() . '/fonts/OpenSans-SemiBold.ttf');
    $post->annotateImage($text_obj, 50 , 650, 0, 'Get it in my Bio link and/or at');
    $post->annotateImage($text_obj, 50 , 680, 0, 'Https://my.artigram.me/@'.$product->creator->username);
    $post->setImageFormat('jpg');
    $text_obj->setFontSize(30);
    $white_bg->annotateImage($text_obj, 50 , 923, 0, 'Get it in my Bio link and/or at');
    $white_bg->annotateImage($text_obj, 50 , 961, 0, 'Https://my.artigram.me/@'.$product->creator->username);
    $white_bg->setImageFormat('jpg');
    Storage::cloud()->put(config('app.storage_dir') . '/creator_images/' . $product->image_id . '/previews/categories/'.$productDetails->category_id.'/post/700.jpg', (string) $post, 'public');
    Storage::cloud()->put(config('app.storage_dir') . '/creator_images/' . $product->image_id . '/previews/categories/'.$productDetails->category_id.'/story/700.jpg', (string) $white_bg, 'public');
  }
  public function putOverlay($base, $overlayPath,$w,$x,$y,$opacity=false,$reso=1100){
    $overlay = new \Imagick();
    $overlay->readImageBlob(Storage::cloud()->get($overlayPath));
    if($opacity) $overlay->evaluateImage(\Imagick::EVALUATE_MULTIPLY, 0.7, \Imagick::CHANNEL_ALPHA);
    $white_bg = new \Imagick();
    $white_bg->newImage($reso, $reso, new \ImagickPixel('white'));
    $base->adaptiveResizeImage($w, $w, 1);
    $white_bg->compositeImage($base, \Imagick::COMPOSITE_DEFAULT, $x, $y,\Imagick::CHANNEL_ALPHA);
    $white_bg->setImageFormat('jpg');
    $white_bg->compositeImage($overlay,\Imagick::COMPOSITE_OVER   , 0, 0);
    $this->removeBackground($white_bg,'#00b140');
    $white_bg->brightnessContrastImage(-7, 10, \Imagick::CHANNEL_ALL);

    return $white_bg;
  }
  public function displaceOverlay($base=false, $overlayPath,$w,$ratio,$x,$y,$blackElement=false,$reso=1100){
    $shirtPath = config('app.storage_dir') . '/test/VYLZsoD.jpg';
    // $shirtPath = config('app.storage_dir') . '/creator_images/1/shirt.jpg';
    $logoPath= config('app.storage_dir') . '/test/aa1000.jpg';
    $shirt = new \Imagick();
    $shirt->readImageBlob(Storage::cloud()->get($overlayPath));
    $shirt->adaptiveResizeImage($reso, $reso, 1);
    $displaceMap =clone $shirt;
    $displaceMap->setImageFormat('jpg');
    $displaceMap->cropImage ($w,$w/$ratio,$x,$y );
    $displaceMap->setImageColorspace(1);

    $lightMap=clone $displaceMap;
    for ($i=0; $i <10 ; $i++) {
      $displaceMap->blurImage(10,100);
    }
    $displaceMap->autoLevelImage();
    $lightMap->blurImage(4,50);// $lightMap->blurImage(2,50);
    // $this->show($lightMap);
    if($blackElement || 1){
      $lightMap->autoLevelImage();
      $lightMap->brightnessContrastImage(65, -55, \Imagick::CHANNEL_ALL);
    }
    $logo = clone $base;
    if(!$blackElement){
      $this->removeBackground($logo,'#ffffff');
    }
    // $this->removeBackground($shirt,'#00b140',0.27);
    // $logo = new \Imagick();
    // $logo->readImageBlob(Storage::cloud()->get($logoPath));
    // $logo->setbackgroundcolor(new \ImagickPixel('transparent'));
    // $logo->setImageAlphaChannel(\Imagick::ALPHACHANNEL_SET );
    $logo->thumbnailImage($w,$w/$ratio,1);
    $logo->evaluateImage(\Imagick::EVALUATE_MULTIPLY, 0.95, \Imagick::CHANNEL_ALPHA);
    $logo->setImageVirtualPixelMethod(\Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
    $logo->setImageArtifact('compose:args', "-5x-5");
    $logo->compositeImage($displaceMap, \Imagick::COMPOSITE_DISPLACE, 0, 0);

    // $imageDisplace=clone $logo;
    // $logo->separateImageChannel(\Imagick::CHANNEL_ALPHA  );
    $logo->compositeImage($lightMap, \Imagick::COMPOSITE_MULTIPLY, 0, 0,\Imagick::CHANNEL_DEFAULT        );

    // $logo->compositeImage($imageDisplace, \Imagick::COMPOSITE_MULTIPLY, 0, 0,\Imagick::CHANNEL_DEFAULT  );
    $shirt->compositeImage($logo, \Imagick::COMPOSITE_OVER, $x,$y);
    return $shirt;
  }
  public function crop($image, $new_w, $new_h, $focus = 'center'){
    $w = $image->getImageWidth();
    $h = $image->getImageHeight();

    if ($w > $h) {
      $resize_w = $w * $new_h / $h;
      $resize_h = $new_h;
    }
    else {
      $resize_w = $new_w;
      $resize_h = $h * $new_w / $w;
    }
    $image->adaptiveResizeImage($resize_w, $resize_h,1);
    switch ($focus) {
      case 'northwest':
      $image->cropImage($new_w, $new_h, 0, 0);
      break;

      case 'center':
      $image->cropImage($new_w, $new_h, ($resize_w - $new_w) / 2, ($resize_h - $new_h) / 2);
      break;

      case 'northeast':
      $image->cropImage($new_w, $new_h, $resize_w - $new_w, 0);
      break;

      case 'southwest':
      $image->cropImage($new_w, $new_h, 0, $resize_h - $new_h);
      break;

      case 'southeast':
      $image->cropImage($new_w, $new_h, $resize_w - $new_w, $resize_h - $new_h);
      break;
    }
  }
  public function prevForBanner($img){
    $this->removeBackground($img,'#00b140');
    $path=config('app.storage_dir') . '/creator_images/' . $this->product->image_id . '/previews/'.$this->product->product_code;
    $img->resizeImage(250, 250, \Imagick::FILTER_BOX, 1, 1);
    Storage::cloud()->put($path.'/banner.png', (string) $img, 'public');
  }
  public function saveMultipleSizes($img,$number,$color=''){
    $img= clone $img;
    $path=config('app.storage_dir') . '/creator_images/' . $this->product->image_id . '/previews/'.$this->product->product_code;
    Storage::cloud()->put($path.'/1000_'.$number.$color.'.jpg', (string) $img, 'public');
    $img->resizeImage(500, 500, \Imagick::FILTER_BOX, 1, 1);
    Storage::cloud()->put($path.'/500_'.$number.$color.'.jpg', (string) $img, 'public');
    $img->resizeImage(80, 80, \Imagick::FILTER_BOX, 1, 1);
    Storage::cloud()->put($path.'/80_'.$number.$color.'.jpg', (string) $img, 'public');
  }
  public function removeBackground($img,$color,$wide=0.1){
    $img->setImageFormat("png");
    $img->transparentPaintImage(
      $color, 0, $wide * \Imagick::getQuantum(), 0
    );
  }
  public function ratioToName($ratio){
    if($ratio<0.9) return 'portrait';
    if($ratio>1.1) return 'landscape';
    return 'square';
  }
}
