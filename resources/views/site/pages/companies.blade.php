@extends('site.layout.master')

@php
$lang = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp

@section('content')

<main class="content-offset-to-top">
    <div class="theme-container">
        @auth()
        <div class="row">
            @if(auth()->user()->type_usage === 'company')
                @php $cardMessage = '<a href="#" class="links">' . 'click here to see your company page.' . '</a>'; @endphp
            @elseif($balance !== 0)
                @php $cardMessage = 'you have package which is not finished yet!'; @endphp
            @endif
            <div class="col-xs-11 col-sm-7 col-md-5 my-1 mx-auto my-3">
                <div class="card card-subscribe card-buy shadow companies-card rounded">
                    <div class="card-body p-3">
                        <div class="row">
                            @isset($cardMessage)
                                <p class="my-0 fw-600 mx-auto">{!! $cardMessage !!}</p>
                            @else
                                <div class="col-md-4 col-xs-5 p-0">
                                    <img src="https://placehold.jp/150x150.png" alt="agent-image" class="w-100 d-block rounded">
                                </div>
                                <div class="col-md-8 col-xs-7 center-xs p-0 pl-3 company-card-body">
                                    <p class="mb-3 fw-600">upgrade to company account</p>

                                    <a href="{{ route('companies.new', app()->getLocale()) }}" class="mdc-button mdc-button--raised w-90 mx-auto">
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__label">upgrade account</span>
                                    </a>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <div class="row">
            <a href="{{ '/'.app()->getLocale().'/contact' }}" class="fw-500 text-muted mx-auto">call us for assistance.</a>
        </div>
        <div class="row">
            <h1 class="fw-600 mx-auto py-3">Companies list</h1>
        </div>
        <div class="row md:px-5 justify-content-center">
            @foreach($companies as $company)
                <div class="card card-subscribe card-buy shadow companies-card rounded col-xs-11 col-sm-5 col-md-2  p-0 sm:m{{$lang}}-2 mb-3">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-4 col-xs-5 col-md-12 p-0">
                                <img src="https://placehold.jp/150x150.png" alt="agent-image" class="mw-100 md:w-100 d-block rounded small-only-max-height max-height">
                            </div>
                            <div class="col-md-8 col-xs-7 col-md-12 center-xs p-0">
                                <a href="#" class="my-1 fw-600 text-body links company-name">{{ $company->name }}</a>

                                @php
                                    $tel = \Illuminate\Support\Str::startsWith($company->mobile, '+') ? $company->mobile : "+{$company->mobile}";
                                    $tel = \Illuminate\Support\Str::startsWith($tel, '+965') ? $tel : str_replace('+', '+965', $tel);
                                    $tel = str_replace(' ', '', $tel);
                                @endphp
                                <a href="tel:{{ $tel }}" class="mdc-button mdc-button--raised mb-2">
                                    <span class="mdc-button__ripple"></span>
                                    <i class="material-icons mdc-button__icon">phone</i>
                                    <span class="mdc-button__label">{{ $company->mobile }}</span>
                                </a>
                                @if(count($company->socials))
                                    <div class="company-socials-container">
                                        @foreach($company->socials as $social)
                                            @if($social->type == 'instagram')
                                            <svg class="material-icons mat-icon-md company-social" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                                            </svg>
                                            @elseif($social->type === 'twitter')
                                                <svg class="material-icons mat-icon-md company-social" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z" />
                                                </svg>
                                            @elseif($social->type === 'email')
                                                <svg class="material-icons mat-icon-md company-social" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                                                </svg>
                                            @elseif($social->type === 'facebook')
                                                <svg class="material-icons mat-icon-md company-social" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" />
                                                </svg>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
