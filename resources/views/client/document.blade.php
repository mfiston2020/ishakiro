@extends('client.includes.app')

@push('css')
<link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endpush

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">My Documents</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                    {{-- <a href="profile-edit.html" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a> --}}
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        @if ($document->isEmpty())
                        <h4>No Document Registered <br> <small>use The form to register your document!</small></h4>
                        @else
                        @foreach ($document as $item)
                        <div class="col-4">
                            <div class="card small_mcard_1">
                                <div class="user">
                                    @if ($item->document_type==1)
                                    <img src="{{ asset('frontend/images/id.jpg')}}" alt="profile-image">
                                    @elseif($item->document_type==2)
                                    <img src="{{ asset('frontend/images/dl.jpg')}}" alt="profile-image">
                                    @elseif($item->document_type==3)
                                    <img src="{{ asset('frontend/images/pst.jpg')}}" alt="profile-image">
                                    @else
                                    <img src="{{ asset('frontend/images/land.jpg')}}" alt="profile-image">
                                    @endif
                                    <div class="details">
                                        <span><strong>Owner:</strong>
                                            {{\App\User::where(['id'=>$item->owner_id])->pluck('firstname')->first()}}
                                            {{\App\User::where(['id'=>$item->owner_id])->pluck('lastname')->first()}}</span><br>
                                        <span><strong>Number:</strong>
                                            <small>{{substr_replace($item->document_number,'*********',5)}}{{substr($item->document_number,-2)}}</small></span><br>
                                        <span><strong>Issue Place:</strong> <small>{{$item->issue_place}}</small></span><br>
                                        <span><strong>Document Type:</strong> <small>
                                            {{\App\DocumentType::where(['id'=>$item->document_type])->pluck('type')->first()}}</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Register your <strong>Document</strong></h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="{{ route('client.document.save')}}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Type</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <select class="form-control" name="document_type">
                                                <option value="">-- Please select --</option>
                                                @foreach ($types as $type)
                                                <option value="{{$type->id}}"
                                                    checked="{{(old('document_type')==$type->id)?'checked':''}}">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Number</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('document_number') is-invalid @enderror"
                                                name="document_number" value="{{old('document_number')}}">
                                        </div>
                                        @error('document_number')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Issue Place</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('issue_place') is-invalid @enderror"
                                                name="issue_place" value="{{old('issue_place')}}">
                                        </div>
                                        @error('issue_place')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Expiration (optional)</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('expiration') is-invalid @enderror"
                                                name="expiration" value="{{old('expiration')}}">
                                        </div>
                                        @error('expiration')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-sm-8 offset-sm-2">
                                    </div>
                                    <div class="col-sm-8 offset-sm-2">
                                        <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect"
                                            id="send">Save Document</button>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $('.update').editable({
        validate: function (value) {
            if ($.trim(value) == '')
                return 'Value is required.';
        },
        mode: 'inline',
        url: '{{url("/type/update")}}',
        title: 'Update',
        success: function (response, newValue) {
            console.log('Updated', response)
        }
    });

</script>
@endpush
