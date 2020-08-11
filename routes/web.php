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
/*
Route::get('/dashboard', function () {
    return view('dashboard');
});*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/schools', 'School\SchoolsController')->only(['index', 'edit', 'store', 'update']);
//Route::get('/students', 'Student\StudentsController@index')->name('see.students');
//Route::get('/students/edit/{id}', 'Student\StudentsController@edit')->name('edit.student');
//Route::get('/schools', 'School\SchoolsController@index')->name('see.schools');
//Route::post('/schools/store/{id}', 'School\SchoolsController@store')->name('schools.store');
//Route::get('/schools/edit/{id}', 'School\SchoolsController@edit')->name('edit.school');
//Route::post('/schools/update/{id}/', 'School\SchoolsController@update')->name('update.school');
//Route::get('/classes', 'Classe\ClassesController@index')->name('see.classes');
