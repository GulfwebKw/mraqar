<!-- Start Navbar Area -->
<div class="navbar-area">

    <div class="braike-responsive-nav">
        <div class="container">
            <div class="braike-responsive-menu">

                <div class="row">
                    <div class="col-12">
                        <div style="display: block!important;" class="others-option">
                            <div class="text-right align-items-center">
                                <div class="option-item">
                                    <a href="{{ route('site.advertising.create',app()->getLocale()) }}" class="default-btn"><i class="bx bx-plus"></i> {{__('add_listing_title')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mini-bar" class="col-12">
                        <div class="logo" style="position: unset">
                            <a href="{{'/'.app()->getLocale(). '/' }}">
                                <img style="margin-top: -45px;" src="{{ asset('images/main/logo.png') }}" alt="logo">
                            </a>
                        </div>

                    </div>



                </div>



            </div>
        </div>
    </div>

    <div class="braike-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{'/'.app()->getLocale(). '/' }}">
                    <img src="{{ asset('images/main/logo.png') }}" alt="logo">
                </a>

                <div class="collapse navbar-collapse mean-menu header-right-section" >

                    <ul class="navbar-nav" style="">
                        <li class="nav-item"><a href="{{'/'.app()->getLocale(). '/' }}" class="nav-link active">{{__('home_title')}}</a></li>

                        <li class="nav-item"><a href="#" class="nav-link">{{__('categories_title')}} <i class='bx bx-chevron-down'></i></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="{{ route('Advertising.residentials',app()->getLocale()) }}" class="nav-link">{{__('residential_property')}}</a></li>
                                <li class="nav-item"><a href="{{ route('Advertising.industrials',app()->getLocale()) }}" class="nav-link">{{__('industrial_property')}}</a></li>
                                <li class="nav-item"><a href="{{ route('Advertising.commercials',app()->getLocale()) }}" class="nav-link">{{__('commercial_property')}}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="{{ route('Advertising.premiums',app()->getLocale()) }}" class="nav-link">{{__('premium_ad_title')}}</a></li>

                        <li class="nav-item"><a href="#" class="nav-link">{{__('services_title')}} <i class='bx bx-chevron-down'></i></a>
                            <ul class="dropdown-menu">
                                @php
                                    $services = \App\Models\Service::all();
                                @endphp
                                @foreach($services as $service)
                                    <li class="nav-item"><a href="{{ url(app()->getLocale() . "/services/show/" . $service->id) }}" class="nav-link">{{$service->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item"><a href="{{ '/'.app()->getLocale().'/aboutus' }}" class="nav-link">{{__('about_us_title')}}</a></li>
                        <li class="nav-item"><a href="{{ '/'.app()->getLocale().'/contact' }}" class="nav-link">{{__('contact_title')}}</a></li>
                    </ul>

                    <div class="others-option">
                        <div class="d-flex align-items-center">
                            <div class="option-item">
                                <a href="{{ route('site.advertising.create',app()->getLocale()) }}" class="default-btn"><i class="bx bx-plus"></i> {{__('add_listing_title')}}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
