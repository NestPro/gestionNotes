<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::user()->role != 'master') {
            $secondes = 3600;
            $school_id = \Auth::user()->school->id;
           
            $totalStudents = \Cache::remember('totalStudents-'.$school_id, $secondes, function () use($school_id) {
              return \App\User::ofSchool($school_id)
                              ->where('role','student')
                              ->where('active', 1)
                              ->count();
            });
            $totalTeachers = \Cache::remember('totalTeachers-'.$school_id, $secondes, function () use($school_id) {
              return \App\User::ofSchool($school_id)
                              ->where('role','teacher')
                              ->where('active', 1)
                              ->count();
            });
            
            $totalClasses = \Cache::remember('totalClasses-'.$school_id, $secondes, function () use($school_id) {
              return \App\Models\Classe::ofSchool($school_id)->count();
            });
            
            return view('home',[
              'totalStudents'=>$totalStudents,
              'totalTeachers'=>$totalTeachers,
              'totalClasses'=>$totalClasses,
            ]);
        } else {
            return redirect('/masters');
        }
    }
}
