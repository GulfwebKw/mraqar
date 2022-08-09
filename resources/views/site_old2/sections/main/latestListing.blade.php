<!-- Start Latest Listing Area -->
<section class="listing-area pb-70">
    <div class="container">

        <div class="container">
            <div class="section-title">
                <span class="sub-title">{{__('discover_title')}}</span>
                <h2>{{__('the_latest_ad_title')}}</h2>
            </div>
        </div>

        <div class="tab listing-list-tab">
            <ul class="tabs">
                <li><a href="#">{{__('residential_title')}}</a></li>
                <li><a href="#">{{__('industrial_title')}}</a></li>
                <li><a href="#">{{__('commercial_title')}}</a></li>
            </ul>

            <div class="tab-content">
                <div class="tabs-item">
                    <div class="row">
                        @foreach($residentials as $residential)
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="single-listing-item">
                                    <div class="listing-image">
                                        <a href="{{ route('site.ad.detail',[app()->getLocale(),$residential->hash_number]) }}"  class="d-block">
                                            <img src="{{ $residential->main_image }}" class="w-100 ad-image-responsive" alt="image">
                                        </a>
                                        <div class="listing-tag">
                                            <a href="#" class="d-block">{{__('residential_title')}}</a>
                                        </div>
                                    </div>

                                    <div class="listing-content">
                                        <div class="listing-author d-flex align-items-center">
                                            @if(@$residential->user->image_profile)
                                                <img src="{{ @$residential->user->image_profile }}"  class="rounded-circle mr-2" alt="image">
                                            @else
                                                <img src="{{ asset('/images/main/logo.png') }}" alt="image">
                                            @endif
                                            <span>{{ @$residential->user->name }}</span>
                                            @if( ($residential->user->verified) == 1)
                                                <i class='bx bxs-badge-check verify' style="color:#088dd3;font-size: 25px "></i>
                                            @endif
                                        </div>
                                        <h3><a href="{{ route('site.ad.detail',[app()->getLocale(),$residential->hash_number]) }}" class="d-inline-block ad-text-ellipsis">{{app()->getLocale()=='en'? $residential->title_en: $residential->title_ar}}</a></h3>

                                        <span class="location"><i class="bx bx-map"></i>{{app()->getLocale()=='en'? $residential->city->name_en . " - " . $residential->area->name_en:$residential->city->name_ar . " - " . $residential->area->name_ar }}</span>
                                    </div>

                                    <div class="listing-box-footer">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                @php
                                                    if ($residential->price < 100 ) $level = "Pricey" ;
                                                    elseif ($residential->price < 200) $level = "Moderate" ;
                                                    else $level = "Ultra High" ;
                                                @endphp
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $level }}">
                                                         {{ __('kd_title') }} {{ $residential->price }}
                                                    </span>
                                            </div>

                                            <div class="listing-option-list">
                                                <a target="_blank" href="{{route('site.advertising.direction',[app()->getLocale(),$residential->hash_number])}}" data-toggle="tooltip" data-placement="top" title="Find Directions"><i class='bx bx-directions'></i></a>
                                                <add-to-wishlist
                                                    :locale="{{json_encode(app()->getLocale())}}"
                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                    :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                    @if(in_array($residential->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                    :archived="true"
                                                    @endif
                                                    @endif
                                                    :advertising="{{json_encode($residential)}}"
                                                ></add-to-wishlist>
                                                <a  target="_blank" href="{{route('site.advertising.location',[app()->getLocale(),$residential->hash_number])}}" data-toggle="tooltip" data-placement="top" title="On the Map"><i class='bx bx-map'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="listing-badge">{{__('for_rent_title')}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tabs-item">
                    <div class="row">
                        @foreach($industrials as $industrial)
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="single-listing-item">

                                    <div class="listing-image">
                                        <a  href="{{ route('site.ad.detail',[app()->getLocale(),$industrial->hash_number]) }}" class="d-block">
                                            <img src="{{ $industrial->main_image }}" class="w-100 ad-image-responsive" alt="image">
                                        </a>

                                        <div class="listing-tag">
                                            <a href="#" class="d-block">{{__('industrial_title')}}</a>
                                        </div>
                                    </div>

                                    <div class="listing-content">
                                        <div class="listing-author d-flex align-items-center">
                                            <img src="{{ $industrial->user->image_profile }}" class="rounded-circle mr-2" alt="image">
                                            <span>{{ $industrial->user->name }}</span>
                                            @if( ($industrial->user->verified) == 1)
                                                <i class='bx bxs-badge-check verify' style="color:#088dd3;font-size: 25px "></i>
                                            @endif
                                        </div>
                                        <h3><a href="{{ route('site.ad.detail',[app()->getLocale(),$industrial->hash_number]) }}" class="d-inline-block ad-text-ellipsis">{{app()->getLocale()=='en'? $industrial->title_en:$industrial->title_ar }}</a></h3>

                                        <span class="location"><i class="bx bx-map"></i>{{ app()->getLocale()=='en'? $industrial->city->name_en . " - " . $industrial->area->name_en:$industrial->city->name_ar . " - " . $industrial->area->name_ar }}</span>
                                    </div>

                                    <div class="listing-box-footer">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                @php
                                                    if ($industrial->price < 100 ) $level = "Pricey" ;
                                                    elseif ($industrial->price < 200) $level = "Moderate" ;
                                                    else $level = "Ultra High" ;
                                                @endphp
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $level }}">
                                                         {{ __('kd_title') }} {{ $industrial->price }}
                                                    </span>
                                            </div>

                                            <div class="listing-option-list">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Find Directions"><i class='bx bx-directions'></i></a>
                                                <add-to-wishlist
                                                    :locale="{{json_encode(app()->getLocale())}}"
                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                    :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                    @if(in_array($industrial->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                    :archived="true"
                                                    @endif
                                                    @endif
                                                    :advertising="{{json_encode($industrial)}}"
                                                ></add-to-wishlist>
                                                <a href="{{route('site.advertising.location',[app()->getLocale(),$residential->hash_number])}}" data-toggle="tooltip" data-placement="top" title="On the Map"><i class='bx bx-map'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="listing-badge">{{__('for_rent_title')}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tabs-item">
                    <div class="row">
                        @foreach($commercials as $commercial)
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="single-listing-item">

                                    <div class="listing-image">

                                        <a  href="{{ route('site.ad.detail',[app()->getLocale(),$commercial->hash_number]) }}" class="d-block">
                                            <img class="w-100 ad-image-responsive" src="{{ $commercial->main_image }}" alt="image">
                                        </a>

                                        <div class="listing-tag">
                                            <a href="#" class="d-block">{{__('commercial_title')}}</a>
                                        </div>
                                    </div>

                                    <div class="listing-content">
                                        <div class="listing-author d-flex align-items-center">

                                            <img src="{{ $commercial->user->image_profile }}" class="rounded-circle mr-2" alt="image">
                                            <span>{{ $commercial->user->name }}</span>
                                            @if( ($commercial->user->verified) == 1)
                                                <i class='bx bxs-badge-check verify' style="color:#088dd3;font-size: 25px "></i>
                                            @endif
                                        </div>
                                        <h3><a href="{{ route('site.ad.detail',[app()->getLocale(),$commercial->hash_number]) }}" class="d-inline-block ad-text-ellipsis">{{ app()->getLocale()=='en'?$commercial->title_en :$commercial->title_ar}}</a></h3>

                                        <span class="location"><i class="bx bx-map"></i>{{app()->getLocale()=='en'? $commercial->city->name_en . " - " . $commercial->area->name_en:$commercial->city->name_ar . " - " . $commercial->area->name_ar }}</span>
                                    </div>

                                    <div class="listing-box-footer">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                @php
                                                    if ($commercial->price < 100 ) $level = "Pricey" ;
                                                    elseif ($commercial->price < 200) $level = "Moderate" ;
                                                    else $level = "Ultra High" ;
                                                @endphp
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $level }}">
                                                         {{ __('kd_title') }} {{ $commercial->price }}
                                                    </span>
                                            </div>

                                            <div class="listing-option-list">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Find Directions"><i class='bx bx-directions'></i></a>
                                                <add-to-wishlist
                                                    :locale="{{json_encode(app()->getLocale())}}"
                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                    :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                    @if(in_array($commercial->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                    :archived="true"
                                                    @endif
                                                    @endif
                                                    :advertising="{{json_encode($commercial)}}"
                                                ></add-to-wishlist>
                                                <a href="{{route('site.advertising.location',[app()->getLocale(),$commercial->hash_number])}}" data-toggle="tooltip" data-placement="top" title="On the Map"><i class='bx bx-map'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="listing-badge">{{__('for_rent_title')}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Latest Listing Area -->
