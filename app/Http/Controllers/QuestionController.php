<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Question;
use App\QuestionOption;
use DB;
use Session;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = ['question', 'question'];
        $question = Question::with('option')->with('user')->orderBy('id', 'desc')->get();
        //dd($question);
        return view('question.index', compact('menu', 'question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = ['question', 'question'];
        $question = Question::orderBy('id', 'desc')->get();
        return view('question.create', compact('menu', 'question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'question' => 'required',
            'point' => 'required',
        ]);

        $table = new Question();
        $table->question = $request->question;
        $table->point = $request->point;
        $table->user_id = Auth::id();
        $table->status = $request->status;

        $table->save();
        return redirect()->route('question.create')
                        ->with('success','New Question added');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $question = Question::find($id);
        // $question->delete();
        // Session::flash('success', 'question has been deleted');
        // return redirect()->route('question.index');
    }
}
