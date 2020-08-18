@extends('layouts.home-app')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .glyphicon-ok:before {
        content: "\f00c";
    }

    .glyphicon-remove:before {
        content: "\f00d";
    }

    .glyphicon {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
@endpush

@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>New Document Type</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Document Type </li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Document Type</strong> List </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Operations</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($types as $key=> $type)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            
                                            <td>
                                                <a href="" class="update" data-name="type" data-type="text"
                                                data-pk="{{ $type->id }}"
                                                data-title="Enter Cohort Name">{{ $type->type}}</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-target="#defaultModal-{{$key+1}}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="defaultModal-{{$key+1}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="title" id="defaultModalLabel"><i class="fa fa-info-circle"></i> Warning</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do You Want to delete {{$type->type}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{route('admin.type.delete',Crypt::encryptString($type->id))}}">
                                                            <button type="button" class="btn btn-default btn-round waves-effect">DELETE</button>
                                                        </a>
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Document Type</strong> Form</h2>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('admin.save.type')}}">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('document_type') is-invalid @enderror" placeholder="Document Type" name="document_type"
                                                value="{{old('document_type')}}">
                                                @error('document_type')
                                                    <div style="color: red">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect m-l-20">Save</button>          
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
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
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