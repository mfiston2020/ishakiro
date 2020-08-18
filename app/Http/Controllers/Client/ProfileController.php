<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.profile');
    }

    public function update_email(Request $request)
    {
        $this->validate($request,[
            'email'=>'required | email',
        ]);

        $user = \App\User::findOrFail(Auth::user()->id);

        $user->email    =   $request->email;
        try {
            $user->save();
            toast('Email successfully changed','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong','error');
            return redirect()->back();
        }
    }

    public function update_password(Request $request)
    {
        $this->validate($request,[
            'old_password'=>'required | string | min:8',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\User::findOrFail(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) { 
            $user->fill([
             'password' => Hash::make($request->password)
             ])->save();
         
            toast('Your Password Changed successfully!','success');
            return redirect()->back();
         
         } else {
             toast('Old Password does not match!','error');
             return redirect()->back()->withInput();
         }
    }
}
