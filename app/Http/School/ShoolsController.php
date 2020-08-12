<?php

namespace App\Http\Controllers\Ecole;

use App\User;
use App\Models\Classe;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;

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
    public function store(SchoolRequest $request)
    {
        School::create([
            'name'        => $request->name,
            'address' => $request->address,
            'about'       => $request->about,
            'code'        => date("y").substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6),
        ]);

        return redirect()->route('schools.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($school_id){
        $admins = User::ofSchool($school_id)->where('role', 'admin')->get();
        return view('school.admin-list', compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school){
        return view('schools.edit', compact('school'));
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

    public function addClass(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $sc = new Classe;
        $sc->school_id = \Auth::user()->school_id;
        $sc->name = $request->name;
        $sc->save();

        return back()->with('status', __('Classe created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}