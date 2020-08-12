<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $school = \Auth::user()->school;
        $classes = Classe::all();
        $teachers = User::select(/*'classes.*', */'users.*')
            //->join('classes', 'classes.id', '=', 'users.classe_id')
            ->where('role', 'teacher')
            ->orderBy('name', 'ASC')
            ->where('active',1)
            ->get();

        return view('settings.index', compact('school', 'classes', 'teachers'));
    }
}
