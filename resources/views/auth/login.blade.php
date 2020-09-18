<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="theme_bubble" />
    <!-- Page Title -->
    <title>Atalla - Log In</title>
    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('img/logo2.png') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/material-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/jqvmap.min.css" />
    <link id="mode-option" rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css" />
</head>

<body class="tb-white-bg">
    <div class="tb-login-wrap tb-style1 tb-bg tb-dynamicbg" data-src="{{ asset('assets') }}/img/signup/03.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('login') }}" class="tb-form tb-style2 tb-border">
                        <div class="tb-form-logo">
                            <img src="{{ asset('img/logo2.png') }}" alt="logo" width="120">
                        </div>
                        <div class="tb-height-b25 tb-height-lg-b25"></div>
                        {{-- <div class="alert alert-info text-left">
                            <strong>Owner</strong>
                            <ul>
                                <li>Email: owner@atalla.com</li>
                                <li>Password: password</li>
                            </ul>
                            <strong>Sales</strong>
                            <ul>
                                <li>Email: sales@atalla.com</li>
                                <li>Password: password</li>
                            </ul>
                        </div> --}}
                        <div class="tb-height-b25 tb-height-lg-b25"></div>
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tb-height-b5 tb-height-lg-b5"></div>
                                <div class="tb-height-b20 tb-height-lg-b20"></div>
                                <button type="submit" class="btn btn-dark btn-block"><span>Sign In</span></button>
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
    <script src="{{ asset('assets') }}/js/Chart.min.js"></script>
    <script src="{{ asset('assets') }}/js/chartjs.light.js"></script>
    <script src="{{ asset('assets') }}/js/smooth-scrollbar.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
</body>

</html>
