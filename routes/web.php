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


//HOME
Route::get('/',[
    'uses' => 'HomeController@index',
    'as' => 'home.index'
]);


// ADMIN PANEL
Route::group(['prefix' => 'admin'],function (){

    Route::get('/',[
        'uses' => 'AdminPanelController@index',
        'as' => 'admin.index'
    ]);
});

// USER PANEL
Route::group(['prefix' => 'user','middleware' => 'verified'],function (){

    Route::get('/',[
        'uses' => 'UserPanelController@index',
        'as' => 'user.index'
    ]);

    Route::get('/edit/{id}',[
        'uses' => 'UserPanelController@edit',
        'as' => 'user.edit'
    ]);

    Route::post('/update/{id}',[
        'uses' => 'UserPanelController@update',
        'as' => 'user.update'
    ]);



});
//USER PROFILE
Route::get('/user/{id}/{name}',[
    'uses' => 'ProfileController@profile',
    'as' => 'user.profile.index'
]);
Route::post('/user/follow/{id}',[
    'uses' => 'ProfileController@follow',
    'as' => 'user.follow'
]);

//USER REGISTER
Route::post('/registered',[
    'uses' => 'UserController@store',
    'as' => 'user.store'
]);






Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
