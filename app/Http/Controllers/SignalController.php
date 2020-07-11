<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Signal;
use DB;
use Session;
use Auth;

class SignalController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['signal', 'signal'];
        $signal = Signal::orderBy('id', 'desc')->get();
        // dd($signal->toArray());
        return view('signal.index', compact('menu', 'signal'));
    }

    public function create()
    {
       $menu = ['signal', 'signal'];
       return view('signal.create', compact('menu'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        request()->validate([
            'signal_type' => 'required',
            'signal_name' => 'required',
            'signal_description' => 'required',
            'status' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $url = $this->url->to('/');

        // $imageName = time().'.'.request()->image->getClientOriginalExtension();

        // request()->image->move(public_path('uploads/quiz'), $imageName);
        
        // $imgpath =$url.'/uploads/quiz/'.$imageName;


        foreach($request->file('image') as $image_data)
        {
            // dd($image_data);
            $name=$image_data->getClientOriginalName();
            $image_data->move(public_path().'/uploads/signal/', $name);  
            $imgpath =$url.'/uploads/signal/'.$name;
            $data[] = $imgpath;  
        }
            // dd($data);
         // $form->filename=json_encode($data);


        $table = new Signal();
        $table->signal_type = $request->signal_type;
        $table->signal_name = $request->signal_name;
        $table->signal_description = $request->signal_description;
        $table->image = json_encode($data);
        $table->status = $request->status;

        $table->save();
        return redirect()->route('signal.index')
                        ->with('success','New Signal added');
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
        $signal = Signal::find($id);
        $signal->delete();
        Session::flash('success', 'signal has been deleted');
        return redirect()->route('signal.index');
    }
}
