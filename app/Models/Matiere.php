<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $guarded = array('id');

    //Une matiere est associé à plusieurs classe
    public function classes(){
        return $this->belongsToMany('App\Classe');
    }

    //
    public function notes(){
        return $this->hasMany('App\Note');
    }
}