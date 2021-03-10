<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Image extends Model {
  protected $fillable = ['status','creator_id','name','description','tags','width','height','ratio','average_color'];

    public function creator() {
        return $this->belongsTo('App\Models\Creator');
    }
    public function products() {
        return $this->hasMany('App\Models\Product');
    }

}
