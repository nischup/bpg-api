<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests;
use App\Message;
use App\VisitRequisition;
use Session;
use Auth;
use Mail;
use DB;

class MessageController extends Controller
{

    public function index()
    {
        $menu = ['message', 'message'];
        $message = Message::orderBy('id', 'desc')->get();
        //dd($message);
        return view('message.index', compact('menu', 'message'));
    }


    public function create()
    {
        $menu = ['message', 'message'];
        return view('message.create', compact('menu', 'message'));
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message_description' => $request->message,
        ];

        Message::create($data);

        Mail::send('email',
           array(
               'name' => $request->get('name'),
               'email' => $request->get('email'),
               'subject' => $request->get('subject'),
               'customer_message' => $request->get('message'),
           ), function($message) use ($request)
       {
           $message->from($request->email);
           $message->to('noreplay-tradewme@gmail.com', 'Support')->subject('Contact Message');
       });

        DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Message Send Successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
        }


    }    

    public function sendReq(Request $request)
    {


        $data = [
            'concern' => $request->concern,
            'date' => $request->date,
            'purpose' => $request->purpose,
            'type' => $request->type,
        ];

        $saveData = VisitRequisition::create($data);

        return response()->json([
            'status' => "success",
            'code' => "200",
            'data' => $saveData,
        ], 200);

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
        $message = Message::find($id);
        $message->delete();
        Session::flash('success', 'message has been deleted');
        return redirect()->route('message.index');
    }
}
