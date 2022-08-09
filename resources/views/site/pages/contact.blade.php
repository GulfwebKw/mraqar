@extends('site.layout.master', ['header' => 'transparent'])

@section('content')
{{--
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg1">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('contact_us_title')}}</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>{{__('success_title')}}!</strong> {{__('contact_success')}} !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>{{__('un_success_title')}}!</strong> {{__('contact_unsuccess')}} !
    </div>
@endif

<div id="result"></div>

<!-- Start Contact Area -->
<section class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="contact-info">

                    <h3>{{__('heretohelp')}}</h3>
                    <p>{{__('heretohelp_note')}}</p>

                    <ul class="contact-list">
                        @if (app()->getLocale()=='en')
                            <li><i class='bx bx-map'></i> {{__('location_title')}}: <a href="#">{!! $address !!}</a></li>
                        @else
                            <li><i class='bx bx-map'></i> {{__('location_title')}}: <a href="#">{!! $address_ar !!}</a></li>
                        @endif
                        <li><i class='bx bx-phone-call'></i> {{__('administrator')}}: <a href="tel:{{$phone2}}">{{ $phone2 }}</a></li>
                        <li><i class='bx bx-phone-call'></i> {{__('technicalsupport')}}: <a href="tel:{{$phone}}">{{ $phone }}</a></li>
                        <li><i class='bx bx-envelope'></i> {{__('email_us') }} <a href="mailto:{{ $email }}">{{ $email }}</a></li>
                        <li><i class='bx bx-world'></i> {{__('visit_us_title')}}: <a href="{{ $website }}">{{ $website }}</a></li>
                    </ul>

                    <h3>{{__('follow_us')}} :</h3>
                    @php
                        $facebook = App\Http\Controllers\site\MessageController::getSettingDetails('facebook');
                        $twitter = App\Http\Controllers\site\MessageController::getSettingDetails('twitter');
                        $instagram = App\Http\Controllers\site\MessageController::getSettingDetails('instagram');
                        $snapchat = App\Http\Controllers\site\MessageController::getSettingDetails('snapchat');
                        $youtube = App\Http\Controllers\site\MessageController::getSettingDetails('youtube');
                    @endphp
                    <ul class="social">
                        @if($facebook)
                            <li><a href="{{$facebook}}"  target="_blank"><i class='bx bxl-facebook'></i></a></li>
                        @endif
                        @if($twitter)
                            <li><a href="{{$twitter}}" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                        @endif
                        @if($instagram)
                            <li><a href="{{$instagram}}"  target="_blank"><i class='bx bxl-instagram'></i></a></li>
                        @endif
                        @if($snapchat)
                            <li><a href="{{$snapchat}}"  target="_blank"><i class='bx bxl-snapchat'></i></a></li>
                        @endif
                        @if($youtube)
                            <li><a href="{{$youtube}}"  target="_blank"><i class='bx bxl-youtube'></i></a></li>
                        @endif
                        <li><a href="{{$whatsapp}}" target="_blank"><i class='bx bxl-whatsapp'></i></a></li>

                    </ul>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="contact-form">

                    <h3>{{__('dropaline')}}</h3>
                    <p>{{__('dropaline_note')}}</p>


                    <form method="post" action="{{ route('message.store' , app()->getLocale()) }}" >

                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label class="w-100">{{__('full_name_title')}} <span>*</span></label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" required data-error="{{__('name_required')}}" placeholder="{{__('your_name')}}" @if(auth()->check()) value="{{auth()->user()->name}}" @endif value="{{ old('name') }}" >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label class="w-100"> {{__('email_us')}} <span>*</span></label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" required data-error="{{__('email_required')}}" placeholder="{{__('your_email')}}"  @if(auth()->check()) value="{{auth()->user()->email}}" @endif value="{{ old('email') }}" >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="w-100">{{__('phone_number_title')}} <span>*</span></label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" required data-error="{{__('phone_required')}}" placeholder="{{__('your_phone')}}"  @if(auth()->check()) value="{{auth()->user()->mobile}}" @endif value="{{ old('phone_number') }}" >
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="w-100">{{__('your_message_title')}} <span>*</span></label>
                                    <textarea name="message" id="message" cols="30" rows="5" required data-error="Please enter your message" class="form-control" placeholder="{{__('write_your_message')}}"></textarea>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn">{{__('send_title')}}</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

<!-- Map -->
<div class="map-area">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8269.381942820617!2d47.979978215795796!3d29.374774147096584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf9c83ce455983%3A0xc3ebaef5af09b90e!2sKuwait%20City!5e0!3m2!1sen!2skw!4v1600156454756!5m2!1sen!2skw"></iframe>
</div>
<!-- End Map -->
@endsection
--}}

<main class="content-offset-to-top">
    <div class="header-image-wrapper">
        <div class="bg" style="background-image: url('{{ url('') }}/asset/images/others/contact.jpg');"></div>
        <div class="mask"></div>
        <div class="header-image-content offset-bottom">
            <h1 class="title">{{__('contact_us_title')}}</h1>
            <p class="desc">{{__('heretohelp_note')}}</p>
        </div>
    </div>
    <div class="px-3">
        <div class="theme-container">
            <div class="mdc-card main-content-header mb-5">
                <div class="row around-xs">
                    <div class="col-xs-12 col-sm-3">
                        <div class="column center-xs middle-xs text-center">
                            <i class="material-icons mat-icon-lg primary-color">location_on</i>
                            <h3 class="primary-color py-1">{{__('location_title')}} :</h3>
                            @if (app()->getLocale()=='en')
                                <span class="text-muted fw-500">{!! $address !!}</span>
                            @else
                                <span class="text-muted fw-500">{!! $address_ar !!}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="column center-xs middle-xs text-center">
                            <i class="material-icons mat-icon-lg primary-color">call</i>
                            <h3 class="primary-color py-1">{{__('administrator')}} :</h3>
                            <span> <span class="text-muted fw-500">{{__('administrator')}}: </span><a class="text-muted fw-500" href="tel:{{ $phone2 }}">{{ $phone2 }}</a></span>
                            <span> <span class="text-muted fw-500">{{__('technicalsupport')}}: </span><a class="text-muted fw-500" href="tel:{{ $phone }}">{{ $phone }}</a></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="column center-xs middle-xs text-center">
                            <i class="material-icons mat-icon-lg primary-color">mail_outline</i>
                            <h3 class="primary-color py-1">{{__('email_us') }} :</h3>
                            <a class="text-muted fw-500" href="mailto:{{ $email }}">{{ $email }}</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="column center-xs middle-xs text-center">
                            <i class="material-icons mat-icon-lg primary-color">public</i>
                            <h3 class="primary-color py-1">{{__('visit_us_title')}} :</h3>
                            <a class="text-muted fw-500" href="{{ $website }}">{{ $website }}</a>
                        </div>
                    </div>
                    <div class="col-xs-12 mt-3 px-3 p-relative">
                        <div class="divider w-100"></div>
                    </div>
                    <h3 class="w-100 text-center pt-3">{{__('dropaline')}}</h3>
                    <p class="mt-2">{{__('dropaline_note')}}</p>
                    <form method="post" action="{{ route('message.store' , app()->getLocale()) }}" class="contact-form row">
                        @csrf
                        <div class="col-xs-12 col-sm-12 col-md-4 p-2">
                            <div class="mdc-text-field mdc-text-field--outlined w-100">
                                <input class="mdc-text-field__input" placeholder="{{__('your_name')}}">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('full_name_title')}} <span class="warn-color">*</span></label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 p-2">
                            <div class="mdc-text-field mdc-text-field--outlined w-100">
                                <input class="mdc-text-field__input" placeholder="{{__('your_email')}}">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('email_us')}} <span class="warn-color">*</span></label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 p-2">
                            <div class="mdc-text-field mdc-text-field--outlined w-100">
                                <input class="mdc-text-field__input" placeholder="{{__('your_phone')}}">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('phone_number_title')}} <span class="warn-color">*</span></label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 p-2">
                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea w-100">
                                <textarea class="mdc-text-field__input" rows="5" placeholder="{{__('write_your_message')}}"></textarea>
                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('your_message_title')}} <span class="warn-color">*</span></label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 w-100 py-3 text-center">
                            <button class="mdc-button mdc-button--raised" type="submit">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">{{__('send_title')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-5">
                    <div id="contact-map"></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
