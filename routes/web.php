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


Route::resource('articles', 'ArticleController');
Route::resource('infograph', 'InfographController');
Route::resource('question', 'QuestionController');
Route::post('question-option', 'QuestionController@qoStore')->name('question.option.store');


//start for template all page , it should be remove for production
Route::get('pages/{name}', 'HomeController@pages')->name('template');