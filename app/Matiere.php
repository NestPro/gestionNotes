<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $guarded = array('id');

    public function classes(){
        return $this->belongsToMany('App\Classe');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }
}
