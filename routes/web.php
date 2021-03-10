<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Image;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductTemplate;
use App\Models\TemplateIndex;
use App\Models\OrderItem;
use App\Jobs\TransloaditResults;
use App\Jobs\TransloaditJob;
use Aws\Rekognition\RekognitionClient;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  dd($request);
  return $request->user();
});
Route::get('/storage/{else?}', function ($else) {
  if(Str::endsWith($else, ['_1white.jpg', '_2white.jpg','_3white.jpg','_4white.jpg'])){
    $else=Str::replaceLast('white.jpg','.jpg',$else);
  }
  $else = config('app.storage_dir') . '/' . $else;

  $filename = basename(Storage::cloud()->url($else));
  $file_extension = strtolower(substr(strrchr($filename, "."), 1));
  switch ($file_extension) {
    case "gif": $ctype = "image/gif";
    break;
    case "png": $ctype = "image/png";
    break;
    case "jpeg":
    case "jpg": $ctype = "image/jpeg";
    break;
    case "css": $ctype = "text/css";
    break;
    default: $ctype = "text/plain";
    break;
  }

  header('Content-type: ' . $ctype);
  echo Storage::cloud()->get($else);
  return;
})->where('else', '(.*)');
Route::get('/', function () {
  return view('welcome');
});
Route::get('message', function () {
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
});
Route::get('/test', 'ApiController@test');
Route::any('@{slug}', function () { // Image gallery
  return view('welcome');
});
Route::any('admin/{slug}', function () {
  return view('welcome');
});
Route::any('{slug}', function () {
  return view('welcome');
});
// Route::any('/catalog/{slug}', function () {
//   return view('welcome');
// });
