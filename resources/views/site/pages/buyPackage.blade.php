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
                                        <div class="bg-accent pricing-header p-3">
                                            <h1>{{__('kd_title')}} <small><span class="del opacity-70">{{ $normal->old_price }} </span></small>{{ $normal->price }}<small> /{{ $normal->count_day }} {{__('days')}}</small></h1>
                                            <p class="desc mb-2">@if(app()->getLocale()=="en"){{$normal->title_en}}@else{{$normal->title_ar}}@endif</p>
                                        </div>
                                        <div class="p-3">
                                            <p class="py-2">
                                                <!--<span class="mx-2 fw-500">10</span>-->
                                                @if(app()->getLocale()=="en"){{$normal->description_en}}@else{{$normal->description_ar}}@endif
                                            </p>

                                            <form method="post" action="{{ route('Main.buyPackageOrCredit',app()->getLocale()) }}" >
                                                @csrf
                                                <input type="hidden" class="form-control" name="payment_type" value="Knet" >
                                                <input type="hidden" name="type" value="normal" >
                                                <input type="hidden" name="package_id" value="{{ $normal->id }}">
                                                <button type="submit" class="mdc-button mdc-button--raised">
                                                    <span class="mdc-button__ripple"></span>
                                                    <span class="mdc-button__label">{{__('buy')}}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            @foreach($statics as $static)
                                <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                    <div class="mdc-card pricing-card text-center border-accent p-0 h-100">
                                        <div class="bg-accent pricing-header p-3">
                                            <h1>{{__('kd_title')}} <small><span class="del opacity-70">{{ $static->old_price }} </span></small>{{ $static->price }}<small> /{{ $normal->count_day }} {{__('days')}}</small></h1>
                                            <p class="desc mb-2">@if(app()->getLocale()=="en"){{$static->title_en}}@else{{$static->title_ar}}@endif</p>
                                        </div>
                                        <div class="p-3 ad-plan-bottom">
                                            <p class="py-2 add-plan-description">@if(app()->getLocale()=="en"){{$static->description_en}}@else{{$static->description_ar}}@endif</p>

                                            <form method="post" action="{{ route('Main.buyPackageOrCredit',app()->getLocale()) }}" >
                                                @csrf
                                                <div>
                                                    <input type="hidden" class="form-control" name="payment_type" value="Knet">
                                                    <div class="mdc-text-field mdc-text-field--outlined w-100 custom-field mb-3">
                                                        <input type="number" min="1" class="mdc-text-field__input" placeholder="{{__('noofads')}}" name="count" id="{{ "static-num-" . $static->id }}" required>
                                                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                            <div class="mdc-notched-outline__leading"></div>
                                                            <div class="mdc-notched-outline__notch">
                                                                <label class="mdc-floating-label" style="">{{__('noofads')}}</label>
                                                            </div>
                                                            <div class="mdc-notched-outline__trailing"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="type" value="static" >
                                                <input type="hidden" name="package_id" value="{{ $static->id }}" >
                                                <button type="submit" class="mdc-button mdc-button--raised">
                                                    <span class="mdc-button__ripple"></span>
                                                    <span class="mdc-button__label">{{__('buy')}}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
