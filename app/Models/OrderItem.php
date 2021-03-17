<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
  protected $fillable = ['creator_id','order_id','product_id','supplier_id',
  'status','quantity','price','discount','properties','shipping_price','tax'];
  protected $table = 'order_items';

  public function creator() {
    return $this->belongsTo('App\Models\Creator','creator_id');
  }

  public function order() {
    return $this->belongsTo('App\Models\Order');
  }

  public function product() {
    return $this->belongsTo('App\Models\Product');
  }
  public function supplier() {
      return $this->belongsTo('App\Models\Supplier');
  }

  public function template() {
    return $this->hasOneThrough(
      'App\Models\ProductTemplate',
      'App\Models\Product',
      'id',
      'product_code',
      'product_id',
      'product_code'
      )->where('supplier_id', $this->supplier_id);
    }


  }
