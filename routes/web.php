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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::post('/follow/{user}', 'FollowsController@store');

Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show')->where('post', '[0-9]+');
Route::get('/p/create', 'PostsController@create');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/secret', 'ProfilesController@secret')->name('profile.show');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
