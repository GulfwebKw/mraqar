@extends('site_old2.template')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg2">
        <div class="container ">
            <div class="page-title-content">
                <h2>{{__('edit_title')}} {{__('advertising_title')}}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start listing Details Area -->
    <section class="listing-details-area pt-100 pb-70 bg-f7fafd">
        <div class="container ">
            <edit :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                  :advertising="{{json_encode($advertising)}}"
                  :other_image="{{json_encode(collect(json_decode($advertising->other_image))->toArray())}}"
                  :locale="{{json_encode(app()->getLocale())}}"></edit>
        </div>
    </section>
    <!-- End listing Details Area -->

@endsection
@section('scripts')

@endsection
