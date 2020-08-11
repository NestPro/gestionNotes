<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth', 'master'])->group(function () {
    Route::get('/masters', 'Master\MasterController@index')->name('masters.index');
    Route::resource('/schools', 'School\SchoolsController')->only(['index', 'edit', 'store', 'update']);
});

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
   
    Route::get('users/{school_code}/{student_code}/{teacher_code}', 'UserController@index');
    Route::get('users/{school_code}/{role}', 'UserController@indexOther');
    Route::get('user/{user_code}', 'UserController@show');
    Route::get('user/config/change_password', 'UserController@changePasswordGet');
    Route::post('user/config/change_password', 'UserController@changePasswordPost');
});

Route::middleware(['auth', 'master'])->group(function () {
    Route::get('register/admin/{id}/{code}', function ($id, $code) {
        session([
        'register_role' => 'admin',
        'register_school_id' => $id,
        'register_school_code' => $code,
        ]);

        return redirect()->route('register');
    });
    Route::post('register/admin', 'UserController@storeAdmin');
    Route::get('master/activate-admin/{id}', 'UserController@activateAdmin');
    Route::get('master/deactivate-admin/{id}', 'UserController@deactivateAdmin');
    Route::get('school/admin-list/{school_id}', 'SchoolController@show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('school')->name('school.')->group(function () {
        Route::post('add-class', 'Classe\ClasseController@store');
        //Route::post('add-department', 'SchoolsController@addDepartment');
    });

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('student', 'UserController@redirectToRegisterStudent');
        
        Route::get('teacher', function () {
            $classes = \App\Models\Classe::where('school_id', \Auth::user()->school_id)->get();
            session([
        'register_role' => 'teacher',
        'classes' => $classes,
      ]);

            return redirect()->route('register');
        });
        
        Route::post('student', 'UserController@store');
        Route::post('teacher', 'UserController@storeTeacher');
    });
});

Route::middleware(['auth', 'master.admin'])->group(function () {
    Route::get('edit/user/{id}', 'UserController@edit');
    Route::post('edit/user', 'UserController@update');
});
