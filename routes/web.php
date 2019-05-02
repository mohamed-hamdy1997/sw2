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
    return redirect('/home');
});



Auth::routes();


//user

Route::get('/users-deatails', 'UserController@index');
Route::get('/adduser', 'UserController@viewAdd');
Route::post('/adduser', 'UserController@addUser');
Route::get('users/{id}', 'UserController@destroy');
Route::get('user/{id}/posts', 'UserController@userPosts');
Route::get('editprofile/{id}', 'UserController@showUpdateProfilePage');
Route::post('editprofile/{id}', 'UserController@updateProfile');


//posts

Route::get('/posts', 'PostsController@index');


Route::get('/home', 'PostsController@index');

Route::resource('posts', 'PostsController');

Route::get('/create', 'PostsController@create');

Route::post('/create', 'PostsController@store');

Route::post('/posts/{id}', 'PostsController@update');

Route::get('/posts/{id}/destroy', 'PostsController@destroy');

Route::get('/posts/{id}/view', 'PostsController@viewPost');

//comment

Route::post('/posts/{id}/addComment', 'CommentController@addComment');
Route::get('/posts/{id}/destroyComment', 'CommentController@destroyComment');


// chat

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/private', 'HomeController@private')->name('private');
Route::get('/users', 'HomeController@users')->name('users');

Route::get('messages', 'MessageController@fetchMessages');
Route::post('messages', 'MessageController@sendMessage');
Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');

//Like
Route::post('/like', 'LikeController@like')->name('like');
Route::post('/dislike', 'LikeController@dislike')->name('dislike');

