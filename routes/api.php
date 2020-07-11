<?php

use Illuminate\Http\Request;
use App\News;
use App\Signal;
use App\Pips;
use App\PipDetail;
use App\EducationCategory;
use App\EducationTitle;
use App\QuizTopic;
use App\User;
use App\Employee;
use App\VisitRequisition;

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
//Route::post('user-register', 'NewsController@register')->name('user.register');

Route::group(['middleware' => ['api','cors']], function () 
{
    
    Route::post('quiz-visitor-count/{id}', function($id){
		$post = QuizTopic::findorfail($id); // Find our post by ID.
        $post->increment('count'); // Increment the value in the clicks column.
        $post->update(); // Save our updated post.
        return response($content = $post, $status = 200);
	});

	// tradewme api start

    Route::get('news', function(){
		$news = News::where('status', 1)->orderBy('id', 'desc')->get();
		return response($content = $news, $status = 200);
	});
   
    Route::get('pips', function(){
		$pips = Pips::orderBy('id', 'desc')->get();
		return response($content = $pips, $status = 200);
	});    

	Route::get('pip-detail/{id}', function($id){
		$pip_detail = PipDetail::with('pips', 'signal')->where('pips_id', $id)->orderBy('id', 'desc')->get();
		return response($content = $pip_detail, $status = 200);
	});

	Route::get('signal', function(){
		$signal = Signal::where('status', 1)->orderBy('id', 'desc')->get();
		return response($content = $signal, $status = 200);
	});	

	Route::get('education-category', function(){
		$education_category = EducationCategory::where('status', 1)->orderBy('id', 'desc')->get();
		return response($content = $education_category, $status = 200);
	});	

	Route::get('education-category-detail/{id}', function($id){
		$education_category_detail = EducationTitle::with('category')->where('category_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
		return response($content = $education_category_detail, $status = 200);
	});

	Route::post('send-message', 'MessageController@store')->name('message.store');

    Route::post('update-to-premium-user', 'UserController@upgradeToPremium');
    Route::post('update-name', 'UserController@updateName');
    Route::post('update-email', 'UserController@updateEmail');
    Route::post('update-password', 'UserController@updatePassword');
    Route::post('update-profile-pic', 'NewsController@saveProfilePic')->name('save-profilepic.page');
    
	Route::post('auth/register', 'Auth\ApiRegisterController@register');


	Route::get('employee-list', function(){
		$employeeList = Employee::select('emp_id', 'emp_name')->orderBy('emp_id', 'desc')->get();
		return response($content = $employeeList, $status = 200);
	});


	Route::get('visit-requisition-list', function(){
		$requisitionList = VisitRequisition::orderBy('id', 'desc')->get();
		return response($content = $requisitionList, $status = 200);
	});	

	Route::post('send-requisition', 'MessageController@sendReq')->name('sendreq.store');


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
