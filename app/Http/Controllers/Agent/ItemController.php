<?php

namespace App\Http\Controllers\Agent;

use App\Notifications\DocumentFoundNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use Alert;
use Crypt;
use Auth;

class ItemController extends Controller
{
    public function documents()
    {
        $documents  =   \App\LostDocument::all();
        return view('agent.reports.document',compact('documents'));
    }

    public function approve($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        $document->agent_approval   =   '1';
        try {
            $document->save();
            toast('The Document Was Approved','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong!','error');
            return redirect()->back();
        }
    }

    public function received($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        $document->received   =   '1';
        $document->found_state   =   '1';
        $document->status   =   '2';
        try {
            $document->save();
            toast('The Document Was Received','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong!','error');
            return redirect()->back();
        }
    }

    public function lostAdd()
    {
        $types   =   \App\DocumentType::all();
        return view('agent.lost-item.index',compact('types'));
    }

    public function addLost(Request $request)
    {
        $this->validate($request,[
            'owner_name'=>'required',
            'issue_place'=>'required',
            'document_type'=>'required',
            'document_number'=>'required | max:16',
        ]);

        $lost   =   \App\LostDocument::all();
        $found  =   0;
        $id     =   0;

        foreach ($lost as $key => $value) 
        {
            if ($value->document_type==$request->document_type && $value->document_number==$request->document_number) 
            {
                if ($value->found_state=='1') 
                {
                    $found  =   1;
                    $id     =   $value->id;
                }
                else
                {
                    $found  =   2;
                }
            }
        }

        if ($found==1) 
        {
            $lost   =   \App\LostDocument::find($id);

            $lost->owner_id =   Auth::user()->id;
            // $lost->found_state      =   '1';
            try {
                $lost->save();
                toast('You Found your Lost Document','success');
                return redirect()->route('agent.myfound.document',Crypt::encryptString($id));
            } 
            catch (\Throwable $th) 
            {
                toast('Error Something Went Wrong','error');
                return redirect()->route('agent');
            }
        }
        elseif($found==2)
        {
            Alert::info('Info','This Document was reported already');
            return redirect()->back();
        }
        else 
        {
            $lost   =   new \App\LostDocument();

            $lost->owner_id =   Auth::user()->id;
            $lost->document_type    =   $request->document_type;
            $lost->owner_name    =   $request->owner_name;
            $lost->issue_place    =   $request->issue_place;
            $lost->expiry_date    =   date('Y-m',strtotime($request->expiry_date));
            $lost->document_number  =   $request->document_number;
            $lost->status           =   '0';
            $lost->found_state      =   '1';
            $lost->type      =   'lost';

            try {
                $lost->save();
                toast('Lost Document Successfully Reported','success');
                return redirect()->route('agent');
            } 
            catch (\Throwable $th) {
                toast('Error! Something Went Wrong!','error');
                return redirect()->back()->withInput();
            }
        }
        

    }
    
    public function foundAdd()
    {
        $types   =   \App\DocumentType::all();
        return view('agent.lost-item.found-item',compact('types'));
    }

    public function addFound(Request $request)
    {
        $this->validate($request,[
            'document_type'=>'required',
            'document_number'=>'required',
            'document_place'=>'required',
        ]);

        $found  =   0;
        $id     =   0;
        $mail     =   null;

        $lost   =   \App\LostDocument::all();
        foreach ($lost as $key => $value) 
        {
            if ($value->document_type==$request->document_type && $value->document_number==$request->document_number) 
            {
                if ($value->found_state=='1') 
                {
                    $found  =   1;
                }
                else {
                    $found  =   2;
                    $id     =   $value->id;
                    $mail   =   \App\User::where(['id'=>$value->owner_id])->select('email')->first();
                }
            }
        }

        if ($found==1) 
        {
            toast('The Id was Found Before!','info');
            return redirect()->back()->withInput();
        } 
        elseif($found==2)
        {
            $lost   =   \App\LostDocument::find($id);

            $lost->founder_id =   Auth::user()->id;
            $lost->document_type    =   $request->document_type;
            $lost->place_of_keep    =   $request->document_place;
            $lost->found_state      =   '1';
            $lost->type      =   'found';

            try 
            {
                $lost->save();
                if ($lost->owner_id==Auth::user()->id) 
                {
                    toast('Conglatulations You Found it by yourself!','success');
                    return redirect()->route('agent');
                }
                else
                {
                    Notification::route('mail', $mail->email)->notify(new DocumentFoundNotification());
                    toast('The ID Owner will Reach out to you soon','success');
                    return redirect()->route('agent');
                }
                
            } 
            catch (\Throwable $th) 
            {
                toast('Error! Something Went Wrong!','error');
                return redirect()->back()->withInput();
            }
        }
        else 
        {
            $lost   =   new \App\LostDocument();

            $lost->founder_id =   Auth::user()->id;
            $lost->document_type    =   $request->document_type;
            $lost->document_number  =   $request->document_number;
            $lost->place_of_keep    =   $request->document_place;
            $lost->status           =   '0';
            $lost->found_state      =   '1';
            $lost->type      =   'found';

            try 
            {
                $lost->save();
                toast('Lost Document Successfully Reported','success');
                return redirect()->route('agent');
            } 
            catch (\Throwable $th) 
            {
                toast('Error! Something Went Wrong!','error');
                return redirect()->back()->withInput();
            }
        }
        
    }

    public function myFounds($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        if ($document->founder_id ==null) 
        {
            Alert::info('Info','This document is not yet found');
            return redirect()->back();
        } 
        else 
        {
            return view('agent.reports.more',compact('document'));
        }  
        
    }
}
