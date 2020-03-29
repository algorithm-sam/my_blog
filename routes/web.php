<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'PostsController@index');
Route::post('/posts', 'PostsController@create');
Route::get('posts/{post}','PostsController@show');
Route::delete('posts/{post}','PostsController@destroy')->middleware('auth');
Route::get('/protected','HomeController@protected')->middleware('auth');
// Route::get('{post}','PostsController@show');


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

