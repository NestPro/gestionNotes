<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $guarded = array('id');


    public function matieres(){
        return $this->belongsToMany('App\Models\Matiere');
    }

    public function profs(){
        return $this->hasMany('App\Models\Prof');
    }

    public function etudiants(){
        return $this->hasMany('App\Models\Etudiant');
    }

    public function ecole(){
        return $this->belongsTo('App\Models\Ecole');
    }

}