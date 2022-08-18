@extends('site.layout.master')
@php
$side = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp
@section('content')

    <main>
        <div class="px-3">
            <div class="theme-container">
                <div class="mt-5"></div>
                <div>
                    <div class="col-xs-12 rounded-sm b-gray p-0">
                        <div class="border p-2 bg-blue"> {{-- premium:blue --}}
                            <div class="row">
                                <div class="p-relative col-sm-2 w-sm1/5 p-0 p{{$side}}-2">
                                    <img class="w-100 m{{$side}}-2 rounded-xs" src="https://placehold.jp/150x150.png" alt="">
                                    <div class="row property-status p-absolute top-0"> {{-- premium:badge --}}
                                        <span class="red badge-sm">hot</span>
                                    </div>
                                </div>
                                <div class="col-sm-10 w-sm4/5 p-0">
                                    <h2 class="text-lg mb-2">الیجار شقه فی السلام</h2>

                                    <div class="flex-container mb-2">
                                        <span class="primary-color fw-600 d-inline-block m{{$side}}-2">600 {{__('kd_title')}}</span>
                                        <span class="flex flex-container m{{$side}}-2">
                                            <i class="material-icons mat-icon-sm text-muted m{{$side}}-1 mb-1">calendar_month</i>
                                            <span class="text-sm">3 days ago</span>
                                            {{-- <p>قبل 3 ایام</p> --}}
                                        </span>
                                        <span class="flex flex-container">
                                            <i class="material-icons-outlined mat-icon-sm text-muted m{{$side}}-1">visibility</i>
                                            <span class="text-sm">23</span>
                                        </span>
                                    </div>

                                    <div class="d-none d-sm-block d-md-block d-lg-more-block mb-2 fw-600 {{-- premium:fw-600 --}}">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                                    </div>

                                    <a href="javascript:void(0);" class="mdc-button mdc-button--outlined small-button d-none sm-show-button">
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__label fw-600">Rent</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 p-0 d-sm-none d-md-none d-lg-more-none fw-600 {{-- premium:fw-600 --}}">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mdc-card main-content-header mb-3">
                    <form action="javascript:void(0);" id="filters" class="search-wrapper">
                        <div class="row md-flex-no-wrap">
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-select mdc-select--outlined">
                                    <input id="cityInput" type="hidden" name="city_id" value="{{ old('city_id') }}">
                                    <div class="mdc-select__anchor">
                                        <i class="mdc-select__dropdown-icon"></i>
                                        <div class="mdc-select__selected-text"></div>
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label class="mdc-floating-label">Property Type</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                                    <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                        <ul class="mdc-list">
                                            <li class="mdc-list-item mdc-list-item--selected" data-value=""></li>
                                            <li class="mdc-list-item" data-value="1">Office</li>
                                            <li class="mdc-list-item" data-value="2">House</li>
                                            <li class="mdc-list-item" data-value="3">Apartment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                                <div class="mdc-select mdc-select--outlined">
                                    <input id="cityInput" type="hidden" name="city_id" value="{{ old('city_id') }}">
                                    <div class="mdc-select__anchor">
                                        <i class="mdc-select__dropdown-icon"></i>
                                        <div class="mdc-select__selected-text"></div>
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label class="mdc-floating-label">Property Status</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                                    <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                        <ul class="mdc-list">
                                            <li class="mdc-list-item mdc-list-item--selected" data-value=""></li>
                                            <li class="mdc-list-item" data-value="1">For Sale</li>
                                            <li class="mdc-list-item" data-value="2">For Rent</li>
                                            <li class="mdc-list-item" data-value="3">Open House</li>
                                            <li class="mdc-list-item" data-value="4">No Fees</li>
                                            <li class="mdc-list-item" data-value="5">Hot Offer</li>
                                            <li class="mdc-list-item" data-value="6">Sold</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4 mb-2 p-0 d-flex justify-center">
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input class="mdc-radio__native-control" type="radio" id="normal" name="advertise_type" value="normal"
                                            {{ old('advertise_type')=="normal" ? 'checked' : '' }}>
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                    </div>
                                    <label for="normal">Normal</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input class="mdc-radio__native-control" type="radio" id="premium" name="advertise_type" value="premium"
                                            {{ old('advertise_type')=="premium" ? 'checked' : '' }}>
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                    </div>
                                    <label for="premium">Premium</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input class="mdc-radio__native-control" type="radio" id="gold" name="advertise_type" value="gold"
                                            {{ old('advertise_type')=="gold" ? 'checked' : '' }}>
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                    </div>
                                    <label for="gold">Gold</label>
                                </div>
                                <br>
                                @error('advertise_type')
                                <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>

                            <span class="row center-xs middle-xs p-2 col-md-2 d-none d-md-flex d-lg-flex">
                                <button class="mdc-button mdc-button--raised w-100" type="submit">
                                    <span class="mdc-button__ripple"></span>
                                    <i class="material-icons mdc-button__icon">search</i>
                                    <span class="mdc-button__label">Search</span>
                                </button>
                            </span>
                        </div>
                        <span class="row center-xs middle-xs p-2 col-xs-12 col-md-2 d-md-none d-lg-none">
                            <button class="mdc-button mdc-button--raised w-100" type="submit">
                                <span class="mdc-button__ripple"></span>
                                <i class="material-icons mdc-button__icon">search</i>
                                <span class="mdc-button__label">Search</span>
                            </button>
                        </span>
                    </form>
                </div>

            </div>
        </div>
    </main>

@endsection
