<section class="faq-area ptb-100">
    <div class="container">

        <div class="tab faq-accordion-tab">
            <div class="profile" style="margin: 0 auto 50px auto;text-align: center;">
                <img src="{{ $user->image_profile }}" class="profile_pic"
                     style="width: 200px;height: 200px;border-radius: 100px;-moz-border-radius: 100px;-webkit-border-radius: 100px;border: solid 5px #088dd3;"
                     alt=""/>
                <br>
                <div class="profile_text">
                    {{ __('full_name_title') }} : <strong>{{ $user->name }}</strong>
                    @if($user->verified == 1)
                        <i class='bx bxs-badge-check verify' style="color:#088dd3;font-size: 25px "></i>
                    @endif
                    <br/>

                    Status :
                    @if($user->is_enable == 1)
                        <strong  class="text_green" style="color: #00b232">Active</strong>
                    @else
                        <strong  style="color: red">Deactive</strong>
                    @endif

                </div>
            </div>




            <div class="row">
                @foreach($advertises as $ad)
                    <div class="col-lg-4 col-sm-12 col-md-6 f_left">
                        <div class="single-listing-item">
                            <div class="listing-image">
                                <a href="{{ '/'.app()->getLocale().'/advertising/' . $ad->hash_number . '/details' }}" class="d-block">
                                    <img  src="{{ asset($ad->main_image) }}" class="w-100 ad-image-responsive" alt="image">
                                </a>


                                <div class="listing-tag">
                                    <a href="#" class="d-block">
                                        @if (app()->getLocale()=='ar')
                                            @if ($ad->type =='residential')
                                                {{__('residential_title')}}
                                            @elseif($ad->type =='industrial')
                                                {{__('industrial_title')}}
                                            @elseif($ad->type =='commercial')
                                                {{__('commercial_title')}}
                                            @endif
                                        @else
                                            {{ $ad->type }}
                                        @endif</a>
                                </div>
                            </div>

                            <div class="listing-content">
                                <div class="listing-author d-flex align-items-center">
                                    <img src="{{ asset($ad->user->image_profile) }}" class="rounded-circle mr-2" alt="image">
                                    <span>{{ $ad->user->name }}</span>
                                </div>


                                <h3><a href="{{'/'. app()->getLocale(). '/advertising/' . $ad->hash_number . '/details' }}"
                                       class="d-inline-block">{{ app()->getLocale()==='en'? $ad->title_en : $ad->title_ar}}</a></h3>

                                <span class="location"><i class="bx bx-map"></i>{{ app()->getLocale()==='en'?$ad->city->name_en . " - " . $ad->area->name_en:$ad->city->name_ar . " - " . $ad->area->name_ar }}</span>
                            </div>

                            <div class="listing-box-footer">
                                <div class="d-flex align-items-center justify-content-between">

                                </div>
                            </div>

                            <div class="listing-badge">
                                @if($ad->advertising_type == "premium") {{__('premium_title')}}
                                @elseif($ad->advertising_type == "normal") {{__('normal_title')}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach





        </div>
    </div>
</section>