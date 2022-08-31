@extends('site.layout.master')

@isset($company)
    @section('title', $company->company_name . ' | ' . $company->company_phone)
@endisset
@isset($required_for_rent)
    @section('title', __('required_for_rent_page_title'))
@endisset

@php
$side = app()->getLocale() === 'en' ? 'r' : 'l';
$unSide = app()->getLocale() === 'en' ? 'l' : 'r';
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
                    <img v-if="isLoading !== false" src="{{asset('images/main/loading.gif')}}" alt="loading" style="width: 10vw;">
{{--                    <h3 v-else-if="noMore" class="mt-2">{{__('no_more_ads')}}</h3>--}}
                    <h3 v-else-if="notFound" class="alert alert-danger text-center mt-2"><strong>{{__('norecord')}}</strong></h3>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        @if(app()->getLocale() === 'en')

        .image-box::before {
            content: "";
            position: absolute;
            left: -11px;
            top: 1rem;
            border-top: 11px solid transparent;
            border-bottom: 11px solid transparent;
            border-right: 11px solid var(--badge);
            font-size: .875rem;
        }
        .image-box::after {
            content: "{{__('premium_short')}}";
            position: absolute;
            left: -11px;
            top: 0;
            background: var(--badge);
            border-radius: 2px 2px 0 2px;
            padding: .2rem .8rem;
            color: #fff;
            font-size: .875rem;
        }

        @else

        .image-box::before {
            content: "";
            position: absolute;
            right: -11px;
            top: 1rem;
            border-top: 11px solid transparent;
            border-bottom: 11px solid transparent;
            border-left: 11px solid var(--badge);
            font-size: .875rem;
        }
        .image-box::after {
            content: "مميز";
            position: absolute;
            right: -11px;
            top: 0;
            background: var(--badge);
            border-radius: 2px 2px 0 2px;
            padding: .2rem .8rem;
            color: #fff;
            font-size: .875rem;
        }

        @endif
    </style>

@endsection
