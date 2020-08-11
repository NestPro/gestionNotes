<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;


class User extends Model implements CanResetPasswordContract, AuthorizableContract, AuthenticatableContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword;

    //use Notifiable;
    //use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'code',/* school code*/'student_code', 'active', 'verified', 'school_id', 'address', 'about', 'phone_number', 'nationality', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeStudent($qurey)
    {
        return $qurey->where('role', 'student');
    }

    public function scopeOfSchool($query, int $school_id){
        return $query->where('school_id', $school_id);
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function studentInfo(){
        return $this->hasOne('App\Models\StudentInfo', 'student_id');
    }

    public function hasRole(string $role): bool
    {
        return $this->role == $role ? true : false;
    }
}
