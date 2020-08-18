@extends('layouts.home-app')

@push('css')
@endpush

@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Inbox</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Read {{$message->reason}} </li>
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
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="mobile-left">
                            <a class="btn btn-info btn-icon toggle-email-nav collapsed" data-toggle="collapse" href="#email-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                                <span class="btn-label"><i class="zmdi zmdi-more"></i></span>
                            </a>
                        </div>
                        <div class="inbox left" id="email-nav">
                            <div class="mail-compose mb-4">
                                {{-- <a href="mail-compose.html" class="btn btn-danger btn-block">Compose</a> --}}
                            </div>
                            <div class="mail-side">
                                <ul class="nav">
                                    <li class="active"><a href="{{ route('admin.inbox')}}"><i class="zmdi zmdi-inbox"></i>Inbox<span class="badge badge-primary">
                                        {{count(\App\ContactUs::where(['status'=>'0'])->select('*')->get())}}
                                        </span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="inbox right">
                            <div class="card">
                                <div class="body mb-2">
                                    <div class="d-flex justify-content-between flex-wrap-reverse">
                                        <h5 class="mt-0 mb-0 font-17">Your message information</h5>
                                        <div>
                                            <small>{{ date('Y-m-d H:m:s',strtotime($message->created_at))}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="body mb-2">
                                    <ul class="list-unstyled d-flex justify-content-md-start mb-0">
                                        <li><img class="rounded w40" src="assets/images/xs/avatar7.jpg" alt=""></li>
                                        <li class="ml-3">
                                            <p class="mb-0"><span class="text-muted">From:</span> <a href="javascript:void(0);">{{$message->email}}</a></p>
                                            <p class="mb-0"><span class="text-muted">To:</span> Ishakiro</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body mb-2">
                                    {{$message->message}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush