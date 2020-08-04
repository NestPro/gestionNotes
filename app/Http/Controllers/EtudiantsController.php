<?php

namespace App\Http\Controllers;

use App\Etudiant;

use Illuminate\Http\Request;

class EtudiantsController extends Controller
{
    public function index(){
        $etudiants = Etudiant::all();
        
        return view('etudiants.index', ['etudiants' => $etudiants]);
    }
}
