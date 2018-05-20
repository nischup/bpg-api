<?php

use Illuminate\Http\Request;
use App\Article;
use App\InfoGraph;
use App\Question;
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

Route::get('article', function(){
	$article = Article::with('user')->orderBy('id', 'desc')->get();
	return response($content = $article, $status = 200);
});

Route::get('infographic', function(){
	$infographic = InfoGraph::with('user')->orderBy('id', 'desc')->get();
	return response($content = $infographic, $status = 200);
});

Route::get('question', function(){
	$question = Question::with('option')->with('user')->orderBy('id', 'desc')->get();
	return response($content = $question, $status = 200);
});