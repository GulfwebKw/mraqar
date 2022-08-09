<div id="result" ></div>
@php
$dir = app()->getLocale()=="en"?"ltr":"rtl";
$align = app()->getLocale()=="en"?"left":"right";
$aligno = app()->getLocale()=="en"?"right":"left";
@endphp
@if((session('status')) == 'package_bought')
    <div class="alert alert-success">
        <strong>Success!</strong> Your package was submitted succesfully !
    </div>
@endif


<table class="my_table table-striped table-bordered table-hover thead-light" style="width: 100%;text-align: center" >
    <tr style="height: 40px">
        <th>{{__('row_title')}}</th>
        <th>{{__('package_title')}}</th>
        <th>{{__('price_title')}}({{__('kd_title')}})</th>
        <th>{{__('date_title')}}</th>
        <th>{{__('details')}}</th>
        <th>{{__('status')}}</th>
    </tr>
    @foreach($payments as $payment)
    @php
    if($payment->is_payed==1){$txtPay='<font color="#009900">'.__('paid_title').'</font>';}else{$txtPay='<font color="#ff0000">'.__('not_paid_title').'</font>';}
    @endphp
    <tr style="height: 40px">
        <td>{{($loop->index)+1}}</td>
        <td>{{ app()->getLocale()==='en'?$payment->title_en:$payment->title_ar }}</td>
        <td> {{!empty($payment->price)?number_format($payment->price,3):'0.000'}}</td>
        <td>{{ $payment->date }}</td>
        <td>
        <div style="text-align:{{$align}};margin:5px;" dir="{{$dir}}">{{__('remain_regular_ads')}}:<a href="javascript:;" style="float:{{$aligno}};">{{($payment->is_payed == 1)?($payment->count_advertising - $payment->count_usage):0}}</a></div>
        <div style="text-align:{{$align}};margin:5px;" dir="{{$dir}}">{{__('remain_premium_ads')}}:<a href="javascript:;" style="float:{{$aligno}};">{{($payment->is_payed == 1)?($payment->count_premium - $payment->count_usage_premium):0}}</a></div>
        <td>
        @if($payment->package_id == 18){{__('free')}}@endif
        @if($payment->package_id != 18)<a href="{{url(app()->getLocale().'/paymentdetails/'.$payment->payment_id)}}">{{__('details')}}({!!$txtPay!!})</a>@endif
        </td>
        </td>
    </tr>
    @endforeach
</table>

<div style="clear:both;"></div>
