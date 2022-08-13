@extends('site.layout.master')

@section('content')

<main class="content-offset-to-top">
    @auth()
    <div class="row">
        @if(auth()->user()->type_usage === 'company')
            <div class="center-xs col-xs-12 my-3">
                <span class="fw-500 text-muted mx-auto">see your <a href="#">company page!</a></span>
            </div>
        @elseif($balance !== 0)
            <div class="center-xs col-xs-12 my-3">
                <span class="fw-500 text-muted mx-auto">you have packages/ads which not finished yet!</span>
            </div>
        @else
        <div class="col-xs-11 col-lg-5 my-1 mx-auto my-3">
            <div class="card card-subscribe card-buy shadow companies-card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-4 col-xs-5 p-0">
                            <img src="https://placehold.jp/150x150.png" alt="agent-image" class="mw-100 d-block">
                        </div>
                        <div class="col-md-8 col-xs-7 center-xs p-0 pl-3">
                            <p class="mb-3 fw-500">upgrade to company account</p>

                            <a href="{{ route('companies.new', app()->getLocale()) }}" class="mdc-button mdc-button--raised w-100 mb-2">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">upgrade account</span>
                            </a>
                            <br>
                            <a class="mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">Foo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endauth
    <div class="row">
        <span class="fw-500 text-muted mx-auto">Email us or call us for assistance</span>
    </div>
    <div class="row">
        <h1 class="fw-600 mx-auto py-3">Companies list</h1>
    </div>
    <div class="row">
        @foreach($companies as $company)
            <div class="card card-subscribe card-buy shadow companies-card col-xs-11 col-lg-2">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-4 col-xs-5 p-0">
                            <img src="https://placehold.jp/150x150.png" alt="agent-image" class="mw-100 d-block">
                        </div>
                        <div class="col-md-8 col-xs-7 center-xs p-0 pl-3">
                            <p class="mb-3 fw-500">{{ $company->name }}</p>

                            <a class="mdc-button mdc-button--raised mb-2">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">{{ $company->mobile }}</span>
                            </a>
                            <div>
                                @foreach($company->socials as $social)
                                    {{ $social->type }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

@endsection
