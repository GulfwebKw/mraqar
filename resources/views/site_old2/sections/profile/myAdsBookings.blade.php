<table class="my_table table-striped table-bordered table-hover thead-light" style="width: 100%;text-align: center" >
    <tr style="height: 40px">
        <th>{{__('row_title')}}</th>
        <th>{{__('advertising_title')}}</th>
        <th>{{__('full_name_title')}}</th>
        <th>{{__('mobile_title')}}</th>
        <th>{{__('date_title')}}</th>
        <th>{{__('time_title')}}</th>
        <th>{{__('message_title')}}</th>
        <th>{{__('status_title')}}</th>
        <th>{{__('action_title')}}</th>
    </tr>
    @foreach($myAdsBookings as $myAdsBooking)
        <tr style="height: 40px">
            <td>{{($loop->index)+1}}</td>
            <td>{{app()->getLocale()=='en'? optional($myAdsBooking->advertising)->title_en: optional($myAdsBooking->advertising)->title_ar}}</td>
            <td>{{ $myAdsBooking->name }}</td>
            <td>{{ $myAdsBooking->mobile }}</td>
            <td>{{ $myAdsBooking->date }}</td>
            <td>{{ $myAdsBooking->time }}</td>
            <td style="word-wrap:break-word; min-width:160px; max-width:160px;">{{ $myAdsBooking->message }}</td>
            <td>@if (app()->getLocale()=='en')
                    {{ $myAdsBooking->status }}
                @else
                    @if ($myAdsBooking->status==='pending')
                        {{__('pending_title')}}
                    @elseif($myAdsBooking->status==='accept')
                        {{__('accept_title')}}

                    @elseif($myAdsBooking->status==='reject')
                        {{__('reject_title')}}

                    @endif

                @endif</td>
            <td>
                <form method="post" action="{{ route('Main.acceptOrRejectBooking',app()->getLocale()) }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $myAdsBooking->id }}">
                    <input type="hidden" name="status" value="accept">
                    <button type="submit" style="width:100%" class="btn btn-success" @if($myAdsBooking->status != "pending") disabled @endif>
                        <i class='bx bxs-check-circle'></i> {{__('accept_title')}}
                    </button>
                </form>
                <form method="post" action="{{ route('Main.acceptOrRejectBooking',app()->getLocale()) }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $myAdsBooking->id }}">
                    <input type="hidden" name="status" value="reject">
                    <button type="submit" style="width:100%" class="btn btn-danger" @if($myAdsBooking->status != "pending") disabled @endif>
                        <i class='bx bxs-x-circle' ></i> {{__('reject_title')}}
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div style="clear:both;"></div>
