<?php

namespace App\Http\Controllers\Ecole;

use App\Models\Classe;
use App\Models\Ecole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EcolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecoles = Ecole::all();

        return view('ecoles.index', ['ecoles' => $ecoles]);
    }

    public function view($id)
    {
        $classes = Classe::where(['classe_id' => $id])->get();

        return view('classes.index', ['classes' => $classes]);
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
        $ecole = Ecole::where(['id' => $id])->first();
        
        return view('ecoles.edit', ['ecole' => $ecole]);
    }

    public function saveSchoolChange(Request $request, $id){
        
        $validate = $request->validate([
            'nom' => 'required',
            'addresse' => 'required'
        ]);

        if($validate){
            $ecole = Ecole::where(['id' => $id])->first();

            $ecole->nom = $validate['nom'];
            $ecole->addresse = $validate['adresse'];

            $ecole->save();
        }
        return redirect()->route('see.schools');
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
        Ecole::destroy($id);

        return redirect()->route('see.schools');
    }
}