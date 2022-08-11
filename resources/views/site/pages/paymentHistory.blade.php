@extends('site.layout.panel')

@php
    $float = app()->getLocale()=="en"?"right":"left";
@endphp

@section('panel-content')

<table class="mdc-data-table__table" aria-label="Dessert calories">
    <thead>
        <tr class="mdc-data-table__header-row">
            <th class="mdc-data-table__header-cell">{{__('row_title')}}</th>
            <th class="mdc-data-table__header-cell">{{__('package_title')}}</th>
            <th class="mdc-data-table__header-cell">{{__('price_title')}}({{__('kd_title')}})</th>
            <th class="mdc-data-table__header-cell">{{__('date_title')}}</th>
            <th class="mdc-data-table__header-cell">{{__('details')}}</th>
            <th class="mdc-data-table__header-cell">{{__('status')}}</th>
        </tr>
    </thead>
    <tbody class="mdc-data-table__content">
        @foreach($payments as $payment)
            <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell">{{($loop->index)+1}}</td>
                <td class="mdc-data-table__cell">{{ app()->getLocale()==='en'?$payment->title_en:$payment->title_ar }}</td>
                <td class="mdc-data-table__cell">{{!empty($payment->price)?number_format($payment->price,3):'0.000'}}</td>
                <td class="mdc-data-table__cell">{{ $payment->date }}</td>
                <td class="mdc-data-table__cell" style="min-width: 240px;">
                    <div>{{__('remain_regular_ads')}}:<a href="javascript:;" style="float: {{ $float }}; text-decoration: none; color: var(--theme-base-color);">{{($payment->is_payed == 1)?($payment->count_advertising - $payment->count_usage):0}}</a></div>
                    <div>{{__('remain_premium_ads')}}:<a href="javascript:;" style="float: {{ $float }}; text-decoration: none; color: var(--theme-base-color);">{{($payment->is_payed == 1)?($payment->count_premium - $payment->count_usage_premium):0}}</a></div>
                </td>
                <td class="mdc-data-table__cell">
                    <a href="{{url(app()->getLocale().'/paymentdetails/'.$payment->payment_id)}}" class="mdc-button mdc-ripple-surface mdc-ripple-surface--primary normal">
                        @if($payment->package_id == 18){{__('free')}}@endif
                        @if($payment->is_payed==1)
                            @if($payment->package_id != 18){{__('details')}}(<span class="text-success">{{__('paid_title')}}</span>)@endif
                        @else
                            @if($payment->package_id != 18){{__('details')}}(<span class="text-danger">{{__('not_paid_title')}}</span>)@endif
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
