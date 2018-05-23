<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Article;
use App\User;
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

    public function userCreate()
    {
        $menu = ['article', 'articles'];
        return view('articles.user', compact('menu'));
    }

    public function register(Request $request) {

        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $table = new User();
        $table->name = $request->name;
        $table->email = $request->email;
        $table->password = bcrypt($request->password);

        $table->save();
        return response()->json(['status' => 'success','message' => 'registration success']);
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
        $imgpath =$url.'/uploads/articles/'.$imageName;
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
        $table = Article::find($id);
        $table->title = $request->input('title');
        $table->description = $request->input('description');
        $table->image = $request->input('image');
        $table->user_id = Auth::id();
        $table->status = $request->input('status');

        $table->save();
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
}
