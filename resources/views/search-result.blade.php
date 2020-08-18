<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Site Metas -->
<title>Ishakiro | Landing Page</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">


<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
<!-- Site CSS -->
<link rel="stylesheet" href="{{ asset('frontend/style.css')}}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css')}}">
<script src="{{ asset('frontend/js/modernizr.js')}}"></script>

<style>
    .search__container {
        padding-top: 64px;
    }

    .search__title {
        font-size: 22px;
        font-weight: 900;
        text-align: center;
        color: #ff8b88;
    }

    .search__input {
        width: 50%;
        padding: 12px 24px;

        background-color: transparent;
        transition: transform 250ms ease-in-out;
        font-size: 14px;
        line-height: 18px;

        color: #fff;
        background-color: transparent;
        background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #fff;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

    .search__input::placeholder {
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .search__input:hover,
    .search__input:focus {
        padding: 12px 0;
        outline: 0;
        border: 1px solid transparent;
        border-bottom: 1px solid #575756;
        border-radius: 0;
        background-position: 100% center;
    }

</style>

</head>

<body id="page-top" class="politics_version">

    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
            <div id="loader"></div>
        </div>
    </div><!-- end loader -->
    <!-- END LOADER -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="/">
                <img class="img-fluid" src="{{ asset('backend/LOGO-FULL.png')}}" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>
    <br><br>
    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                
                <div class="table-responsive">
                    @if ($search->isEmpty())
                        <h3>No Result found for <strong>{{$query}}</strong></h3><br>
                        {{-- <a href="/">
                            <button class="get_btn hvr-bounce-to-top" href="#" style="border:none;">Go Back Home</button>
                        </a> --}}
                    @else 
                    <table class="table table-hover mb-0 c_table search_page">
                        <tbody>
                            @foreach ($search as $item)
                            <tr>
                                <td class="max_ellipsis">
                                    <h5 class=""><a href="{{ route('client.myfound.document',Crypt::encryptString($item->id))}}" style="color: #1272BA"><strong>
                                        {{$query}}</strong> Search result!</a></h5>
                                    <a class="link" href="{{ route('client.myfound.document',Crypt::encryptString($item->id))}}" style="color:#5CC2D6">
                                        {{\App\DocumentType::where(['id'=>$item->document_type])->pluck('type')->first()}} : 
                                        {{substr_replace($item->document_number,'*********',5)}}{{substr($item->document_number,-2)}} was 
                                        {{($item->status==1 && $item->found_state==0)? 'Lost':'Found'}}!</a><br>
                                    <span class="details">place of Issue: {{$item->issue_place}}</span><br>
                                    <span class="details">for more detail about the document please click on a relevant link!</span>
                                </td>
                            </tr>
                            @endforeach
                            <br>
                        </tbody>
                    </table>
                    @endif
                </div>
                <hr>
                <div class="col-md-12">
                    <ul class="pagination pagination-primary m-t-20">
                        {{$search->links()}}
                    </ul>
                    <a href="/">
                            <button class="get_btn hvr-bounce-to-top" href="#" style="border:none;">Go Back Home</button>
                        </a>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="{{ asset('frontend/js/all.js')}}"></script>
    <!-- Camera Slider -->
    <script src="{{ asset('frontend/js/jquery.mobile.customized.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('frontend/js/parallaxie.js')}}"></script>
    <script src="{{ asset('frontend/js/headline.js')}}"></script>
    <!-- Contact form JavaScript -->
    <script src="{{ asset('frontend/js/jqBootstrapValidation.js')}}"></script>
    <script src="{{ asset('frontend/js/contact_me.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.vide.js')}}"></script>

</body>

</html>
