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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[
   'uses' => 'v1\HomeController@index',
   'as' => 'home.index'
]);

Route::post('/users/register',[
    'uses' => 'v1\UserController@store',
    'as' => 'user.store'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
