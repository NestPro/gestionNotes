<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    protected $fillable = ['nom', 'addresse'];

    public function classes(){
        return $this->hasMany('App\Classe');
    }

    public function profs(){
        return $this->hasMany('App\Prof');
    }
}
