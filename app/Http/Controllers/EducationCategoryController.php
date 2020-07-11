<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\EducationCategory;
use DB;
use Session;
use Auth;

class EducationCategoryController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['category', 'category'];
        $category = EducationCategory::orderBy('id', 'desc')->get();
        //dd($EducationCategory);
        return view('category.index', compact('menu', 'category'));
    }

    public function create()
    {
        $menu = ['category', 'category'];
        return view('category.create', compact('menu'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'category' => 'required',
            'status' => 'required',
        ]);

        $table = new EducationCategory();
        $table->title = $request->category;
        $table->status = $request->status;

        $table->save();
        return redirect()->route('category.index')
                        ->with('success','New Category added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['category', 'category'];
        $category = EducationCategory::findOrFail($id);

        return view('category.edit',compact('menu', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = EducationCategory::find($id);

        $data->title = $request->input('title');
        $data->status = $request->input('status');

        $data->save();
        Session::flash('success', 'category has been updated');
        return redirect()->route('category.index');

    }

    public function destroy($id)
    {
        $category = EducationCategory::find($id);
        $category->delete();
        Session::flash('success', 'category has been deleted');
        return redirect()->route('category.index');
	}
}
