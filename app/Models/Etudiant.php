<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $guarded = ['id'];

    public function classe(){
        return $this->belongsTo('App\Models\Classe');
    }

    public function ecole(){
        return $this->belongsTo('App\Models\Ecole');
    }

    public function notes(){
        return $this->hasMany('App\Models\Note');
    }

    public function validationRules() {
		return [	 
			'nom'=>'required',
            'prenom'=>'required',
            'ecole'=>'required',
            'classe'=>'required',
	    ];	
	}
}