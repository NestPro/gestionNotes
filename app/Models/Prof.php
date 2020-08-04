<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    protected $guarded = array('id');

    public function classes(){
        return $this->belongsToMany('App\Classe');
    }
}
