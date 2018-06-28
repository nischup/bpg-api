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
    
    Route::post('quiz-visitor-count/{id}', function($id){
		$post = QuizTopic::findorfail($id); // Find our post by ID.
        $post->increment('count'); // Increment the value in the clicks column.
        $post->update(); // Save our updated post.
        return response($content = $post, $status = 200);
	});

    Route::get('article', function(){
	$article = Article::orderBy('id', 'desc')->get();
	// $article = Article::with('user')->orderBy('id', 'desc')->get();
	return response($content = $article, $status = 200);
	});

	Route::get('infographic', function(){
		$infographic = InfoGraph::orderBy('id', 'desc')->get();
		return response($content = $infographic, $status = 200);
	});

	Route::get('unseen-quiz/{id}', function($id){
	    
	    $playedQuiz = DB::table('played_quizzes')
	        ->select(DB::raw('DISTINCT(quiz_id) quiz_id'))
	        ->where('user_id','=',$id)
	        ->get();
	   
	   $quiz_id = [];
	   foreach($playedQuiz as $row):
	        array_push($quiz_id, $row->quiz_id);
	   endforeach;
	   
	   	$quiz = QuizTopic::with('question')
	   	    ->whereNotIn('id', $quiz_id)
	   	    ->orderBy('id', 'desc')
	   	    ->get();
	   	    
	   	return response($content = $quiz, $status = 200);
	});
	
	Route::get('latest-quiz', function(){
		$quiz = QuizTopic::with('question')
        // ->whereBetween('count', array(1, 10))
        ->where('status','=', '1')
		->orderBy('id', 'desc')->get();
		return response($content = $quiz, $status = 200);
	});
	
	Route::get('played-last-three-quiz/{id}', function($id){
	    
		$quiz = DB::table('played_quizzes')
            ->join('quiz_topics', 'quiz_topics.id', '=', 'played_quizzes.quiz_id')
            ->select('quiz_topics.quiz_title', 'played_quizzes.quiz_id', 'played_quizzes.user_id', 'played_quizzes.right_ans', 'played_quizzes.wrong_ans', 'played_quizzes.total_question', 'played_quizzes.obtain_point')
            ->orderBy('played_quizzes.id', 'desc')->where('played_quizzes.user_id', $id)->get()->take(3);
	    	return response($content = $quiz, $status = 200);
	});
	
	Route::get('mostviewed-quiz', function(){
		$quiz = QuizTopic::with('question')->where('count', '>', '10')->where('status','=', '1')->orderBy('id', 'desc')->get();
		return response($content = $quiz, $status = 200);
	});

    Route::post('save-played-quiz-score', 'QuestionController@palyedQuiz')->name('played.quiz.store');
    
    Route::post('update-name', 'QuestionController@updateName');
    Route::post('update-email', 'QuestionController@updateEmail');
    Route::post('update-password', 'QuestionController@updatePassword');
    Route::post('update-profile-pic', 'ArticleController@saveProfilePic')->name('save-profilepic.page');
    Route::get('search/{title}', 'ArticleController@searchFilter')->name('search');
   // Route::get('searchView/{title}/{id}', 'ArticleController@searchView')->name('view');
    
// quiz score start

	Route::get('percentage-of-success/{id}', 'ArticleController@getscore');

	Route::get('highest-mark-by-quiz/{id}', function($id){
		$max_mark = PlayedQuiz::where('quiz_id', $id)->max('obtain_point');
		return response($content = $max_mark, $status = 200);
	});
	
	Route::get('highest-point', function(){
		$max_mark = PlayedQuiz::max('obtain_point');
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

// quiz score end
	Route::get('played-quiz-score', function(){
        $pqs = DB::table('played_quizzes')
            ->join('users', 'users.id', '=', 'played_quizzes.user_id')
            ->select('name', DB::raw('SUM(played_quizzes.obtain_point) as obtain_point'))
            ->groupBy('played_quizzes.user_id')
            ->orderBy('obtain_point', 'desc')
            ->take(10)
            ->get();
		return response($content = $pqs, $status = 200);
	});
	
	Route::get('leaderboard-onlythis-quiz/{id}', function($id){
        $leaderboardscore = DB::table('played_quizzes')
            ->join('users', 'users.id', '=', 'played_quizzes.user_id')
            ->select('name', DB::raw('SUM(played_quizzes.obtain_point) as obtain_point'))
            ->groupBy('played_quizzes.user_id')
            ->where('played_quizzes.quiz_id', $id)
            ->orderBy('obtain_point', 'desc')
            ->take(10)
            ->get();
		return response($content = $leaderboardscore, $status = 200);
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
	        'error' => 'Wrong Login Credential',
	        'code' => 401,
	    ], 401);
	});

});
