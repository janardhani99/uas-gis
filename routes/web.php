<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::resource('/covid-19', 'CovidController');
Route::resource('/', 'IndexController');
Route::post('/search', 'IndexController@search');
Route::get('/create-pallete', 'IndexController@createPallete');
Route::get('/getData', 'IndexController@getData');
Route::get('/getPositif', 'IndexController@getPositif');
// Route::get('/covid-19', 'CovidController@index');
// Route::get('/covid-19/create', 'CovidController@create');
// Route::post('/covid-19/store', 'CovidController@store');
// Route::get('/covid-19/edit', 'CovidController@edit');
// Route::get('/covid-19/update', 'CovidController@update');
// Route::get('/covid-19/{id}/delete', 'CovidController@destroy');