@extends('layouts.home-app')

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
                        <li class="breadcrumb-item active">Documents List</li>
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
                    @if ($documents->isEmpty())
                        <h3>No Documents Request In The System!</h3>
                    @else
                    <div class="card">
                        <div class="header">
                            <h2><strong>Documents </strong> list </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reporter Name</th>
                                            <th>Owner Name</th>
                                            <th>Requested By</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>firstname</th>
                                            <th>lastname</th>
                                            <th>Requested By</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($documents as $key=> $lost)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    @if ($lost->type=='found')
                                                    {{\App\User::where(['id'=>$lost->founder_id])->pluck('firstname')->first()}}
                                                    {{\App\User::where(['id'=>$lost->founder_id])->pluck('lastname')->first()}}
                                                    @else
                                                    {{\App\User::where(['id'=>$lost->owner_id])->pluck('firstname')->first()}}
                                                    {{\App\User::where(['id'=>$lost->owner_id])->pluck('lastname')->first()}}
                                                    @endif
                                                </td>
                                                <td>{{$lost->owner_name}}</td>
                                                <td>
                                                    {{\App\User::where(['id'=>$lost->info])->pluck('firstname')->first()}}
                                                    {{\App\User::where(['id'=>$lost->info])->pluck('lastname')->first()}}
                                                </td>
                                                <td>{{\App\DocumentType::where(['id'=>$lost->document_type])->pluck('type')->first()}}</td>
                                                <td>{{$lost->document_number}}</td>
                                                <td>
                                                    <span class="badge badge-default">{{$lost->type}}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('document.requested.accept',Crypt::encryptString($lost->id))}}" class="btn btn-primary btn-round">Accept Request</a>
                                                </td>
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