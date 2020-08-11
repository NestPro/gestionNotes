<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Model;

class School extends Model
{
    protected $fillable = ['name', 'address', 'about', 'code'];

    public function users(){
        return $this->hasMany('App\User');
    }
    
    public function classes(){
        return $this->hasMany('App\Models\Classe');
    }
    
    public function scopeBySchool($query, int $school_id){
        return $query->where('school_id', $school_id);
    }
}