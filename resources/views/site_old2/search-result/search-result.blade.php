@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.main.mainBanner')
    <section class="listing-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">{{__('discover_title')}}</span>
                <h2></h2>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @foreach($advertisings as $advertising)

                    <div class="col-lg-4">
                        <div class="single-listing-box">
                            <a href="{{'/'. app()->getLocale().'/advertising/'.$advertising->hash_number.'/details' }}"
                               class="listing-image">
                                @if($advertising->main_image)
                                    <img src="{{ asset($advertising->main_image) }}" style="height: 330px!important;"
                                         alt="image">
                                @else
                                    <img src="{{ asset('resources/uploads/images/listing/img1.jpg') }}"
                                         style="height: 330px!important;" alt="image">
                                @endif
                            </a>

                            <div class="listing-badge"> {{__('for_rent_title')}}</div>

                            <div class="listing-content">
                                <div class="content">
                                    <div class="author">
                                        @if(@$advertising->user->image_profile)
                                            <img src="{{ @$advertising->user->image_profile }}" alt="image">
                                        @else
                                            <img src="{{ asset('/images/main/logo.png') }}" class="w-100" style=""
                                                 alt="image">
                                        @endif
                                        <span>{{ $advertising->user->name }}</span>
                                    </div>

                                    <h3>
                                        <a href="{{  '/'. app()->getLocale().'/advertising/'.$advertising->hash_number.'/details'}}"> {{app()->getLocale()=='en'? $advertising->title_en:$advertising->title_ar }} </a>
                                    </h3>
                                    <span class="location"><i class='bx bx-map'></i> {{app()->getLocale()=='en'? $advertising->city->name_en . " - " . $advertising->area->name_en:$advertising->city->name_ar . " - " . $advertising->area->name_ar }} </span>
                                </div>

                                <div class="footer-content">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="listing-option-list">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                               title="Find Directions"><i class='bx bx-directions'></i></a>
                                            <add-to-wishlist :locale="{{json_encode(app()->getLocale())}}"
                                                             @if(\Illuminate\Support\Facades\Auth::check())
                                                                 :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                                                             @if(in_array($advertising->id,(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())))
                                                                 :archived="true"
                                                             @endif@endif:advertising="{{json_encode($advertising)}}"

                                            ></add-to-wishlist>
                                            <a target="_blank"
                                               href="{{route('site.advertising.location',[app()->getLocale(),$advertising->hash_number])}}"
                                               data-toggle="tooltip" data-placement="top" title="On the Map"><i
                                                        class='bx bx-map'></i></a>
                                        </div>

                                        <div class="price-level">

                                            <span data-toggle="tooltip" data-placement="top" title="
                                                @if($advertising->price < 100)
                                                Pricey
                                                @elseif($advertising->price < 200)
                                                Moderate
                                                @else
                                                Ultra High
                                                @endif">
                                                <strong> {{ $advertising->price }}KD</strong>
                                            </span>
                                        </div>

                                        <div class="listing-category">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Category">
                                                <i class='bx bx-home'></i> {{ $advertising->type }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="row">
                <div class="col-12">
                    {{ $advertisings->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
