<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\News;
use App\User;
use DB;
use Session;
use Auth;

class NewsController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['news', 'news'];
        $news = News::with('user')->orderBy('id', 'desc')->get();
        return view('news.index', compact('menu', 'news'));
    }

    public function create()
    {
        $menu = ['news', 'news'];
        return view('news.create', compact('menu'));
    }
    
    
    public function profilePic()
    {
        $menu = ['news', 'news'];
        return view('news.profilepic', compact('menu'));
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
    

    public function userCreate()
    {
        $menu = ['news', 'news'];
        return view('news.user', compact('menu'));
    }

    public function userList()
    {
        $menu = ['news', 'news'];
        $user = User::all();
        return view('news.userlist', compact('user','menu'));
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
        $table->status = '420';

        $table->save();
         return redirect()->route('user.list')
                        ->with('success','New User Registered');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        request()->validate([
            // 'title' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            // 'type' => 'required',
        ]);

        $url = $this->url->to('/');

        // $imageName = time().'.'.request()->image->getClientOriginalExtension();

        // request()->image->move(public_path('uploads/articles'), $imageName);
        // $imgpath =$url.'/public/uploads/articles/'.$imageName;
        //dd($imgpath);

        $table = new News();
        // $table->title = $request->title;
        $table->description = $request->description;
        // $table->image = $imgpath;
        $table->user_id = Auth::id();
        // $table->type = $request->type;
        $table->status = $request->status;

        $table->save();
        return redirect()->route('news.index')
                        ->with('success','New News added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['news', 'news'];
        $news = News::findOrFail($id);

        return view('news.edit',compact('menu', 'news'));
    }

    public function update(Request $request, $id)
    {
      $data = News::find($id);

        // if ($request->hasfile('image')) {

        //     $url = $this->url->to('/');
        //     $iamge = $request->file('image');
        //     $file_name = time().'.'.$image->getClientOriginalExtension();
        //     $old_file = $data->image;
        //     dd($old_file);
        //     $request->image->move(public_path('uploads/articles'), $file_name);
        //     $data->image = $file_name;
        //     $image_path =$url.'/uploads/articles/'.$old_file;
        //     unlink($image_path);

        // }

        // $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->user_id = Auth::id();
        $data->status = $request->input('status');

        $data->save();
        Session::flash('success', 'News has been updated');
        return redirect()->route('news.index');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        Session::flash('success', 'News has been deleted');
        return redirect()->route('news.index');
    }
    
}
