<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model {
use \Awobaz\Compoships\Compoships;

    public function cur_sup() {
        return $this->hasOne('App\Models\Supplier','current_supplier_id');
    }
    public function category() {
        return $this->belongsTo('App\Models\ProductCategory','category_id');
    }
    public function production_details() {
      return $this->hasOne('App\Models\ProductionDetails',['product_code','supplier_id'],['product_code','current_supplier_id']);
    }

}
