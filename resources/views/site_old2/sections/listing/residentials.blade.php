<!-- Start Latest Listing Area -->
<section class="listing-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="listing-filter-options">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p>Showing {{ $residentials->firstItem() }} – {{ $residentials->lastItem() }} of {{ $residentials->total() }}</p>
                        </div>

                        <div class="col-lg-4">
                            <div class="listing-ordering-list">

                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            style="width:100%;color:gray;text-align:right">
                                        {{__('sort_ads_title')}} : {{__('latest_ads')}}
                                    </button>
                                    <div class="dropdown-menu" style="width: 100%">
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/residentials/latest' }}">{{__('latest_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/residentials/highestprice' }}">{{__('high_price_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/residentials/lowestprice' }}">{{__('low_price_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/residentials/mostvisited' }}">{{__('most_visited_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/residentials/mostliked' }}">{{__('most_liked_ads')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @foreach($residentials as $residential)
                <div class="col-lg-4 col-sm-12 col-md-6">
                    <div class="single-listing-item">
                        <div class="listing-image">

                            <a href="{{'/'.app()->getLocale(). '/advertising/' . $residential->hash_number . '/details' }}" class="d-block">
                                <img src="{{ asset($residential->main_image) }}" class="w-100 ad-image-responsive" alt="image">
                            </a>

                            <div class="listing-tag">
                                <a href="#" class="d-block"> {{ __('residential_title') }} </a>
                            </div>
                        </div>

                        <div class="listing-content">
                            <div class="listing-author d-flex align-items-center">
                                    <img src="{{ asset(@$residential->user->image_profile) }}" class="rounded-circle mr-2" alt="image">
                                    <span>{{ @$residential->user->name }}</span>
                                    @if( ($residential->user->verified) == 1)
                                        <i class='bx bxs-badge-check verify'></i>
                                    @endif
                            </div>

                            <h3><a href="{{ '/'.app()->getLocale().'/advertising/' . $residential->hash_number . '/details' }}" class="d-inline-block ad-text-ellipsis">{{ app()->getLocale()=='en'? $residential->title_en:$residential->title_ar }}</a></h3>

                            <span class="location"><i class="bx bx-map"></i>{{ app()->getLocale()=='en'?$residential->city->name_en . " - " . $residential->area->name_en:$residential->city->name_ar . " - " . $residential->area->name_ar }}</span>
                        </div>

                        <div class="listing-box-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="price">
                                    <span data-toggle="tooltip" data-placement="top" title="
                                        @if($residential->price < 100) Pricey
                                        @elseif($residential->price < 200) Moderate
                                        @else Ultra High
                                        @endif
                                            ">

                                   {{ $residential->price }}{{__('kd_title')}}
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
                                    <a target="_blank" href="{{route('site.advertising.location',[app()->getLocale(),$residential->hash_number])}}" data-toggle="tooltip" data-placement="top" title="On the Map"><i class='bx bx-map'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="listing-badge">{{__('for_rent_title')}}</div>
                    </div>
                </div>
            @endforeach

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pagination-area text-center" style="display:flex;justify-content: center">
                    {{ $residentials->links() }}
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Latest Listing Area -->
