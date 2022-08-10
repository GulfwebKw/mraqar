@extends('site.layout.master')

@section('content')

    <main>
        <div class="px-3">
            <div class="theme-container">
                <div class="row center-xs middle-xs my-5">
                    <div class="mdc-card p-3 p-relative mw-500px">
                        <div class="column center-xs middle-xs text-center">
                            <h1 class="uppercase">{{__('sign_up_title')}}</h1>
                            <a href="{{ route('login',app()->getLocale()) }}" class="mdc-button mdc-ripple-surface mdc-ripple-surface--primary normal w-100">
                                {{__('already_registered')}}
                                {{__('sign_in')}}
                            </a>
                        </div>
                        <form method="post" action="{{ route('register',app()->getLocale()) }}">
                            @csrf
                            <input type="hidden" name="type_usage" value="individual">
                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon w-100 mt-3 custom-field ">
                                <i class="material-icons mdc-text-field__icon text-muted">phone</i>
                                <input id="mobile" type="tel" placeholder="{{__('phone_number_title')}}" class="mdc-text-field__input @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('phone_number_title')}}</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                            @error('mobile')
                            <span class="invalid-feedback warn-color d-inline-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon mdc-text-field--with-trailing-icon w-100 custom-field mt-4 custom-field">
                                <i class="material-icons mdc-text-field__icon text-muted">lock</i>
                                <i class="material-icons mdc-text-field__icon text-muted password-toggle" tabindex="1">visibility_off</i>
                                <input  name="password" id="password" type="password" placeholder="{{__('password')}}" class="mdc-text-field__input @error('password') is-invalid @enderror" type="password" required>
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('password')}}</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback warn-color d-inline-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon mdc-text-field--with-trailing-icon w-100 custom-field mt-4 custom-field">
                                <i class="material-icons mdc-text-field__icon text-muted">lock</i>
                                <i class="material-icons mdc-text-field__icon text-muted password-toggle" tabindex="1">visibility_off</i>
                                <input  name="password_confirmation" id="password_confirmation" type="password" placeholder="{{__('Confirm Password')}}" class="mdc-text-field__input @error('password') is-invalid @enderror" required>
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">{{__('Confirm Password')}}</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <span class="invalid-feedback warn-color d-inline-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="text-center mt-2">
                                <button class="mdc-button mdc-button--raised" type="submit">
                                    <span class="mdc-button__ripple"></span>
                                    <span class="mdc-button__label">{{__('sign_up_title')}}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
