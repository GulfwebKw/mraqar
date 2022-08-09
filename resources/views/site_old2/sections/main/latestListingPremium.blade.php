<!-- Start Latest Listing Area -->
<section class="listing-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">{{__('discover_title')}}</span>
            <h2>{{__('the_premium_ad_title')}}</h2>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach($premiumAds as $premiumAd)

                <div class="col-lg-4">
                    <div class="single-listing-box">
                        <a href="{{ route('site.ad.detail',[app()->getLocale(),$premiumAd->hash_number]) }}" class="listing-image">
                            <img src="{{ $premiumAd->main_image }}" alt="image" class="w-100 ad-image-responsive">
                        </a>

                        <div class="listing-badge">{{__('for_rent_title')}}</div>

                        <div class="listing-content">
                            <div class="content">
                                <div class="author">
                                    @if(@$premiumAd->user->image_profile)
                                    <img src="{{ @$premiumAd->user->image_profile }}" class="rounded-circle mr-2" alt="image">
                                    @else
                                        <img src="{{ asset('/images/main/logo.png') }}" alt="image">
                                    @endif
                                    <span>{{ @$premiumAd->user->name }}</span>
                                    @if( ($premiumAd->user->verified) == 1)
                                        <i class='bx bxs-badge-check verify'></i>
                                    @endif
                                </div>

                                <h3><a href="{{ route('site.ad.detail',[app()->getLocale(),$premiumAd->hash_number]) }}" class="d-inline-block ad-text-ellipsis"> {{app()->getLocale()=='en'? $premiumAd->title_en :$premiumAd->title_ar}} </a></h3>

                                <span class="location"><i class='bx bx-map'></i> {{ app()->getLocale()=='en'? $premiumAd->city->name_en . " - " . $premiumAd->area->name_en :$premiumAd->city->name_ar . " - " . $premiumAd->area->name_ar }} </span>
                            </div>

                            <div class="footer-content">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="listing-option-list">
                                        <a target="_blank" href="{{route('site.advertising.direction',[app()->getLocale(),$premiumAd->hash_number])}}" data-toggle="tooltip" data-placement="top" title="Find Directions"><i class='bx bx-directions'></i></a>
                                        <add-to-wishlist
                                            :locale="{{json_encode(app()->getLocale())}}"
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                            :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                            @if(in_array($premiumAd->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                            :archived="true"
                                            @endif
                                            @endif
                                            :advertising="{{json_encode($premiumAd)}}"
                                        ></add-to-wishlist>
                                        <a target="_blank" href="{{route('site.advertising.location',[app()->getLocale(),$premiumAd->hash_number])}}" data-toggle="tooltip" data-placement="top" title="On the Map"><i class='bx bx-map'></i></a>
                                    </div>

                                    <div class="price-level">
                                        @php
                                            if ($premiumAd->price < 100 ) $level = "Pricey" ;
                                            elseif ($premiumAd->price < 200) $level = "Moderate" ;
                                            else $level = "Ultra High" ;
                                        @endphp
                                        <span data-toggle="tooltip" data-placement="top" title="{{ $level }}">
                                            <strong>{{ __('kd_title') }} {{ $premiumAd->price }}</strong>
                                        </span>
                                    </div>

                                    <div class="listing-category">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Category">
                                            <i class='bx bx-home'></i>
                                            @if($premiumAd->type == "residential") {{ __('residential_title') }}
                                            @elseif($premiumAd->type == "industrial") {{ __('industrial_title') }}
                                            @elseif($premiumAd->type == "commercial") {{ __('commercial_title') }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

</section>
<!-- End Latest Listing Area -->
