@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>Success!</strong> Your booking submited succesfully and waiting for approval !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Something went wrong !
    </div>
@endif



<table class="my_table table-striped table-bordered table-hover thead-light" style="width: 100%;text-align: center" >
    <tr style="height: 40px">
        <th>{{__('row_title')}}</th>
        <th>{{__('advertising_title')}}</th>
        <th>{{__('full_name_title')}}</th>
        <th>{{__('mobile_title')}}</th>
        <th>{{__('date_title')}}</th>
        <th>{{__('time_title')}}</th>
        <th>{{__('status_title')}}</th>
    </tr>
    @foreach($bookings as $booking)
        <tr style="height: 40px">
            <td>{{($loop->index)+1}}</td>
            <td>{{app()->getLocale()=='en'? optional($booking->advertising)->title_en:optional($booking->advertising)->title_ar }}</td>
            <td>{{ $booking->name }}</td>
            <td>{{ $booking->mobile }}</td>
            <td>{{ $booking->date }}</td>
            <td>{{ $booking->time }}</td>
            <td>@if (app()->getLocale()=='en')
                    {{ $booking->status }}
                @else
                    @if ($booking->status==='pending')
                        {{__('pending_title')}}
                    @elseif($booking->status==='accept')
                        {{__('accept_title')}}

                    @elseif($booking->status==='reject')
                        {{__('reject_title')}}

                    @endif

            @endif</td>
        </tr>
    @endforeach
</table>

<div style="clear:both;"></div>
