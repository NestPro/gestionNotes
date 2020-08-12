<?php
namespace App\Services\User;

use App\Models\StudentInfo;
use App\User;

class UserService {
    
    protected $user;
    protected $student_info;

    public function __construct(User $user, StudentInfo $student_info){
        $this->user = $user;
        $this->student_info = $student_info;
    }

    public function isListOfStudents($school_code, $student_code){
        return !empty($school_code) && $student_code == 1;
    }

    public function isListOfTeachers($school_code, $teacher_code){
        return !empty($school_code) && $teacher_code == 1;
    }

    public function indexView($view, $users){
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function updateStudentInfo($request, $id){
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
        $info->annee = $request->annee;
        $info->classe = $request->classe;
        $info->birthday = $request->birthday;
        $info->father_name = $request->father_name;
        $info->father_phone_number = $request->father_phone_number;
        $info->mother_name = $request->mother_name;
        $info->mother_phone_number = $request->mother_phone_number;
        $info->user_id = auth()->user()->id;
        $info->save();
    }

    public function indexOtherView($view, $users){
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function getStudents(){
        return $this->user->with(['classe','school', 'studentInfo'])
                ->where('code', auth()->user()->school->code)
                ->student()
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getTeachers(){
        return $this->user->with(['classe', 'school'])
                ->where('code', auth()->user()->school->code)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }


    public function getUserByUserCode($user_code){
        return $this->user->with('classe', 'studentInfo')
              ->where('student_code', $user_code)
              ->where('active', 1)
              ->first();
    }

    public function storeAdmin($request){
        $us = new $this->user;
        $us->name = $request->name;
        $us->email = $request->email;
        $us->password = bcrypt($request->password);
        $us->role = 'admin';
        $us->active = 1;
        $us->school_id = session('register_school_id');
        $us->code = session('register_school_code');
        $us->student_code = session('register_school_id').date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $us->gender = $request->gender;
        $us->nationality = $request->nationality;
        $us->phone_number = $request->phone_number;
        $us->verified = 1;
        $us->save();
        return $us;
    }

    public function storeStudent($request){
        $us = new $this->user;
        $us->name = $request->name;
        $us->email = $request->email;
        $us->password = bcrypt($request->password);
        $us->role = 'student';
        $us->active = 1;
        $us->school_id = auth()->user()->school_id;
        $us->code = auth()->user()->code;// School Code
        $us->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $us->gender = $request->gender;
        $us->nationality = $request->nationality;
        $us->phone_number = $request->phone_number;
        $us->address = $request->address;
        $us->about = $request->about;
        $us->verified = 1;
        $us->save();
        return $us;
    }

    public function storeTeach($request, $role){
        $us = new $this->user;
        $us->name = $request->name;
        $us->email = $request->email;
        $us->password = bcrypt($request->password);
        $us->role = $role;
        $us->active = 1;
        $us->school_id = auth()->user()->school_id;
        $us->code = auth()->user()->code;
        $us->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $us->gender = $request->gender;
        $us->nationality = $request->nationality;
        $us->phone_number = $request->phone_number;
        $us->verified = 1;
        $us->classe = $request->classe_id;
        
        $us->save();
        return $us;
    }
}