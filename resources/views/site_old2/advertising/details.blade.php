@extends('site_old2.template')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg2">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('listing_detail_title')}}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start listing Details Area -->
    <section class="listing-details-area pt-100 pb-70">
        <div class="container">
            <div class="listing-details-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="listing-title">
                            <h2>{{app()->getLocale()?$advertising->title_en:$advertising->title_ar}}</h2>
                            <p>{{$advertising->description}}</p>
                        </div>

                        <div class="listing-meta">
                            <ul>
                                <li>
                                    <i class='bx bx-user-check'></i>
                                    <span>{{$advertising->user->name}}</span>
                                    <a href="javascript:;">{{__('id')}}:#{{$advertising->id}}</a>
                                </li>
                                <li>
                                    <i class='bx bx-time'></i>
                                    <span>{{__('last_update_title')}}</span>
                                    <a href="javascript:;">{{\Carbon\Carbon::parse($advertising->updated_at)->ago()}}</a>
                                </li>
                                <li>
                                    <i class='bx bx-show-alt'></i>
                                    <span>{{__('views_title')}}</span>
                                    <a href="javascript:;">{{count($advertising->advertisingView)}}</a>
                                </li>
                                <li>
                                    <like :locale="{{json_encode(app()->getLocale())}}"
                                          @if(\Illuminate\Support\Facades\Auth::check())
                                              :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                          @if(in_array($advertising->id,(collect(\Illuminate\Support\Facades\Auth::user()->advertisingLikes)->pluck('id')->toArray())))
                                              :liked="true"
                                          @endif@endif:advertising="{{json_encode($advertising)}}"></like>

                                </li>

                                <add-to-wishlist :locale="{{json_encode(app()->getLocale())}}"
                                                 @if(\Illuminate\Support\Facades\Auth::check())
                                                     :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                 @if(in_array($advertising->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                     :archived="true" @endif@endif:lg_class="true"
                                                 :advertising="{{json_encode($advertising)}}"></add-to-wishlist>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="listing-price">

                            <div class="price">{{$advertising->price}}{{__('kd_title')}}</div>
                            <button id="show_phone" class="default-btn">{{__('call_now_title')}}</button>
                            <div id="phone_number" style="border:2px solid #17a2b8;
                                         color:#17a2b8;
                                         font-size: 20px;"
                                 class="d-none p-2 mt-2 text-center w-100">{{$advertising->phone_number?$advertising->phone_number:$advertising->user->mobile}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="listing-details-image-slides owl-carousel owl-theme">
                        <div class="listing-details-image text-center">
                            <img src="{{asset($advertising->main_image)}}" alt="image">
                        </div>
                        @foreach(collect(json_decode($advertising->other_image))->toArray() as $img)
                            @if($img!=="")
                                <div class="listing-details-image text-center">
                                    <img src="{{$img}}" alt="image">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="listing-details-desc">
                        <h3>{{__('description_title')}}</h3>
                        <p>{{$advertising->description}}</p>
                        <ul class="description-features-list">
                            @if($advertising->number_of_rooms)
                                <li>{{__('no_room')}} : {{$advertising->number_of_rooms}}</li>
                            @endif
                            @if($advertising->number_of_bathrooms)
                                <li>{{__('no_bathrooms')}} : {{$advertising->number_of_bathrooms}}</li>
                            @endif
                            @if($advertising->number_of_master_rooms)
                                <li>{{__('no_master_rooms')}}: {{$advertising->number_of_master_rooms}}</li>
                            @endif
                            @if($advertising->number_of_miad_rooms)
                                <li>{{__('no_maid_rooms')}} : {{$advertising->number_of_miad_rooms}} </li>
                            @endif
                            @if($advertising->number_of_floor)
                                <li>{{__('no_floor')}}
                                    : {{$advertising->number_of_floor ?$advertising->number_of_floor:' — '}}</li>
                            @endif
                            @if($advertising->number_of_parking)
                                <li>{{__('no_parking')}} : {{$advertising->number_of_parking}}</li>
                            @endif
                            @if($advertising->number_of_balcony)
                                <li>{{__('no_balcony')}} : {{$advertising->number_of_balcony}}</li>
                            @endif
                            @if($advertising->surface)
                                <li>{{__('surface')}} : {{$advertising->surface}}</li>
                            @endif
                            <li>{{__('gym_title')}} : {{$advertising->gym===1? __('yes_title') :__('no_title')}}</li>
                            <li>{{__('pool_title')}} : {{$advertising->pool===1? __('yes_title') :__('no_title')}}</li>
                            <li>{{__('furnished_title')}} : {{$advertising->furnished===1?  :__('no_title')}}</li>

                        </ul>
                        @if(count($advertising->amenities))

                            <h3>{{__('service_title')}}</h3>

                            <div class="amenities-list">
                                <ul>
                                    @foreach($advertising->amenities as $amenity)
                                        <li>
                                        <span>
                                            <i class='bx bx-check'></i>
                                            {{app()->getLocale()=='en'?$amenity->title_en:$amenity->title_ar}}
                                        </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($advertising->floor_plan)
                            <h3>{{__('floor_plan_title')}}</h3>

                            <!-- Map -->
                            <div class="map-area">
                                <img src="{{$advertising->floor_plan}}" alt="image">
                            </div>
                            <!-- End Map -->
                        @endif

                        <h3>{{__('location_title')}}</h3>

                        <!-- Map -->
                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-12">--}}
                        {{--                                <div class="map-area">--}}
                        <div id="map" style="height: 400px"></div>
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <!-- End Map -->

                        <h3>{{__('meet_ur_author_title')}}</h3>

                        <div class="listing-author">
                            <div class="author-profile-header"></div>
                            <div class="author-profile">
                                <div class="author-profile-title">
                                    <img src="{{$advertising->user->image_profile}}" class="shadow-sm rounded-circle"
                                         alt="image">

                                    <div class="author-profile-title-details d-flex justify-content-between">
                                        <div class="author-profile-details">
                                            <h4>{{$advertising->user->name}}</h4>
                                            {{--                                            <span class="d-block">Photographer, Author, Teacher</span>--}}
                                        </div>

                                        <div class="author-profile-raque-profile">
                                            <form action="{{route('site.show.user',app()->getLocale())}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="mobile"
                                                       value="{{$advertising->user->mobile}}">
                                                <button class="btn btn-air-primary">{{__('view_profile_title')}}</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{--                                <p>Abdul Rehman is a celebrated photographer, author, and teacher who brings passion to--}}
                                {{--                                    everything he does.</p>--}}
                                {{--                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem--}}
                                {{--                                    Ipsum has been the industry's standard dummy text ever since the 1500s.</p>--}}
                            </div>
                        </div>
                        <comment :locale="{{json_encode(app()->getLocale())}}"
                                 :advertising="{{json_encode($advertising)}}"
                                 @if(\Illuminate\Support\Facades\Auth::user())
                                     :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                @endif
                        ></comment>
                    </div>

                    <div class="related-listing">
                        <h3>{{__('related_listing_title')}}</h3>

                        <div class="row">
                            @foreach($relateds as $related)
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <div class="single-listing-item">
                                        <div class="listing-image">
                                            <a href="{{route('site.ad.detail',[app()->getLocale(),$related->hash_number])}}"
                                               class="d-block"><img src="{{$related->main_image}}" alt="image"
                                                                    class="w-100" style="height:250px"></a>

                                            <div class="listing-tag">
                                                <a href="#" class="d-block">    @if (app()->getLocale()=='ar')
                                                        @if ($related->type =='residential')
                                                            {{__('residential_title')}}
                                                        @elseif($related->type =='industrial')
                                                            {{__('industrial_title')}}
                                                        @elseif($related->type =='commercial')
                                                            {{__('commercial_title')}}
                                                        @endif
                                                    @else
                                                        {{ $related->type }}
                                                    @endif</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">
                                            <div class="listing-author d-flex align-items-center">
                                                <img src="{{asset($related->user->image_profile)}}"
                                                     class="rounded-circle mr-2" alt="image">
                                                <span>{{$related->user->name}}</span>
                                            </div>

                                            <h3>
                                                <a href="{{route('site.ad.detail',[app()->getLocale(),$related->hash_number])}}"
                                                   class="d-inline-block">{{app()->getLocale()==='en'?$related->title_en:$related->title_ar}}</a>
                                            </h3>

                                            <span class="location"><i class="bx bx-map"></i> </span>
                                        </div>

                                        <div class="listing-box-footer">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="price">
                                                    <span data-toggle="tooltip" data-placement="top" title="Pricey">
                                                        {{$related->price}}{{__('kd_title')}}
                                                    </span>
                                                </div>

                                                <div class="listing-option-list">
                                                    <a target="_blank"
                                                       href="{{route('site.advertising.direction',[app()->getLocale(),$related->hash_number])}}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Find Directions"><i class='bx bx-directions'></i></a>
                                                    <add-to-wishlist :locale="{{json_encode(app()->getLocale())}}"
                                                                     @if(\Illuminate\Support\Facades\Auth::check())
                                                                         :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                                     @if(in_array($related->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                                         :archived="true"
                                                                     @endif@endif:advertising="{{json_encode($related)}}"></add-to-wishlist>
                                                    <a target="_blank"
                                                       href="{{route('site.advertising.location',[app()->getLocale(),$related->hash_number])}}"
                                                       data-toggle="tooltip" data-placement="top" title="On the Map"><i
                                                                class='bx bx-map'></i></a>
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

                <div class="col-lg-4 col-md-12">
                    <div class="listing-sidebar-widget">

                        <div class="listing-contact-info">
                            <h3>{{__('contact_info_title')}}</h3>

                            <ul>
                                <li><span>{{__('address_title')}}:</span> <a
                                            href="#">{{app()->getLocale()=='en'?$advertising->city->name_en . '-'.$advertising->area->name_en:$advertising->city->name_ar . '-'.$advertising->area->name_ar}}</a>
                                </li>
                                <li><span>{{__('phone_number_title')}}:</span> <a
                                            href="tel:+965 960123456">{{$advertising->phone_number?$advertising->phone_number:$advertising->user->mobile}}</a>
                                </li>
                                <li><span>Email:</span> <a
                                            href="mailto:info@ajrnii.com">{{$advertising->user->email}}</a></li>
                                {{--                                <li><span>Website:</span> <a href="#">http://www.ajrnii.com</a></li>--}}
                                {{--                                <li><a href="#">+ Google Map</a></li>--}}
                            </ul>
                        </div>
                        <div class="listing-book-table">
                            <h3>{{__('book_appointment_title')}}</h3>
                            <booking :locale="{{json_encode(app()->getLocale())}}"
                                     :advertisin="{{json_encode($advertising)}}"
                                     :user="{{json_encode(auth()->user())}}"></booking>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End listing Details Area -->

@endsection
@section('scripts')

    <script>
        $('#show_phone').on('click', function () {
            $('#phone_number').removeClass('d-none').addClass('d-inline-block');

        });

        $(document).ready(function () {
            let map;
            var myLatlng = {lat: 29.368570, lng: 47.972832};
            @if($advertising->location_lat && $advertising->location_long)
                myLatlng = {
                lat: parseFloat({{$advertising->location_lat}}),
                lng: parseFloat({{$advertising->location_long}})
            };
            @endif
                map = new google.maps.Map(document.getElementById("map"), {
                center: myLatlng,
                zoom: 12,
            });
            const marker = new google.maps.Marker({
                position: myLatlng,
                map,
                title: "Click to zoom",
            });

        })
    </script>

@endsection
