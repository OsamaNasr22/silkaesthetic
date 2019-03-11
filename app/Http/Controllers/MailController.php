<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use App\Setting;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        // TODO: Implement __invoke() method.


    }
    public function sendMail(Request $request){

        $this->validate($request ,[
            'name'=>'required|string',
            'phone'=>'required|numeric',
            'sender'=>'required|email',
            'message'=>'required|string|min:10'
        ]);

        $data= [
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'sender'=>$request['sender'],
            'message'=>$request['message'],
        ];
        $settings= Setting::find(1);
        Mail::to($settings->email)->send(new SendMessage($data));
        return redirect()->back()->with(['success'=>'Your message send successfully']);

    }
}
