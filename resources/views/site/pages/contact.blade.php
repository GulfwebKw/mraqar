@extends('site.layout.master')

@section('content')

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
