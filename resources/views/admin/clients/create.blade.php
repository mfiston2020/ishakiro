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
                    <h2>Clients</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">New Clients</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form class="form-horizontal" action="{{ route('admin.client.save')}}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Firstname</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                            value="{{old('firstname')}}">
                                        </div>
                                        @error('firstname')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Lastname</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{old('lastname')}}">
                                        </div>
                                        @error('lastname')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <div class="radio inlineblock m-r-20">
                                                <input type="radio" name="gender" id="male" class="with-gap" value="M" checked=""
                                                {{(old('gender')=='M')?'checked':''}}>
                                                <label for="male">Male</label>
                                            </div>                                
                                            <div class="radio inlineblock">
                                                <input type="radio" name="gender" id="Female" class="with-gap" value="F"
                                                {{(old('gender')=='F')?'checked':''}}>
                                                <label for="Female">Female</label>
                                            </div>
                                        </div>
                                        @error('gender')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Phone Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8"> 
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                            value="{{old('phone_number')}}">
                                        </div>
                                        @error('phone_number')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8"> 
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{old('email')}}">
                                        </div>
                                        @error('email')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-sm-8 offset-sm-2">
                                    </div>
                                    <div class="col-sm-8 offset-sm-2">
                                        <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect" id="send">ADD CLIENT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

<script>
    $('#send').click(function(){
        var $this = $(this);
        $this.text('Please Wait....');
        $this.disabled=true;
    })
</script>
@endpush