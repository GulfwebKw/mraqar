@extends('site.layout.master', ['header' => 'transparent'])

@section('content')
    {{--
    &lt;!&ndash; Start Page Title Area &ndash;&gt;
    <div class="page-title-area page-title-bg3">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('about_us_title') }}</h2>
            </div>
        </div>
    </div>
    &lt;!&ndash; End Page Title Area &ndash;&gt;

    &lt;!&ndash; Start About Area &ndash;&gt;
    <section class="about-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-content">
                        <span class="sub-title">{{__('aboutus')}}</span>
                        @if(app()->getLocale()=="en"){!!!empty($aboutus_large_en)?$aboutus_large_en:''!!}@else{!!!empty($aboutus_large_ar)?$aboutus_large_ar:''!!}@endif
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        @if($aboutus_large_pic1){!!$aboutus_large_pic1!!}@endif
                        @if($aboutus_large_pic2){!!$aboutus_large_pic2!!}@endif
                    </div>
                </div>
            </div>

            <div class="about-inner-area">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="about-text">
                            <h3>{{__('ourstory')}}</h3>
                            @if(app()->getLocale()=="en"){!!!empty($our_story_en)?$our_story_en:''!!}@else{!!!empty($our_story_ar)?$our_story_ar:''!!}@endif
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="about-text">
                            <h3>{{__('ourvalues')}}</h3>
                            @if(app()->getLocale()=="en"){!!!empty($our_value_en)?$our_value_en:''!!}@else{!!!empty($our_value_ar)?$our_value_ar:''!!}@endif
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                        <div class="about-text">
                            <h3>{{__('ourpromise')}}</h3>
                            @if(app()->getLocale()=="en"){!!!empty($our_promise_en)?$our_promise_en:''!!}@else{!!!empty($our_promise_ar)?$our_promise_ar:''!!}@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    &lt;!&ndash; End About Area &ndash;&gt;
    @endsection
    --}}








    <main class="content-offset-to-top">
        <div class="header-image-wrapper">
            <div class="bg" style="background-image: url('{{ url('') }}/asset/images/others/about.jpg');"></div>
            <div class="mask"></div>
            <div class="header-image-content offset-bottom">
                <h1 class="title">{{ __('about_us_title') }}</h1>
    {{--            <p class="desc">We help you for find your house key</p>--}}
        </div>
    </div>
    <div class="section default">
        <div class="px-3">
            <div class="theme-container">
                <h1 class="section-title">ABOUTUS</h1>
                <div class="mdc-card p-0 row o-hidden">
                    <div class="col-xs-12 col-lg-6 col-xl-6 p-3">
                        <div class="row">
                            @if(app()->getLocale()=="en"){!!!empty($aboutus_large_en)?$aboutus_large_en:''!!}@else{!!!empty($aboutus_large_ar)?$aboutus_large_ar:''!!}@endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-6 col-xl-6 p-0 d-none d-lg-flex d-xl-flex">
{{--                        <img src="" alt="mission" class="mw-100 d-block">--}}
                        @if($aboutus_large_pic1){!!$aboutus_large_pic1!!}@endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="section mt-3">
        <div class="px-3">
            <div class="theme-container">
                <h1 class="section-title">Our Services</h1>
                <div class="services-wrapper row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
                        <div class="mdc-card h-100 w-100 text-center middle-xs p-3">
                            <i class="material-icons mat-icon-xlg primary-color">supervisor_account</i>
                            <h2 class="capitalize fw-600 my-3">ourstory</h2>
                            <p class="text-muted fw-500">When you make it easy to do business, your business grows.</p>
                            <div class="row text-left">
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Verify your listing</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Love listing again</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Online listing.</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Listing for all seasons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
                        <div class="mdc-card h-100 w-100 text-center middle-xs p-3">
                            <i class="material-icons mat-icon-xlg primary-color">format_list_bulleted</i>
                            <h2 class="capitalize fw-600 my-3">ourvalues</h2>
                            <p class="text-muted fw-500">When you make it easy to do business, your business grows.</p>
                            <div class="row text-left">
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Verify your listing</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Love listing again</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Online listing.</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Listing for all seasons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
                        <div class="mdc-card h-100 w-100 text-center middle-xs p-3">
                            <i class="material-icons mat-icon-xlg primary-color">location_on</i>
                            <h2 class="capitalize fw-600 my-3">ourpromise</h2>
                            <p class="text-muted fw-500">When you make it easy to do business, your business grows.</p>
                            <div class="row text-left">
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Verify your listing</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Love listing again</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Online listing.</span>
                                </div>
                                <div class="col-xs-12">
                                    <i class="material-icons mat-icon-sm primary-color">check</i>
                                    <span class="mx-2">Listing for all seasons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
