<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    public function creator() {
        return $this->belongsTo('App\Models\Creator');
    }
    
}
