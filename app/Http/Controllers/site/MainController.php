<?php

namespace App\Http\Controllers\site;

use App\Events\ConfirmBookEvents;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Booking;
use App\Models\City;
use App\Models\Advertising;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Setting;
use App\User;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    // index page
    public function index()
    {
        // app('debugbar')->disable();
        $premiumAds = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $cities = City::all();
        $areas = Area::orderBy('name_en')->get();

        $residentials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $industrials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $commercials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('site.pages.main', compact('premiumAds', 'residentials', 'industrials', 'commercials', 'cities', 'areas'));
    }

    //sign up page
    public function signup()
    {
        return view('site.auth.signup');
    }

    // login page
    public function login()
    {
        return view('site.auth.login');
    }

    // about us page
    public function aboutus()
    {

	    $aboutus_large_ar = Setting::where('setting_key' , 'aboutus_large_ar')->value('setting_value');
		$aboutus_large_en = Setting::where('setting_key' , 'aboutus_large_en')->value('setting_value');
		$aboutus_large_pic1 =   Setting::where('setting_key' , 'aboutus_large_pic1')->value('setting_value');
		$aboutus_large_pic2 =   Setting::where('setting_key' , 'aboutus_large_pic2')->value('setting_value');

		$our_story_en =   Setting::where('setting_key' , 'our_story_en')->value('setting_value');
		$our_story_ar =   Setting::where('setting_key' , 'our_story_ar')->value('setting_value');
		$our_value_en =   Setting::where('setting_key' , 'our_value_en')->value('setting_value');
		$our_value_ar =   Setting::where('setting_key' , 'our_value_ar')->value('setting_value');
		$our_promise_en =   Setting::where('setting_key' , 'our_promise_en')->value('setting_value');
		$our_promise_ar =   Setting::where('setting_key' , 'our_promise_ar')->value('setting_value');
        return view('site.pages.aboutus',compact('aboutus_large_ar','aboutus_large_en','aboutus_large_pic1','aboutus_large_pic2','our_story_en','our_story_ar','our_value_en','our_value_ar','our_promise_en','our_promise_ar'));
    }

    /*
    //
    my account page
    //
    */

    // get available ads for user
    public static function getBalance($ignoreGift=false)
    {
        $user = auth()->user();
        $date = date("Y-m-d");
        User::where('id', $user->id)->update(['last_activity' => date("Y-m-d")]);
        $listBalance = PackageHistory::where("user_id", $user->id)
            ->where("expire_at", ">", $date)
            ->where("is_payed", 1)
            ->where('accept_by_admin', 1)
            ->whereColumn('count_advertising', '>=', 'count_usage')
            ->whereColumn('count_premium', '>=', 'count_usage_premium')
            ->orderBy('id', 'desc');
if ($ignoreGift){
    $listBalance=$listBalance->where('title_en',"!=",'gift credit');
}
        $listBalance=$listBalance->get();
        if ($listBalance->count() >= 1) {
            $expireAt = $listBalance[0]->expire_at;
            $type = $listBalance[0]->type;
            $titleAr = $listBalance[0]->itle_ar;
            $titleEn = $listBalance[0]->title_en;

            $count = 0;
            $countPremium = 0;
            $countUsage = 0;
            $countPremiumUsage = 0;
            foreach ($listBalance as $item) {
                $count += $item->count_advertising;
                $countPremium += $item->count_premium;
                $countUsage += $item->count_usage;
                $countPremiumUsage += $item->count_usage_premium;
            }
            $av = $count - $countUsage;
            $avp = $countPremium - $countPremiumUsage;
            $record = [
                'type' => $type,
                'title_en' => $titleEn,
                'title_ar' => $titleAr,
                'expire_at' => $expireAt,
                'count_advertising' => $count,
                'count_usage' => $countUsage,
                'count_premium' => $countPremium,
                'count_premium_usage' => $countPremiumUsage,
                'available' => $av,
                'available_premium' => $avp
            ];
        } else {
            $record = 0;
        }
        return $record;
    }

    // profile page
    public function profile()
    {
        $record = $this->getBalance();
        return view('site.pages.profile', [
            'balance' => $record
        ]);
    }

    // change password
    public function changePassword()
    {
        $record = $this->getBalance();
        return view('site.pages.changePassword', [
            'balance' => $record
        ]);
    }

    //wishlist
    public function wishList()
    {
        $record = $this->getBalance();
        //return  $user = User::whereId(Auth::user()->id)->with(['archiveAdvertising','advertising'])->first();
        $wishList = User::whereId(Auth::user()->id)->with(['archiveAdvertising' => function ($q) {
            $q->where('expire_at', '>=', Carbon::now()->format('Y-m-d'))->with(['user', 'city', 'area']);
        }])->first();
//        return $wishList->archiveAdvertising;
        if (\request()->wantsJson()) {
            return [
                'balance' => $record,
                'wishLists' => $wishList->archiveAdvertising
            ];
        }
        return view('site.pages.wishList', [
            'balance' => $record,
            'wishLists' => $wishList->archiveAdvertising
        ]);
    }

    //payment history
    public function paymentHistory()
    {
        $record = $this->getBalance();
        $user = auth()->user();
        $payments = PackageHistory::where('user_id', $user->id)
            ->orderBy('id', 'desc')->paginate(20);

        return view('site.pages.paymentHistory', [
            'balance' => $record,
            'payments' => $payments
        ]);
    }

	public function paymentDetails(Request $request){
	if(empty($request->paymentid)){abort('404');}

	$record       = $this->getBalance();

	$payments     = Payment::where('payments.id',$request->paymentid);
	$payments     = $payments->select('tbl_transaction_api.*','payments.*')
	                         ->join('tbl_transaction_api','tbl_transaction_api.api_ref_id','=','payments.ref_id');
	$payments     = $payments->first();
	return view('site.pages.paymentDetails',['balance'=>$record,'paymentsDetails'=>$payments]);
	}

    //my ads
    public function myAds()
    {
        $record = $this->getBalance();

        $user = auth()->user();
        $ads = Advertising::where('user_id', $user->id)
            ->orderBy('id', 'desc')->paginate(20);

        return view('site.pages.myAds', [
            'balance' => $record,
            'ads' => $ads
        ]);
    }

    //bookings
    public function bookings()
    {
        $record = $this->getBalance();
//dd(Auth::user()->id);
        $bookings = Booking::where('booker_id', Auth::user()->id)->whereHas('advertising', function ($q) {
            $q->where('expire_at', '>', date('Y-m-d'));
        })->with(['advertising'])->orderBy('id','DESC')->get();
//        return  $bookings;
        return view('site.pages.bookings', [
            'balance' => $record,
            'bookings' => $bookings
        ]);
    }

    //my ads bookings
    public function myAdsBookings()
    {
        $record = $this->getBalance();

        $myAdsBookings = Booking::where('user_id', auth()->user()->id)->whereHas('advertising', function ($q) {
            $q->where('expire_at', '>', date('Y-m-d'));
        })->with(['advertising'])->get();

        return view('site.pages.myAdsBookings', [
            'balance' => $record,
            'myAdsBookings' => $myAdsBookings
        ]);
    }

    // accept or reject a booking
    public function acceptOrRejectBooking(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $validate = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'status' => 'required|in:accept,reject'
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());

        $booking = Booking::with(["booker", "user"])->whereId($id)->first();
        $booking->status = $status;
        $booking->save();
        if ($request->status == "accept") {
            $title = __('accept_request');
            $message = __('accept_booking_request');
        } else {
            $title = __('reject_request');
            $message = __('reject_booking_request');
        }
        event(new ConfirmBookEvents($booking));
        if (optional($booking->booker)->device_token != null) {
            $data = array("title" => $title, "message" => $message, 'notify_type' => 'booking_response');
            $notification = ["title" => $title, 'body' => $message, 'badge' => 1, 'sound' => 'ping.aiff', 'notify_type' => 'booking_response'];
            // Notification::create(["user_id"=>$booking->booker->id,'device_token'=>$])
            parent::sendPushNotification($data, optional($booking->booker)->device_token, [], $notification);
        }
        return redirect(route('Main.myAdsBookings',app()->getLocale()));
        //return $this->success("");
    }

    // buy package
    public function buyPackage()
    {
        $record = $this->getBalance();

        if (auth()->user()->type_usage == 'individual') {
            $normals = Package::where('type', 'normal')
                ->where('user_type', 'individual')
                ->where('is_enable', 1)
                ->where('is_visible', 1)->get();
            $statics = Package::where('type', 'static')
                ->where('user_type', 'individual')
                ->where('is_enable', 1)
                ->where('is_visible', 1)->get();
        } elseif (auth()->user()->type_usage == 'company') {
            $normals = Package::where('type', 'normal')
                ->where('user_type', 'company')
                ->where('is_enable', 1)
                ->where('is_visible', 1)->get();
            $statics = Package::where('type', 'static')
                ->where('user_type', 'company')
                ->where('is_enable', 1)
                ->where('is_visible', 1)->get();
        }

        return view('site.pages.buyPackage', [
            'balance' => $record,
            'normals' => $normals,
            'statics' => $statics,
        ]);
    }

    //buy package or credit
    public function buyPackageOrCredit(Request $request)
    {
        try {
            $user = auth()->user();

            $validate = Validator::make($request->all(), [
                'package_id' => 'required|numeric',
                'type' => 'required|in:static,normal',
                'count' => 'nullable|numeric',
                'payment_type' => 'required|in:Cash,Knet',
            ]);
            if ($validate->fails()) {
                return redirect()->route('Main.buyPackage',app()->getLocale())->with(['status' => 'validation_failed']);
            }
       $package = Package::find($request->package_id);
//dd($package->type=="normal");
            // untill now request data is validated
            // now we check user doesn't choose a package that already bought
            if ($package->type=="normal"){
            if ($user->package_id != null && $user->package_id != 0) {
             $balance=$this->getBalance(true);
//                dd($this->getBalance());
                if ($balance!==0 && $balance['available']>0 && $balance['available_premium']>0) {
                        return redirect(app()->getLocale().'/buypackage#result')->with(['status' => 'ads_remaining']);
                }
            }
}
            $countDay = optional($package)->count_day;

            $today = date("Y-m-d");
            $date = strtotime("+$countDay day", strtotime($today));
            $expireDate = date("Y-m-d", $date);


            if (isset($request->count) && is_numeric($request->count) && $request->count > 1) {
                $count = $request->count;
            } else {
                $count = 1;
            }
            $countP = intval($package->count_premium) * intval($count);
            $countN = intval($package->count_advertising) * intval($count);


            if ($request->payment_type == "Cash" || $request->payment_type == "cash") {
                $accept = 0;
            } else {
                $accept = 1;
            }


            $ref = $this->makeRefId($user->id);
            $payment = Payment::create([
                'user_id' => $user->id,
                'package_id' => $request->package_id,
                'payment_type' => $request->payment_type,
                'price' => $package->price,
                'status' => 'new'
            ]);

            //todo:: 'is_payed'=>1  change to 0 after implement logic payment
            $res = PackageHistory::create([
                'title_en' => $package->title_en,
                'title_ar' => $package->title_ar,
                'user_id' => $user->id,
                'type' => $request->type,
                'package_id' => $request->package_id,
                'date' => date('Y-m-d'),
                'is_payed' => 0,
                'price' => $package->price,
                'count_day' => $package->count_day,
                'count_show_day' => $package->count_show_day,
                'count_advertising' => $countN,
                'count_premium' => $countP,
                'count' => $count,
                'expire_at' => $expireDate,
                'payment_type' => $request->payment_type,
                'accept_by_admin' => $accept
            ]);
            $payment->package_history_id = $res->id;
            $payment->ref_id = $ref;
            $res->payment_id = $payment->id;
            $res->save();
            $payment->save();


            if ($request->get('payment_type') == "Knet") {
                $response = $this->sendRequestForPayment($package->price, $ref, $user->id, $request->type, $package->id);
                $responseObject = json_decode($response);
                $payUrl = $responseObject->payUrl;

                return redirect($payUrl) ;
            }
            else{ // if payment type is cash
                $res->accept_by_admin=1;
                $res->is_payed=1;

                $package_id = $res->package_id ;
                $user->package_id = $package_id ;
                $user->save() ;
                $res->save();

                return redirect(app()->getLocale().'/paymenthistory#result')->with(['status' => 'package_bought']);
                //return redirect('/paymenthistory#result',app()->getLocale())->with(['status' => 'package_bought']);

            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function makeRefId($userId)
    {
        return substr(time(), 5, 4) . rand(1000, 9999) . $userId;
    }

    private function sendRequestForPayment($price, $refId, $user_id = null, $type = null, $package_id = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payment.ajrnii.com/paymentInit.php?token=66a08c59-3ef4-44bb-9fbf-c6206d785f04&refid=" . $refId . "&amount=" . $price . "&user_id=" . $user_id . "&type=" . $type . "&package_id=" . $package_id . "&returnUrl=" . route('callback',app()->getLocale()),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cookie: __cfduid=d40b460b35a430341a1efef90bc437b2a1599411044; PHPSESSID=aeb4fca473e3ab09a3782d12083737df"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function paymentResult(Request $request)
    {
        $message = $request->get('message');
        $refId = $request->get('refid');
        $trackid = $request->get('trackid');
        $payment = Payment::with(['package', 'packageHistory', 'user'])->where('ref_id', $request->get('refid'))->first();
        $order = DB::table('tbl_transaction_api')->where("api_ref_id", $request->get('refid'))->first();

        if ($payment) {

            if ($message == "CAPTURED") {
                $payment->status = "completed";
                $payment->packageHistory->accept_by_admin = 1;
                $payment->packageHistory->is_payed = 1;
                \App\User::find($payment->user->id)->update(['package_id' => intval($payment->package_id)]);

            } else {
                $payment->status = "failed";
                $payment->packageHistory->accept_by_admin = 0;
            }
            $payment->description = $message;
            $payment->update();
            $payment->packageHistory->update();
        }
        if ($payment) {
            event(new \App\Events\Payment($message, $payment, $refId, $trackid));

        }
        return view("site.pages.payment", compact('message', 'refId', 'trackid', 'payment', 'order'));
    }

    public function getAreas()
    {
        return app()->getLocale()=='en'?  Area::orderBy('name_en')->get():Area::orderBy('name_ar')->get();
    }

    public function showService( $locale , $serviceId)
    {
        $service = Service::find($serviceId) ;
        return view('site.pages.service' , compact('service')) ;
    }

}
