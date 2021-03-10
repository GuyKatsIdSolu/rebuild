<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BioPage extends Model {
  public $timestamps = false;
  protected $table = 'bio_page';
  protected $fillable = ['creator_id','bio','link_1','link_2','link_3','link_4','link_5'];

    public function creator() {
        return $this->belongsTo('App\Models\Creator');
    }

}
