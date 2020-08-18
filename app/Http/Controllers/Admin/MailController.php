<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;

class MailController extends Controller
{
    public function inbox()
    {
        $mail   =   \App\ContactUs::all();
        return view('admin.mail.inbox',compact('mail'));
    }

    public function read($id)
    {
        $message   =   \App\ContactUs::find(Crypt::decryptString($id));
        $message->status    =   '1';
        $message->save();
        return view('admin.mail.read',compact('message'));
    }
}
