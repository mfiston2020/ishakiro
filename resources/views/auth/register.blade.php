@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <form class="card auth_form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="header">
                    <img class="logo" src="assets/images/logo.svg" alt="">
                    <h5>Sign Up</h5>
                    <span>Register as a new member</span>
                </div>
                <div class="body">
                    @error('email')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    @error('passwors')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" placeholder="Firstname" value="{{old('firstname')}}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Lastname" value="{{old('lastname')}}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="radio inlineblock m-r-20">
                            <input type="radio" name="gender" id="male" class="with-gap" value="M">
                            <label for="male">Male</label>
                        </div>                                
                        <div class="radio inlineblock">
                            <input type="radio" name="gender" id="Female" class="with-gap" value="F" checked="">
                            <label for="Female">Female</label>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <input type="number" name="national_id_card" class="form-control @error('national_id_card') is-invalid @enderror" 
                        placeholder="national ID card" value="{{old('national_id_card')}}" maxlength="16">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-card"></i></span>
                        </div>
                    </div> --}}
                    <div class="input-group mb-3">
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" name="phone" value="{{old('phone')}}"
                        maxlength="10">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                        </div>
                    </div>
                        @error('phone')
                        <div style="color: red">
                            {{$message}}
                        </div>
                        @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" 
                        name="email" value="{{old('email')}}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                        </div>
                        @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Confirm Password"name="password_confirmation">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN UP</button>
                    <div class="signin_with mt-3">
                        <a class="link" href="{{ route('login')}}">You already a member?</a>
                    </div>
                </div>
            </form>
            <div class="copyright text-center">
                &copy;
                <script>
                    document.write(new Date().getFullYear())

                </script>,
                <span><a href="/">Ishakiro ltd</a></span>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <img src="{{ asset('backend/assets/images/signup.svg')}}" alt="Sign Up" />
            </div>
        </div>
    </div>
</div>
@endsection
