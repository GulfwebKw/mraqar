<!-- Start Latest Listing Area -->

<section class="listing-area ptb-100">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="listing-filter-options">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p>Showing {{ $premiums->firstItem() }} – {{ $premiums->lastItem() }}
                                of {{ $premiums->total() }}</p>
                        </div>

                        <div class="col-lg-4">
                            <div class="listing-ordering-list">

                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            style="width:100%;color:gray;text-align:right">
                                        {{__('sort_ads_title')}} : {{__('latest_ads')}}
                                    </button>
                                    <div class="dropdown-menu" style="width: 100%">
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/premiums/latest' }}">{{__('latest_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/premiums/highestprice' }}">{{__('high_price_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/premiums/lowestprice' }}">{{__('low_price_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/premiums/mostvisited' }}">{{__('most_visited_ads')}}</a>
                                        <a class="dropdown-item" href="{{ '/'.app()->getLocale().'/cat/premiums/mostliked' }}">{{__('most_liked_ads')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12  mt-5">
                <div class="row">

                    @foreach($premiums as $premium)

                        <div class="col-lg-4 col-sm-12 col-md-6">

                            <div class="single-listing-box">
                                <a href="{{ '/'.app()->getLocale().'/advertising/' . $premium->hash_number . '/details' }}" class="listing-image">
                                    <img src="{{ asset($premium->main_image) }}" alt="image" class="w-100 ad-image-responsive" >
                                </a>

                                <div class="listing-badge">{{__('for_rent_title')}}</div>

                                <div class="listing-content">
                                    <div class="content">
                                        <div class="author">
                                            <img src="{{ asset(@$premium->user->image_profile) }}" class="rounded-circle mr-2" alt="image">
                                            <span>{{ @$premium->user->name }}</span>
                                            @if( ($premium->user->verified) == 1)
                                                <i class='bx bxs-badge-check verify'></i>
                                            @endif
                                                <span>{{ @$premium->user->name }}</span>
                                        </div>

                                        <h3><a href="{{'/'.app()->getLocale(). '/advertising/' . $premium->hash_number . '/details' }}" class="d-inline-block ad-text-ellipsis"> {{app()->getLocale()=='en'? $premium->title_en: $premium->title_ar}} </a></h3>

                                        <span class="location"><i class='bx bx-map'></i> {{ app()->getLocale()=='en'?$premium->city->name_en . " - " . $premium->area->name_en:$premium->city->name_ar . " - " . $premium->area->name_ar }} </span>
                                    </div>

                                    <div class="footer-content">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="listing-option-list">
                                                <a target="_blank" href="{{route('site.advertising.direction',[app()->getLocale(),$premium->hash_number])}}" data-toggle="tooltip" data-placement="top"
                                                   title="Find Directions"><i class='bx bx-directions'></i></a>
                                                <add-to-wishlist
                                                    :locale="{{json_encode(app()->getLocale())}}"
                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                    :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                    @if(in_array($premium->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                    :archived="true"
                                                    @endif
                                                    @endif
                                                    :advertising="{{json_encode($premium)}}"
                                                ></add-to-wishlist>
                                                <a target="_blank" href="{{route('site.advertising.location',[app()->getLocale(),$premium->hash_number])}}"  data-toggle="tooltip" data-placement="top"
                                                   title="On the Map"><i class='bx bx-map'></i></a>
                                            </div>

                                            <div class="price-level">
                                                <span data-toggle="tooltip" data-placement="top" title="
                                                @if($premium->price < 100)
                                                    Pricey
                                                    @elseif($premium->price < 200)
                                                    Moderate
                                                    @else
                                                    Ultra High
                                                    @endif
                                                        ">

                                                <strong> {{ $premium->price }}{{__('kd_title')}}</strong>
                                            </span>
                                            </div>

                                            <div class="listing-category">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Category">
                                                    <i class='bx bx-home'></i>
                                                    @if($premium->type == "residential") {{ __('residential_title') }}
                                                    @elseif($premium->type == "industrial") {{ __('industrial_title') }}
                                                    @elseif($premium->type == "commercial") {{ __('commercial_title') }}
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
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pagination-area text-center" style="display:flex;justify-content: center">
                    {{ $premiums->links() }}
                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- End Latest Listing Area -->
