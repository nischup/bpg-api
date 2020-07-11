<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Pips;
use DB;
use Session;
use Auth;

class PipsController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $menu = ['pips', 'pips'];
        $pips = Pips::orderBy('id', 'desc')->get();
        //dd($Pips);
        return view('pips.index', compact('menu', 'pips'));
    }

    public function create()
    {
        $menu = ['pips', 'pips'];
        return view('pips.create', compact('menu'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'pips' => 'required',
            'month_year' => 'required',
        ]);

        $table = new Pips();
        $table->month_year = $request->month_year;
        $table->pips = $request->pips;

        $table->save();
        return redirect()->route('pips.index')
                        ->with('success','New pips added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = ['pips', 'pips'];
        $pips = Pips::findOrFail($id);

        return view('pips.edit',compact('menu', 'pips'));
    }

    public function update(Request $request, $id)
    {
        $data = Pips::find($id);

        $data->month_year = $request->input('month_year');
        $data->pips = $request->input('pips');

        $data->save();
        Session::flash('success', 'pips has been updated');
        return redirect()->route('pips.index');

    }

    public function destroy($id)
    {
        $pips = Pips::find($id);
        $pips->delete();
        Session::flash('delete', 'pips has been deleted');
        return redirect()->route('pips.index');
    }
}
