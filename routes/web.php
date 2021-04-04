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

Route::get('/signIn', 'UserController@signin');
Route::any('/log', 'UserController@log');
Route::view('/register', 'sign_up');
Route::any('/regist', 'UserController@regist');

Route::group(['middleware' => ['login']], function () {

    // Post Route
    Route::any('/posts', 'PostController@index');
    Route::get('/getAllPost', 'PostController@getAllPost');
    Route::any('/posts/add', 'PostController@add');
    Route::any('/post/store', 'PostController@store');
    Route::get('/post/edit/{id}', 'PostController@editPost');
    Route::get('/post/update/{id}', 'PostController@updatePost');
    Route::any('/post/delete/{id}', 'PostController@deletePost');

    // Mark Read
    Route::any('/markRead', 'PostController@markRead');

    // Logout
    Route::any('/logout', 'UserController@logout');

    // Users Route
    Route::any('/users', 'UserController@users');
    Route::any('/getAllUsers', 'UserController@getAllUsers');
    Route::any('/user/add', 'UserController@userAdd');
//    Route::any('/user/store', 'UserController@userStore');
    Route::any('/user/edit/{id}', 'UserController@userEdit');
    Route::any('/user/update/{id}', 'UserController@userUpdate');
    Route::any('/user/delete/{id}', 'UserController@userDelete');
});
