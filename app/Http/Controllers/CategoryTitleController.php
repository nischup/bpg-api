<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Article;
use App\EducationCategory;
use App\EducationTitle;
use DB;
use Session;
use Auth;

class CategoryTitleController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['category-title', 'category-title'];
        $category_title = EducationTitle::with('category')->orderBy('id', 'desc')->get();
        // dd($category_title->toArray());
        return view('category-title.index', compact('menu', 'category_title'));
    }

    public function create()
    {
        $menu = ['category-title', 'category-title'];
        $category = EducationCategory::orderBy('id', 'desc')->get()->toArray();
        return view('category-title.create', compact('menu', 'category'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'category_id' => 'required',
            'category_title' => 'required',
            'category_description' => 'required',
            'status' => 'required',
        ]);

        $table = new EducationTitle();
        $table->category_id = $request->category_id;
        $table->category_title = $request->category_title;
        $table->category_description = $request->category_description;
        $table->status = $request->status;

        $table->save();
        return redirect()->route('category-title.index')
                        ->with('success','New Category added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['category-title', 'category-title'];
        $category = EducationCategory::orderBy('id', 'desc')->get()->toArray();
        $category_title = EducationTitle::with('category')->findOrFail($id);

        return view('category-title.edit',compact('menu', 'category_title', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = EducationTitle::find($id);

        $data->category_id = $request->input('category_id');
        $data->category_title = $request->input('category_title');
        $data->category_description = $request->input('category_description');
        $data->status = $request->input('status');

        $data->save();
        Session::flash('success', 'category has been updated');
        return redirect()->route('category-title.index');

    }

    public function destroy($id)
    {
        $category = EducationTitle::find($id);
        $category->delete();
        Session::flash('success', 'category has been deleted');
        return redirect()->route('category.index');
    }
}
