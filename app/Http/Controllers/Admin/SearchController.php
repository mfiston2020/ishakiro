<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_page()
    {
        $results    =   \App\LostDocument::where('id','=','jskdjflkjsdlkfjlksjf;klsdjalkfjlsdkjfklsajdflkjdslkfjlss')->select('*')->paginate();
        return view('admin.report.search',compact('results'));
    }

    public function results2(Request $request)
    {
        $type   =   \App\DocumentType::select('*')->where('type','like','%' . $request->search . '%')->first();
        if (!$type==null) 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search)->orWhere('document_type', 'like', '%' . $type->id . '%')
                            ->paginate(5);
            $query  =   $request->search_query;
            return view('admin.report.search',compact('results','query','type'));
        } 
        else 
        {
            $results     =   \App\LostDocument::where('document_number', $request->search_query)->paginate(5);
            $query  =   $request->search;
            return view('admin.report.search',compact('results','query','type'));
        }
    }
}
