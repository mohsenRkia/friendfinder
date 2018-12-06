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

Route::get('/contact',[
    'uses' => 'ContactController@index',
    'as' => 'contact.index'
]);
Route::post('/contact/send',[
    'uses' => 'ContactController@send',
    'as' => 'contact.send'
]);

// ADMIN PANEL
Route::group(['prefix' => 'admin','middleware' => ['verified','isadmin']],function (){

    Route::get('/',[
        'uses' => 'AdminPanelController@index',
        'as' => 'admin.index'
    ]);

    Route::get('/edit/{id}',[
        'uses' => 'AdminPanelController@edit',
        'as' => 'admin.edit'
    ]);
});

// USER PANEL
Route::group(['prefix' => 'user','middleware' => ['verified','isuser']],function (){

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

Route::group(['prefix' => 'profile','middleware' => 'verified'],function (){
    //USER PROFILE
    Route::get('/{id}/{name}',[
        'uses' => 'ProfileController@timeline',
        'as' => 'user.profile.timeline'
    ]);
    Route::post('/follow/{id}',[
        'uses' => 'ProfileController@follow',
        'as' => 'user.follow'
    ]);

    Route::post('/sendpost/{id}',[
        'uses' => 'PostController@send',
        'as' => 'post.send'
    ]);
    Route::post('/comment/{id}',[
        'uses' => 'CommentController@send',
        'as' => 'comment.send'
    ]);
    Route::post('/like/{id}',[
        'uses' => 'LikeController@add',
        'as' => 'like.add'
    ]);

    Route::get('/about/{id}/{name}',[
        'uses' => 'ProfileController@about',
        'as' => 'user.profile.about'
    ]);

    Route::get('/friends/{id}/{name}',[
        'uses' => 'ProfileController@friends',
        'as' => 'user.profile.friends'
    ]);
    Route::get('/album/{id}/{name}',[
        'uses' => 'ProfileController@album',
        'as' => 'user.profile.album'
    ]);

    Route::get('/chats/{id}/{name}',[
        'uses' => 'ChatController@index',
        'as' => 'user.chat.index'
    ]);

    Route::post('/chats/send/{id}',[
        'uses' => 'ChatController@send',
        'as' => 'user.chat.send'
    ]);
});


//USER REGISTER
Route::post('/registered',[
    'uses' => 'UserController@store',
    'as' => 'user.store'
]);






Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
