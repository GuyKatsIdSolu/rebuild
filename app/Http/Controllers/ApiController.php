<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\ProductDetails;
use App\Models\ProductCategory;
use App\Models\Creator;
use App\Models\BioPage;
use App\Models\Image;
use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductionDetails;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\TransloaditJob;
use App\Jobs\TransloaditResults;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use GuzzleHttp;
use GuzzleHttp\Client;
use Storage;
use Cart;
use Str;
use Jenssegers\Agent\Agent;
use transloadit\Transloadit;

class ApiController extends Controller
{
  use \App\Traits\PreviewsController;
  use \App\Traits\SendToProduction;
  // -----------------Api---------------------------
  public function transloaditResults($ImageId, Request $request){
    dd(dispatch(new TransloaditResults($ImageId)));
  }
  // -----------------/Api--------------------------

  public function test(){
       // $this->sendToSupplier(3);
    // $this->displaceOverlay();
    // for ($i=1; $i < 80 ; $i++) {
    //   // echo $i;
      $this->createPreviews(Product::find(8));
    // }
    dd('done');
  }
  public function removeItemFromCart($rowId){
    \Cart::remove($rowId);
    return \json_encode(\Cart::content());
  }
  public function usernameByProductId($productId){
    return Product::find($productId)->creator->username;
  }
  public function getStoreDetails($creatorId){
    return ProductDetails::with(['category','production_details'])->get();
  }
  public function getOrders($creatorId){
    return OrderItem::with(['order','product','product.details','product.details.production_details'])->where('creator_id',$creatorId)->paginate(10);
  }
  public function getOrder($orderId){
    return Order::with(['items','items.creator','items.product','items.product.details'])->find($orderId);
  }
  public function setBioPageBio(request $request){
    DB::table('bio_page')->where('creator_id',$request->creatorId)->update([
      'bio'=>$request->bio? $request->bio : '',
    ]);
  }
  public function setProfile(request $request){
    $creator=Creator::find($request->creatorId);
    DB::table('users')->where('id',$creator->user_id)->update([
      'first_name'=>$request->first_name,
      'last_name'=>$request->last_name,
    ]);
    $toUpdate=[
      'username'=>$request->username,
      'store_name'=>$request->store_name? $request->store_name : ''
    ];
    foreach ($request->links as $key => $value) {
      $toUpdate[$key]=\json_encode(['url'=>$value,'status'=>1]);
    }
    DB::table('creators')->where('id',$creator->id)->update($toUpdate);
    if($request->imgChanged && Storage::cloud()->has( config('app.storage_dir') . '/test/'.$creator->id.'.jpg')){
      Storage::cloud()->delete(config('app.storage_dir') . '/creator_images/'.$creator->id.'.jpg');
      Storage::cloud()->move( config('app.storage_dir') . '/test/'.$creator->id.'.jpg',config('app.storage_dir') . '/creator_images/'.$creator->id.'.jpg', 'public');
    }
  }
  public function setBioPageLinks(request $request){
    $updated=[];
    foreach (json_decode($request->links,true) as $key => $value) {
      $updated[$key]=\json_encode($value);
    }
    return DB::table('bio_page')->where('creator_id',$request->creatorId)->update($updated);
  }
  public function trackOrder(request $request){
    if(!OrderItem::find($request->itemId)){
      return ['error'=>'Item id does not exist'];
    }
    $item=OrderItem::with(['order','product','product.details'])->find($request->itemId);
    if(Str::lower($item->order->email)!=Str::lower($request->email)){
      return ['error'=>'Wrong email address'];
    }
    return $item;

  }
  public function setStoreDetails(request $request){
    $creator=Creator::find($request->creatorId);
    $creator->chosen_products=$request->chosenProducts;
    $creator->products_price=$request->productsPrice;
    $creator->save();
  }
  public function setBio(request $request){
    $creator=Creator::find($request->creatorId);
    $creator->bio=$request->bio;
    $creator->save();
  }
  public function setCreatorDetails(request $request){
    $creator=Creator::find($request->creator_id);
    $creator->store_name=$request->store_name;
    $creator->username=$request->username;
    foreach (\json_decode($request->social) as $key=>$val) {
      $creator->{$key}=$val;
    }
    $creator->save();
    $bioPage=BioPage::where('creator_id',$request->creator_id)->first();
    $bioPage=BioPage::where('creator_id',1)->first();
    foreach (\json_decode($request->links) as $i=>$link) {
      if($link->title!='' && $link->url!=''){
        $link->status=1;
      }
      $bioPage->{'link_'.$i}=\json_encode($link);
    }
    $bioPage->save();
  }
  public function addItemToCart(request $request){
    $product = Product::find($request->productId);
    $options=[];
    $options['shippingPrice'] = 0;
    $options['taxPrice'] = 0;
    $options['discount'] = $product->creator->discount;
    $options['previewUrl'] = $request->previewUrl;
    $options['properties'] = $request->properties;
    Cart::add([
      'id' => $product->id,
      'name' => $product->details->title,
      'qty' => $request->quantity,
      'weight' => 0,
      'price' => $request->price,
      'options' => $options,
    ]);
    return \json_encode(\Cart::content());
  }
  public function getCartContent(){
    return \json_encode(Cart::content());
  }
  public function storeOwner($username){
    return Creator::with([
      'user'  => function($query) {
        $query->select(['first_name','last_name','id']);
      },
      'images',
      'bio_page',
    ])
    ->where('username',$username)->first();
  }
  public function getImage($ImageId){
    return Image::with(['creator',
    'creator.user'  => function($query) {
      $query->select(['first_name','last_name','id']);
    },
    'creator.images',
    'products',
    'products.details',
    'products.details.category',
  ])
  ->find($ImageId);
}
public function imageDelete($ImageId){
  Product::where('image_id',$ImageId)->delete();
  Image::find($ImageId)->delete();
  Storage::cloud()->deleteDirectory(config('app.storage_dir') . '/creator_images/'.$ImageId);
}
public function imageLike($ImageId){
  Image::where('id',$ImageId)->update(
    [
      'likes'=>DB::raw('likes+1'),
    ]
  );
}
public function getCategoriesByCreator($creatorId){
  $categories=[];
  foreach (json_decode(Creator::find($creatorId)->chosen_products) as $productCode) {
    $product=ProductDetails::with(['category','category.dady'])->where('product_code',$productCode)->first();
    if($product->category->dady){
      if(!isset($categories[$product->category->dady->id])){
        $categories[$product->category->dady->id]=[];
      }
      $categories[$product->category->dady->id][]=$product->category;
    }
    else{
      $categories[$product->category_id]=$product->category;
    }
  }
  return $categories;
}
// public function imageProducts($ImageId){
//   $products = Product::with(['details','details.category','details.production_details'])->where('image_id',$ImageId)->get();
//   return $products;
// }
public function imageByProductId($productId){
  return Image::with(['creator',
  'creator.user'  => function($query) {
    $query->select(['first_name','last_name','id']);
  },
  'creator.images',
  'products',
  'products.details',
  'products.details.category',
  'products.details.production_details',
  'creator.images.products',
  'creator.images.products.details',
])
->find(Product::find($productId)->image_id);
}
public function editUser(Request $request)
{
  $creator=Creator::where('user_id', $request->uid)->first();
  if($request->store_name!='undefined' && $request->store_name!='' ) $creator->store_name=$request->store_name;
  else $creator->store_name=$creator->username.' Shop';
  if($request->facebook_username!='undefined' && $request->facebook_username!='') $creator->facebook_username=$request->facebook_username;
  if($request->twitter_username!='undefined' && $request->twitter_username!='') $creator->twitter_username=$request->twitter_username;
  if($request->instagram_username!='undefined' && $request->instagram_username!='') $creator->instagram_username=$request->instagram_username;
  if($request->pinterest_username!='undefined' && $request->pinterest_username!='') $creator->pinterest_username=$request->pinterest_username;
  if($request->tumblr_username!='undefined' && $request->tumblr_username!='') $creator->tumblr_username=$request->tumblr_username;
  if($request->youtube_username!='undefined' && $request->youtube_username!='') $creator->youtube_username=$request->youtube_username;
  if($request->reddit_username!='undefined' && $request->reddit_username!='') $creator->reddit_username=$request->reddit_username;
  if($request->flickr_username!='undefined' && $request->flickr_username!='') $creator->flickr_username=$request->flickr_username;
  if($request->behance_username!='undefined' && $request->behance_username!='') $creator->behance_username=$request->behance_username;
  $creator->save();
  return json_encode(['status'=>'boom']);
}
public function getUserImages(Request $request){
  $search=$request->search;

  $status=[$request->status];
  if($status=='pending') $status[]='autoNotApproved';
  return Image::with(
    'products',
    'products.details',
    'products.details.category',
    'products.details.production_details'
    )
  ->where(function ($query) use ($search) {
    $query->where('name', 'like', '%'.$search.'%')
    ->orWhere('tags',  'like', '%#'.$search.'%')
    ->orWhere('id', $search);
  })
  ->orderBy('created_at', 'desc')
  ->whereIn('status', $status)
  ->where('creator_id',$request->creatorId)->paginate(10);
}
// public function getUserImages(Request $request){
//   $search=$request->search;
//   $status=$request->status;
//   $relatedTags = [];
//   $products = [];
//   $imgs;
//   if($status=="pending"){
//     $imgs = DB::table('images')
//     ->whereIn('status', ['pending','autoNotApproved'])
//     ->where('creator_id', $request->creatorId)
//     ->where(function ($query) use ($search) {
//       $query->where('name', 'like', '%'.$search.'%')
//       ->orWhere('tags',  'like', '%#'.$search.'%')
//       ->orWhere('id', $search);
//     })
//     ->orderBy('created_at', 'desc')
//     ->select('id', 'creator_id', 'tags', 'description', 'name', 'status' ,'likes')
//     ->paginate($request->perPage?$request->perPage:12);
//     foreach ($imgs as $img) {
//       $tags = explode('#', $img->tags);
//       array_shift($tags);
//       foreach ($tags as $tag) {
//         if (!isset($relatedTags[$tag])) {
//           $relatedTags[$tag] = 1;
//         }
//       }
//     }
//   }else if($status=="approved"){
//     $imgs = DB::table('images')
//     ->where('creator_id', $request->creatorId)
//     ->where(function ($query) use ($search) {
//       $query->where('name', 'like', '%'.$search.'%')
//       ->orWhere('tags',  'like', '%#'.$search.'%')
//       ->orWhere('id', $search);
//     })
//     ->where('status', $request->status)
//     ->orderBy('created_at', 'desc')
//     ->select('id', 'creator_id', 'tags', 'description', 'name', 'status' ,'likes')
//     ->paginate($request->perPage?$request->perPage:12);
//
//     $relatedTags = [];
//     foreach ($imgs as $img) {
//       $products[$img->id]=Product::with('details','details.category')->where('image_id',$img->id)->get();
//       $tags = explode('#', $img->tags);
//       array_shift($tags);
//       foreach ($tags as $tag) {
//         if (!isset($relatedTags[$tag])) {
//           $relatedTags[$tag] = 1;
//         }
//       }
//     }
//   }else{
//     $imgs = DB::table('images')
//     ->where('creator_id', $request->creatorId)
//     ->where(function ($query) use ($search) {
//       $query->where('name', 'like', '%'.$search.'%')
//       ->orWhere('tags',  'like', '%#'.$search.'%')
//       ->orWhere('id', $search);
//     })
//     ->where('status', 'notApproved')
//     ->orderBy('created_at', 'desc')
//     ->select('id', 'creator_id', 'tags', 'description', 'name', 'status' ,'likes')
//     ->paginate($request->perPage?$request->perPage:12);
//     $relatedTags = [];
//     foreach ($imgs as $img) {
//       $tags = explode('#', $img->tags);
//       array_shift($tags);
//       foreach ($tags as $tag) {
//         if (!isset($relatedTags[$tag])) {
//           $relatedTags[$tag] = 1;
//         }
//       }
//     }
//   }
//   $relatedTags = array_keys($relatedTags);
//   return [
//     "imgs"=>$imgs,
//     "tags"=>$relatedTags,
//     "products"=>$products,
//   ];
// }
public function creator($userId){
  return Creator::with('bio_page')->where('user_id',$userId)->first();
}
public function tests(){
  dd('tests');
}
public function isEmpty($creatorId){
  return Image::where('creator_id',$creatorId)->first()? 0 : 1;
}
public function originalMove(Request $request){
  $imgs_id=$names=[];
  foreach ($request->results as $img) {
    $step_name=$img['stepName'];
    if($img['stepName']==':original'){
      $image_name=substr($img['basename'], 0, 5);
      $names[]=$img['basename'];
      if($img['meta']['width']<1000 || $img['meta']['height']<1000){
        $imgs_id[$img['basename']]=0;
        continue;
      }
      $averageColor=isset($img['meta']['average_color'])? $img['meta']['average_color'] : '';
      $imgs_id[$img['basename']] = Image::create(
        [
          'creator_id' => 0,
          'status' => 'preUploaded',
          'name' => '',
          'description' => '',
          'tags' => '',
          'width' => $img['meta']['width'],
          'height' => $img['meta']['height'],
          'ratio' => (float)$img['meta']['aspect_ratio'],
          'average_color' => $averageColor,
        ]
        )->id;
        $step_name='original';
      }
      if($imgs_id[$img['basename']]==0){
        continue;
      }
      if($img['stepName']=='described'){
        if(Storage::cloud()->has(config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/tags.json')){
          Storage::cloud()->delete(config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/tags.json');
        }
        Storage::cloud()->move( config('app.storage_dir') . '/test/'.$img['id'].'.json',config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/tags.json', 'public');
        continue;
      }
      if(Storage::cloud()->has(config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/'.$step_name.'.jpg')){
        Storage::cloud()->delete( config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/'.$step_name.'.jpg');
      }
      Storage::cloud()->move( config('app.storage_dir') . '/test/'.$img['id'].'.'.$img['ext'],config('app.storage_dir') . '/creator_images/'.$imgs_id[$img['basename']].'/'.$step_name.'.jpg', 'public');
    }
    return json_encode($imgs_id);
  }
  public function imageUpload(Request $request){
    $creator_id = $request->creator_id;
    $tags=$request->tags ? $request->tags : '';
    $tags='#'.str_replace(',', '#', $tags);
    $response;
    // $img_name = $request->name ? $request->name :'';
    // $img_name = $request->name ? $request->name : pathinfo($request->file('img')->getClientOriginalName(), PATHINFO_FILENAME);
    $ImageId=$request->imgId;
    Image::where('id',$ImageId)->update(
      [
        'creator_id' => $creator_id,
        'name' => $request->name ? $request->name :'',
        'tags' => $tags,
        'description' => $request->description ? $request->description : '',
        // 'path' => '',
        'status' => 'pending',
      ]
    );
    dispatch(new TransloaditJob($ImageId));
    return json_encode([
      'index'=>$request->index,
      'imgId'=>$ImageId,
    ]);
  }


}
