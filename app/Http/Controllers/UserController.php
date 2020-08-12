<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Classe;
use App\Services\User\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;
    protected $user;

    public function __construct(UserService $userService, User $user){
        $this->userService = $userService;
        $this->user = $user;
    }
    
    //Display a listing of the resource.
    
    public function index($school_code, $student_code, $teacher_code){
        
        if($this->userService->isListOfStudents($school_code, $student_code))
            return $this->userService->indexView('list.student-list', $this->userService->getStudents());
        else if($this->userService->isListOfTeachers($school_code, $teacher_code))
            return $this->userService->indexView('list.teacher-list',$this->userService->getTeachers());
        else
            return view('home');
    }

    public function redirectToRegisterStudent()
    {
        $classes = Classe::query()
            ->ofSchool(\Auth::user()::user()->school->id)
            ->pluck('id');

        session([
            'register_role' => 'student',
            'register_classe' => $classes,
        ]);

        return redirect()->route('register');
    }

    public function changePasswordGet()
    {
        return view('profile.change-password');
    }

    public function changePasswordPost(ChangePasswordRequest $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->user()->fill([
              'password' => Hash::make($request->new_password),
            ])->save();

            return back()->with('status', __('Saved'));
        }

        return back()->with('error-status', __('Passwords do not match.'));
    }

    
    //Store a newly created resource in storage.
   
    public function store(CreateUserRequest $request)
    {
        $this->userService->storeStudent($request);

        return back()->with('status', __('Saved'));
    }

   
    public function storeAdmin(CreateAdminRequest $request)
    {
        $this->userService->storeAdmin($request);

        return back()->with('status', __('Saved'));
    }

    public function storeTeacher(CreateTeacherRequest $request)
    {
        $this->userService->storeTeach($request, 'teacher');

        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($user_code)
    {
        $user = $this->userService->getUserByUserCode($user_code);

        return view('profile.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        
        $classes = Classe::query()
            ->ofSchool($user->school_id)
            ->get();

        return view('profile.edit', [
            'user' => $user,
            'classe' => $classes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
		 
        DB::transaction(function () use ($request) {
            $us = $this->user->find($request->user_id);
            $us->name = $request->name;
            $us->email = $request->email;
            $us->nationality = $request->nationality;
            $us->phone_number = $request->phone_number;
            $us->address = $request->address;
            $us->about = $request->about;
            if ($request->user_role == 'teacher') {
                $us->classe = $request->classe_id;
                $us->cours = $request->class_teacher_cours_id;
            }
            if ($us->save()) {
                if ($request->user_role == 'student') {
            
                }
            }
        });

        return back()->with('status', __('Saved'));
    }

    public function activateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back();
    }

    public function deactivateAdmin($id)
    {
       $admin = $this->user->find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        // return ($this->user->destroy($id))?response()->json([
      //   'status' => 'success'
      // ]):response()->json([
      //   'status' => 'error'
      // ]);
    }
}
