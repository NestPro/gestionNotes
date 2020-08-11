<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Model;

class Classe extends Model
{
    protected $table = "classes";
    
    protected $fillable = ['code', 'nom', 'school_id',];

    
    public function students(){
        return $this->hasMany('App\Models\StudentInfo');
    }

    public function cours(){
        return $this->hasMany('App\Models\Cours');
    }

    public function school(){
        return $this->belongsTo('App\Models\School');
    }

    public function scopeBySchool($query, int $school_id){
        return $query->where('school_id', $school_id);
    }

}