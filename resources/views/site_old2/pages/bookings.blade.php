@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.profile.searchOverlay')
    @include('site_old2.sections.profile.pageTitle')
    @include('site_old2.sections.profile.profileHeader')
    @include('site_old2.sections.profile.bookings')
    @include('site_old2.sections.profile.profileFooter')

@endsection
