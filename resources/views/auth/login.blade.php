@extends('layouts.app')

@section('title','Ishakiro::Login')
    
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
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
            <form class="card auth_form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="header">
                    <img class="logo" src="{{ asset('backend/assets/images/logo.svg')}}" alt="">
                    <h5>Log in</h5>
                </div>
                <div class="body">
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="#" class="forgot"
                                    title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <input id="remember_me" type="checkbox" name="remember" {{old('remember') ? 'checked' : '' }}>
                        <label for="remember_me">Remember Me</label>
                    </div>
                    <hr>
                        Forgot Your Password?<a class="link" href="{{ route('password.request') }}"> Click Here</a>
                    {{-- </div> --}}
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN IN</button>
                    <div class="signin_with mt-3">
                        <a class="link" href="{{ route('register')}}">Don't have an account?</a>
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
                <img src="{{ asset('backend/assets/images/signin.svg')}}" alt="Sign In" />
            </div>
        </div>
    </div>
</div>
@endsection
