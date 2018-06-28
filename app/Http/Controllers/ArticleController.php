<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\QuizTopic;
use App\InfoGraph;
use App\Article;
use App\User;
use App\PlayedQuiz;
use DB;
use Session;
use Auth;

class ArticleController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['article', 'articles'];
        $article = Article::with('user')->orderBy('id', 'desc')->get();
        //$headers= [];
        //return response($content = $article, $status = 200);
        //dd($article);
        return view('articles.index', compact('menu', 'article'));
    }

    public function create()
    {
        $menu = ['article', 'articles'];
        return view('articles.create', compact('menu'));
    }
    
    
    public function profilePic()
    {
        $menu = ['article', 'articles'];
        return view('articles.profilepic', compact('menu'));
    }

    public function saveProfilePic(Request $request) {

  
        
        $id = $request->id;
        $data = User::find($id);
        $profile_image = $request->profile_image;
        
        if ($data->profile_image != $profile_image &&  $profile_image != "") {
             $data->profile_image = $profile_image;
             $data->save();
             
             return response()->json([
            'status' => "success",
            'code' => "200",
            'data' =>  User::find($id)
        ], 200);
        }
      

    }
    
    public function getscore($id) {
        $total_obtain_point = PlayedQuiz::where('user_id', $id)->sum('obtain_point');
        $right_ans = PlayedQuiz::where('user_id', $id)->sum('right_ans');
        $wrong_ans = PlayedQuiz::where('user_id', $id)->sum('wrong_ans');
        $total_question = PlayedQuiz::where('user_id', $id)->sum('total_question');
        $played_quiz = PlayedQuiz::where('user_id', $id)->count('quiz_id');

        $score = [
            "played_quiz" => $played_quiz,
            "total_obtain_point" => $total_obtain_point,
            "total_question" => $total_question,
            "wrong_ans" => $wrong_ans,
            "right_ans" => $right_ans
        ];

        return response($content = $score, $status = 200);
    }

    public function userCreate()
    {
        $menu = ['article', 'articles'];
        return view('articles.user', compact('menu'));
    }

    public function userList()
    {
        $menu = ['article', 'articles'];
        $user = User::all();
        return view('articles.userlist', compact('user','menu'));
    }

    public function userdelete($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'user has been deleted');
        return redirect()->route('user.list');
    }

    public function register(Request $request) {

        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $table = new User();
        $table->name = $request->name;
        $table->email = $request->email;
        $table->password = bcrypt($request->password);

        $table->save();
         return redirect()->route('user.page')
                        ->with('success','New User Registered');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);

        $url = $this->url->to('/');

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('uploads/articles'), $imageName);
        $imgpath =$url.'/public/uploads/articles/'.$imageName;
        //dd($imgpath);

        $table = new Article();
        $table->title = $request->title;
        $table->description = $request->description;
        $table->image = $imgpath;
        $table->user_id = Auth::id();
        $table->type = $request->type;
        $table->status = $request->status;

        $table->save();
        return redirect()->route('articles.index')
                        ->with('success','New Article added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['article', 'articles'];
        $article = Article::findOrFail($id);

        return view('articles.edit',compact('menu', 'article'));
    }

    public function update(Request $request, $id)
    {
      $data = Article::find($id);

        if ($request->hasfile('image')) {

            $url = $this->url->to('/');
            $iamge = $request->file('image');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $old_file = $data->image;
            dd($old_file);
            $request->image->move(public_path('uploads/articles'), $file_name);
            $data->image = $file_name;
            $image_path =$url.'/uploads/articles/'.$old_file;
            unlink($image_path);

        }

        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->user_id = Auth::id();
        $data->status = $request->input('status');

        $data->save();
        Session::flash('success', 'Article has been updated');
        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        Session::flash('success', 'Article has been deleted');
        return redirect()->route('articles.index');
    }
    
    public function searchFilter($title){
        $url = $this->url->to('/');
        $filter = $title;
        
        $first = DB::table('articles')
            ->select('id','title', 'description', 'image', 'type')
            ->where('title', 'like', $filter.'%');

        $second = DB::table('info_graphs')
            ->select( 'id','title', 'description', 'image', 'type')
            ->where('title', 'like', $filter.'%')
             ->union($first)
            ->get(); 
        
        // $third = DB::table('quiz_topics')
        //     ->select('id', DB::raw("quiz_title  AS title"))
        //     ->where('quiz_title', 'like', $filter.'%')
        //     ->union($first)
        //     ->union($second)
        //     ->get();    
            
         return response()->json([
            'status' => "success",
            'code' => "200",
            'data' => $second,
        ], 200);   
    }
    
    public function searchView($table, $id){
        $data = DB::table($table)
            ->where('id', '=', $id)
            ->first();
            
        return response()->json([
            'status' => "success",
            'code' => "200",
            'data' => $data,
        ], 200);      
    }
}
