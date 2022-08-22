@extends('site.layout.master')
@section('title' , __('companies'))
@php
    $side = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp

@section('content')

    <main class="content-offset-to-top">
{{--            @dd($company->company_name)--}}

            <div class="section" style="background: var(--mdc-theme-primary)">
                <div class="px-3">
                    <div class="theme-container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-4 col-xl-4 p-0">
                                <img src="assets/images/others/mission.jpg" alt="mission" class="mw-100 d-block">
                            </div>
                            <div class="col-xs-12 col-lg-8 col-xl-8 p-3">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-2">
                                        <i class="material-icons mat-icon-xlg primary-color">monetization_on</i>
                                        <h2 class="capitalize fw-600 mb-2">save money</h2>
                                        <p class="text-muted fw-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae dolor magnam, facilis voluptas quia excepturi provident cupiditate.</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-2">
                                        <i class="material-icons mat-icon-xlg primary-color">thumb_up</i>
                                        <h2 class="capitalize fw-600 mb-2">better ideas</h2>
                                        <p class="text-muted fw-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae dolor magnam, facilis voluptas quia excepturi provident cupiditate.</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-2">
                                        <i class="material-icons mat-icon-xlg primary-color">group</i>
                                        <h2 class="capitalize fw-600 mb-2">collaboration</h2>
                                        <p class="text-muted fw-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae dolor magnam, facilis voluptas quia excepturi provident cupiditate.</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-2">
                                        <i class="material-icons mat-icon-xlg primary-color">search</i>
                                        <h2 class="capitalize fw-600 mb-2">easy to find</h2>
                                        <p class="text-muted fw-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae dolor magnam, facilis voluptas quia excepturi provident cupiditate.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>

@endsection
