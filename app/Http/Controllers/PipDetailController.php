<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Pips;
use App\Signal;
use App\PipDetail;
use DB;
use Session;
use Auth;

class PipDetailController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['pips_detail', 'pips_detail'];
        $pips_detail = PipDetail::with('pips', 'signal')->orderBy('id', 'desc')->get();
        // dd($pips_detail->toArray());
        return view('pips_detail.index', compact('menu', 'pips_detail'));
    }

    public function create()
    {
        $menu = ['pips_detail', 'pips_detail'];
        $pips = Pips::orderBy('id', 'desc')->get()->toArray();
        $signal = Signal::orderBy('id', 'desc')->get()->toArray();
        return view('pips_detail.create', compact('menu', 'pips', 'signal'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'pips_id' => 'required',
            'signal_id' => 'required',
            'pips_number' => 'required',
            'pips_type' => 'required',
        ]);

        $table = new PipDetail();
        $table->pips_id = $request->pips_id;
        $table->signal_id = $request->signal_id;
        $table->pips_number = $request->pips_number;
        $table->pips_type = $request->pips_type;

        $table->save();
        return redirect()->route('pips_detail.index')
                        ->with('success','New pips_detail added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['pips_detail', 'pips_detail'];
        $pips = Pips::orderBy('id', 'desc')->get()->toArray();
        $signal = Signal::orderBy('id', 'desc')->get()->toArray();
        $pips_detail = PipDetail::with('pips', 'signal')->findOrFail($id);

        return view('pips_detail.edit',compact('menu', 'pips_detail', 'pips','signal'));
    }

    public function update(Request $request, $id)
    {
        $data = PipDetail::find($id);

        $data->pips_id = $request->input('pips_id');
        $data->signal_id = $request->input('signal_id');
        $data->pips_number = $request->input('pips_number');
        $data->pips_type = $request->input('pips_type');

        $data->save();
        Session::flash('success', 'pips_detail has been updated');
        return redirect()->route('pips_detail.index');

    }

    public function destroy($id)
    {
        $pips_detail = PipDetail::find($id);
        $pips_detail->delete();
        Session::flash('delete', 'pips_detail has been deleted');
        return redirect()->route('pips_detail.index');
    }
}
