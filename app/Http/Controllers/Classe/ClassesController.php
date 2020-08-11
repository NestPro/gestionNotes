<?php

namespace App\Http\Controllers\Classe;

use App\Models\Classe as Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClasseRessource;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school_id)
    {
        //$classes = Classe::all();

        //return view('classes.index', ['classes' => $classes]);

        return ($school_id > 0)? ClasseRessource::collection(Classe::bySchool($school_id)->get()):response()->json(['Invalid school ID '. $school_id, 404]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $cl = new Classe;
        $cl->name = $request->name;
        $cl->code = $request->code;
        $cl->school_id = \Auth::user()->school_id;

        $cl->save();

        return view('status', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClasseRessource(Classe::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $cl = Classe::find($id);
        $cl->name = $request->name;
        $cl->code = $request->code;
        $cl->school_id = $request->schol_id;

        return ($cl->save())?response()->json(['status' => 'success']):response(['status' => 'error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return (Classe::destroy($id))?response()->json(['status' => 'success']):response()->json(['status' => 'error']);
/*
    $classe = $this->model->findOrFail($id);
	
	$classe->delete();
	
    }
}