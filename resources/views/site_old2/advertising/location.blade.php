@extends('site_old2.template')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg2">
        <div class="container ">
            <div class="page-title-content">
                <h2>{{__('advertising_title')}} {{app()->getLocale()=='en'?$advertising->title_en:$advertising->title_ar}} {{__('location_title')}}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start listing Details Area -->
    <section class="listing-details-area pt-100 pb-70 bg-f7fafd">
        <div class="container-fluid ">
            <div id="map" style="height: 600px"></div>
        </div>
    </section>
    <!-- End listing Details Area -->

@endsection
@section('scripts')

    <script>
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
