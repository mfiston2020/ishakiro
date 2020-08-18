<?php

namespace App\Http\Controllers\Client;

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
        $myDoc  =   \App\Document::where('owner_id','=',Auth::user()->id)->select('*')->get();
        return view('client.lost-item.index',compact('types','myDoc'));
    }

    public function addLost(Request $request){

        if ($request->own_doc) {
            $this->validate($request,[
                'owner_name'=>'required',
                'issue_place'=>'required',
                'document_type_'=>'required',
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
                    return redirect()->route('client.myfound.document',Crypt::encryptString($id));
                } 
                catch (\Throwable $th) 
                {
                    toast('Error Something Went Wrong!'.$th,'error');
                    return redirect()->route('client');
                }
            }
            else{
                $lost   =   new \App\LostDocument();

                $lost->owner_id =   Auth::user()->id;
                $lost->document_type    =   $request->document_type_;
                $lost->owner_name    =   $request->owner_name;
                $lost->issue_place    =   $request->issue_place;
                $lost->expiry_date    =   date('Y-m',strtotime($request->expiry_date));
                $lost->document_number  =   $request->document_number;
                $lost->status           =   '0';
                $lost->found_state      =   '0';
                $lost->type      =   'lost';

                try 
                {
                    $lost->save();
                    toast('Lost Document Successfully Reported','success');
                    return redirect()->route('client');
                } 
                catch (\Throwable $th) {
                    toast('Error! Something Went Wrong!','error');
                    return redirect()->back()->withInput();
                }
            }
        }
        else
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
                    return redirect()->route('client.myfound.document',Crypt::encryptString($id));
                } 
                catch (\Throwable $th) 
                {
                    toast('Error Something Went Wrong!','error');
                    return redirect()->route('client');
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
                $lost->type      =   'lost';

                try 
                {
                    $lost->save();
                    toast('Lost Document Successfully Reported','success');
                    return redirect()->route('client');
                } 
                catch (\Throwable $th) {
                    toast('Error! Something Went Wrong!','error');
                    return redirect()->back()->withInput();
                }
            }
        }

        
    }


    
    public function foundAdd()
    {
        $types   =   \App\DocumentType::all();
        return view('client.lost-item.found-item',compact('types'));
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

    public function myLost()
    {
        $losts  =   \App\LostDocument::where(['owner_id'=>Auth::user()->id])->select('*')->get();
        return view('client.reports.lost',compact('losts'));
    }

    public function myFound($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        if ($document->founder_id ==null) 
        {
            Alert::info('Info','This document is not yet found');
            return redirect()->back();
        } 
        else 
        {
            return view('client.reports.more',compact('document'));
        }     
    }

    public function request_permission($id)
    {
        $id =    Crypt::decryptString($id);
        $document   =   \App\LostDocument::find($id);
        $document->requested    =  '1';
        $document->info    =  Auth::user()->id;
        try 
        {
            $document->save();
            toast('Request Sent!','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong!','error');
            return redirect()->back();
        }
    }
}
