<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Question;
use App\QuestionOption;
use App\QuizTopic;
use App\PlayedQuiz;
use DB;
use Session;
use Auth;

class QuestionController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['question', 'question'];
        $question = Question::with('option')->with('quiz')->with('user')->orderBy('id', 'desc')->get();
        //dd($question);
        return view('question.index', compact('menu', 'question'));
    }

    public function create()
    {
        $menu = ['question', 'question'];
        $question = Question::orderBy('id', 'desc')->get();
        $quiz = QuizTopic::orderBy('id', 'desc')->get();
        //dd($quiz);
        return view('question.create', compact('menu', 'question', 'quiz'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'question' => 'required',
            'point' => 'required',
            'quiz_topic_id' => 'required',
        ]);

        $url = $this->url->to('/');

        if ($request->image != null) {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();

            request()->image->move(public_path('uploads/question'), $imageName);
            
            $imgpath =$url.'/uploads/question/'.$imageName;
            //dd($imgpath);

            $table = new Question();
            $table->quiz_topic_id = $request->quiz_topic_id;
            $table->question = $request->question;
            $table->point = $request->point;
            $table->image = $imgpath;
            $table->user_id = Auth::id();
            $table->status = $request->status;

            $table->save();
            return redirect()->route('question.create')
                            ->with('success','New Question added');

        }
        else
            {

            $table = new Question();
            $table->quiz_topic_id = $request->quiz_topic_id;
            $table->question = $request->question;
            $table->point = $request->point;
            $table->image = $request->image;
            $table->user_id = Auth::id();
            $table->status = $request->status;

            $table->save();
            return redirect()->route('question.create')
                            ->with('success','New Question added');
            }

    }

    public function qoStore(Request $request)
    {
        //dd($request->all());
        request()->validate([
            'question_option' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
        ]);

        $table = new QuestionOption();
        $table->question_id = $request->question_option;
        $table->option_1 = $request->option_1;
        $table->option_2 = $request->option_2;
        $table->option_3 = $request->option_3;
        $table->option_4 = $request->option_4;
        $table->answer = $request->answer;
        $table->user_id = Auth::id();

        $table->save();
        return redirect()->route('question.create')
                        ->with('success','Question Option Save');
    }

    public function palyedQuiz(Request $request) {
        
        $table = new PlayedQuiz();
        $table->quiz_id = 4;
        $table->user_id = Auth::id();
        $table->right_ans = 190;
        $table->wrong_ans = 75;
        $table->total_question = 330;
        $table->obtain_point = 210;

        $table->save();
        return response()->json(['status' => 'success','message' => 'Score Updated']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        Session::flash('success', 'question has been deleted');
        return redirect()->route('question.index');
    }
}
