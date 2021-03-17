<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model {

  protected $fillable = ['product_code','creator_id','image_id'];

    public function details() {
        return $this->belongsTo('App\Models\ProductDetails','product_code','product_code');
    }
    public function properties() {
        return $this->hasMany('App\Models\ProductProperties','product_code','product_code');
    }
    public function creator() {
        return $this->belongsTo('App\Models\Creator');
    }
    public function image() {
        return $this->belongsTo('App\Models\Image');
    }
}
