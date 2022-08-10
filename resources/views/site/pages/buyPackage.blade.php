@extends('site.layout.master')

@section('content')


<main>
    <div class="px-3">
        <div class="theme-container">
            <div class="my-5">
                <div class="column center-xs middle-xs text-center">
                    <h1 class="uppercase">{{__('buy_package_title')}}</h1>
                    <p class="text-muted fw-500">{{__('subscribetoourpackagenote')}}</p>
                </div>

                <div class="mdc-tab-bar-wrapper centered pricing-tabs">
                    <div class="mdc-tab-bar mb-3">
                        <div class="mdc-tab-scroller">
                            <div class="mdc-tab-scroller__scroll-area">
                                <div class="mdc-tab-scroller__scroll-content">
                                    <button class="mdc-tab mdc-tab--active" tabindex="0">
                                <span class="mdc-tab__content">
                                <span class="mdc-tab__text-label">{{__('longtermsubscribe')}}</span>
                                </span>
                                        <span class="mdc-tab-indicator mdc-tab-indicator--active">
                                <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                                        <span class="mdc-tab__ripple"></span>
                                    </button>
                                    <button class="mdc-tab mdc-tab" tabindex="0">
                                <span class="mdc-tab__content">
                                <span class="mdc-tab__text-label">{{__('payasyougo')}}</span>
                                </span>
                                        <span class="mdc-tab-indicator mdc-tab-indicator">
                                <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                                        <span class="mdc-tab__ripple"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content--active">
                        <div class="row">
                            @foreach($normals as $normal)
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">free</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ {{__('kd_title')}} <small><strike>{{ $normal->old_price }}</strike></small>{{ $normal->price }}<small> /{{ $normal->count_day }} {{__('days')}}</small></h1>
                                        <p class="desc mb-2">@if(app()->getLocale()=="en"){{$normal->title_en}}@else{{$normal->title_ar}}@endif</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">10</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">1</span>Agent Profile</p>
                                        <p class="py-2 del text-muted">Agency Profiles</p>
                                        <p class="py-2 del text-muted">Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">basic</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 49<small> /mo</small></h1>
                                        <p class="desc mb-2">The most popular package we offer</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">100</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">3</span>Agent Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">1</span>Agency Profile</p>
                                        <p class="py-2 del text-muted">Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">premium</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 79<small> /mo</small></h1>
                                        <p class="desc mb-2">The perfect package for your small business</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">250</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">10</span>Agent Profile</p>
                                        <p class="py-2"><span class="mx-2 fw-500">5</span>Agency Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">50</span>Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">professional</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 159<small> /mo</small></h1>
                                        <p class="desc mb-2">Our most advanced & complete package</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Agent Profile</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Agency Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">free</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 0<small> /yr</small></h1>
                                        <p class="desc mb-2">Simplest package to get you started</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">10</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">1</span>Agent Profile</p>
                                        <p class="py-2 del text-muted">Agency Profiles</p>
                                        <p class="py-2 del text-muted">Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">basic</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 569<small> /yr</small></h1>
                                        <p class="desc mb-2">The most popular package we offer</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">100</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">3</span>Agent Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">1</span>Agency Profile</p>
                                        <p class="py-2 del text-muted">Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">premium</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 929<small> /yr</small></h1>
                                        <p class="desc mb-2">The perfect package for your small business</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">250</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">10</span>Agent Profile</p>
                                        <p class="py-2"><span class="mx-2 fw-500">5</span>Agency Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">50</span>Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                    <h2 class="pricing-title my-3">professional</h2>
                                    <div class="bg-accent pricing-header p-3">
                                        <h1>$ 1899<small> /yr</small></h1>
                                        <p class="desc mb-2">Our most advanced & complete package</p>
                                    </div>
                                    <div class="p-3">
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Properties</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Agent Profile</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Agency Profiles</p>
                                        <p class="py-2"><span class="mx-2 fw-500">Unlimited</span>Featured Properties</p>
                                        <button type="submit" class="mdc-button mdc-button--raised">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Buy now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
