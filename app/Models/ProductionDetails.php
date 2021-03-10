<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionDetails extends Model {
  use \Awobaz\Compoships\Compoships;

  public function product_details() {
      return $this->belongsTo('App\Models\ProductDetails', 'product_code','product_code');
  }

}
