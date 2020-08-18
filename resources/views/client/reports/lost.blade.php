@extends('client.includes.app')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Documents</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Lost Documents List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    @if ($losts->isEmpty())
                        <h3>No Documents In The System!</h3>
                    @else
                    <div class="card">
                        <div class="header">
                            <h2><strong>Document's</strong> list </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>On Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>On Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($losts as $key=> $document)
                                            <tr>
                                                <td>{{ $key+1}}</td>
                                                <td>{{\App\DocumentType::where(['id'=>$document->document_type])->pluck('type')->first()}}</td>
                                                <td>{{ $document->document_number}}</td>
                                                <td>
                                                    @if ($document->status==0 && $document->found_state==0)
                                                        <span class="badge badge-info">New</span>
                                                    @elseif($document->status==1 && $document->found_state==0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                    @if($document->found_state==1)
                                                        <span class="badge badge-success">Found</span>
                                                        <a href="{{route('client.myfound.document',Crypt::encryptString($document->id))}}">more Info</a>
                                                    @endif
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($document->updated_at)->diffForHumans()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>

<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush