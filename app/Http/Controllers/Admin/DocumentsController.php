<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use DB;

class DocumentsController extends Controller
{
    // public function index()
    // {
    //     $documents  =   \App\LostDocument::all();
    //     return view('admin.document.index',compact('documents'));
    // }

    public function addType()
    {
        $types  =   \App\DocumentType::all();
        return view('admin.document.add-type',compact('types'));
    }

    public function saveType(Request $request)
    {
        $this->validate($request,[
            'document_type'=>'required',
        ]);

        $type   =   new \App\DocumentType();

        $type->type =   $request->document_type;
        try 
        {
            $type->save();
            toast('Document Type Successfully added','success');
            return redirect()->back();
        } 
        catch (\Throwable $th) {
            toast('Document Type Successfully added','success');
            return redirect()->back();
        }
    }

    public function newReports()
    {
        $lost_documents     =  DB::table('lost_documents')->orderBy('created_at','DESC')->get();
        return view('admin.report.new',compact('lost_documents'));
    }

    public function pendingDocument($id)
    {
        $documents  =   \App\LostDocument::find(Crypt::decryptString($id));
        $documents->status  =   '1';
        try {
            $documents->save();
            toast('Status Changed','success');
            return redirect()->back();
        } catch (\Throwable $th)
        {
            toast('Error! Something Went Wrong!','error');
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

    public function approve($id)
    {
        $document   =   \App\LostDocument::find(Crypt::decryptString($id));
        $document->agent_approval   =   '1';
        // $document->status   =   '1';
        try {
            $document->save();
            toast('The Document Was Approved','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Error Something Went Wrong!','error');
            return redirect()->back();
        }
    }
}
