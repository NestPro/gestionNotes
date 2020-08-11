<?php

namespace App\Http\Controllers\Ecole;

use App\User;
use App\Models\Classe;
use App\Models\School;
use App\Models\Departement;
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
        //$ecoles = Ecole::all();
        $schools = School::orderBy('created_at', 'desc')->paginate();

        return view('schools.index', ['schools' => $schools]);
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
        School::create([
            'name'        => $request->name,
            'address' => $request->address,
            'about'       => $request->about,
            'code'        => date("y").substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6),
        ]);

        return redirect()->route('schools.index')->with('status', __('Created'));
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
    public function edit(School $school)
    {
        //$ecole = Ecole::where(['id' => $id])->first();
        
        //return view('ecoles.edit', ['ecole' => $ecole]);
        return view('schools.edit', compact('school'));

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
    public function update(Request $request, School $school)
    {
        $school->name = $request->name;
        $school->about = $request->about;
        $school->save();

        return redirect()->route('schools.index');
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