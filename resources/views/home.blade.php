@extends('layouts.home-app')

@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Documents</strong>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>All Reports</h6>
                            <h2>{{$all}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Pending</h6>
                            <h2>{{$pending}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Found</h6>
                            <h2>{{$found}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Lost</h6>
                            <h2>{{$lost}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Received</h6>
                            <h2>{{$received}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <h6>Document Types</h6>
                            <h2>{{$type}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <a href="{{ route('document.requested')}}">
                            <div class="body">
                                <h6>Document Requests</h6>
                                <h2>{{$request}} </h2>
                                <div class="progress">
                                    <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Users</strong>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>Agents</h6>
                            <h2>{{ $agent}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>clients</h6>
                            <h2>{{$other}} </h2>
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Contact Emails</strong>
                            </h2>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{route('admin.inbox')}}">
                        <div class="card widget_2 big_icon email">
                            <div class="body">
                                <h6>All</h6>
                                <h2>{{ $mail}} </h2>
                                <div class="progress">
                                    <div class="progress-bar l-orange" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                </div>
                            </div>
                        </div>
                </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{route('admin.inbox')}}">
                        <div class="card widget_2 big_icon email">
                            <div class="body">
                                <h6>Unread</h6>
                                <h2>{{$umail}} </h2>
                                <div class="progress">
                                    <div class="progress-bar l-orange" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                </div>
                            </div>
                        </div>
                </a>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
