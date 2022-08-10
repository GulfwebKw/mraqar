<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('css/main/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/responsive.css') }}">

    <title>Ajrnii - Buy & Sell Properties</title>

    <link rel="icon" type="image/png" href="{{ asset('images/main/favicon.png') }}">
</head>
<body>

<!-- Start Login Area -->
<section class="login-area">
    <div class="row m-0">
        <div class="col-lg-6 col-md-12 p-0">
            <div class="login-image">
                <img src="{{ asset('images/main/login-bg.jpg') }}" alt="image">
            </div>
        </div>

        <div class="col-lg-6 col-md-12 p-0">
            <div class="login-content">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="login-form">
                            <div class="logo">
                                <a href="{{ route('Main.index',app()->getLocale()) }}"><img src="{{ asset('images/main/logo.png') }}" alt="image"></a>
                            </div>

                            <h3>{{__('welcome_back')}}</h3>
                            <p @if(app()->getLocale() == "ar") style="direction: rtl" @endif >{{__('new_to_ajrnii')}}
                                <a href="{{ route('register',app()->getLocale()) }}">{{__('sign_up')}}</a>
                            </p>

                            <form method="POST" action="{{ route('login',app()->getLocale()) }}">
                                @csrf

                                <div class="form-group">
                                    <input id="mobile" type="tel" placeholder="{{__('phone_number_title')}}" class="form-control form-control-lg @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="{{__('password')}}" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="checkbox p-0">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">{{ __('remember_me') }}</label>
                                </div>


                                <div class="form-group form-row mt-3 mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-secondary">{{__('login')}}</button>
                                    </div>
                                </div>


                                <div class="forgot-password">
                                    <a href="{{ route('password.request',app()->getLocale()) }}">{{__('forgot_password')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Area -->

<!-- Links of JS files -->
<script src="{{ asset('js/main/jquery.min.js') }}"></script>
<script src="{{ asset('js/main/popper.min.js') }}"></script>
<script src="{{ asset('js/main/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/main/appear.min.js') }}"></script>
<script src="{{ asset('js/main/odometer.min.js') }}"></script>
<script src="{{ asset('js/main/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/main/parallax.min.js') }}"></script>
<script src="{{ asset('js/main/slick.min.js') }}"></script>
<script src="{{ asset('js/main/rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/main/nice-select.min.js') }}"></script>
<script src="{{ asset('js/main/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/main/meanmenu.min.js') }}"></script>
<script src="{{ asset('js/main/wow.min.js') }}"></script>
<script src="{{ asset('js/main/form-validator.min.js') }}"></script>
<script src="{{ asset('js/main/contact-form-script.js') }}"></script>
<script src="{{ asset('js/main/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/main/main.js') }}"></script>

</body>
</html>
