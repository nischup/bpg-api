<?php

use Illuminate\Http\Request;
use App\Article;
use App\InfoGraph;
use App\Question;
use App\QuizTopic;
use App\PlayedQuiz;
use App\User;

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
//Route::post('user-register', 'ArticleController@register')->name('user.register');

Route::group(['middleware' => ['api','cors']], function () 
{

    Route::get('article/{id}', function($id){
	$article = Article::orderBy('id', 'desc')->where('type', $id)->get();
	// $article = Article::with('user')->orderBy('id', 'desc')->get();
	return response($content = $article, $status = 200);
	});

	Route::get('infographic/{id}', function($id){
		$infographic = InfoGraph::orderBy('id', 'desc')->where('type', $id)->get();
		return response($content = $infographic, $status = 200);
	});

	Route::get('quiz', function(){
		$quiz = QuizTopic::with('question')->orderBy('id', 'desc')->get();
		return response($content = $quiz, $status = 200);
	});

	Route::post('save-played-quiz-score', 'QuestionController@palyedQuiz')->name('played.quiz.store');

	// quiz score

	Route::get('percentage-of-success/{id}', 'ArticleController@getscore');

	Route::get('highest-mark-by-quiz/{id}', function($id){
		$max_mark = PlayedQuiz::where('quiz_id', $id)->max('obtain_point');
		return response($content = $max_mark, $status = 200);
	});

	Route::get('highest-mark-by-login-user/{id}', function($id){
		$max_mark = PlayedQuiz::where('user_id', $id)->max('obtain_point');
		return response($content = $max_mark, $status = 200);
	});

	Route::get('right-ans-by-login-user/{id}', function($id){
		$right_ans = PlayedQuiz::where('user_id', $id)->sum('right_ans');
		return response($content = $right_ans, $status = 200);
	});

	Route::get('total-question-by-login-user/{id}', function($id){
		$total_question = PlayedQuiz::where('user_id', $id)->sum('total_question');
		return response($content = $total_question, $status = 200);
	});

	Route::get('wrong-ans-by-login-user/{id}', function($id){
		$wrong_ans = PlayedQuiz::where('user_id', $id)->sum('wrong_ans');
		return response($content = $wrong_ans, $status = 200);
	});

	Route::get('played-quiz-score', function(){
	$pqs = DB::table('users')
            ->join('played_quizzes', 'users.id', '=', 'played_quizzes.user_id')
            ->select('users.id', 'users.name', 'played_quizzes.id', 'played_quizzes.quiz_id', 'played_quizzes.right_ans', 'played_quizzes.wrong_ans', 'played_quizzes.total_question', 'played_quizzes.obtain_point', 'played_quizzes.user_id')->orderBy('users.id', 'desc')->get();
		return response($content = $pqs, $status = 200);
	});

	Route::post('auth/register', 'Auth\ApiRegisterController@register');

	Route::post('login', function (Request $request) {
    
    if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        // Authentication passed...
        $user = auth()->user();
        $user->api_token = str_random(60);
        $user->save();
        return response()->json([
        	'status' => "success",
        	'code' => "200",
        	'data' => $user,
        ], 200);
    }
	    return response()->json([
	        'error' => 'Unauthenticated user',
	        'code' => 401,
	    ], 401);
	});

});
