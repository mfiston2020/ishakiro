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
                    <h2>Agents</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Agents List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{ route('admin.agent.add')}}">
                        <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    @if ($agents->isEmpty())
                        <h3>No Agents In The System!</h3>
                    @else
                    <div class="card">
                        <div class="header">
                            <h2><strong>client's</strong> list </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>firstname</th>
                                            <th>lastname</th>
                                            <th>gender</th>
                                            <th>email</th>
                                            <th>status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>firstname</th>
                                            <th>lastname</th>
                                            <th>gender</th>
                                            <th>email</th>
                                            <th>status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($agents as $key=> $client)
                                        <tr>
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $client->firstname}}</td>
                                                <td>{{ $client->lastname}}</td>
                                                <td>{{ $client->gender}}</td>
                                                <td>{{ \App\User::where(['id'=>$client->user_id])->pluck('email')->first()}}</td>
                                                <td>
                                                    @if ($client->status=='1')
                                                        <span class="badge badge-success badge-lg">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Dormant</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.agent.edit',Crypt::encryptString($client->id))}}">
                                                        <button class="btn btn-primary btn-sm btn-round">edit</button>
                                                    </a>
                                                    {{-- @if ($client->status=='1')
                                                        <a href="{{ route('admin.client.edit',Crypt::encryptString($client->id))}}">
                                                            <button class="btn btn-warning btn-sm btn-round">deActivate</button>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.client.edit',Crypt::encryptString($client->id))}}">
                                                            <button class="btn btn-success btn-sm btn-round">Activate</button>
                                                        </a>
                                                    @endif --}}
                                                    <button class="btn btn-danger btn-sm btn-round" data-toggle="modal" data-target="#delete-{{$key+1}}">
                                                        Delete</button>
                                                </td>

                                                <div class="modal fade" id="delete-{{$key+1}}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="title" id="defaultModalLabel">Warning</h4>
                                                            </div>
                                                            <div class="modal-body"> Do you want to delete this client???</div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('admin.client.delete',Crypt::encryptString($client->user_id))}}">
                                                                    <button type="button" class="btn btn-default btn-round waves-effect">YES</button>
                                                                </a>
                                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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