<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = array('id');

    public function classes() {
		return $this->belongsTo('App\Classe');
	}
	
	public function matieres() {
		return $this->belongsTo('App\Matiere');
    }
    
    public function validationRules() {
		return [	 
			'classe_id'=>'required',
			'matiere_id'=>'required',
            'etudiant_id'=>'required',
            'note'=> 'numeric',
	    ];
	}
}
