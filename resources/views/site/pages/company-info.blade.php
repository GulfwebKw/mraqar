@extends('site.layout.master')
@section('title' , __('companies'))
@php
    $side = app()->getLocale() === 'en' ? 'r' : 'l';
@endphp

@section('content')

    <main class="content-offset-to-top">
        <div class="theme-container">
            @dd($company->company_name)
        </div>
    </main>

@endsection
