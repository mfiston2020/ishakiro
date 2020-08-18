<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $document=  \App\Document::where('owner_id','=',Auth::user()->id)->select('*')->get();
        $types   =   \App\DocumentType::all();

        return view('client.document',compact('document','types'));
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'document_type'=>'required',
            'document_number'=>'required | max:16',
            'issue_place'=>'required',
        ]);

        $document   =   new \App\Document();

        $document->owner_id         =   Auth::user()->id;
        $document->document_type    =   $request->document_type;
        $document->document_number  =   $request->document_number;
        $document->issue_place      =   $request->issue_place;
        $document->expire_date      =   $request->expiration;

        $documents_search   =   0;
        $type   =   0;

        $doc    =   \App\Document::all();
        foreach ($doc as $key => $value) 
        {
            // if ($value->owner_id==Auth::user()->id && $value->document_type==$request->document_type && $value->document_number==$request->document_number) 
            // {
            //     $documents_search   =   1;
            // }
            if ($value->document_type==$request->document_type) 
            {
                $type   =   1;
            }
        }
        if ($type==1) {
            $id =   \App\DocumentType::where(['id'=>$request->document_type])->pluck('type')->first();
            toast('You already registered a(n) '.$id,'info');
            return redirect()->back();
        }
        else
        {
            try {
                $document->save();
                toast('Document Saved Successfully!','success');
                return redirect()->back();
            } catch (\Throwable $th) {
                toast('Oops!! Something Went Wrong!','success');
                return redirect()->back();
            }
        }
    }

    public function fetch(Request $request)
    {

        $data   =   \App\Document::where(['document_type'=>$request->id])->select('*')->get();
        return $data;
    }
}
