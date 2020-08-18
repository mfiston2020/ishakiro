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
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Documents</a></li>
                        <li class="breadcrumb-item active">Documents List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    {{-- <a href="{{ route('admin.agent.add')}}">
                        <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button>
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    {{-- @if ($agents->isEmpty())
                        <h3>No Agents In The System!</h3>
                    @else --}}
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
                                            <th>email</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>Type</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>firstname</th>
                                            <th>lastname</th>
                                            <th>email</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>status</th>
                                            <th>Type</th>
                                            <th>Operations</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($lost_documents as $key=> $lost)
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
                                                    @if ($lost->type=='found')
                                                        {{\App\User::where(['id'=>$lost->founder_id])->pluck('email')->first()}}
                                                    @else
                                                        {{\App\User::where(['id'=>$lost->owner_id])->pluck('email')->first()}}
                                                    @endif
                                                </td>
                                                <td>{{\App\DocumentType::where(['id'=>$lost->document_type])->pluck('type')->first()}}</td>
                                                <td>{{$lost->document_number}}</td>
                                                <td>
                                                    @if ($lost->type=='lost')
                                                        @if ($lost->status==0 && $lost->found_state==0 && $lost->agent_approval==0 && $lost->received==0 && $lost->type=='lost')
                                                        <span class="badge badge-info">New</span>
                                                        @endif
                                                        @if ($lost->status==0 && $lost->found_state==0 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <span class="badge badge-info">New</span>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==0 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <span class="badge badge-warning">Lost</span>
                                                        @endif
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <span class="badge badge-success">Found</span>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==1 && $lost->type=='lost')
                                                            <span class="badge badge-success">Received</span>
                                                        @endif
                                                    @else
                                                        @if ($lost->status==0 && $lost->found_state==1 && $lost->agent_approval==0 && $lost->received==0 && $lost->type=='found')
                                                            <span class="badge badge-info">Pending</span>
                                                        @endif
                                                        @if ($lost->status==0 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <span class="badge badge-info">Pending</span>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <span class="badge badge-warning">Posted</span>
                                                        @endif
                                                        {{-- @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <span class="badge badge-success">Found</span>
                                                        @endif  --}}
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==1 && $lost->type=='found')
                                                            <span class="badge badge-success">Received</span>
                                                        @endif                                                        
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-default">{{$lost->type}}</span>
                                                </td>
                                                <td>
                                                    @if ($lost->type=='lost')
                                                        @if ($lost->status==0 && $lost->found_state==0 && $lost->agent_approval==0 && $lost->received==0 && $lost->type=='lost')
                                                            <a href="{{ route('admin.approve.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Confirm</button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==0 && $lost->found_state==0 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <a href="{{ route('admin.documents.pending',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-warning btn-sm btn-round">Approve</button>
                                                            </a>
                                                        @endif
                                                        @if ($lost->status==1 && $lost->found_state==0 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <a href="{{ route('admin.received.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-success btn-sm btn-round">Received</button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='lost')
                                                            <a href="{{ route('admin.myfound.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Founder Info >></button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==1 && $lost->type=='lost')
                                                            <a href="{{ route('admin.myfound.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Founder Info >></button>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if ($lost->status==0 && $lost->found_state==1 && $lost->agent_approval==0 && $lost->received==0 && $lost->type=='found')
                                                            <a href="{{ route('admin.approve.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Confirm</button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==0 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <a href="{{ route('admin.documents.pending',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-warning btn-sm btn-round">Approve</button>
                                                            </a>
                                                        @endif
                                                        @if ($lost->status==1 && $lost->found_state==0 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <a href="{{ route('admin.received.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-success btn-sm btn-round">Received</button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==0 && $lost->type=='found')
                                                            <a href="{{ route('admin.myfound.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Founder Info >></button>
                                                            </a>
                                                        @endif 
                                                        @if ($lost->status==1 && $lost->found_state==1 && $lost->agent_approval==1 && $lost->received==1 && $lost->type=='found')
                                                            <a href="{{ route('admin.myfound.document',Crypt::encryptString($lost->id))}}">
                                                                <button class="btn btn-primary btn-sm btn-round">Founder Info >></button>
                                                            </a>
                                                        @endif                                                        
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
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