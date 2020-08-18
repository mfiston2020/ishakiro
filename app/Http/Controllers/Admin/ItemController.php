<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\DocumentFoundNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use Crypt;
use Alert;
use Auth;

class ItemController extends Controller
{
    public function lostAdd()
    {
        $types   =   \App\DocumentType::all();
        return view('admin.document.lost',compact('types'));
    }

    public function addLost(Request $request){
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
                return redirect()->route('admin.myfound.document',Crypt::encryptString($id));
            } 
            catch (\Throwable $th) 
            {
                toast('Error Something Went Wrong!','error');
                return redirect()->route('home');
            }
        }
        else{
            $lost   =   new \App\LostDocument();

            $lost->owner_id =   Auth::user()->id;
            $lost->document_type    =   $request->document_type;
            $lost->owner_name    =   $request->owner_name;
            $lost->issue_place    =   $request->issue_place;
            $lost->expiry_date    =   date('Y-m',strtotime($request->expiry_date));
            $lost->document_number  =   $request->document_number;
            $lost->status           =   '0';
            $lost->found_state      =   '0';
            $lost->agent_approval      =   '1';
            $lost->type      =   'lost';

            try {
                $lost->save();
                toast('Lost Document Successfully Reported','success');
                return redirect()->route('home');
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
        return view('admin.document.found',compact('types'));
    }

    public function addFound(Request $request){
        $this->validate($request,[
            'owner_name'=>'required',
            'issue_place'=>'required',
            'document_type'=>'required',
            'document_number'=>'required',
            'document_place'=>'required',
        ]);

        $found  =   0;
        $id     =   1;
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
            $lost->owner_name    =   $request->owner_name;
            $lost->issue_place    =   $request->issue_place;
            $lost->found_state      =   '1';
            $lost->agent_approval      =   '1';
            $lost->type      =   'found';

            try 
            {
                $lost->save();
                if ($lost->owner_id==Auth::user()->id) 
                {
                    toast('Conglatulations You Found it by yourself!','success');
                    return redirect()->route('client');
                }
                else
                {
                    Notification::route('mail', $mail->email)->notify(new DocumentFoundNotification());
                    toast('The ID Owner will Reach out to you soon','success');
                    return redirect()->route('client');
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
            $lost->owner_name    =   $request->owner_name;
            $lost->issue_place    =   $request->issue_place;
            $lost->status           =   '0';
            $lost->found_state      =   '1';
            $lost->agent_approval      =   '1';
            $lost->type      =   'found';

            try 
            {
                $lost->save();
                toast('Lost Document Successfully Reported','success');
                return redirect()->route('client');
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
            return view('admin.report.more',compact('document'));
        } 
        
    }

    public function requested()
    {
        $documents   =   \App\LostDocument::where('requested','=','1')->get();
        return view('admin.document.requests',compact('documents'));
    }

    public function requested_confirm($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        $document->requested    =   '2';
        try {
            $document->save();
            toast('Request Approved!','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong!','error');
            return redirect()->back();
        }
    }
}
