<!DOCTYPE html>
<html lang="en" {!! app()->getLocale() === 'ar' ? ' dir="rtl"' : '' !!}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajerni @hasSection('title') - @yield('title') @endif </title>
    <link rel="icon" type="image/png" href="{{ asset('images/main/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @include('site.layout.css')
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
    @yield('header')
</head>
<body class="mdc-theme--background">
    <div class="spinner-wrapper" id="preloader">
        <div class="spinner-container">
            <div class="spinner-outer">
                <div class="spinner">
                    <div class="left mask">
                        <div class="plane"></div>
                    </div>
                    <div class="top mask">
                        <div class="plane"></div>
                    </div>
                    <div class="right mask">
                        <div class="plane"></div>
                    </div>
                    <div class="triangle">
                        <div class="triangle-plane"></div>
                    </div>
                    <div class="top-left mask">
                        <div class="plane"></div>
                    </div>
                    <div class="top-right mask">
                        <div class="plane"></div>
                    </div>
                </div>
                <p class="spinner-text">HouseKey</p>
            </div>
        </div>
    </div>
    <aside class="mdc-drawer mdc-drawer--modal sidenav" {!! app()->getLocale() === 'ar' ? ' dir="rtl"' : '' !!}>
        <div class="row end-xs middle-xs py-1 px-3">
            <button id="sidenav-close" class="mdc-icon-button material-icons warn-color">close</button>
        </div>
        <hr class="mdc-list-divider m-0">
        <div class="mdc-drawer__content">
            <div class="vertical-menu">
                <div>
                    <a href="{{'/'.app()->getLocale(). '/' }}" class="mdc-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{__('home_title')}}</span>
                    </a>
                </div>
                <div>
                    <a href="{{'/'.app()->getLocale(). '/' }}" class="mdc-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{__('required_for_rent')}}</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('companies', app()->getLocale()) }}" class="mdc-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{__('companies')}}</span>
                    </a>
                </div>
                <div>
                    <a href="{{ '/'.app()->getLocale().'/aboutus' }}" class="mdc-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{__('about_us_title')}}</span>
                    </a>
                </div>
                <div>
                    <a href="{{ '/'.app()->getLocale().'/contact' }}" class="mdc-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{__('contact_title')}}</span>
                    </a>
                </div>
                <div>
                    @if ( app()->getLocale() == "en")
                        <a href="#"  onclick="changeLng('ar')" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">العربیه</span>
                        </a>
                    @else
                        <a href="#"  onclick="changeLng('en')" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">English</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <hr class="mdc-list-divider m-0">
        <div class="row center-xs middle-xs py-3">

            @if($facebook)
            <a href="{{$facebook}}" target="blank" class="social-icon">
                <svg class="material-icons mat-icon-xlg primary-color" viewBox="0 0 24 24">
                    <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z" />
                </svg>
            </a>
            @endif
            @if($twitter)
            <a href="{{ $twitter }}" target="blank" class="social-icon">
                <svg class="material-icons mat-icon-xlg primary-color" viewBox="0 0 24 24">
                    <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M17.71,9.33C18.19,8.93 18.75,8.45 19,7.92C18.59,8.13 18.1,8.26 17.56,8.33C18.06,7.97 18.47,7.5 18.68,6.86C18.16,7.14 17.63,7.38 16.97,7.5C15.42,5.63 11.71,7.15 12.37,9.95C9.76,9.79 8.17,8.61 6.85,7.16C6.1,8.38 6.75,10.23 7.64,10.74C7.18,10.71 6.83,10.57 6.5,10.41C6.54,11.95 7.39,12.69 8.58,13.09C8.22,13.16 7.82,13.18 7.44,13.12C7.81,14.19 8.58,14.86 9.9,15C9,15.76 7.34,16.29 6,16.08C7.15,16.81 8.46,17.39 10.28,17.31C14.69,17.11 17.64,13.95 17.71,9.33Z" />
                </svg>
            </a>
            @endif
            @if($whatsapp)
            <a href="https://api.whatsapp.com/send?phone={{$whatsapp}}&text=Hello,I need your help."  target="blank" class="social-icon">
                <svg class="material-icons mat-icon-xlg primary-color" viewBox="0 0 24 24">
                    <path d="M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H19M18.5,18.5V13.2A3.26,3.26 0 0,0 15.24,9.94C14.39,9.94 13.4,10.46 12.92,11.24V10.13H10.13V18.5H12.92V13.57C12.92,12.8 13.54,12.17 14.31,12.17A1.4,1.4 0 0,1 15.71,13.57V18.5H18.5M6.88,8.56A1.68,1.68 0 0,0 8.56,6.88C8.56,5.95 7.81,5.19 6.88,5.19A1.69,1.69 0 0,0 5.19,6.88C5.19,7.81 5.95,8.56 6.88,8.56M8.27,18.5V10.13H5.5V18.5H8.27Z" />
                </svg>
            </a>
            @endif
            @if($instagram)
            <a href="{{$instagram}}" target="blank" class="social-icon">
                <svg class="material-icons mat-icon-xlg primary-color" viewBox="0 0 24 24">
                    <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M19.5,12H18V10.5H17V12H15.5V13H17V14.5H18V13H19.5V12M9.65,11.36V12.9H12.22C12.09,13.54 11.45,14.83 9.65,14.83C8.11,14.83 6.89,13.54 6.89,12C6.89,10.46 8.11,9.17 9.65,9.17C10.55,9.17 11.13,9.56 11.45,9.88L12.67,8.72C11.9,7.95 10.87,7.5 9.65,7.5C7.14,7.5 5.15,9.5 5.15,12C5.15,14.5 7.14,16.5 9.65,16.5C12.22,16.5 13.96,14.7 13.96,12.13C13.96,11.81 13.96,11.61 13.89,11.36H9.65Z" />
                </svg>
            </a>
            @endif
        </div>
    </aside>
    <div class="mdc-drawer-scrim sidenav-scrim"></div>
    <header class="toolbar-1 {{ ($header ?? '') !== 'transparent' ?: 'has-bg-image' }} dir="ltr">
        <div id="top-toolbar" class="mdc-top-app-bar">
            <div class="theme-container row between-xs middle-xs h-100">
                <div class="row d-lg-none start-xs middle-xs">
                    <button id="sidenav-toggle" class="mdc-button mdc-ripple-surface d-md-none d-lg-none d-xl-none">
                        <span class="mdc-button__ripple"></span>
                        <i class="material-icons">menu</i>
                    </button>

                </div>
                @include('site.sections.socials', ['classes' => 'start-xs middle-xs d-none d-lg-flex d-xl-flex'])
                <div class="row end-xs middle-xs">
                    <div class="mdc-menu-surface--anchor">
                        @if(auth()->check())
                        <button class="mdc-button mdc-ripple-surface">
                            <span class="mdc-button__ripple"></span>
                            <i class="material-icons mdc-button__icon mx-1">person</i>
                            <span class="mdc-button__label">{{__('my_account_title')}}</span>
                            <i class="material-icons mdc-button__icon m-0">arrow_drop_down</i>
                        </button>
                        <div class="mdc-menu mdc-menu-surface user-menu" {!! app()->getLocale() === 'ar' ? ' dir="rtl"' : '' !!}>
                            <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical" tabindex="-1">
                                <li class="user-info row start-xs middle-xs">
                                    <img src="{{ is_file(public_path(auth()->user()->image_profile)) ? asset(auth()->user()->image_profile) : asset('asset/assets/images/others/user.jpg') }}" alt="user-image" width="50">
                                    <p class="m-0">@if(auth()->user()->name){{ auth()->user()->name }}@else<a href="{{ route('Main.profile',app()->getLocale()) }}">{{ __('update_name') }}</a>@endif<br>
                                        <a href="{{url(app()->getLocale().'/paymenthistory')}}" class="text_blue" style="color:#088dd3;text-decoration:none;">
                                            @if($balance == 0) 0 {{__('ads_title')}}
                                            @else
                                                    <span class="">
                                                        {{ $balance['available'] }} {{__('ads_title')}}
                                                    </span>
                                                    <span class="@if( app()->getLocale() == "ar" ) mr-3 @else ml-3  @endif">
                                                        {{ $balance['available_premium'] }} {{__('premium_short')}}
                                                    </span>
                                            @endif
                                        </a>
                                    </p>

                                </li>
                                <li role="separator" class="mdc-list-divider m-0"></li>
                                <li>
                                    <a href="{{ route('Main.buyPackage',app()->getLocale()) }}" class="mdc-list-item" role="menuitem" style="@if(collect(request()->segments())->last() == "buypackage") background-color: #088dd3; color: white; @endif">
                                        <i class="material-icons mat-icon-sm text-muted ">add_circle</i>
                                        <span class="mdc-list-item__text px-3">{{__('buy_package_title')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('Main.myAds',app()->getLocale()) }}" class="mdc-list-item" role="menuitem" style="@if(collect(request()->segments())->last() == "myads") background-color: #088dd3; color: white; @endif">
                                        <i class="material-icons mat-icon-sm text-muted">home</i>
                                        <span class="mdc-list-item__text px-3">{{__('my_ads_title')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('Main.paymentHistory',app()->getLocale()) }}" class="mdc-list-item" role="menuitem" style="@if(collect(request()->segments())->last() == "paymenthistory") background-color: #088dd3; color: white; @endif">
                                        <i class="material-icons mat-icon-sm text-muted">compare_arrows</i>
                                        <span class="mdc-list-item__text px-3">{{__('package_history_title')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('Main.profile',app()->getLocale()) }}" class="mdc-list-item" role="menuitem" style="@if(collect(request()->segments())->last() == "profile") background-color: #088dd3; color: white; @endif">
                                        <i class="material-icons mat-icon-sm text-muted">edit</i>
                                        <span class="mdc-list-item__text px-3">{{__('edit_profile_title')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('Main.changePassword',app()->getLocale()) }}" class="mdc-list-item" role="menuitem" style="@if(collect(request()->segments())->last() == "changepassword") background-color: #088dd3; color: white; @endif">
                                        <i class="material-icons mat-icon-sm text-muted">lock</i>
                                        <span class="mdc-list-item__text px-3">{{__('change_password_title')}}</span>
                                    </a>
                                </li>
                                <li role="separator" class="mdc-list-divider m-0"></li>
                                <li>
                                    <a href="#" class="mdc-list-item" role="menuitem" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons mat-icon-sm text-muted">power_settings_new</i>
                                        <span class="mdc-list-item__text px-3">{{__('Logout')}}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                            <div class="row start-xs middle-xs fw-500 d-none d-md-flex d-lg-flex d-xl-flex">
                                <span class="d-flex center-xs middle-xs item">
                                    <a href="{{ route('register',app()->getLocale()) }}" style="text-decoration: none;" class="social-icon mr-2 ml-2" >
                                        <i class="material-icons mat-icon-sm">person</i>
                                        <span class="px-1">{{__('sign_up_title')}}</span>
                                    </a>
                                </span>
                                <span class="d-flex center-xs middle-xs item">
                                    <a href="{{ route('login',app()->getLocale()) }}" style="text-decoration: none;" class="social-icon mr-2 ml-2">
                                        <i class="material-icons mat-icon-sm">login</i>
                                        <span class="px-1">{{__('login_title')}}</span>
                                    </a>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="main-toolbar" class="mdc-elevation--z2">
            <div class="theme-container row between-xs middle-xs h-100">
                <a href="{{ route('Main.index', ['locale' => app()->getLocale()]) }}" class="logo">
                    <img src="{{ asset('images/main/logo.png') }}" alt="image" style="max-height: 62px;margin: 5px 0;">
                </a>
                <div class="horizontal-menu d-none d-md-flex d-lg-flex d-xl-flex">
                    <div>
                        <a href="{{'/'.app()->getLocale(). '/' }}" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">{{__('home_title')}}</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{'/'.app()->getLocale(). '/' }}" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">{{__('required_for_rent')}}</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('companies', app()->getLocale()) }}" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">{{__('companies')}}</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ '/'.app()->getLocale().'/aboutus' }}" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">{{__('about_us_title')}}</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ '/'.app()->getLocale().'/contact' }}" class="mdc-button">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">{{__('contact_title')}}</span>
                        </a>
                    </div>
                    <div>
                        @if ( app()->getLocale() == "en")
                            <a href="#"  onclick="changeLng('ar')" class="mdc-button">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">العربیه</span>
                            </a>
                        @else
                            <a href="#"  onclick="changeLng('en')" class="mdc-button">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">English</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="row middle-xs">
                    <a href="submit-property.html" class="mdc-fab mdc-fab--mini primary d-sm-flex d-md-none d-lg-none d-xl-none">
                        <span class="mdc-fab__ripple"></span>
                        <span class="mdc-fab__icon material-icons">add</span>
                    </a>
                    <a href="submit-property.html" class="mdc-button mdc-button--raised d-none d-sm-none d-md-flex d-lg-flex d-xl-flex">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">{{ __('add_listing_title') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
