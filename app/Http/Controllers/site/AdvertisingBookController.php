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


	    	return ['status' => 200];
    	}
    	return ['status' => 404];

    }
}
