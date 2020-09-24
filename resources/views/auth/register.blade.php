<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="theme_bubble" />
    <!-- Page Title -->
    <title>Atalla - Register</title>
    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('img/logo2.png') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/font-awesome.min.css" /> --}}
    <link id="mode-option" rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css" />
</head>

<body class="tb-white-bg">
    <div class="tb-login-wrap tb-style1 tb-bg tb-dynamicbg" data-src="{{ asset('assets') }}/img/signup/03.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="tb-form-logo " href="{{ url('/') }}">
                        <img src="{{ asset('img/logo2.png') }}" alt="logo" width="120">
                        <h5 class="mt-3">Register</h5>
                    </a>
                    <div class="tb-height-b25 tb-height-lg-b25"></div>
                    @if (session('info'))
                        <div class="alert alert-info text-left">
                            {{session('info')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class=" row justify-content-center">
                <div class=" card card-body col-lg-8">
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-between mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Daftar') }}
                                </button>

                                <span class="ml-3">
                                    Sudah punya akun?
                                </span>
                                
                                <a href="{{ url('/login') }}" class="text-dark">
                                    {{ __('Masuk') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .container -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets') }}/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
</body>

</html>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
