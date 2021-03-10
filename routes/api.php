<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/api/transloadit-results/{imgId}', 'ApiController@transloaditResults');
Route::post('/api/transloadit-results/{imgId}', 'ApiController@transloaditResults');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/get-cart-content', 'ApiController@getCartContent');
Route::post('/add-item-to-cart', 'ApiController@addItemToCart');
Route::get('/remove-item-from-cart/{rowId}', 'ApiController@removeItemFromCart');
Route::get('/image/{imgId}', 'ApiController@getImage');
Route::get('/image-like/{imgId}', 'ApiController@imageLike');
// Route::get('/image-products/{imgId}', 'ApiController@imageProducts');
Route::get('/image-by-product-id/{productId}', 'ApiController@imageByProductId');
Route::get('/username-by-product-id/{productId}', 'ApiController@usernameByProductId');
Route::get('/order/{orderId}', 'ApiController@getOrder');
Route::post('/creator-details', 'ApiController@setCreatorDetails');
Route::get('/store-details/{creatorId}', 'ApiController@getStoreDetails');
Route::get('/categories-by-creator/{creatorId}', 'ApiController@getCategoriesByCreator');
Route::get('/orders/{creatorId}', 'ApiController@getOrders');
Route::post('/store-details', 'ApiController@setStoreDetails');
Route::post('/set-bio', 'ApiController@setBio');
Route::post('/set-bio-page-bio', 'ApiController@setBioPageBio');
Route::post('/set-profile', 'ApiController@setProfile');
Route::post('/set-bio-page-links', 'ApiController@setBioPageLinks');
Route::any('/track-order', 'ApiController@trackOrder');


Route::get('/get-bluesnap-token', 'PaymentController@getBluesnapToken');
Route::post('/pay-with-credit-card', 'PaymentController@payWithCreditCard');
Route::post('/pay-with-paypal', 'PaymentController@payWithPaypal');
Route::any('/paypal-payment-succeeded/{orderId}', 'PaymentController@paypalPaymentSucceeded');
Route::any('/paypal-payment-failed/{orderId}', 'PaymentController@paypalPaymentFailed');


Route::get('/store-owner/{username}', 'ApiController@storeOwner');
Route::get('/creator/{userId}', 'ApiController@creator');
Route::get('/delete-img/{imgId}', 'ApiController@imageDelete');

Route::get('/is-empty/{creatorId}', 'ApiController@isEmpty');
Route::get('/is-first-time/{creatorId}', 'ApiController@isFirstTime');
Route::post('/image-upload', 'ApiController@imageUpload');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::post('/original-move', 'ApiController@originalMove');
Route::post('/images-upload', 'ApiController@imagesUpload');
Route::post('/edit-user', 'ApiController@editUser');
Route::post('/update-img', 'ApiController@imageUpdate');
Route::get('/get-user-images/', 'ApiController@getUserImages');
Route::get('/get-creator-templates/{creatorId}', 'ApiController@getCreatortemplates');

Route::get('/is-first-time/{userId}', 'ApiController@isFirstTime');
Route::get('/get-purchases-number', 'ApiController@getPurchasesNumber');
Route::get('/get-shop-gallery-data/{storeId}', 'ApiController@getShopGalleryData');
Route::get('/get-user-gallery-images/', 'ApiController@getUserGalleryImages');

Route::group(['namespace' => 'Shop','middleware' => []], function () {
  Route::get('/get-product-page-data/{storeId}', 'ApiController@getProductPageData');
  Route::get('/get-product-page-previews/{pid}', 'ApiController@getProductPagePreviews');
  Route::get('/get-product/{pid}', 'ApiController@getProduct');
});
