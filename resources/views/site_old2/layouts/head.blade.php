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
<link rel="stylesheet" href="{{ asset('css/main/custom.css') }}">
@if (app()->getLocale()== "ar")
    <link rel="stylesheet" href="{{ asset('css/main/rtl.css') }}">
@endif

<title>Ajrnii - Buy & Sell Properties</title>

<link rel="icon" type="image/png" href="{{ asset('images/main/favicon.png') }}">
<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Scripts -->
<script>
window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
</script>
