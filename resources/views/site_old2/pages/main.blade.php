@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.main.mainBanner')
    @include('site_old2.sections.main.latestListingPremium')
    @include('site_old2.sections.main.latestListing')
    @include('site_old2.sections.main.appDownload')

@endsection
