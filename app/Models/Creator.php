<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Creator extends Model {

    protected $table = 'creators';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function bio_page() {
        return $this->hasOne('App\Models\BioPage');
    }
    public function images() {
        return $this->hasMany('App\Models\Image');
    }

}
