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

// ADMIN PANEL
Route::group(['prefix' => 'admin'],function (){

    Route::get('/',[
        'uses' => 'AdminPanelController@index',
        'as' => 'admin.index'
    ]);
});

// USER PANEL
Route::group(['prefix' => 'user'],function (){

    Route::get('/',[
        'uses' => 'UserPanelController@index',
        'as' => 'user.index'
    ]);
});


//HOME
Route::get('/',[
   'uses' => 'HomeController@index',
   'as' => 'home.index'
]);


// USERS
Route::post('/users/register',[
    'uses' => 'UserController@store',
    'as' => 'user.store'
]);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
