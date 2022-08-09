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
            var directionService = new google.maps.DirectionsService;
            var directionsRenderer = new google.maps.DirectionsRenderer;
            let map;
            var myLatlng = {lat: 29.368570, lng: 47.972832};
            // var endLat = '29.368570'
            // var endLong = '47.972832';
            var startLat = '29.368570'
            var startLong = ' 47.972832'
            if (navigator.geolocation) {
                console.log('start')
                navigator.geolocation.watchPosition(startPosition)
            } else {
                console.log('not')
            }
            @if(!is_null($advertising->location_lat) && !is_null($advertising->location_long))
            var endLat = {{$advertising->location_lat}};
            var endLong = {{$advertising->location_long}};
            // console.log('hi')
            myLatlng = {
                lat: parseFloat({{$advertising->location_lat}}),
                lng: parseFloat({{$advertising->location_long}})
            };
            @endif
                map = new google.maps.Map(document.getElementById("map"), {
                center: myLatlng,
                zoom: 12,
            });
            directionsRenderer.setMap(map);
            // function calcRoute() {
            // console.log(startLat)
            // console.log(startLong)
            function startPosition(position) {
                // console.log('hi')
                console.log(position.coords.latitude)
                console.log(position.coords.longitude)
                startLat = position.coords.latitude
                startLong = position.coords.longitude
                var start = new google.maps.LatLng(startLat, startLong);
                var end = new google.maps.LatLng(endLat, endLong);
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING'
                };
                directionService.route(request, function (result, status) {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(result);
                    }
                });
            }

            // }
            const marker = new google.maps.Marker({
                position: myLatlng,
                map,
                title: "Click to zoom",
            });

        })
    </script>

@endsection
