<?php

namespace App\Services\Cours;

use App\User;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;

class CoursService {
    public function isCourseOfTeacher($teacher_id){
        return auth()->user()->role != 'student' && $teacher_id > 0;
    }

    public function getCoursesByTeacher($teacher_id){
        return Cours::with(['classe', 'teacher'])
                        ->where('teacher_id', $teacher_id)
                        ->get();
    }

    public function updateCourseInfo($id, $request){
        $co = Cours::find($id);
        $co->name = $request->course_name;
        $co->time = $request->course_time;
        $co->save();
    }


    public function addCours($request){
        $co = new Cours;
        $co->name = $request->name;
        $co->time = $request->time;
        $co->coefficient = $request->coefficient;
        $co->teacher_id = $request->teacher_id;
        $co->classe_id = $request->classe_id;
        $co->school_id = auth()->user()->school_id;
        $co->user_id = auth()->user()->id; // qui créé le cours ?
        
        $co->save();
    }

    public function saveConfiguration($request){
        $co = Cours::find($request->id);
        $co->name = $request->name;
        $co->time = $request->time;
        $co->coefficient = $request->coefficient;
        $co->save();
    }
}