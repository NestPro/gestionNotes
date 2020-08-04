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
Route::get('/etudiants', 'EtudiantsController@index')->name('see_students');
Route::get('/etudiants/edit/{id}', 'EtudiantsController@edit')->name('edit_student');
Route::get('/ecoles', 'EcolesController@index')->name('see_schools');
Route::get('/ecoles/edit/{id}', 'EcolesController@edit')->name('edit_school');
Route::get('/classes', 'ClassesController@index')->name('see_classes');
