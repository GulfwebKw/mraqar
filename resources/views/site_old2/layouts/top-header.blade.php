@php
$callphone  = App\Http\Controllers\site\MessageController::getSettingDetails('phone');
@endphp
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <ul class="header-contact-info">
                    <li id="header-welcome-title">{{__('welcome_title')}}</li>
                    @if($callphone)
                    <li> {{__('call_now_title')}}: <a href="tel:{{$callphone}}">{{$callphone}}</a></li>
                    @endif
                    <li>
                        <div class="dropdown language-switcher d-inline-block">
                            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                @if (app()->getLocale()=='en')
                                    <img src="{{ asset('images/main/us-flag.jpg') }}" alt="image">
                                    <span>Eng <i class='bx bx-chevron-down'></i></span>
                                @endif
                                @if (app()->getLocale()== 'ar')
                                    <img src="{{ asset('images/main/kuwait-flag.jpg') }}" class="shadow-sm" alt="flag">
                                    <span>العربية <i class='bx bx-chevron-down'></i></span>
                                @endif

                            </button>

                            <div class="dropdown-menu">

                                    @if (app()->getLocale()== 'en')
                                    <a style="cursor: pointer" onclick="changeLng('ar')" class="dropdown-item d-flex align-items-center">
                                        <img  src="{{ asset('images/main/kuwait-flag.jpg') }}" class="shadow-sm"
                                             alt="flag">
                                        <span>العربية</span>
                                    </a>
                                    @endif
                                    @if (app()->getLocale()== 'ar')
                                            <a style="cursor: pointer" onclick="changeLng('en')" class="dropdown-item d-flex align-items-center">
                                            <img  src="{{ asset('images/main/us-flag.jpg') }}" alt="image">
                                            <span>Eng</span>
                                            </a>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6 col-md-12" style="display:flex;justify-content: center">
                <ul class="header-top-menu">
                    @if(auth()->check())
                        <li>
                            <a href="{{ route('Main.profile',app()->getLocale()) }}"><i class='bx bxs-user'></i>
                               {{__('my_account_title')}}</a>
                        </li>
                        <li>
                            <form method="post" action="{{ route('logout',app()->getLocale()) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger"><span class='bx bx-log-out'></span> {{__('logout_title')}}
                                </button>
                            </form>

                        </li>
                    @else
                        <li><a href="{{ route('register',app()->getLocale()) }}"><i class='bx bx-log-in-circle'></i> {{__('sign_up_title')}}</a></li>
                        <li><a href="{{ route('login',app()->getLocale()) }}"><i class='bx bx-log-in'></i> {{__('login_title')}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
