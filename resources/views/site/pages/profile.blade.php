@extends('site.layout.panel')
@section('panel-content')
    @if((session('status')) == 'success')
        <div class="alert alert-success">
            <strong>{{ __('success_title') }}!</strong> {{ __('profile_success') }}
        </div>
    @elseif((session('status')) == 'unsuccess')
        <div class="alert alert-danger">
            <strong>{{ __('un_success_title') }}!</strong> {{ __('contact_unsuccess') }}
        </div>
    @endif

    <form method="post" class="contact-form" action="{{ route('User.editUser',app()->getLocale()) }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="mdc-text-field mdc-text-field--outlined w-100">
                    <input type="text" name="name" id="name"  class="mdc-text-field__input @error('name') is-invalid @enderror" placeholder="{{__('your_name')}}"  value="{{ old('name' , auth()->user()->name)}}"  >
                    <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch">
                            <label class="mdc-floating-label">{{__('full_name_title')}}</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                    </div>
                </div>
                @error('name')
                <span class="invalid-feedback warn-color">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mdc-text-field mdc-text-field--outlined w-100">
                    <input type="text" disabled  class="mdc-text-field__input"   value="{{  auth()->user()->mobile}}"  >
                    <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch">
                            <label class="mdc-floating-label">{{__('phone_number_title')}}</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mt-3">
            <div class="col-lg-6 col-md-6">
                <div class="mdc-text-field mdc-text-field--outlined w-100">
                    <input type="email" name="email" id="email"  class="mdc-text-field__input @error('email') is-invalid @enderror" placeholder="{{__('email_address_title')}}"  value="{{ old('email' , auth()->user()->email)}}"  >
                    <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch">
                            <label class="mdc-floating-label">{{__('email_address_title')}}</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback warn-color">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-lg-6 col-md-6">
                <div class="mdc-text-field--outlined w-100">
                    <label class="text-muted w-100">{{__('get_verified_profile_title')}}</label>
                    <input type="file" name="licence" id="licence"  class="mdc-text-field__input @error('licence') is-invalid @enderror" placeholder="{{__('get_verified_profile_title')}}"  >
                </div>
                @error('licence')
                <span class="invalid-feedback warn-color">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mdc-text-field--outlined w-100">
                    <label class="text-muted w-100">{{__('profile_image_title')}}</label>
                    <input type="file" name="avatar" id="avatar"  class="mdc-text-field__input @error('avatar') is-invalid @enderror" placeholder="{{__('profile_image_title')}}"  >
                </div>
                @error('avatar')
                <span class="invalid-feedback warn-color">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

        </div>
        <button type="submit" class="mdc-button mdc-button--raised mdc-ripple-upgraded" style="margin-top:30px;">{{__('save_title')}} &amp; {{__('upload_title')}}</button>


    </form>
@endsection
{{--@section('pagination')--}}
{{--    dsadad--}}
{{--@endsection--}}
