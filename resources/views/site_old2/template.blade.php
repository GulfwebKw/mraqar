<!doctype html>
<html lang="en">
<head>

    @include('site_old2.layouts.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDitaBI4yXvMp3nUetN0KBjHkB_9eFJD9Q"></script>
</head>
<body>
    <div id="app">
        @include('site_old2.layouts.header')
        @yield('content')
        @include('site_old2.layouts.footer')

    </div>
    @include('site_old2.layouts.js')
    <script src="{{ asset('js/app.js?v=5') }}"></script>
    @yield('scripts')
    <script>
        $('#search').on('click', function () {
            window.location.href = '/{{app()->getLocale()}}' + '/search?keyword=' + $('#keyword').val() + '&&area=' + $('#area').val() + '&&venue_type=' + $('#venueType').val() + '&&purpose=' + $('#purpose').val() + '&&type=' + $('#type').val()
        })

        function changeLng(locale) {
            console.log(locale)
            var url = window.location.href;
            if (locale === 'ar') {
                url = url.replace('en', 'ar')
            }
            if (locale === 'en') {
                url = url.replace('ar', 'en')
            }
            console.log(url)
            window.location.href = url

        }

    </script>

</body>
</html>
