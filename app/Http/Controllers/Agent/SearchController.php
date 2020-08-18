<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_page()
    {
        $results    =   \App\LostDocument::where('id','=','jskdjflkjsdlkfjlksjf;klsdjalkfjlsdkjfklsajdflkjdslkfjlss')->select('*')->paginate();
        return view('agent.reports.search',compact('results'));
    }

    public function results2(Request $request)
    {
        $type   =   \App\DocumentType::select('*')->where('type','like','%' . $request->search . '%')->first();
        if (!$type==null) 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search)->orWhere('document_type', 'like', '%' . $type->id . '%')
                            ->orwhere('issue_place', 'like', '%' . $type->search_query . '%')
                            ->orwhere('owner_name', 'like', '%' . $type->search_query . '%')->where('status','=','1')->paginate(5);
            $query  =   $request->search_query;
            return view('agent.reports.search',compact('results','query','type'));
        } 
        else 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search_query)->where('status','=','1')
                                ->orwhere('issue_place', 'like', '%' . $type->search_query . '%')
                                ->orwhere('owner_name', 'like', '%' . $type->search_query . '%')->paginate(5);
                                
            $query  =   $request->search;
            return view('agent.reports.search',compact('results','query','type'));
        }
    }
}
