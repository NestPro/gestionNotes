<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $guarded = ['id'];

    public function classes(){
        return $this->hasOne('App\Classe');
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
