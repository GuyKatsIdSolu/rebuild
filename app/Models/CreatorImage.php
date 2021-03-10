<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CreatorImage extends Model {

    protected $table = 'images';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function creator() {
        return $this->hasOneThrough('App\Models\User','App\Models\Creator');
    }
    public function store() {
        return $this->hasOne('App\Models\Store');
    }

}
