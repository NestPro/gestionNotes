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
Route::get('/etudiants', 'Etudiant\EtudiantsController@index')->name('see.students');
Route::get('/etudiants/edit/{id}', 'Etudiant\EtudiantsController@edit')->name('edit.student');
Route::get('/ecoles', 'Ecole\EcolesController@index')->name('see.schools');
Route::get('/ecoles/delete/{id}', 'Ecole\EcolesController@destroy')->name('delete.school');
Route::get('/ecoles/edit/{id}', 'Ecole\EcolesController@edit')->name('edit.school');
Route::post('/ecoles/edit/{id}/save', 'Ecole\EcolesController@saveSchoolChange')->name('edit.school.post');
Route::get('/classes', 'Classe\ClassesController@index')->name('see.classes');
