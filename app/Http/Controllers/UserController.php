<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\User;
use DB;
use Session;
use Auth;

class UserController extends Controller
{
     protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function upgradeToPremium(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

             $data->status = '1';
             $data->save();

             return response()->json([
            'status' => "success",
            'code' => "200",
            'data' =>  User::find($id)
        ], 200);

        return response()->json(['status' => 'error','message' => 'We Could not Find the name']);
    }

    public function updateName(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $new_name = $request->name;
        if ($data->name != $new_name && $new_name != "") {
             $data->name = $new_name;
             $data->save();

             return response()->json([
            'status' => "success",
            'code' => "200",
            'data' =>  User::find($id)
        ], 200);
        }
        return response()->json(['status' => 'error','message' => 'We Could not Find the name']);
    }

    public function updateEmail(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $new_email = $request->email;
        if ($data->email != $new_email && $new_email != "") {
             $data->email = $new_email;
             $data->save();
             
             return response()->json([
            'status' => "success",
            'code' => "200",
            'data' =>  User::find($id)
        ], 200);
        }
        return response()->json(['status' => 'error','message' => 'We Could not Find the Email']);
    }

    public function updatePassword(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $new_pass = bcrypt($request->password);
        if ($data->password != $new_pass && $new_pass != "") {
             $data->password = $new_pass;
             $data->save();
             
             return response()->json([
            'status' => "success",
            'code' => "200",
            'data' =>  User::find($id)
        ], 200);
        }
        return response()->json(['status' => 'error']);
    }

    public function update(Request $request, $id)
    {
        //
    }
}
