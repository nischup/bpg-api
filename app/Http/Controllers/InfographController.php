<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Article;
use App\InfoGraph;
use DB;
use Session;
use Auth;

class InfographController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['infograph', 'infograph'];
        $infograph = InfoGraph::with('user')->orderBy('id', 'desc')->get();
        //dd($infograph);
        return view('infograph.index', compact('menu', 'infograph'));
    }

    public function create()
    {
        $menu = ['infograph', 'infograph'];
        return view('infograph.create', compact('menu'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);

        $url = $this->url->to('/');
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('uploads/infograph'), $imageName);
        $imgpath =$url.'/uploads/infograph/'.$imageName;
       // dd($imgpath);

        $table = new InfoGraph();
        $table->title = $request->title;
        $table->description = $request->description;
        $table->image = $imgpath;
        $table->user_id = Auth::id();
        $table->type = $request->type;
        $table->status = $request->status;

        $table->save();
        return redirect()->route('infograph.index')
                        ->with('success','New Infograph added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['infograph', 'infograph'];
        $infograph = InfoGraph::findOrFail($id);

        return view('infograph.edit',compact('menu', 'infograph'));
    }

    public function update(Request $request, $id)
    {
        $data = InfoGraph::find($id);
        if ($request->hasfile('image')) {
            $url = $this->url->to('/');
            $iamge = $request->file('image');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $old_file = $data->image;
            dd($old_file);
            $request->image->move(public_path('uploads/infograph'), $file_name);
            $data->image = $file_name;
            $image_path =$url.'/uploads/articles/'.$old_file;
            unlink($image_path);
        }

        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->user_id = Auth::id();
        $data->status = $request->input('status');

        $data->save();
        Session::flash('success', 'infograph has been updated');
        return redirect()->route('infograph.index');

    }

    public function destroy($id)
    {
        $infograph = InfoGraph::find($id);
        $infograph->delete();
        Session::flash('success', 'Infograph has been deleted');
        return redirect()->route('infograph.index');
    }
}
