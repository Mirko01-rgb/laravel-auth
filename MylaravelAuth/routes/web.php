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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/homepage', 'TestController@homepage')
     ->name('homepage');


//EDIT
Route::get('edit/car/{id}', 'LoggedController@edit')
        -> name('edit');
Route::post('update/car/{id}', 'LoggedController@update')
      -> name('update');


//DELETE
Route::get('destroy/{id}', 'LoggedController@destroy')
        -> name('destroy');
