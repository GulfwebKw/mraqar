@extends('site.layout.master')

@isset($company)
    @section('title', $company->company_name . ' | ' . $company->company_phone)
@endisset
@isset($required_for_rent)
    @section('title', __('required_for_rent_page_title'))
@endisset

@php
$side = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp
@section('content')

    <main>
        @isset($company)
            @include('site.sections.company-info')
        @endisset
        <div class="px-3">
            <div class="theme-container" id="app" @isset($company) data-company="{{$company->id}}" @endisset data-requiredPage="{{ isset($required_for_rent) ? '1' : '0' }}"  data-locale="{{app()->getLocale()}}">

                @isset($company)
                        <h2>{{__('company_ads')}}</h2>
                @endisset

                <div class="mt-5"></div>

                @if(! isset($company))
                    @include('site.sections.search')
                @endif

                @include('site.sections.card')

                <div class="center-xs" id="pageEnd">
                    <img v-if="isLoading !== false" src="{{asset('images/main/loading.gif')}}" alt="loading" style="width: 180px;">
{{--                    <h3 v-else-if="noMore" class="mt-2">{{__('no_more_ads')}}</h3>--}}
                    <h3 v-else-if="notFound" class="alert alert-danger text-center mt-2"><strong>{{__('norecord')}}</strong></h3>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
