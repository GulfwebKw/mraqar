<?php

namespace App\Http\Controllers\Api\V1;
use App\Jobs\EmailNotify;
use App\Lib\KnetPayment;
use App\Models\Advertising;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\InvalidKey;
use App\Models\LogVisitAdvertising;
use App\Models\Notification;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Payment;
use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdvertisingController extends ApiBaseController
{
    public function getListAdvertising(Request $request)
    {
        $advertising = $this->bindFilter($request);
        $advertising=$advertising->paginate(10);

        return $this->success("",$advertising);
    }
    public function search(Request $request)
    {
        $advertising = $this->bindFilter($request);
        $advertising=$advertising->paginate(10);
        $this->makeSearchHistory($request);
        return $this->success("",$advertising);
    }
    public function similarAdvertising($id)
    {
        $advertising=Advertising::with(["user","area","city","amenities"])->find($id);
        $list=Advertising::getValidAdvertising()->where('type',$advertising->type)->where("venue_type",$advertising->venue_type)->where("purpose",$advertising->purpose)->paginate(10);
        return $this->success("aaa",$list);
    }
    public function getAdvertising($id)
    {
        $advertising=Advertising::with(["user","area","city","amenities"])->find($id);
        $device_token=\request()->device_token;
        $user_id=\request()->user_id;
        $count=$this->visitAdvertising($id,$device_token);
        $countLike=$this->getCountLike($id);
        $hasLike=$this->hasLikeUser(\request()->device_token,$id);
        $hasArchive=$this->hasArchive($user_id,$id);
        $advertising->count_view=$count;
        $advertising->count_like=$countLike;
        $advertising->has_like=$hasLike;
        $advertising->has_archive=$hasArchive;
        return $this->success("",$advertising);
    }
    public function getListComments($id)
    {
        $list = $this->getComments($id);
        return $this->success("",$list);
    }
    public function getRelatedComments(Request $request)
    {
        $user=auth()->user();
        $res=        DB::table("advertisings")->where('user_id',$user->id)->pluck('id')->toArray();
        if(count($res)>=1){
          $result=  $this->getComments($res);
            return $this->success("",$result);
        }
        return $this->success("");
    }
    public function setComment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());

        $result=$this->filterKeywords($request->comment);
        if(!$result[0]){
            return $this->fail("invalid Keyword (".$result[1].")",-1,$request->all());
        }
        $user=auth()->user();
        Comment::create(['comment'=>$request->comment,
            'advertising_id'=>$request->id,
            'user_id'=>$user->id,
            'comment_id'=>$request->comment_id,
            'status'=>1
        ]);
        $list = $this->getComments($request->id);
        return $this->success("",$list);

    }
    public function getUserSaved(Request $request)
    {
        $user=auth()->user();
        $userId=$user->id;
        $ids=DB::table("user_archive_advertising")->where('user_id',$userId)->pluck('advertising_id')->toArray();
        $advertising=Advertising::getValidAdvertising()->whereIn('id',$ids)->paginate(10);
        return $this->success("",$advertising);
    }
    public function getUserAdvertising(Request $request)
    {
        $advertising=Advertising::getValidAdvertising(0)->with("amenities")->where(function ($r)use($request){
            if($request->expire==1){
                $r->where('expire_at','<',date('Y-m-d'))->whereNotNull('expire_at');
            }else{
                $r->whereNotNull('expire_at')->where('expire_at','>',date('Y-m-d'));
            }

        })->where('user_id',auth()->user()->id)->paginate(10);

        return $this->success("",$advertising);
    }
    public function createAdvertising(Request $request)
    {

        try{
            $validate = $this->validateAdvertising($request);
            if ($validate->fails())
                return $this->fail($validate->errors()->first(),-1,$request->all());

            $result=$this->filterKeywords($request->description);

            if(!$result[0]){
                return $this->fail("invalid Keyword (".$result[1].")",-1,$request->all());
            }
            $result2=$this->filterKeywords($request->title_en);

            if(!$result2[0]){
                return $this->fail("invalid Keyword (".$result2[1].")",-1,$request->all());
            }



            $user=auth()->user();
            $isValid=$this->isValidCreateAdvertising($user->id,$request->advertising_type);
            if($isValid){
                DB::beginTransaction();
                $advertising=new Advertising();
                $advertising=$this->saveAdvertising($request, $user, $advertising);
                $countShowDay= $this->affectCreditUser($user->id,$request->advertising_type);
                $today=   date("Y-m-d");
                $date = strtotime("+$countShowDay day", strtotime($today));
                $expireDate=date("Y-m-d",$date);
                $advertising->expire_at=$expireDate;
                $advertising->save();
                DB::commit();
                return $this->success("",['advertising'=>$advertising]);
            }
            return $this->fail(trans("main.expire_your_credit"));
        }catch (\Exception $exception){
            DB::rollback();
            return $this->fail($exception->getMessage(),-1,$request->all());
        }
    }
    public function updateAdvertising(Request $request)
    {
        try {
            $validate = $this->validateAdvertising($request,false);
            if ($validate->fails())
                return $this->fail($validate->errors()->first());


            $user=auth()->user();
            $advertising=Advertising::find($request->id);
            if(isset($advertising)){
                $advertising=$this->saveAdvertising($request, $user, $advertising);
                return $this->success("");
            }
            return $this->fail("not_found_advertising");

        }catch (\Exception $exception){
            return $this->fail("server_error");
        }



    }
    public function attachFileToAdvertising(Request $request)
    {
        //Log::info($request->all());

        $validate =   Validator::make($request->all(),[
            'advertising_id'=>'required',
            //'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20000',
           // 'other_image.*' => 'nullable|mimes:jpeg,bmp,png|max:2048',
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());

        $advertising=Advertising::find($request->advertising_id);
        if($advertising->other_image!="" && $advertising->other_image!=null){
            $otherImage=(array)json_decode($advertising->other_image);
        }else{
            $otherImage=[];
        }

        for($i=1;$i<=10;$i++){
            if(isset($request->{"other_image".$i})){
                $file=$request->{"other_image".$i};
                if($request->hasFile("other_image".$i)){
                    $path =$this->saveImage($file);
                    $otherImage["other_image".$i]= $path;
                }elseif ($file=="false"){
                    $otherImage["other_image".$i]= "";
                }
            }
        }

        if(count($otherImage)>=1){
            $otherImage = json_encode($otherImage);
            $advertising->other_image = $otherImage;
        }
        if($request->hasFile('main_image')){
            $advertising->main_image =$this->saveImage($request->main_image);
        }elseif ($request->main_image=="false"){
            $advertising->main_image="";
        }
        if(isset($request->video)){
            if(!is_string($request->video)){
                $video=$request->video;
                $advertising->video=$this->saveVideo($video);
            }elseif($request->video=="false"){
                $advertising->video="";
            }
        }
        if($request->hasFile('floor_plan')){
            $advertising->floor_plan = $this->saveImage($request->floor_plan);
        }elseif($request->floor_plan=="false"){
            $advertising->floor_plan="";
        }

        $advertising->save();

        return $this->success("");

    }
    public function archiveAdvertising(Request $request)
    {
        $validate = Validator::make($request->all(), [
                   'advertising_id' => 'required|numeric',
                   ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());


          auth()->user()->archiveAdvertising()->syncWithoutDetaching([$request->advertising_id]);
          return $this->success("");

    }
    public function detachArchive(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'advertising_id' => 'required|numeric',
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());


        auth()->user()->archiveAdvertising()->detach([$request->advertising_id]);
        return $this->success("");
    }
    public function deleteAdvertising(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'advertising_id' => 'required|numeric',
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());


         $result=  Advertising::where('id','advertising_id')->where("user_id",auth()->user()->id)->first();
         if(isset($result)){
             $result->delete();
             return $this->success("");
         }
        return $this->fail("not found");


    }
    // get available ads for user
    public function getBalance($ignoreGift=false)
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
    public function buyPackageOrCredit(Request $request)
    {
        try {
            $user=auth()->user();

            $validate = Validator::make($request->all(), [
                'package_id' => 'required|numeric',
                'type'=>'required|in:static,normal',
                'count'=>'nullable|numeric',
                'payment_type'=>'required|in:Cash,Knet',
            ]);
            if ($validate->fails())
                return $this->fail($validate->errors()->first());
       $package = Package::find($request->package_id);
            // untill now request data is validated
            // now we check user doesn't choose a package that already bought
            if ($package->type=="normal"){
            if ($user->package_id != null && $user->package_id != 0) {
                $balance=$this->getBalance(true);
//                dd($this->getBalance()['available']);
                if ($balance!==0 && isset($balance['available'])>0 && isset($balance['available_premium'])>0) {
                    return $this->fail('You cant buy package because Your package has available item');                }
            }
}


            $countDay=optional($package)->count_day;

            $today=   date("Y-m-d");
            $date = strtotime("+$countDay day", strtotime($today));
            $expireDate=date("Y-m-d",$date);


            if(isset($request->count)&& is_numeric($request->count)&&$request->count>1){
                $count=$request->count;
            }else{
                $count=1;
            }
            $countP=intval($package->count_premium)*intval($count);
            $countN=intval($package->count_advertising)*intval($count);



               if($request->payment_type=="Cash"||$request->payment_type=="cash"){
                   $accept=0;
                   $is_paid=1;
               }else{
                   $accept=1;
                   $is_paid=0;

               }


               $ref=$this->makeRefId($user->id);
                $payment=Payment::create(['user_id'=>$user->id,'package_id'=>$request->package_id,'payment_type'=>$request->payment_type,'price'=>$package->price,'status'=>'new']);

              //todo:: 'is_payed'=>1  change to 0 after implement logic payment
                $res=PackageHistory::create(['title_en'=>$package->title_en,'title_ar'=>$package->title_ar,
                    'user_id'=>$user->id,'type'=>$request->type,'package_id'=>$request->package_id,
                    'date'=>date('Y-m-d'),'is_payed'=>$is_paid,'price'=>$package->price,
                    'count_day'=>$package->count_day,'count_show_day'=>$package->count_show_day,
                    'count_advertising'=>$countN,'count_premium'=>$countP,'count'=>$count,
                    'expire_at'=>$expireDate,'payment_type'=>$request->payment_type,'accept_by_admin'=>$accept]);
                $payment->package_history_id=$res->id;
                $payment->ref_id=$ref;
                $res->payment_id=$payment->id;
                $res->save();
                $payment->save();


            if($request->get('payment_type')=="Knet"){

                $response = $this->sendRequestForPayment($package->price,$ref,$user->id,$request->type,$package->id);
                //dd($response);
                return $this->success("",['payment_type'=>$request->get('payment_type'),'paymentDetails'=>$response]);

            }else{
                //temp
                if($request->type=="normal" || $package->type=="normal"){
                    User::whereId($user->id)->update(['package_id'=>$package->id]);
                }
            }
              return $this->success("",['payment_type'=>$request->get('payment_type')]);
        }catch (\Exception $e){
            return $this->fail($e->getMessage());
        }


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
        if ($message == "CAPTURED") {
            return view("api.pages.payment", compact('message', 'refId', 'trackid', 'payment', 'order'));

        }else
            return view("api.pages.payment", compact('message', 'refId', 'trackid', 'payment', 'order'));
    }
    public function likeOrUnLike(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'device_token' => 'required',
            'like' => 'required|in:1,0',
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());

        $like=$request->like;
        $deviceToken=$request->device_token;
        $id=$request->id;
        if($like==1){
           $res= DB::table("advertising_like")->where('advertising_id',$id)->where('device_token',$deviceToken)->first();
               if(!isset($res)){
                DB::table("advertising_like")->insert(['advertising_id'=>$id,'device_token'=>$deviceToken,'created_at'=>date("Y-m-d h:i:s")]);
               }
            $count=$this->getCountLike($id);
            return $this->success("",['count'=>$count]);
        }else{
            DB::table("advertising_like")->where('advertising_id',$id)->where('device_token',$deviceToken)->delete();
            $count=$this->getCountLike($id);
            return $this->success("",['count'=>$count]);
        }
    }
    private function getCountLike($id){
        return DB::table("advertising_like")->where('advertising_id',$id)->count();
    }
    private function visitAdvertising($id,$token=null)
    {
        if(isset($token)&&$token!=null&&!empty($token)){
                $res= DB::table("advertising_view")->where('advertising_id',$id)->where('device_token',$token)->first();
                if(!isset($res)){
                    DB::table("advertising_view")->insert(['advertising_id'=>$id,'device_token'=>$token,'created_at'=>date('Y-m-d h:i:s',time())]);
                }else{
                    $res->update(['created_at'=>date('Y-m-d h:i:s',time())]);
                }
          }
        $count=DB::table("advertising_view")->where('advertising_id',$id)->count();
        return $count;

    }
    public function setBooking(Request $request)
    {
        try {
            $user=auth()->user();
            $validate = Validator::make($request->all(), [
                'advertising_id' => 'required|numeric',
                'name'=>"required",
                'email'=>'nullable|email',
                'mobile'=>'required|digits:8',
                'date'=>'required',
                'time'=>'required'
            ]);
            if ($validate->fails())
                return $this->fail($validate->errors()->first());

            $advertising=Advertising::with("user")->find($request->advertising_id);
            $booking=  Booking::create(['advertising_id'=>$request->advertising_id,'user_id'=>$advertising->user_id,'booker_id'=>auth()->user()->id,'name'=>$request->name,'mobile'=>$request->mobile,'email'=>$request->email,'message'=>$request->message,'date'=>$request->date,'time'=>$request->time]);
           // $notification=   Notification::create(['user_id'=>$user->id,'title_en'=>__("new_booking_request"),"title_ar"=>__("new_booking_request"),'message_en'=>__("new_booking"),"message_ar"=>__("new_booking")]);

            if(optional($advertising->user)->device_token!=null){
                $data = array("title" =>__("new_booking_request"),"message" =>__("new_booking"),'notify_type'=>'new_booking');
                $notification=["title" =>__("new_booking_request"),'body'=>__("new_booking"),'badge'=>1,'sound'=>'ping.aiff','notify_type'=>'new_booking'];
                parent::sendPushNotification($data,optional($advertising->user)->device_token,[],$notification);
            }

            if($advertising->user ) {
                    $settings=Setting::whereIn('setting_key',['book_email_text_en','book_email_text_ar'])->get()->keyBy('setting_key')->toArray();
                    $booking=Booking::with(["booker","user"])->whereId($booking->id)->first();
                   $message=optional($advertising->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;
                   $messageBooking=optional($booking->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;

                    if(isset(optional($booking->booker)->email)){
                        dispatch(new EmailNotify(optional($booking->booker)->email,$message,['advertising'=>$advertising,'booking'=>$booking],'booker'))->onQueue("notifyUser");
                    }

                    if(optional($advertising->user)->email){
                        dispatch(new EmailNotify(optional($advertising->user)->email,$messageBooking,['advertising'=>$advertising,'booking'=>$booking],'booking'))->onQueue("notifyUser");
                    }

            }

            return $this->success(trans("main.success"));
        }catch (\Exception $e){
            return $this->fail($e->getMessage());
        }



    }
    public function updateBooking(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'id' => 'required|numeric',
                'name'=>"required",
                'email'=>'nullable|email',
                'mobile'=>'required|digits:8',
                'date'=>'required',
                'time'=>'required'
            ]);
            if ($validate->fails())
                return $this->fail($validate->errors()->first());

                $booking=Booking::find($request->id);
                $booking->name=$request->name;
                $booking->mobile=$request->mobile;
                $booking->email=$request->email;
                $booking->message=$request->message;
                $booking->date=$request->date;
                $booking->time=$request->time;
                $booking->save();


            return $this->success(trans("main.success"));

        }catch (\Exception $e){
            return $this->fail($e->getMessage());
        }


    }
    public function acceptOrRejectBooking(Request $request)
    {
        $id=$request->id;
        $status=$request->status;
        $validate = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'status'=>'required|in:accept,reject'
        ]);
        if ($validate->fails())
            return $this->fail($validate->errors()->first());


        $booking=Booking::with(["booker","user"])->whereId($id)->first();
        $booking->status=$status;
        $booking->save();
        if($request->status=="accept"){
            $title=__('accept_request');
            $message=__('accept_booking_request');
        }else{
            $title=__('reject_request');
            $message=__('reject_booking_request');
        }

        if(optional($booking->booker)->device_token!=null){
            $data = array("title" =>$title,"message" =>$message,'notify_type'=>'booking_response');
            $notification=["title" =>$title,'body'=>$message,'badge'=>1,'sound'=>'ping.aiff','notify_type'=>'booking_response'];
           // Notification::create(["user_id"=>$booking->booker->id,'device_token'=>$])
            parent::sendPushNotification($data,optional($booking->booker)->device_token,[],$notification);

        }
        return $this->success("");

    }
    public function deleteBooking(Request $request)
    {
        Booking::where('id',$request->id)->delete();
        return $this->success(trans("main.success"));

    }
    public function myBooking(Request $request)
    {
        $bookings=Booking::where("booker_id",$request->user()->id)->with(["advertising.user","advertising.area"])->whereHas("advertising")->orderBy('id','desc')->paginate(10);
        return $this->success("",$bookings);
    }
    public function myBooker(Request $request)
    {
        //where("booker_id",'!=',$request->user()->id)->
        $bookings=Booking::where('user_id',$request->user()->id)->with(["advertising.user","advertising.area"])->whereHas("advertising")->orderBy('id','desc')->paginate(10);
        return $this->success("",$bookings);
    }
    public function logVisitAdvertising(Request $request)
    {
        $advertisingId=$request->advertising_id;
        $user_id=$request->user_id;
        $device_token=$request->device_token;
        if(isset($user_id)&& $user_id!="" && $user_id!=null){
            LogVisitAdvertising::updateOrCreate(
                ['user_id' =>$user_id, 'advertising_id'=>$advertisingId],
                ['device_token' =>$device_token]
            );
        }elseif (isset($device_token)&& $device_token!="" && $device_token!=null){
            LogVisitAdvertising::updateOrCreate(
                ['device_token' =>$device_token, 'advertising_id'=>$advertisingId],
                ['user' =>null]
            );
        }
        return $this->success("");

    }
    private function bindFilter(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        $advertising = Advertising::getValidAdvertising()->whereNotNull('expire_at')->where('expire_at','>',date('Y-m-d'))->whereHas("user");;

        if (isset($request->city_id)&& $request->city_id!="-1") {
            $advertising = $advertising->where("city_id", $request->city_id);
        }
        if (isset($request->area_id)&& $request->area_id!="-1") {
            $advertising = $advertising->where("area_id", $request->area_id);
        }
        if (isset($request->advertising_type) && is_array($request->advertising_type)) {
            $advertising = $advertising->whereIn("advertising_type", $request->advertising_type);
        }elseif(isset($request->advertising_type)&&$request->advertising_type!=""){
            $advertising = $advertising->where("advertising_type", $request->advertising_type);
        }
        if (isset($request->type) && is_array($request->type)) {
            $advertising = $advertising->whereIn("type", $request->type);
        }elseif(isset($request->type)&&$request->type!=""){
            $advertising = $advertising->where("type", $request->type);
        }

        if (isset($request->venue_type)) {
            $advertising = $advertising->where("venue_type", $request->venue_type);
        }
        if (isset($request->purpose)) {
            $advertising = $advertising->where("purpose", $request->purpose);
        }
        if (isset($request->keyword)&&$request->keyword!="") {
            $advertising = $advertising->where(function ($r)use($request){
                $r->where('title_en','like','%'.$request->keyword.'%')->orWhere('title_ar','like','%'.$request->keyword.'%');
            });
        }
        if (isset($request->min_price) &&  $request->min_price!="") {
            $minPrice=floatval(trim(str_replace("KD","",$request->min_price)));
            $advertising = $advertising->where("price",'>=',$minPrice);
        }
        if (isset($request->max_price) &&  $request->max_price!="") {
            $p=floatval(trim(str_replace("KD","",$request->max_price)));
            $advertising = $advertising->where("price",'<=',$p);
        }
        if (isset($request->number_of_rooms) &&  is_numeric($request->number_of_rooms)) {
            $advertising = $advertising->where("number_of_rooms",$request->number_of_rooms);
        }

        if(isset($request->amenities)&& is_array($request->amenities)){
            $advertising=$advertising->whereHas("amenities",function ($r)use($request){
               $r->whereIn('id',$request->amenities);
            });
        }


        if(isset($request->property) && is_array($request->property)){
            if(in_array('parking',$request->property)){
                $advertising = $advertising->where("number_of_parking",'>=',1);
            }
            if(in_array('balcony',$request->property)){
                $advertising = $advertising->where("number_of_balcony",'>=',1);
            }
            if(in_array('security',$request->property)){
                $advertising = $advertising->where("security",1);
            }
            if(in_array('pool',$request->property)){
                $advertising = $advertising->where("pool",1);
            }
        }
        return $advertising;
    }
    private function validateAdvertising(Request $request,$create=true): \Illuminate\Contracts\Validation\Validator
    {
        if($create){
            return Validator::make($request->all(), [
                'title_en' => 'required|max:250',
                'title_ar' => 'nullable|max:250',
                'type' => 'required|in:residential,commercial,industrial',
                'venue_type' => 'required',
                'purpose' => 'required|in:rent,sell,exchange,required_for_rent',
                'advertising_type' => 'required|in:normal,premium',
                'city_id' => 'required',
                'area_id' => 'required',
                'price' => 'nullable|numeric',
                'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20000',
                // 'other_image' => 'nullable|array',
                //   'other_image.*' => 'mimes:jpeg,bmp,png|max:2048',
                'main_image' => 'nullable|mimes:jpeg,bmp,png|max:2048',
                'floor_plan' => 'nullable|mimes:jpeg,bmp,png|max:2048',
                'number_of_rooms' => 'nullable',
                'number_of_bathrooms' => 'nullable',
                'number_of_master_rooms' => 'nullable',
                'number_of_parking' => 'nullable',
                'gym' => 'required|in:1,0',
                'pool' => 'required|in:1,0',
                'furnished' => 'required|in:1,0',
            ]);
        }
        return Validator::make($request->all(), [
            'title_en' => 'required|max:250',
            'title_ar' => 'nullable|max:250',
            'type' => 'required|in:residential,commercial,industrial',
            'venue_type' => 'required',
            'purpose' => 'required|in:rent,sell,exchange,required_for_rent',
            'advertising_type' => 'required|in:normal,premium',
            'city_id' => 'required',
            'area_id' => 'required',
            'price' => 'nullable|numeric',
            // 'other_image' => 'nullable|array',
            //   'other_image.*' => 'mimes:jpeg,bmp,png|max:2048',
          //  'main_image' => 'nullable|mimes:jpeg,bmp,png|max:2048',
           // 'floor_plan' => 'nullable|mimes:jpeg,bmp,png|max:2048',
            'number_of_rooms' => 'nullable',
            'number_of_bathrooms' => 'nullable',
            'number_of_master_rooms' => 'nullable',
            'number_of_parking' => 'nullable',
            'gym' => 'required|in:1,0',
            'pool' => 'required|in:1,0',
            'furnished' => 'required|in:1,0',
        ]);
    }
    private function saveAdvertising(Request $request, $user, Advertising $advertising): Advertising
    {
        $advertising->user_id = $user->id;
        $advertising->city_id = $request->city_id;
        $advertising->area_id = $request->area_id;
        $advertising->type = $request->type;
        $advertising->venue_type = $request->venue_type;
        $advertising->purpose = $request->purpose;
        $advertising->advertising_type = $request->advertising_type;
        $advertising->description = $request->description;
        $advertising->price = $request->price;
        $advertising->title_en = $request->title_en;
        $advertising->title_ar = $request->title_en;
        $advertising->number_of_rooms = $request->number_of_rooms;
        $advertising->number_of_bathrooms = $request->number_of_bathrooms;
        $advertising->number_of_master_rooms = $request->number_of_master_rooms;
        $advertising->number_of_parking = $request->number_of_parking;
        $advertising->number_of_balcony = $request->number_of_balcony;
        $advertising->number_of_floor = $request->number_of_floor;
        $advertising->number_of_miad_rooms = $request->number_of_miad_rooms;
        $advertising->surface = $request->surface;
        $advertising->gym = $request->gym;
        $advertising->pool = $request->pool;
        $advertising->furnished = $request->furnished;
        $advertising->security = $request->security;
        $advertising->location_lat = $request->location_lat;
        $advertising->location_long = $request->location_long;
        $advertising->hash_number = Advertising::makeHashNumber();

        if($request->hasFile('floor_plan')){
            $advertising->floor_plan = $this->saveImage($request->floor_plan);
        }elseif($request->floor_plan=="false"){
            $advertising->floor_plan="";
        }

        if($request->hasFile('main_image')){
            $advertising->main_image =$this->saveImage($request->main_image);
        }elseif ($request->main_image=="false"){
            $advertising->main_image="/images/main/defaultbuildingimage.jpg";
        }

        $otherImage=[];
        for($i=1;$i<=10;$i++){
            if(isset($request->{"other_image".$i})){
                $file=$request->{"other_image".$i};
                if($request->hasFile("other_image".$i)){
                    $path =$this->saveImage($file);
                }elseif ($file==false||$file=="false"){
                    $path="";
                } elseif (is_string($file)){
                    $path=$file;
                }else{
                    $path="";
                }
            }else{
                $path="";
            }
            $otherImage["other_image".$i]= $path;
        }
        if(count($otherImage)>=1){
            $otherImage = json_encode($otherImage);
            $advertising->other_image = $otherImage;
        }

        if(isset($request->video)){
            if(!is_string($request->video)){
                $video=$request->video;
                $advertising->video=$this->saveVideo($video);
            }elseif($request->video=="false"){
                $advertising->video="";
            }
        }


        $advertising->save();


        $amenitiesArray=explode(",",$request->amenities);
        Log::info($amenitiesArray);

        if(isset($amenitiesArray)){
           $advertising->amenities()->sync($amenitiesArray,true);
        }
        return $advertising;
    }
    private function getComments($id)
    {
        $list = Comment::with(["user","advertising"]);
        if(is_array($id)){
            $list=$list->whereIn('advertising_id', $id);
        }else{
            $list=$list->where('advertising_id', $id);
        }
        $list=$list->orderBy('id', 'desc')->paginate(10);
        return $list;
    }
    private function makeSearchHistory($request){
        if($request->device_token!=null&&$request->device_token!="" && $request->device_token!="null"){
            $cityId=$request->city_id!=-1??0;
            $area_id=$request->area_id!=-1??0;
            DB::table("search_history")->insert(['area_id'=>$area_id,'city_id'=>$cityId,'advertising_type'=>$request->advertising_type,'type'=>$request->type,'venue_type'=>$request->venue_type,'purpose'=>$request->purpose,'main_price'=>floatval($request->main_price),'max_price'=>floatval($request->max_price),'device_token'=>$request->device_token]);
        }
    }
    private function hasLikeUser($device_token,$id)
    {
      return  DB::table("advertising_like")->where("advertising_id",$id)->where("device_token",$device_token)->count();
    }
    private function hasArchive($userId,$id)
    {
       return  DB::table("user_archive_advertising")->where("user_id",$userId)->where("advertising_id",$id)->count();
    }
    private function sendRequestForPayment($price,$refId,$user_id=null,$type=null,$package_id=null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payment.ajrnii.com/paymentInit.php?token=66a08c59-3ef4-44bb-9fbf-c6206d785f04&refid=".$refId."&amount=".$price."&user_id=".$user_id."&type=".$type."&package_id=".$package_id."&returnUrl=".route('api.callback'),
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
    public function makeRefId($userId)
    {
       return substr(time(),5,4).rand(1000,9999).$userId;
    }
    private function getInvalidKeys()
    {
        $keys=  InvalidKey::first();
        if(isset($keys)){
            $items=json_decode($keys->key_title);
        }else{
            $items=[];
        }
        return $items;
    }
    public function filterKeywords($text)
    {
        $keys=explode(" ",$text);
        $invalidKeys=$this->getInvalidKeys();
        foreach ($keys as $key) {
            if(in_array($key,$invalidKeys)){
                return [false,$key];
            }
        }
        return[true];
    }
}
