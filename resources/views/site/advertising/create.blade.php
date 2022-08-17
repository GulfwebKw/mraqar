@extends('site.layout.master')

@section('title' , __('add_ad_title'))

@php
    $unSide = app()->getLocale() === 'en' ? 'l' : 'r';
@endphp

@section('content')

    <!-- Start listing Details Area -->
    <section class="listing-details-area pt-100 pb-70 bg-f7fafd">
        <div class="container">
            <create :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                    :locale="{{json_encode(app()->getLocale())}}"></create>
        </div>
    </section>
    <!-- End listing Details Area -->



    <main>
        <div class="px-3">
            <div class="theme-container">
                @if((session('status')) == 'unsuccess')
                    <div class="alert alert-danger mt-3">
                        <strong>{{__('un_success_title')}}!</strong> {{__('un_success_alert_title')}}!
                    </div>
                @endif
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
                                        <p class="uppercase m-2 fw-500">{{__('ADVERTISE_TYPE')}}</p>
                                        <div class="mdc-form-field w-100">
                                            <div class="mdc-radio">
                                                <input class="mdc-radio__native-control" type="radio" id="normal" name="advertising_type" value="normal"
                                                       {{ old('advertising_type')=="normal" ? 'checked' : '' }} {{ $credit['count_normal_advertising'] > 0 ?: 'disabled' }}>
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                            </div>
                                            <label for="normal">
                                                {{__('normal_title')}}
                                                @if($credit['count_normal_advertising'] > 0)
                                                    <span class="text-success m{{$unSide}}-5">{{$credit['count_normal_advertising']}} ad remaining</span>
                                                @else
                                                    <span class="text-danger m{{$unSide}}-5">{{$credit['count_normal_advertising']}} ad remaining</span>
                                                @endif
                                            </label>
                                        </div>
                                        <br>
                                        <div class="mdc-form-field">
                                            <div class="mdc-radio">
                                                <input class="mdc-radio__native-control" type="radio" id="premium" name="advertising_type" value="premium"
                                                    {{ old('advertising_type')=="premium" ? 'checked' : '' }} {{ $credit['count_premium_advertising'] > 0 ?: 'disabled' }}>
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                            </div>
                                            <label for="premium">{{__('premium_title')}}</label>
                                            @if($credit['count_premium_advertising'] > 0)
                                                <span class="text-success m{{$unSide}}-5">{{$credit['count_premium_advertising']}} ad remaining</span>
                                            @else
                                                <span class="text-danger m{{$unSide}}-5">{{$credit['count_premium_advertising']}} ad remaining</span>
                                            @endif
                                        </div>
                                        <br>
                                        @error('advertising_type')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input" placeholder="{{__('full_name_title')}}" value="{{auth()->user()->name}}" disabled required>
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label" style="">{{__('full_name_title')}}</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input" name="phone_number" placeholder="{{__('phone_number_title')}}" value="{{ old('phone_number', auth()->user()->mobile)}}" required>
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label" style="">{{__('phone_number_title')}}</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('phone_number')
                                            <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined role-list">
                                            <input id="cityInput" type="hidden" name="city_id" value="{{ old('city_id') }}">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">{{__('city')}}</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    @foreach($cities as $city)
                                                        <li class="mdc-list-item" data-value="{{ $city->id }}">
                                                            {{ app()->getLocale() == 'en' ? $city->name_en : $city->name_ar }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @error('city_id')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <script type="module">
                                        $(document).on('inputUpdated', function(e, event_data) {
                                            if (event_data[0] === 'city_id') {
                                                let city_id = event_data[1]
                                                $.post('/{{app()->getLocale()}}/areas', {city_id}, function(data, status){
                                                    if (status === 'success') {
                                                        $('#areasList').empty()
                                                        console.log($('#areasList').parent().parent().find('.mdc-select__selected-text').text(''));
                                                        console.log($('#areasList').parent().parent().parent().find('input').val(''));
                                                        $.each(data, function(index, area) {
                                                            let option = `<li class="mdc-list-item" data-value="${area.id}">${area.name_{{app()->getLocale()}}}</li>`
                                                            $('#areasList').append(option)
                                                        })
                                                    } else
                                                        console.error('error in get areas with ajax request')
                                                })
                                            }
                                        })
                                    </script>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <input type="hidden" name="area_id" id="area_id" value="{{ old('area_id') }}">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">{{__('Area')}}</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list" id="areasList">
                                                </ul>
                                            </div>
                                        </div>
                                        @error('area_id')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <input type="hidden" name="venue_type" id="venue_type" value="{{ old('venue_type') }}">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">{{__('property_type')}}</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    @foreach($types as $type)
                                                        <li class="mdc-list-item" data-value="{{$type->id}}">{{ app()->getLocale() == 'en' ? $type->title_en : $type->title_ar }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @error('venue_type')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <input type="hidden" name="purpose" id="purpose" value="{{ old('purpose') }}">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">{{__('purpose')}}</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    @foreach($purposes as $purpose)
                                                        <li class="mdc-list-item" data-value="{{$purpose}}">{{ __($purpose) }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @error('purpose')
                                            <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input" name="price" value="{{ old('price') }}" placeholder="{{__('price_title')}} ({{__('kd_title')}})">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label">{{__('price_title')}} ({{__('kd_title')}})</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('price')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 p-2">
                                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea">
                                            <textarea class="mdc-text-field__input" name="description" rows="5" placeholder="{{__('description_title')}}">{{ old('description') }}</textarea>
                                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label class="mdc-floating-label">{{__('description_title')}}</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('description')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 mt-2">
                                        <label class="text-muted">GALLERY (max 8 images)</label>
                                        <div id="property-images" class="dropzone needsclick">
                                            <div class="dz-message needsclick text-muted">
                                                Drop files here or click to upload.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="files">

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
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
@section('scripts')
    <script src="{{ asset('asset/js/libs/dropzone.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $("#property-images").dropzone({
                maxFiles: 2000,
                url: "{{ route('site.advertising.ajax_file_upload_handler' , app()->getLocale() ) }}",
                success: function (file, response) {
                    $('#files').append('<input type="hidden" name="other_images_link[]" value="'+response+'">');
                }
            });
        })

    </script>


@endsection
@section('header')
     <link rel="stylesheet" href="{{ asset('asset/css/libs/dropzone.css') }}">
@endsection
