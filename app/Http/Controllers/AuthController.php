<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Creator;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Storage;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'min:8', 'confirmed']
    ]);

    $user=User::create([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);
    $chosen_products=$products_price=[];
    foreach (ProductDetails::where('is_active',1)->get() as $product) {
      $chosen_products[]=$product->product_code;
      $products_price[$product->product_code]=$product->production_details->msrp;
    }
    $creatorId=DB::table('creators')->insertGetId([
      'user_id' => $user->id,
      'username' => substr($user->email, 0, 3).'_'.substr($user->id, 0, 3),
      'bio' => 'Thanks for visiting our gallery page. Here you can find and buy content we published on tangible products. Appreciate your support!',
      'store_name' => $user->first_name.' Shop',
      'site' => "",
      'chosen_products' => json_encode($chosen_products),
      'products_price' => json_encode($products_price),
      'created_at' => date("Y-m-d H:i:s"),
      'updated_at' => date("Y-m-d H:i:s"),
    ]);
    Storage::cloud()->copy( config('app.storage_dir') . '/images/profile_img_placeholder.png', config('app.storage_dir') . '/creator_images/'.$creatorId.'.jpg', 'public');
  }
  public function login(Request $request)
  {
    $request->validate([
      'email' => ['required'],
      'password' => ['required']
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
      return response()->json(Auth::user(), 200);
    }

    throw ValidationException::withMessages([
      'email' => ['The provided credentials are incorrect.']
    ]);
  }

  public function logout()
  {
    Auth::logout();
  }
}
