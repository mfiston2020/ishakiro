@extends('client.includes.app')

@push('css')

<link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Lost Item</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i>
                                Ishakiro</a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> Lost Item</a></li>
                        <li class="breadcrumb-item active">Lost Item </li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form class="form-horizontal" action="{{ route('client.save.lost')}}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <div class="checkbox">
                                            <input id="own_document" type="checkbox" name="own_doc" {{old('own_doc') ? 'checked' : '' }}>
                                            <label for="own_document">My Own Document</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group" id="doc">
                                            <select class="form-control" name="document_type_" id="my_doc_type">
                                                <option value="">-- Please select --</option>
                                                @foreach ($myDoc as $type)
                                                <option value="{{$type->document_type}}"
                                                    checked="{{(old('document_type')==$type->id)?'checked':''}}">
                                                    {{\App\DocumentType::where(['id'=>$type->document_type])->pluck('type')->first()}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Owner's Name</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('owner_name') is-invalid @enderror"
                                                name="owner_name" value="{{old('owner_name')}}" id="owner_name_id">
                                        </div>
                                        @error('owner_name')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Issue Place</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('issue_place') is-invalid @enderror"
                                                name="issue_place" value="{{old('issue_place')}}" id="issue_place">
                                        </div>
                                        @error('issue_place')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix" id="doc_type">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Document Type</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <select class="form-control" name="document_type" id="">
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
                                                name="document_number" value="{{old('document_number')}}"
                                                id="own_doc_number">
                                        </div>
                                        @error('document_number')
                                        <div style="color:red;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                                        <label for="email_address_2">Expiration Date (optional)</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('expiry_date') is-invalid @enderror"
                                                name="expiry_date" value="{{old('expiry_date')}}" id="expiration">
                                        </div>
                                        @error('expiry_date')
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
                                            id="send">Report Lost Document</button>
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
<script>
    $('#doc').hide();
    $('#own_document').click(function () {
        if ($(this).prop('checked') == true) {
            $('#doc').show();
            $('#doc_type').hide();
            $('#docT').attr('name','tesing');
        } 
        else 
        {
            $('#doc').hide();
            $('#doc_type').show();

            $('#owner_name_id').attr('readonly', false);
            $('#issue_place').attr('readonly', false);
            $('#own_doc_number').attr('readonly', false);
            $('#expiration').attr('readonly', false);
            
            $('#owner_name_id').val(' ');
            $('#issue_place').val(' ');
            $('#own_doc_number').val(' ');
            $('#expiration').val(' ');
        }
    });

    $('#my_doc_type').on('change', function () {
        var type_id = $(this).val();

        $.ajax({
            type: 'get',
            url: '{{route("client.fetch.own.document")}}',
            data: {
                id: type_id
            },

            success: function (data) {
                console.log(data);
                $('#owner_name_id').val('{{Auth::user()->firstname}} {{Auth::user()->lastname}}');
                $('#owner_name_id').attr('readonly', 'true');

                $('#issue_place').val(data[0].issue_place);
                $('#issue_place').attr('readonly', 'true');

                $('#own_doc_number').val(data[0].document_number);
                $('#own_doc_number').attr('readonly', 'true');

                $('#expiration').val(data[0].expire_date);
                $('#expiration').attr('readonly', 'true');
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

</script>
@endpush
