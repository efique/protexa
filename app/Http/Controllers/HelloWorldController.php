<?php

namespace App\Http\Controllers;

use App\Mail\HelloWorld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HelloWorldController extends Controller
{
    public function create()
    {
        return view('emails.helloWorld');
    }

    public function send(Request $request)
    {
        Mail::to($request["mail"])
            ->send(new HelloWorld($request));
 
        return view('emails.helloWorld', ['date'=>HelloWorld::$date]);
    }
}
