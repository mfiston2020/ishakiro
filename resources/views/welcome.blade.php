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
<link rel="stylesheet" href="{{ asset('frontend/css/custom css.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        width: 40%;
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
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <img class="img-fluid" src="{{ asset('backend/LOGO-FULL.png')}}" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#pricing">How It Work</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                    </li>
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home')}}"> | {{Auth::user()->firstname}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout')}}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}"> | Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register')}}"> SignUp</a>
                    </li>
                    @endauth
                    @endif
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">
                        {{ csrf_field() }}
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="main-banner parallaxie"
        style="background: url('{{ asset('frontend/images/background.jpg')}}')">
        <div class="heading">
            <h1>Welcome to Ishakiro</h1>
            <h3 class="cd-headline clip is-full-width">
                <span>Lost Your </span>
                <span class="cd-words-wrapper">
                    <b class="is-visible">Identity Card?</b>
                    <b>Driving Licence?</b>
                    <b>Passport?</b>
                    <b>Land Document?</b>
                    <b>ATM Card?</b>
                </span>
                <span>We've got you covered! </span>
                <div class="btn-ber">
                    <form action="{{ route('document.search')}}" method="get">
                        @csrf
                        <div class="search__container">
                            <input class="search__input" type="text"
                                placeholder="Search here with any keyword eg: document number, document type, name etc."
                                name="search_query" value="{{old('search_query')}}" required id="query">
                            <button type="submit" class="get_btn hvr-bounce-to-top" href="#" style="border:none;">Search
                                Documents</button>
                            <a href="{{ route('client.add.found')}}"
                                style="border:none; background-color:#575756;color:white;"
                                class="get_btn hvr-bounce-to-top">
                                Report Found Document
                            </a>
                        </div>
                    </form>
                </div>
            </h3>
        </div>
    </section>

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">
                        <h2>About Ishakiro LTD</h2>
                        <p> Ishakiro is a company that helps people who lose their important documents
                            like ID,Passport, Driving licenses,and land title documents to get those documents back
                            without replacing them with new ones.
                            We provide an easy and fast platform for lost and found documents. We trace lost documents
                            and direct the owners to where they are.
                        </p>
                        <p>
                            You can search for your lost document, request for the location of your lost document.
                            You can also report someone's lost document
                        </p>

                        <a href="#contact" class="sim-btn hvr-bounce-to-top nav-link js-scroll-trigger"><span>Contact
                                Us</span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="right-box-pro wow fadeIn">
                        <img src="{{ asset('frontend/images/company.png')}}" alt="" class="img-fluid img-rounded">
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="services" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Popular Category</h3>
                <hr style="width:50%;">
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-3">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <img src="{{ asset('frontend/images/id.jpg')}}" alt="" height="80px">
                        </div>
                        <h2>National ID</h2>
                    </div>
                </div><!-- end row -->
                <div class="col-md-3">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <img src="{{ asset('frontend/images/pst.jpg')}}" alt="" height="80px">
                        </div>
                        <h2>Passport</h2>
                    </div>
                </div><!-- end row -->
                <div class="col-md-3">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <img src="{{ asset('frontend/images/dl.jpg')}}" alt="" height="80px">
                        </div>
                        <h2>Driving Licence</h2>
                    </div>
                </div><!-- end row -->
                <div class="col-md-3">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <img src="{{ asset('frontend/images/land.jpg')}}" alt="" height="80px">
                        </div>
                        <h2>Land Document</h2>
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end section -->

        {{-- <div id="team" class="section wb">
            <div class="container">
                <div class="section-title text-center">
                    <h3>Our Team</h3>
                    <hr style="width:50%;">
                </div><!-- end title -->

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="our-team">
                            <div class="pic">
                                <img src="{{ asset('frontend/images/man.jpg')}}">
    </div>
    <div class="team-content">
        <h3 class="title">Test Name</h3>
        <span class="post">Test Position </span>
        <ul class="social">
            <li><a href="#" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-google-plus"></a></li>
            <li><a href="#" class="fa fa-skype"></a></li>
        </ul>
    </div>
    </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="our-team">
            <div class="pic">
                <img src="{{ asset('frontend/images/man.jpg')}}">
            </div>
            <div class="team-content">
                <h3 class="title">Test Name</h3>
                <span class="post">Test Position </span>
                <ul class="social">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                    <li><a href="#" class="fa fa-skype"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="our-team">
            <div class="pic">
                <img src="{{ asset('frontend/images/man.jpg')}}">
            </div>
            <div class="team-content">
                <h3 class="title">Test Name</h3>
                <span class="post">Test Position </span>
                <ul class="social">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                    <li><a href="#" class="fa fa-skype"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="our-team">
            <div class="pic">
                <img src="{{ asset('frontend/images/man.jpg')}}">
            </div>
            <div class="team-content">
                <h3 class="title">Test Name</h3>
                <span class="post">Test Position </span>
                <ul class="social">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                    <li><a href="#" class="fa fa-skype"></a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div> --}}

    <div id="pricing" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>How It Work</h3>
                <hr style="width:50%;">
            </div><!-- end title -->

            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div id="DesignLink" class="col-sm-4 heading-design">
                            <h5 class="mb-0" id="he">01.</h5>
                            <h1 class="mb-0" id="he"><strong>Search Or Report a Lost Document</strong></h1>
                        </div>
                        <div id="ProgLink" class="col-sm-4 heading-prog">
                            <h5 class="mb-0" id="he2">02.</h5>
                            <h1 class="mb-0" id="he2"><strong>Explore Document List</strong></h1>
                        </div>
                        <div id="SupportLink" class="col-sm-4 heading-music">
                            <h5 class="mb-0" id="he3">03.</h5>
                            <h1 class="mb-0" id="he3"><strong>Request Your Document</strong></h1>
                        </div>
                    </div>
                </div>

                <div id="Design" class="container-fluid tab-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 left-content">
                                <img src="{{ asset('frontend/images/search.png')}}" alt="Line art of human head."
                                    class="imf-fluid img-custwidth">
                            </div>
                            <div class="col-sm-6 right-content">
                                <h3><strong>Use The search bar to search for your document</strong></h3>
                                <p>When searching for your lost document, you can choose to search by document type,
                                    your names, place of issue...

                                    Searching by document type- choose a type of your document either national identity
                                    (ID), passport, driving license, or land title to trace your lost document.

                                    Searching by your names- type your name in the search bar and explore all results as
                                    click on which matches with digits of your document.

                                    Searching by place of issue- type place where you got your document in the search
                                    bar.</p>
                                <p>
                                    <a type="submit" class="get_btn hvr-bounce-to-top" href="#" style="border:none;"
                                        onclick="focus()">Search
                                        Documents</a></p>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
                <div id="Programming" class="container-fluid tab-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 left-content">
                                <img src="{{ asset('frontend/images/serch.png')}}" alt="Binary digits and line art."
                                    class="imf-fluid img-custwidth">
                            </div>
                            <div class="col-sm-6 right-content">
                                <h3><strong>Explore The search result</strong></h3>
                                <p>When you search by any keyword, you will see a list all possible results.
                                    Check the list to see if your document is among the results shown</p>
                                <p>you can report a document you found.</p>
                                <ul>
                                    <li> <img src="{{ asset('frontend/images/bullet.png')}}" height="10px"> First login
                                        or create an account</li>
                                    <li><img src="{{ asset('frontend/images/bullet.png')}}" height="10px">
                                        Choose add found document where there is add new document
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; replace it with add new
                                        document</li>
                                    <li><img src="{{ asset('frontend/images/bullet.png')}}" height="10px">my lost
                                        document - found document</li>
                                    <li><img src="{{ asset('frontend/images/bullet.png')}}" height="10px">Fill in the
                                        form and submit it</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Support" class="container-fluid tab-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 left-content">
                                <img src="{{ asset('frontend/images/request.png')}}" alt="Line art of key."
                                    class="imf-fluid img-custwidth">
                            </div>
                            <div class="col-sm-6 right-content">
                                <h3>
                                    <strong>Proccess of Requesting Your Document</strong></h3>
                                <p>When you found your document on the results page,click on a result that corresponds
                                    to your document number in order to request location of your document.</p>
                                    <p>Login or create an account, 
                                    Request Permission to know where your document is kept and we will review your request and
                                    send you information.
                                    Location of your document will displayed on the
                                    dashboard of your account </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-4 col-sm-6 text-center">
                        <div class="pricingTable">
                        
                            <div class="pricing-content">
                                <h5 class="title">Search Or Report a Lost Item</h5>
                                <ul class="pricing-content">
                                <li> Use your Lost Document ID to Trace it</li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 text-center">
                        <div class="pricingTable">
                        
                            <div class="pricing-content">
                                <h5 class="title">Explore Item List</h5>
                                <ul class="pricing-content">
                                <li> You will see the list of possible result</li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 text-center">
                        <div class="pricingTable">
                        
                            <div class="pricing-content">
                                <h5 class="title">Request Your Item</h5>
                                <ul class="pricing-content">
                                <li> Request your item from our agents</li>
                            </ul>
                            </div>
                        </div>
                    </div> --}}
            </div>

        </div>
    </div>

    <div id="contact" class="section db">
        <div class="container">
            <div class="section-title text-center">
                <h3>Contact</h3>
                <hr style="width:50%;">
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form action="{{route('send.message')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="name" type="text" placeholder="Your Name"
                                            required="required" name="name">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="email" type="email" placeholder="Your Email"
                                            required="required" name="email">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="phone" type="tel"
                                            placeholder="Your Reason to write" required="required" name="reason">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Your Message"
                                            required="required" name="message"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button id="sendMessageButton" class="sim-btn hvr-bounce-to-top" type="submit">Send
                                        Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <a href="#"><img src="{{ asset('backend/LOGO-FULL.png')}}" alt="" /></a>
                <p class="footer-company-name">All Rights Reserved. &copy; {{ date('Y')}} <a href="#">Ishakiro ltd</a>
                    Design By
                    :
                    <a href="#">Me</a></p>
            </div>
        </div>
    </div><!-- end container -->
    </div><!-- end copyrights -->

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

    <script>
        // Author: Nicholas Fazzolari
        // Basic tab switching code in pure ES6

        // TODO:   Add default tab open feature with an on off switch
        //         Make the event listener assignments general

        function focus() {
            // document.getElementById("query").focus();
            $('.search__input').focus();
        }

        function openTab(tabName) {
            let i;
            let tabContent;

            tabContent = document.getElementsByClassName("tab-content");

            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }

            document.getElementById(tabName).style.display = "flex";
        }


        // This needs to DRY'ed up so it can be used with a CMS
        let designLinkEl = document.getElementById("DesignLink");
        let progLinkEl = document.getElementById("ProgLink");
        let musicLinkEl = document.getElementById("SupportLink");

        designLinkEl.addEventListener("click", function () {
            openTab("Design")
        }, false);
        progLinkEl.addEventListener("click", function () {
            openTab("Programming")
        }, false);
        musicLinkEl.addEventListener("click", function () {
            openTab("Support")
        }, false);

    </script>
    @include('sweetalert::alert')

</body>

</html>
