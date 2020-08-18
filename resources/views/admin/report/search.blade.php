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
                    <h2>Documents Search</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><i class="zmdi zmdi-home"></i> Ishakiro</a></li>
                        <li class="breadcrumb-item active">Documents search</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('admin.document.search')}}" method="get">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="zmdi zmdi-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('search') is-invalid @enderror" placeholder="Search..." name="search" 
                                    value="{{old('search')}}" required>
                                    
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary">search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (!$results->isEmpty())
                    @if (!$type->id)
                        no results
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 c_table search_page">
                            <tbody>@foreach ($results as $item)
                                <tr>
                                    <td class="max_ellipsis">
                                        <h5 class=""><a href="{{ route('admin.myfound.document',Crypt::encryptString($item->id))}}" style="color: #1272BA"><strong>{{$query}}</strong> Search result!</a></h5>
                                        <a class="link" href="{{ route('admin.myfound.document',Crypt::encryptString($item->id))}}" style="color:#5CC2D6">
                                            {{$type->type}} : {{substr_replace($item->document_number,'************',2)}}{{substr($item->document_number,-2)}} 
                                            was {{($item->status==1 && $item->found_state==0)? 'Lost':'Found'}}!</a>
                                        <span class="details">for more detail about the document please click on a relevant link!</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="pagination pagination-primary m-t-20">
                        {{$results->links()}}
                    </ul>
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