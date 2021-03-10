<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  protected $fillable = ['first_name','last_name','email','currency','country','state','city','address_1','address_2','post_code','price','shipping_price','tax'];

    public function items() {
        return $this->hasMany('App\Models\OrderItem');
    }

}
