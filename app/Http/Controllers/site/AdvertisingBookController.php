<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Advertising;
use App\Models\Booking;

class AdvertisingBookController extends Controller
{
    public function booking(Request $request,$locale, $hasNumber)
    {
    	if (!auth()->check()) {
    		return ['status' => 403];
    	}
    	$bookerDetails = auth()->user();
		
//dd($hasNumber);
    	$ad = Advertising::where('hash_number' , $hasNumber)->with(['user'])->first();
    	if ($ad) {
//    	    dd($ad);
	    	$booking = new Booking;
	    	$booking->user_id = $ad->user->id;
	    	$booking->booker_id = $bookerDetails->id;
	    	$booking->advertising_id = $ad->id;
	    	$booking->name = $request->name;
	    	$booking->mobile = $request->mobile;
	    	$booking->email = $request->email;
	    	$booking->date = str_replace('/', '-', $request->date);
	    	$booking->time = $request->time;
	    	$booking->message = $request->message;
	    	$booking->status = 'pending';
	    	$booking->save();

//	    	event(new \App\Events\Booking($ad,$booking));

            // my changes

            $titleForBooker = "Booking Request Sent";
            $messageForBooker = "Your booking request sent successfully!";

            $titleForUser = "Booking Request Received";
            $messageForUser = "You have received a booking request for your ad";

            if(!is_null(auth()->user()->device_token)){
                $data = array("title" =>$titleForBooker,"message" =>$messageForBooker,'notify_type'=>'booking_response');
                $notification=["title" =>$titleForBooker,'body'=>$messageForBooker,'badge'=>1,'sound'=>'ping.aiff','notify_type'=>'booking_response'];
                // Notification::create(["user_id"=>$booking->booker->id,'device_token'=>$])
                parent::sendPushNotification($data,auth()->user()->device_token,[],$notification);
            }

            if(!is_null(optional($ad->user)->device_token)){
                $data = array("title" =>$titleForUser,"message" =>$messageForUser,'notify_type'=>'booking_response');
                $notification=["title" =>$titleForUser,'body'=>$messageForUser,'badge'=>1,'sound'=>'ping.aiff','notify_type'=>'booking_response'];
                // Notification::create(["user_id"=>$booking->booker->id,'device_token'=>$])
                parent::sendPushNotification($data,optional($ad->user)->device_token,[],$notification);
            }

            //end of my changes

	    	return ['status' => 200];
    	}
    	return ['status' => 404];

    }
}
