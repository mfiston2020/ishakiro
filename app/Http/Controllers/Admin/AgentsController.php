<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\AccountCreationNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Notification;
use Crypt;
use Str;
use DB;

class AgentsController extends Controller
{
    public function index()
    {
        $agents    =   \App\Agent::all();
        return view('admin.agent.index',compact('agents'));
    }
    public function add()
    {
        return view('admin.agent.create');
    }
    public function edit($id)
    {
        $client =   \App\Agent::find(Crypt::decryptString($id));
        return view('admin.agent.edit',compact('client'));
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'gender'=>'required',
            'phone_number'=>'required',
            'national_id_number'=>'required | min:16 | max:16',
            'email'=>'required',
        ]);

        $client =   new \App\Agent();
        $user   =   new \App\User();

        $password   =   $token = Str::random(10);

        $user->firstname  =   $request->firstname;
        $user->lastname   =   $request->lastname;
        $user->email      =   $request->email;
        $user->gender      =   $request->gender;
        $user->phone      =   $request->phone_number;
        $user->role      =   'agent';
        $user->password   =   Hash::make($password);

        try {
            $user->save();

            $client->user_id    =   $user->id;
            $client->firstname  =   $request->firstname;
            $client->lastname   =   $request->lastname;
            $client->gender     =   $request->gender;
            $client->nid        =   $request->national_id_number;
            $client->phone        =   $request->phone_number;
            try 
            {
                $client->save();
                Notification::route('mail', $request->get('email'))->notify(new AccountCreationNotification($password));
                toast('Client Created Successfully','success');
                return redirect()->route('admin.agent');
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
            'phone_number'=>'required | min:10 | max:10',
            'national_id_number'=>'required',
            'email'=>'required',
        ]);

        $user   =   \App\User::find(Crypt::decryptString($id));

        $user->firstname  =   $request->firstname;
        $user->lastname   =   $request->lastname;
        $user->email      =   $request->email;
        $user->phone      =   $request->phone_number;
        $user->gender     =   $request->gender;

        try 
        {
            $user->save();

            $client     =   \App\Agent::where(['user_id'=>Crypt::decryptString($id)])->select('*')->first();

            $client->user_id    =   $user->id;
            $client->firstname  =   $request->firstname;
            $client->lastname   =   $request->lastname;
            $client->gender     =   $request->gender;
            $user->phone        =   $request->phone_number;
            $client->nid        =   $request->national_id_number;
            // $client->email      =   $request->email;
            try 
            {
                $client->save();
                toast('Client Updated Successfully','success');
                return redirect()->route('admin.agent');
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
}
