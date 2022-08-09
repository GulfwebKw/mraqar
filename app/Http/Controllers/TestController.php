<?php


namespace App\Http\Controllers;
use App\Events\NewAdvertising;
use App\Events\UserRegistered;
use App\Jobs\EmailNotify;
use App\Jobs\NotifyUser;
use App\Lib\KnetPayment;
use App\Mail\InfluencerMail;
use App\Mail\RegisterMember;
use App\Models\Advertising;
use App\Models\Booking;
use App\Models\City;
use App\Models\Notification;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Payment;
use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use IZaL\Knet\KnetBilling;
use Johntaa\Arabic\I18N_Arabic;

class TestController extends Controller
{

    public function getCreditUser($userId)
    {

        $date=date("Y-m-d");
        $packages=DB::table("user_package_history")
            ->where("expire_at",'>=',$date)
            ->where('is_payed',1)
            ->where('accept_by_admin',1)
            ->where("user_id",$userId)
            ->whereColumn('count_advertising','>=','count_usage')
            ->whereColumn('count_premium','>=','count_usage_premium')
            ->orderBy('id','desc')->get();
        if($packages->count()>=1){
            $cp=0;
            $cn=0;

            $cpUse=0;
            $cnUse=0;

            foreach ($packages as $package){
                $cp+=$package->count_premium;
                $cn+=$package->count_advertising;

                $cpUse+=$package->count_usage_premium;
                $cnUse+=$package->count_usage;
            }
            $data['count_premium_advertising']=$cp-$cpUse;
            $data['count_normal_advertising']=$cn-$cnUse;
            return $data;
        }else{
            return [];
        }



    }
    public static function makePermImageFoRSS($advertising)
    {
        $path="/images/template_image.jpeg";
        $id=$advertising->id;
        $advTitle=$advertising->title_en;
        $area=optional($advertising->area)->name_en;
        $mobile=$advertising->user->mobile;


        $image=File::get(public_path($path));
        $p=explode("/",$path);
        $name=end($p);
        array_pop($p);
        $basePath=implode('/',$p);
        $midImageUrl =$basePath.'/'.$id.'_post_'.$name;
        $img=\Image::make($image)->resize(1000,1000);
        $text=$advertising->description_en;

        $width       =1000 ;
        $height      = 800;
        $center_x    = $width / 2;
        $center_y    = $height / 2;
        $max_len     = 90;
        $font_size   = 17;
        $font_height=12;
        $lines = explode("\n", wordwrap($text, $max_len));
        $y     = $center_y - ((count($lines) - 1) * $font_height);

        $img->text('For rent '.$advTitle.' in '.$area, 500,300, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/Helvetica-Bold.ttf'));
            $font->size(18);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        foreach ($lines as $line) {
            $img->text($line, $center_x, $y, function ($font)use ($font_size) {
                $font->file(public_path('fonts/Helvetica-Font/Helvetica-Bold.ttf'));
                $font->size($font_size);
                $font->align('center');
                $font->valign('center');
                $font->angle(0);
            });
            $y += $font_height * 2;
        }

        $img->text($mobile,500,600, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/Helvetica-Bold.ttf'));
            $font->size(17);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $img->save(public_path($midImageUrl));
        $advertising->rss_image=$midImageUrl;
        $advertising->save();
    }
    public function test()
    {
//        $refId=rand(11111,99999);
//        $price=100;
//        $user_id=61;
//        $type="static";
//        $package_id=1;
//
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://payment.ajrnii.com/paymentInit.php?token=66a08c59-3ef4-44bb-9fbf-c6206d785f04&refid="."$refId"."&amount=".$price."&user_id=".$user_id."&type=".$type."&package_id=".$package_id."&returnUrl=http://ajrnii.com/payment-result",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_HTTPHEADER => array(
//                "Cookie: __cfduid=d40b460b35a430341a1efef90bc437b2a1599411044; PHPSESSID=aeb4fca473e3ab09a3782d12083737df"
//            ),
//        ));
//        $response = curl_exec($curl);
//        curl_close($curl);
//        return $response;




        $advertising=Advertising::where('advertising_type','premium')->whereNotNull('description')->first();


        $path="/images/template_image.jpeg";
        $id=$advertising->id;

        $advTitle=$advertising->title_en;
        $area=optional($advertising->area)->name_en;
        $mobile=$advertising->user->mobile;


        $image=File::get(public_path($path));
        $p=explode("/",$path);
        $name=end($p);
        array_pop($p);
        $basePath=implode('/',$p);
        $midImageUrl =$basePath.'/00s2asdrs204'.$id.'_post_'.$name;
        if(File::exists(public_path($midImageUrl))){
         $res=   File::delete(public_path($midImageUrl));
        }
        $img=\Image::make($image)->resize(850,800);
       // $text=$advertising->description;
        $text="لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص";

        $width       =400 ;
        $height      = 800;
        $center_x    = 410;
      //  $center_x    = $width / 2;
        $center_y    = $height / 2;
        $max_len     = 90;
        $font_size   = 22;
        $font_height=13;

        $lines = explode("\n", wordwrap($text, $max_len));
        $y     = $center_y - ((count($lines) - 1) * $font_height);
        $img->text('For rent '.$advTitle.' in '.$area, 400,300, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
            $font->size(22);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });

        $Arabic = new I18N_Arabic('Glyphs');

        $text ="";

        foreach ($lines as $line) {
            $line = $Arabic->utf8Glyphs($line);
          // $line= htmlentities($line, ENT_QUOTES, "UTF-8");
            $img->text($line, $center_x, $y, function ($font)use ($font_size) {
                $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
                $font->size($font_size);
                $font->align('center');
                $font->valign('center');
                $font->angle(0);
            });
            $y += $font_height * 2.5;
        }
        $img->text($mobile,500,600, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
            $font->size(18);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $img->save(public_path($midImageUrl));
        $advertising->rss_image=$midImageUrl;
        $advertising->save();
        dd($midImageUrl);

         DB::table("advertising_like")->insert(['advertising_id'=>125,'device_token'=>'asdasdasdalskdlas','created_at'=>date("Y-m-d h:i:s")]);


        $settings=Setting::whereIn('setting_key',['free_normal_advertising','free_premium_advertising'])->where('is_enable',1)->get()->keyBy('setting_key');


        $advertising=Advertising::whereNotNull('other_image')->first();
        $otheImage=json_decode($advertising->other_image);
        dd((array)$otheImage);


        $user=User::find(61);

        if($user->package_id!=null && $user->package_id!=0){
            $packageHistory=PackageHistory::where('user_id',$user->id)->where('package_id',$user->package_id)->orderBy('id','desc')->first();

            // $userPackage=Package::find($user->package_id);
            //todo:and check mot use all credit package

            if($packageHistory->expire_at>date('Y-m-d')){
                dd(trans("your package has not expire"));
            }

        }


        $user=User::first();
        $settings=Setting::whereIn('setting_key',['welcome_email_text_ar','welcome_email_text_en'])->get()->keyBy('setting_key');

        $message=optional($user)->lang=="ar"?optional($settings['welcome_email_text_ar'])->setting_value:optional($settings['welcome_email_text_en'])->setting_value;
        $res= Mail::to("sajjad.rezaei9090@gmail.com")->send(new RegisterMember($message));

        dd($message);

        dd($settings,optional($settings['welcome_email_text_en'])->setting_value,bcrypt('69008683'));
       // $message=optional($event->user)->lang=="ar"?optional($settings['welcome_email_text_ar'])->setting_value:optional($settings['welcome_email_text_en'])->setting_value;


        $booking=Booking::with(["booker","user"])->whereId()->first();
        dd($booking);

        $booking2=Booking::with(["booker"])->whereIn('id',[]);

        $booking->status="accept";
        $booking->save();

            $title=__('accept_request');
            $message=__('accept_booking_request');

        if(optional($booking->booker)->device_token!=null){
            $data = array("title" =>$title,"message" =>$message,'notify_type'=>'booking_response');
            $notification=["title" =>$title,'body'=>$message,'badge'=>1,'sound'=>'ping.aiff','notify_type'=>'booking_response'];
         $re=   parent::sendPushNotification($data,optional($booking->booker)->device_token,[],$notification);
        }
       dd($re);

        $advertising=Advertising::with("user")->orderBy('id','desc')->first();
        $booking=Booking::orderBy('id','desc')->first();
        if($advertising->user ) {
            $settings=Setting::whereIn('setting_key',['book_email_text_en','book_email_text_ar'])->get()->keyBy('setting_key')->toArray();
            $booking=Booking::with(["booker","user"])->whereId($booking->id)->first();
            $message=optional($advertising->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;
            $messageBooking=optional($booking->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;

                dispatch(new EmailNotify('sajjad.rezaei9090@gmail.com',$message,['advertising'=>$advertising,'booking'=>$booking],'booker'))->onQueue("notifyUser");
                dispatch(new EmailNotify('sajjad.rezaei9090@gmail.com',$messageBooking,['advertising'=>$advertising,'booking'=>$booking],'booking'))->onQueue("notifyUser");
        }

        dd('ok');
        return view("emails.basic",['title'=>"Bocking Successfully "]);

        dispatch(new EmailNotify("sajjad.rezaei9090@gmail.com","asdasdasdasd",[],'booking'))->onQueue("notifyUser");
        dd('sddss');

        //
        $user=User::find(7);
        event(new UserRegistered($user));
        dd('sd');
        $items= Controller::getNotificationMessage();
        User::notifyInactiveUsers($items['InactiveUsers']->title_en,$items['InactiveUsers']->title_ar,$items['InactiveUsers']->message_en,$items['InactiveUsers']->message_ar);
        User::notifyUserHasNotSale($items['UserHasNotSale']->title_en,$items['UserHasNotSale']->title_ar,$items['UserHasNotSale']->message_en,$items['UserHasNotSale']->message_ar);
        User::notifyUserNotRegisteredComment($items['UserNotRegisteredComment']->title_en,$items['UserNotRegisteredComment']->title_ar,$items['UserNotRegisteredComment']->message_en,$items['UserNotRegisteredComment']->message_ar);
        User::notifyUserNotBocked($items['UserNotBocked']->title_en,$items['UserNotBocked']->title_ar,$items['UserNotBocked']->message_en,$items['UserNotBocked']->message_ar);
        User::notifyUserHasNotVisitAdvertising($items['UserHasNotVisitAdvertising']->title_en,$items['UserHasNotVisitAdvertising']->title_ar,$items['UserHasNotVisitAdvertising']->message_en,$items['UserHasNotVisitAdvertising']->message_ar);
        Log::info("notify user".date("Y-m-d H:i:s"));
        dd('sdd');
        dd(parent::getNotificationMessage());
        $inctiveNotifyList=Notification::where("type","InactiveUsers")->pluck('user_id')->toArray();
        $today=date("Y-m-d");
        $date = strtotime("-15 day", strtotime($today));
        $validDate=date("Y-m-d",$date);
        return   User::where('last_activity','<=',$validDate)->where('type','member')->whereNotIn('id',$inctiveNotifyList)->get();

        dd($inctiveNotifyList,date('Y-m-d h:i:s'));

        $res=Mail::to("sajjad.rezaei9090@gmail.com")->send(new RegisterMember("asdas"));
        dd($res);



        $r="1,10,11,";
        dd(explode(",",$r));
        $advertising=Advertising::find(72);
        $advertising->amenities()->sync([5, 6, 7, 10,4],true);
        dd($advertising);

        try{
            $mobile="93999948";
            $user= User::where("mobile",$mobile)->first();
            if(!is_null($user)){
                $code=rand(10000,99999);
                $message="Activation Code : ".$code;
                $user->sms_code=$code;
                $user->save();
                self::sendSms($message,$mobile);
                dd('ss');
              //  return $this->success(trans("main.successfully_send_verify_code"));
            }
            dd('not found');
            return $this->fail(trans("main.user_not_found"));
        }catch (\Exception $e){
          dd($e->getMessage());
        }


        $packages=Package::where('is_enable',1)->where('is_visible',1)->where('type',"!=","static")->get();
        dd($packages);

        $cities=City::with("areas")->get();
        dd($cities);
       $res= self::sendSms("asas",12341234);

       dd($res);

        $result= $this->getCreditUser(30);
        dd($result);
        $payment=Payment::create(['user_id'=>7,'package_id'=>4,'payment_type'=>"Cash",'price'=>100,'status'=>'new']);

        $payment->package_history_id=12;
        $payment->save();
        dd($payment);
        $res=DB::table("venue_type")->select("*")->get()->groupBy("title_en");
        dd($res);

        $today=date("Y-m-d");
        $date = strtotime("-15 day", strtotime($today));
        $validDate=date("Y-m-d",$date);
        $user=User::getInactiveUsers();
        dd($user);

      //  Mail::to("sajjad.rezaei9090@gmail.com")->send(new RegisterMember("sdasdasd"));
       $res= event(new UserRegistered(User::find(2)));
       dd($res,User::find(2));

       $res= event(New NewAdvertising(Advertising::first()));

        dd($res);
        $lang="ar";
        $settings=Setting::whereIn('setting_key',['welcome_email_text_ar','welcome_email_text_en'])->get()->keyBy('setting_key');
        $message=$lang=="ar"?optional($settings['welcome_email_text_ar'])->setting_value:optional($settings['welcome_email_text_en'])->setting_value;
        dd($message);


        User::where('id',2)->update(['last_activity'=>date("Y-m-d")]);

        dd("Shet");

       $res= Mail::to("sajjad.rezaei9090@gmail.com")->send(new RegisterMember("jasdkajdkasj asjdhbjasdb"));

       dd($res);

        $userId=7;
        $type="normal";

        $listBalance= PackageHistory::where("user_id",$userId)
            ->where("expire_at",">",date("Y-m-d"))
            ->orderBy('id','desc');
        if($type=="normal"){
            $listBalance=$listBalance->whereColumn('count_advertising','>','count_usage');
        }else{
            $listBalance=$listBalance->whereColumn('count_premium','>','count_usage_premium');
        }
        $listBalance=$listBalance->first();
        if(isset($listBalance)){
            if($type=="normal"){
                $listBalance->count_usage=intval($listBalance->count_usage)+1;
            }else{
                $listBalance->count_usage_premium=intval($listBalance->count_usage_premium)+1;
            }
            $listBalance->save();
        }
        dd($listBalance);



        $token="dazxdxcdzxcz";
        $id="14";
        if(isset($token)&&$token!=null&&!empty($token)){
            $res= DB::table("advertising_view")->where('advertising_id',$id)->where('device_token',$token)->first();
            if(!isset($res)){
                DB::table("advertising_view")->insert(['advertising_id'=>$id,'device_token'=>$token]);
            }
        }
        $count=DB::table("advertising_view")->where('advertising_id',$id)->count();
        dd($count);



        $user=User::makeUser(['name'=>"test","mobile"=>"12345678","email"=>"sdsd","password"=>"aadad"]);

        $user->verifed=1;
        $user->save();

        dd('ok');



    }

    public function testPayment(Request $request)
    {




        $knet=      app()->make(KnetPayment::class);
        $request->merge(['ref_id'=>"randomsdkjskdj",'price'=>98.00,'token'=>'sdsdasdasd','udf1'=>'adadadsad','udf2'=>'ADAdaDSDASDASD','udf3'=>'SADASDLKKAJSKDJKAS']);
        $result= $knet->requestPayment($request);


        dd($result);


        $responseURL = 'http://mywebapp.com/payment/response.php';
        $successURL = 'http://mywebapp.com/payment/success.php';
        $errorURL = 'http://mywebapp.com/payment/error.php';
        $knetAlias = 'TEST_ALIAS';
        $resourcePath = '/home/ajrnnaxa/public_html/';
        $amount = 150;
        $trackID = 'UNIQUETRACKID';

        try {

            $knetGateway = new KnetBilling([
                'alias'        => $knetAlias,
                'resourcePath' => $resourcePath
            ]);

            $knetGateway->setResponseURL($successURL);
            $knetGateway->setErrorURL($errorURL);
            $knetGateway->setAmt($amount);
            $knetGateway->setTrackId($trackID);

            $knetGateway->requestPayment();
            $paymentURL = $knetGateway->getPaymentURL();

            // helper function to redirect
            return header('Location: '.$paymentURL);

        } catch (\Exception $e) {

            dd($e->getMessage());
            // to debug error message
            // die(var_dump($e->getMessage()));

          //  return header('Location: '.$errorUrl);
        }


    }

}
