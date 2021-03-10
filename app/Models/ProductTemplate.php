<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTemplate extends Model {
  use \Awobaz\Compoships\Compoships;
  
  public function templateIndex() {
      return $this->belongsTo('App\Models\TemplateIndex', 'product_code','product_code');
  }

}
