{{-- can use: @extends('site.layout.master', ['header' => 'transparent']) for transparent(bg-image) header pages --}}
@include('site.layout.header')

@yield('content')

@include('site.layout.footer')
