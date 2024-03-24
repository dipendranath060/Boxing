<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:11',
            'message' => 'required|min:5|max:100'
        ]);

        Mail::to('backenddev.binaryshastra@gmail.com')->send(new SendMail($data));
        return redirect()->route('contact')
                ->with('message', 'Message Submitted Successfully...We will get in touch with you shortly....');
    // dd($request->all());
    }
}
