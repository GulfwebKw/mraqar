<!-- Start FAQ Area -->
<section class="faq-area ptb-100">
    <div class="container">

        <div class="tab faq-accordion-tab">
            <div class="profile" style="margin: 0 auto 50px auto;text-align: center;">
                @if(auth()->user()->image_profile)
                    <img src="{{ asset(auth()->user()->image_profile)}}" class="profile_pic"
                         style="width: 200px;height: 200px;border-radius: 100px;-moz-border-radius: 100px;-webkit-border-radius: 100px;border: solid 5px #088dd3;"
                         alt=""/>
                @else
                    <img src="{{ asset('/images/main/logo.png')}}" class="profile_pic"
                         style="width: 200px;height: 200px;border-radius: 100px;-moz-border-radius: 100px;-webkit-border-radius: 100px;border: solid 5px #088dd3;"
                         alt=""/>

                @endif
                <br>
                <div class="profile_text text-center mt-2">
                    {{__('full_name_title')}} : <strong>{{ auth()->user()->name }}</strong>
                    @if( (auth()->user()->verified) == 1)
                        <i class='bx bxs-badge-check verify' style="color:#088dd3;font-size: 25px "></i>
                    @endif
                    <br/>
                    {{__('packages')}} :
                    <strong>
                        <a href="{{url(app()->getLocale().'/paymenthistory')}}" class="text_blue" style="color:#088dd3; ">
                            @if($balance == 0) 0 {{__('ads_title')}}
                            @else
                                {{ $balance['available'] }} {{__('Regular_title')}} {{__('ads_title')}} + {{ $balance['available_premium'] }} {{__('premium_title')}}
                                {{__('ads_title')}} {{__('remaining_title')}}
                            @endif
                        </a>
                    </strong>
                    <br/>
                    {{__('status_title')}} :
                    @if( (auth()->user()->is_enable) == 1) <strong class="text_green"
                                                                   style="color: #00b232">{{__('active_title')}}</strong>
                    @else <strong class="text_red" style="color: red">{{__('not_active_title')}}</strong>
                    @endif
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col card shadow mx-1 mt-3 p-3" style="text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "profile") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.profile',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "profile") color: white; @endif" href="{{ route('Main.profile',app()->getLocale()) }}"><i class='bx bx-pencil'></i><br> <span>{{__('edit_profile_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "wishlist") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.wishList',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "wishlist") color: white; @endif"href="{{ route('Main.wishList',app()->getLocale()) }}"><i class='bx bx-heart'></i><br> <span>{{__('wish_list_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "paymenthistory") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.paymentHistory',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "paymenthistory") color: white; @endif"href="{{ route('Main.paymentHistory',app()->getLocale()) }}"><i class='bx bx-history'></i><br> <span>{{__('package_history_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "myads") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.myAds',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "myads") color: white; @endif"href="{{ route('Main.myAds',app()->getLocale()) }}"><i class='bx bx-pencil'></i><br> <span>{{__('my_ads_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "bookings") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.bookings',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "bookings") color: white; @endif"href="{{ route('Main.bookings',app()->getLocale()) }}"><i class='bx bx-book-content'></i><br> <span>{{__('booking_list_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "myadsbookings") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.myAdsBookings',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "myadsbookings") color: white; @endif"href="{{ route('Main.myAdsBookings',app()->getLocale()) }}"><i class='bx bx-book-content'></i><br> <span>{{__('booked_list_title')}}</span></a></div>
                    <div class='w-100 d-md-none'></div>
                    <div class="col card shadow mx-1 mt-3 p-3" style=" text-align:center; font-size: 14px; font-weight: bold; @if(collect(request()->segments())->last() == "buypackage") background-color: #088dd3; color: white; @endif"><a onclick="window.location.href='{{ route('Main.buyPackage',app()->getLocale()) }}'" style="cursor:pointer; @if(collect(request()->segments())->last() == "buypackage") color: white; @endif"href="{{ route('Main.buyPackage',app()->getLocale()) }}"><i class='bx bx-package'></i><br> <span>{{__('buy_package_title')}}</span></a></div>
                </div>
            </div>

            <br>
