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

Route::get('/password/reset', 'Auth\ForgotPasswordController@reset')->name('password.reset');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update')->name('profile/update');

Route::get('/threads', 'ThreadsController@index')->name('threads');
Route::post('/threads', 'ThreadsController@store')->name('threads/create');
Route::post('/threads/show', 'ThreadsController@filter')->name('threads/filter');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads/{thread}', 'ThreadsController@update');
Route::post('/threads/{thread}/delete', 'ThreadsController@destroy');
Route::post('/threads/{thread}/comments', 'CommentsController@store');
Route::get('/home', 'HomeController@index')->name('home');
