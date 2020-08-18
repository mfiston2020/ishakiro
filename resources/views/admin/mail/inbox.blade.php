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
                        <li class="breadcrumb-item active">Inbox </li>
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
                                    <li class="active"><a href=""><i class="zmdi zmdi-inbox"></i>Inbox<span class="badge badge-primary">
                                        {{count(\App\ContactUs::where(['status'=>'0'])->select('*')->get())}}
                                    </span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="inbox right">
                            <div class="i_action d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="checkbox simple d-inline-block mr-3">
                                    </div>
                                </div>
                                <div class="pagination-email">
                                    <div class="btn-group ml-3">
                                        <button type="button" class="btn btn-outline-secondary btn-sm"><i class="zmdi zmdi-chevron-left"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"><i class="zmdi zmdi-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table c_table inbox_table">
                                    @foreach ($mail as $item)
                                    <tr>
                                        <td class="starred {{($item->status=='0')?'active':''}}"><a href="{{ route('admin.read',Crypt::encryptString($item->id))}}"><i class="zmdi zmdi-star"></i></a></td>
                                        <td class="u_name"><h5 class="font-15 mt-0 mb-0">{{$item->name}}</h6></td>
                                        <td class="max_ellipsis">
                                            <a class="link" href="{{ route('admin.read',Crypt::encryptString($item->id))}}">
                                                
                                                {{$item->reason}}
                                            </a>
                                        </td>
                                        <td class="pull-right">
                                            {{ date('Y-m-d H:m:s',strtotime($item->created_at))}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
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