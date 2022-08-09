@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.profile.searchOverlay')
    @include('site_old2.sections.profile.pageTitle')
    @include('site_old2.sections.profile.publicProfile')

    {{--    <show-user :user="{{json_encode($user)}}"--}}
    {{--                :credit="{{json_encode($credit)}}"--}}
    {{--               @if(\Illuminate\Support\Facades\Auth::check())--}}
    {{--               :archived_id="{{json_encode(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())}}"--}}
    {{--               :auth_user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"--}}
    {{--        @endif></show-user>--}}

@endsection
