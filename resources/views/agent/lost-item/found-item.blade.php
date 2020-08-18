@extends('agent.includes.app')

@push('css')
    
<link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Found Item</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{route('home')}}"> Lost Item</a></li> --}}
                        <li class="breadcrumb-item active">Found Item </li>
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
                            <form class="form-horizontal" action="{{ route('agent.save.found')}}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Type</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <select class="form-control" name="document_type">
                                                <option value="">-- Please select --</option>
                                                @foreach ($types as $type)
                                                    <option value="{{$type->id}}" checked="{{(old('document_type')==$type->id)?'checked':''}}">
                                                        {{$type->type}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('document_type')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('document_number') is-invalid @enderror" name="document_number"
                                            value="{{old('document_number')}}">
                                        </div>
                                        @error('document_number')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="email_address_2">Where will it be?</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('document_place') is-invalid @enderror" name="document_place"
                                            value="{{old('document_place')}}">
                                        </div>
                                        @error('document_place')
                                            <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-sm-8 offset-sm-2">
                                    </div>
                                    <div class="col-sm-8 offset-sm-2">
                                        <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect" id="send">Report Found Document</button>
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
