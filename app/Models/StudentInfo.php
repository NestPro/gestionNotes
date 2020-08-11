<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Model;

class StudentInfo extends Model
{
    protected $table = 'student_infos';
    protected $fillable = ['student_id'];
    /**
     * Get the student record associated with the user.
    */
    public function student(){
        return $this->belongsTo('App\User');
    }

    public function scopeBySchool($query, int $school_id){
        return $query->where('school_id', $school_id);
    }
}
