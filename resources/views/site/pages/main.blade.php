@extends('site.layout.master')
@php
$side = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp
@section('content')

    <main>
        <div class="px-3">
            <div class="theme-container" id="app" data-company="0" data-requiredPage="{{ isset($required_for_rent) ? '1' : '0' }}"  data-locale="{{app()->getLocale()}}">

                <div class="mt-5"></div>


                @include('site.sections.search')

                @include('site.sections.card')

                <div class="center-xs" id="pageEnd">
                    <img v-if="isLoading !== false" src="{{asset('images/main/loading.gif')}}" alt="loading" style="width: 180px;">
                    <h3 v-else-if="noMore" class="mt-2">{{__('no_more_ads')}}</h3>
                    <h3 v-else-if="notFound" class="mt-2">{{__('no_ad_found')}}</h3>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
