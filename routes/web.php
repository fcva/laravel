<?php

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

Route::get('/plantilla', function () {
    return view('layouts.app');
});

Auth::routes();
Route::resource('/producto',"ProductoController");


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/user', 'User\UserController@index')->name('user.user');
Route::get('/producto', 'ProductoController@index')->name('producto');
