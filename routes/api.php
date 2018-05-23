<?php

use Illuminate\Http\Request;
use App\Article;
use App\InfoGraph;
use App\Question;
use App\User;
header('Access-Control-Allow-Origin: *');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('article/{id}', function($id){
	$article = Article::orderBy('id', 'desc')->where('type', $id)->get();
	// $article = Article::with('user')->orderBy('id', 'desc')->get();
	return response($content = $article, $status = 200);
});

Route::get('infographic/{id}', function($id){
	$infographic = InfoGraph::orderBy('id', 'desc')->where('type', $id)->get();
	return response($content = $infographic, $status = 200);
});

Route::get('question', function(){
	$question = Question::with('option')->orderBy('id', 'desc')->get();
	return response($content = $question, $status = 200);
});

Route::post('user-register', 'ArticleController@register')->name('user.register');