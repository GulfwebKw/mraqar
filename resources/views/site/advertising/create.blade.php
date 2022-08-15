@extends('site.layout.master')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg2">
        <div class="container ">
            <div class="page-title-content">
                <h2>{{__('create_ad_title')}}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start listing Details Area -->
    <section class="listing-details-area pt-100 pb-70 bg-f7fafd">
        <div class="container ">
            <create :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                    :locale="{{json_encode(app()->getLocale())}}"></create>
        </div>
    </section>
    <!-- End listing Details Area -->



    <main>
        <div class="px-3">
            <div class="theme-container">
                <div class="py-3">
                    <div class="mdc-card p-3">
                        <div class="mdc-tab-bar-wrapper submit-property">
                            <div class="tab-content tab-content--active">
                                <form action="{{ route('site.advertising.store', app()->getLocale()) }}" method="post" id="sp-basic-form" class="row">
                                    @csrf
                                    <div class="col-xs-12 p-3">
                                        <h1 class="fw-500 text-center">{{__('create_ad_title')}}</h1>
                                    </div>



                                    <div class="col-xs-12 mb-2 p-0">
                                        {{-- <p class="uppercase m-2 fw-500">Features</p> --}}

                                        <div class="mdc-form-field">
                                            <div class="mdc-radio">
                                                <input class="mdc-radio__native-control" type="radio" id="radio-1" name="radios">
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                            </div>
                                            <label for="radio-1">Radio 1</label>
                                        </div>

                                        <br>

                                        <div class="mdc-form-field">
                                            <div class="mdc-radio">
                                                <input class="mdc-radio__native-control" type="radio" id="radio-1" name="radios">
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                            </div>
                                            <label for="radio-1">Radio 1</label>
                                        </div>
                                    </div>



                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input">
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label" style="">Bedrooms</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input">
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label" style="">Bedrooms</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined role-list">
{{--                                            <input type="hidden" name="test" value="{{ old('city') }}">--}}
{{--                                            <input type="hidden" name="enhanced-select">--}}
                                            <input type="hidden" name="my_select" id="my_select" value="">

                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">City</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    <li class="mdc-list-item" data-value="1">Nothing</li>
                                                    <li class="mdc-list-item" data-value="2">Office</li>
                                                    <li class="mdc-list-item" data-value="3">House</li>
                                                    <li class="mdc-list-item" data-value="4">Apartment</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">Area</label>
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

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">Property type</label>
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

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">Purpose</label>
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

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label">Price (KD)</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea">
                                            <textarea class="mdc-text-field__input" rows="5"></textarea>
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label">Description</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label">Price (€)</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 mt-2">
                                        <label class="text-muted">GALLERY (max 8 images)</label>
                                        <div id="property-images" class="dropzone needsclick">
                                            <div class="dz-message needsclick text-muted">
                                                Drop files here or click to upload.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 p-2 mt-3 center-xs">
                                        <button class="mdc-button mdc-button--raised next-tab" type="submit">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">Submit</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="dropzone-preview-template" class="d-none plan-image-template">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image"><img src="assets/images/others/transparent-bg.png" data-dz-thumbnail="" alt="prop-image"></div>
                                <div class="dz-details">
                                    <div class="dz-size"><span data-dz-size=""></span></div>
                                    <div class="dz-filename"><span data-dz-name=""></span></div>
                                </div>
                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                <div class="dz-success-mark">
                                    <i class="material-icons mat-icon-xlg">check</i>
                                </div>
                                <div class="dz-error-mark">
                                    <i class="material-icons mat-icon-xlg">cancel</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('scripts')
    <script defer src="{{ asset('asset/js/libs/dropzone.js') }}"></script>
@endsection
@section('header')
     <link rel="stylesheet" href="{{ asset('asset/css/libs/dropzone.css') }}">
@endsection
