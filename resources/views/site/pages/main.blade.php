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

                <div class="" id="pageEnd">Loading</div>

            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
