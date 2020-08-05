<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    protected $fillable = ['nom', 'prenom', 'addresse'];

    public function classes(){
        return $this->belongsToMany('App\Classe');
    }

    public function ecoles(){
        return $this->belongsToMany('App\Models\Ecole');
    }
}