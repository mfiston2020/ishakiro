<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Alert;

class SearchController extends Controller
{
    public function update(Request $request)
    {
        $id     =   $request->get('pk');
        $name   =   $request->input('name');
        $value   =   $request->input('value');

        $type    =   \App\DocumentType::find($id);

        if($name=='type')
        {
            $type->type     =   $value;
            $type->save();
            return 'successfully saved';    
        }
    }
    public function results(Request $request)
    {
        $type   =   \App\DocumentType::select('*')->where('type','like','%' . $request->search_query . '%')->first();
        if (!$type==null) 
        {
            $search     =   \App\LostDocument::orwhere('document_number', $request->search_query)->orWhere('document_type', 'like', '%' . $type->id . '%')
                                ->where('status','=','1')->orwhere('issue_place', 'like', '%' . $request->search_query . '%')
                                ->orwhere('owner_name', 'like', '%' . $request->search_query . '%')
                                ->where('received','=','0')->paginate(10);

            $query  =   $request->search_query;
            return view('search-result',compact('search','query','type'));
        } 
        else 
        {
            $search     =   \App\LostDocument::where('document_number', 'like', '%' . $request->search_query . '%')
                            ->where('status','=','1')->orwhere('issue_place', 'like', '%' . $request->search_query . '%')
                            ->orwhere('owner_name', 'like', '%' . $request->search_query . '%')
                            ->where('received','=','0')->paginate(10);
            $query  =   $request->search_query;
            // return $search;
            return view('search-result',compact('search','query','type'));
        }
    }

    public function search_page()
    {
        $results    =   \App\LostDocument::where('id','=','jskdjflkjsdlkfjlksjf;klsdjalkfjlsdkjfklsajdflkjdslkfjlss')->select('*')->paginate();
        return view('client.reports.search',compact('results'));
    }

    public function results2(Request $request)
    {
        $type   =   \App\DocumentType::select('*')->where('type','like','%' . $request->search . '%')->first();
        if (!$type==null) 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search)->orWhere('document_type', 'like', '%' . $type->id . '%')
                            ->where('status','=','1')->paginate(5);
            $query  =   $request->search_query;
            return view('client.reports.search',compact('results','query','type'));
        } 
        else 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search_query)->where('status','=','1')->paginate(5);
            $query  =   $request->search;
            return view('client.reports.search',compact('results','query','type'));
        }
    }


    public function mode1()
    {
        Session::put('mode','dark');
        return redirect()->back();
    }


    public function mode2()
    {
        Session::put('mode','white');
        return redirect()->back();
    }


    public function message(Request $request)
    {
        $message    =   new \App\ContactUs();

        $message->name  =   $request->name;
        $message->email  =   $request->email;
        $message->reason  =   $request->reason;
        $message->message  =   $request->message;

        try {
            $message->save();
            Alert::success('Message','Sent Successfully!');
            return redirect()->back();
        } catch (\Throwable $th) 
        {
            Alert::error('Error','Message Not Sent!');
            return redirect()->back()->withInput();
        }
    }
}