<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Article;
use DB;
use Session;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = ['article', 'articles'];
        $article = Article::with('user')->orderBy('id', 'desc')->get();
        //$headers= [];
        //return response($content = $article, $status = 200);
        //dd($article);
        return view('articles.index', compact('menu', 'article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = ['article', 'articles'];
        return view('articles.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        request()->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('uploads/articles'), $imageName);

        //dd($imageName);

        $table = new Article();
        $table->title = $request->title;
        $table->description = $request->description;
        $table->image = $imageName;
        $table->user_id = Auth::id();
        $table->status = $request->status;

        $table->save();
        return redirect()->route('articles.index')
                        ->with('success','New Article added');
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
        $menu = ['article', 'articles'];
        $article = Article::findOrFail($id);

        return view('articles.edit',compact('menu', 'article'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        Session::flash('success', 'Article has been deleted');
        return redirect()->route('articles.index');
    }
}
