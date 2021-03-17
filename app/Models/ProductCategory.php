<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {
  public function dady() {
      return $this->hasOne('App\Models\ProductCategory','id','parent');
  }
}
