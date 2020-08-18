<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ContactUsNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Notification;
use Crypt;
use Str;
use DB;

class ClientsController extends Controller
{
    public function index()
    {
        $clients    =   \App\Other::all();
        return view('admin.clients.index',compact('clients'));
    }
    public function add()
    {
        return view('admin.clients.create');
    }
    public function edit($id)
    {
        $client =   \App\Other::find(Crypt::decryptString($id));
        return view('admin.clients.edit',compact('client'));
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'gender'=>'required',
            'phone_number'=>'required | min:10 | max:10',
            'email'=>'required',
        ]);

        $client =   new \App\Other();
        $user   =   new \App\User();

        $password   =   $token = Str::random(10);

        $user->firstname  =   $request->firstname;
        $user->lastname   =   $request->lastname;
        $user->email      =   $request->email;
        $user->role      =   'other';
        $user->password   =   Hash::make($password);

        try {
            $user->save();
            Notification::route('mail', $request->get('email'))->notify(new AccountCreationNotification($password));

            $client->user_id    =   $user->id;
            $client->firstname  =   $request->firstname;
            $client->lastname   =   $request->lastname;
            $client->gender     =   $request->gender;
            $client->phone        =   $request->phone_number;
            $client->email      =   $request->email;
            try 
            {
                $client->save();
                toast('Client Created Successfully','success');
                return redirect()->route('admin.client');
            } catch (\Throwable $th) {
                toast('error! something Went Wrong!'.$th,'error');
                return redirect()->back()->withInput();
            }
        } 
        catch (\Throwable $th) 
        {
            toast('error! something Went Wrong!'.$th,'error');
            return redirect()->back()->withInput();
        }
    }

    public function update($id,Request $request)
    {
        
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'gender'=>'required',
            'phone_number'=>'required',
            'email'=>'required',
        ]);

        $user   =   \App\User::find(Crypt::decryptString($id));

        $user->firstname  =   $request->firstname;
        $user->lastname   =   $request->lastname;
        $user->email      =   $request->email;

        try {
            $user->save();

            $client     =   \App\Other::where(['user_id'=>Crypt::decryptString($id)])->select('*')->first();

            $client->user_id    =   $user->id;
            $client->firstname  =   $request->firstname;
            $client->lastname   =   $request->lastname;
            $client->gender     =   $request->gender;
            $client->phone        =   $request->phone_number;
            $client->email      =   $request->email;
            try 
            {
                $client->save();
                toast('Client Updated Successfully','success');
                return redirect()->route('admin.client');
            } catch (\Throwable $th) {
                toast('error! something Went Wrong!'.$th,'error');
                return redirect()->back()->withInput();
            }
        } 
        catch (\Throwable $th) 
        {
            toast('error! something Went Wrong!'.$th,'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $client =   \App\User::find(Crypt::decryptString($id));
        try {
            $client->delete();
            toast('Client Deleted Successfully!','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Something Went Wrong!','error');
            return redirect()->back();
        }
    }
}
