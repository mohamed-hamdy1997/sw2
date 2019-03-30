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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//user

Route::get('/users', 'UserController@index');


//posts

Route::get('/posts', 'PostsController@index');

Route::get('/home', 'PostsController@index');

Route::resource('posts', 'PostsController');

Route::get('/create', 'PostsController@create');

Route::post('/create', 'PostsController@store');

Route::post('/posts/{id}', 'PostsController@update');
