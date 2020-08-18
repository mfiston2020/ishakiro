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
                        <li class="breadcrumb-item active">Documents Founder Details</li>
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
                <div class="col-lg-4 col-md-12">
                    <h4>Your Document Was found By</h4><hr>
                    <div class="card small_mcard_1">
                        <span hidden>{{$founder    =   \App\User::where(['id'=>$document->founder_id])->select('*')->first()}}</span>
                        <div class="user">
                            <img src="{{ asset('backend/assets/images/users/form_avatar.jpg')}}" alt="profile-image">
                            <div class="details">                                
                                <h6 class="mb-0 mt-2">{{$founder->firstname}} {{$founder->lastname}}</h6>
                                <p class="mb-0"><small>Document: {{ \App\DocumentType::where(['id'=>$document->document_type])->pluck('type')->first()}}</small></p>
                                <p class="mb-0"><small>Dument Number: {{$document->document_number}}</small></p>
                                <p class="mb-0"><small>Placed at: {{ $document->place_of_keep}}</small></p>
                                <p class="mb-0"><small>Phone: {{ \App\User::where(['id'=>$document->founder_id])->pluck('phone')->first()}}</small></p>
                                {{-- <button class="btn btn-primary">OKAY</button> --}}
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
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>

<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush