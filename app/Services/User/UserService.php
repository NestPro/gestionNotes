<?php
namespace App\Services\User;

use App\Models\StudentInfo;
use App\User;

use Illuminate\Support\Facades\DB;

class UserService {
    
    protected $user;
    protected $student_info;
    protected $db;

    public function __construct(User $user, StudentInfo $student_info, DB $db){
        $this->user = $user;
        $this->student_info = $student_info;
        $this->db = $db;
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
        $info->session = (!empty($request->session)) ? $request->session : '';
        $info->group = (!empty($request->group)) ? $request->group : '';
        $info->birthday = (!empty($request->birthday)) ? $request->birthday : '';
        $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
        $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
        $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
        $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
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
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = $request->email;
        $tb->password = bcrypt($request->password);
        $tb->role = 'admin';
        $tb->active = 1;
        $tb->school_id = session('register_school_id');
        $tb->code = session('register_school_code');
        $tb->student_code = session('register_school_id').date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->verified = 1;
        $tb->save();
        return $tb;
    }

    public function storeStudent($request){
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;// School Code
        $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address)) ? $request->address : '';
        $tb->about = (!empty($request->about)) ? $request->about : '';
        $tb->verified = 1;
        $tb->save();
        return $tb;
    }

    public function storeStaff($request, $role){
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = $role;
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;
        $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->verified = 1;
        $tb->classe = (!empty($request->classe_id))?$request->classe_id:0;
        
        $tb->save();
        return $tb;
    }
}