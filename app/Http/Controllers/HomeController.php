<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $other  =   count(\App\Other::all());
        $agent  =   count(\App\Agent::all());
        $type   =   count(\App\DocumentType::all());

        $all        =   count(\App\LostDocument::all());
        $found      =   count(\App\LostDocument::select('*')->where('type','=','found')->get());
        $pending    =   count(\App\LostDocument::select('*')->where('status','=','1')->get());
        $received   =   count(\App\LostDocument::select('*')->where('status','=','2')->get());
        $request    =   count(\App\LostDocument::select('*')->where('requested','=','1')->get());
        $lost       =   count(\App\LostDocument::select('*')->where('type','=','lost')->get());

        $umail      =   count(\App\ContactUs::select('*')->where('status','=','0')->get());
        $mail       =   count(\App\ContactUs::all());

        return view('home',compact('other','agent','type','all','found','pending','mail','received','umail','request','lost'));
    }
    public function agent_index()
    {
        // $all        =   count(\App\LostDocument::all());
        $found      =   count(\App\LostDocument::select('*')->where('found_state','=','1')->get());
        $pending    =   count(\App\LostDocument::select('*')->where('status','=','1')->get());

        return view('agent.index',compact('found','pending'));
    }

    public function client_index()
    {
        $lost   =   count(\App\LostDocument::where(['owner_id'=>Auth::user()->id])->select('*')->where('found_state','=','0')->get());
        $found   =   count(\App\LostDocument::where(['founder_id'=>Auth::user()->id])->select('*')->get());
        $documents   =   count(\App\Document::where(['owner_id'=>Auth::user()->id])->select('*')->get());
        return view('client.index',compact('lost','found','documents'));
    }
}
