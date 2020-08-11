<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\StudentInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', ['etudiants' => $etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etudiants = Etudiant::where(['etudiant_id' => $id])->get();

        return view('etudiants.index', ['etudiants' => $etudiants]);
    }


    public function saveStudentChange(Request $request, $id){
        
        $validate = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'ecole' => 'required',
            'classe' => 'required',
        ]);

        if($validate){
            $etudiant = Etudiant::where(['id' => $id])->first();

            $etudiant->nom = $validate['nom'];
            $etudiant->prenom = $validate['adresse'];
            $etudiant->ecole = $validate['ecole'];
            $etudiant->classe = $validate['classe'];

            $etudiant->save();
        }
        return redirect()->route('see.students');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Etudiant::destroy($id);
    }
}