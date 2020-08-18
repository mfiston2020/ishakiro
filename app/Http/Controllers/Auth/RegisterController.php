<?php

namespace App\Http\Controllers\Auth;


use App\Notifications\AccountCreatedNotification;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Notification;
use Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'gender' => ['required', 'string', 'max:255'],
            // 'national_id_card' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user   =   User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'role' => 'client',
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $id =   0;
        $users  =  User::all();
        foreach($users as $user)
        {
            $id = $user->id;
        }

        $client =   new \App\Other();
        $client->user_id    =   $id;
        $client->firstname  =   $data['firstname'];
        $client->lastname   =   $data['lastname'];
        $client->gender     =   $data['gender'];
        $client->phone      =   $data['phone'];
        // $client->nid        =   $data['national_id_card'];
        $client->email      =   $data['email'];

        $client->save();
        // Notification::route('mail', $data['email'])->notify(new AccountCreatedNotification());

        return $user;
    }
}
