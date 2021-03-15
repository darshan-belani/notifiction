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

Route::get('/admin/signIn', 'UserController@signin');
Route::any('/log', 'UserController@log');

Route::group(['middleware' => ['login']], function () {
//Route::get('/home', 'HomeController@index')->name('home');
    Route::any('/admin/posts', 'PostController@index');
    Route::get('/admin/getAllPost', 'PostController@getAllPost');
    Route::any('/admin/posts/add', 'PostController@add');
    Route::any('/admin/post/store', 'PostController@store');
    Route::get('/admin/post/edit/{id}', 'PostController@editPost');
    Route::get('/admin/post/update/{id}', 'PostController@updatePost');
    Route::any('/admin/post/delete/{id}', 'PostController@deletePost');
    Route::any('/markRead', 'PostController@markRead');
    Route::any('/logout', 'UserController@logout');
});


