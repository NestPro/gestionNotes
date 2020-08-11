<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    /**
     * Get the class record associated with the user.
    */
    public function class()
    {
        return $this->belongsTo('App\Models\Classe');
    }
    
    /**
     * Get the teacher record associated with the user.
    */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function scopeOfSchool($query, int $school_id){
        return $query->where('school_id', $school_id);
    }
}
