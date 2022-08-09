<!-- Start About Area -->
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
<!-- End About Area -->
