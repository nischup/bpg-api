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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');


// password reset route

// Route::post('password/email/');
// Route::post('password/reset/');

Route::resource('news', 'NewsController');
Route::get('Upload-Profile-Pic', 'NewsController@profilepic')->name('add-profilepic.page');
Route::post('Save-Profile-Pic/{id}', 'NewsController@saveProfilePic')->name('save-profilepic.page');

Route::get('userRegister', 'NewsController@userCreate')->name('user.page');
Route::get('user-list', 'NewsController@userList')->name('user.list');
Route::delete('user/{id}', 'NewsController@userdelete')->name('user.destroy');

Route::post('user-register', 'NewsController@register')->name('user.register');
Route::resource('category', 'EducationCategoryController');
Route::resource('category-title', 'CategoryTitleController');
Route::resource('signal', 'SignalController');
Route::resource('message', 'MessageController');
Route::resource('pips', 'PipsController');
Route::resource('pips_detail', 'PipDetailController');

//start for template all page , it should be remove for production
Route::get('pages/{name}', 'HomeController@pages')->name('template');