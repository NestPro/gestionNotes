<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $guarded = array('id');


    public function matieres(){
        return $this->belongsToMany('App\Matiere');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }
}
