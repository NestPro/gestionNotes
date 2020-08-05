<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    protected $fillable = ['nom', 'addresse'];

    public function classes(){
        return $this->hasMany('App\Models\Classe');
    }

    public function profs(){
        return $this->hasMany('App\Models\Prof');
    }

    public function etudiants(){
        return $this->hasMany('App\Models\Etudiant');
    }
}