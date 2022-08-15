<script src="{{ asset('asset/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/material-components-web.min.js') }}"></script>
<script src="{{ asset('asset/js/libs/swiper.min.js') }}"></script>
<script src="{{ asset('asset/js/scripts.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1rF9bttCxRmsNdZYjW7FzIoyrul5jb-s&callback=initMap" async defer></script>

<script>
    $('#search').on('click',function () {
        window.location.href='/{{ app()->getLocale() }}/search?keyword='+$('#keyword').val()+'&&area='+$('#area').val()+'&&venue_type='+$('#venueType').val()+'&&type='+$('#type').val()
    })
    function changeLng(locale) {
        console.log(locale)
        var url=window.location.href;
        if(locale==='ar'){
            url=url.replace('en','ar')
        }
        if(locale==='en'){
            url=url.replace('ar','en')
        }
        console.log(url)
        window.location.href=url

    }

</script>

@yield('js')
@yield('scripts')
