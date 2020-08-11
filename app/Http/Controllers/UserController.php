<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Classe;
use App\Models\Departement;
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
    /**
     * Display a listing of the resource.
     *
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code){
        session()->forget('section-attendance');
        
        if($this->userService->isListOfStudents($school_code, $student_code))
            return $this->userService->indexView('list.student-list', $this->userService->getStudents());
        else if($this->userService->isListOfTeachers($school_code, $teacher_code))
            return $this->userService->indexView('list.teacher-list',$this->userService->getTeachers());
        else
            return view('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegisterStudent()
    {
        $classes = Classe::query()
            ->bySchool(\Auth::user()::user()->school->id)
            ->pluck('id');

        session([
            'register_role' => 'student',
        ]);

        return redirect()->route('register');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordGet()
    {
        return view('profile.change-password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->userService->storeStudent($request);

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $this->userService->storeAdmin($request);

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTeacher(CreateTeacherRequest $request)
    {
        
        $this->userService->storeStaff($request, 'teacher');

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
            ->bySchool($user->school_id)
            ->get();

        $departments = Departement::query()
            ->bySchool($user->school_id)
            ->get();

        return view('profile.edit', [
            'user' => $user,
            'classe' => $classes,
            'departments' => $departments,
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
            $tb = $this->user->find($request->user_id);
            $tb->name = $request->name;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
            $tb->phone_number = $request->phone_number;
            $tb->address = (!empty($request->address)) ? $request->address : '';
            $tb->about = (!empty($request->about)) ? $request->about : '';
            if ($request->user_role == 'teacher') {
                $tb->classe = $request->classe_id;
                $tb->cours = $request->class_teacher_cours_id;
            }
            if ($tb->save()) {
                if ($request->user_role == 'student') {
            
                }
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
       $admin = $this->user->find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
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
