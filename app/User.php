<?php

namespace App;

use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\AdvertisingLike;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Payment;
use App\Models\StaticPackage;
use App\Models\Social;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class User extends Authenticatable //implements Illuminate\Contracts\Auth\CanResetPassword
{
    // Illuminate\Auth\Passwords\CanResetPassword;
    use Notifiable;
    protected $guarded=['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisingLikes()
    {
        return $this->belongsToMany(Advertising::class,AdvertisingLike::class);

    }
    public function advertising()
    {
        return $this->hasMany(Advertising::class)->orderBy('sort','asc');
    }

    public function bocking()
    {
        return $this->hasMany(Booking::class,'booker_id')->orderBy('id','desc');
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function sales()
    {
        return $this->hasMany(PackageHistory::class)->orderBy('id','desc');
    }
    public function archiveAdvertising()
    {
        return $this->belongsToMany(Advertising::class,'user_archive_advertising');
    }
    public function staticPackages()
    {
        return $this->belongsToMany(StaticPackage::class,"user_static_package")->withPivot(['user_id','static_package_id','count','count_usage','created_at','expire_at']);
    }

    public static function makeUser(array $data)
    {
        $user=User::create($data);
         return $user;
    }
    public static function getAllMembers()
    {
        return   User::where('type','member')->get();
    }
    public static function getAllCompanyUsers()
    {
        return   User::where('type_usage','company')->get();
    }

    public static function getAllPotentialUsers()
    {
     return   User::where('type','member')->whereHas("payments",function ($r){
            $r->where('status','canceled')->orWhere('status','failed');
        })->count();
    }
    public static function getAllIndividualUsers()
    {
        return   User::where('type_usage','individual')->get();
    }

    /**
     * @param array $deviceTokens
     * @param string $titleEn
     * @param string $titleAr
     * @param string $messageEn
     * @param string $messageAr
     */
    public static function makeAndSendNotification(array $deviceTokens,$titleEn="",$titleAr="",$messageEn="",$messageAr="",$type="normal"): void
    {
        foreach ($deviceTokens as $userId => $deviceToken) {
            $data = array("title" =>$titleEn, "message" => $messageEn, 'notify_type' => 'new_booking');
            $notification = ["title" =>$titleEn, 'body' => $messageEn, 'badge' => 1, 'sound' => 'ping.aiff', 'notify_type' => 'new_booking'];
            Controller::sendPushNotification($data, $deviceToken, [], $notification);
            Notification::create(['user_id' => $userId, 'device_token' => $deviceToken,'title_ar' =>$titleAr,'title_en'=>$titleEn,'message_en' => $messageEn,'message_ar'=>$messageAr,'type'=>$type]);
        }
    }

    public static function pluckDeviceToken($list)
    {
        $deviceToken=[];
        foreach ($list as $item) {
            if($item->device_token!=null && $item->device_token!="" && $item->device_token!="null")
                $deviceToken[$item->id]=$item->device_token;
        }
        return $deviceToken;
    }

    public static function getUserHasNotVisitAdvertising($repetitious=false)
    {
        $ids=DB::table("log_visit_number")->pluck('user_id')->toArray();
        if(!$repetitious){
            $inctiveNotifyList=Notification::where("type","UserHasNotVisitAdvertising")->pluck('user_id')->toArray();
            return   User::where('type','member')->whereNotIn('id',$inctiveNotifyList)->whereNotIn('id',$ids)->get();
        }
        return   User::where('type','member')->whereNotIn('id',$ids)->get();

    }
    public static function getInactiveUsers($repetitious=false)
    {
        $today=date("Y-m-d");
        $date = strtotime("-15 day", strtotime($today));
        $validDate=date("Y-m-d",$date);
        if(!$repetitious){
            $inctiveNotifyList=Notification::where("type","InactiveUsers")->pluck('user_id')->toArray();
            return   User::where('last_activity','<=',$validDate)->where('type','member')->whereNotIn('id',$inctiveNotifyList)->get();
        }
        return   User::where('last_activity','<=',$validDate)->where('type','member')->get();


    }
    public static function getUserNotBocked($repetitious=false)
    {
        if(!$repetitious){
            $notUserNotBocked=Notification::where("type","UserNotBocked")->pluck('user_id')->toArray();
            return   User::where('type','member')->has("bocking","<",1)->whereNotIn('id',$notUserNotBocked)->get();
        }
        return   User::where('type','member')->has("bocking","<",1)->get();

    }
    public static function getUserHasNotSale($repetitious=false)
    {
        if(!$repetitious){
            $userHasNotSale=Notification::where("type","UserHasNotSale")->pluck('user_id')->toArray();
            return  User::where('type','member')->has("sales","<","2")->whereNotIn('id',$userHasNotSale)->get();
        }
        return  User::where('type','member')->has("sales","<","2")->get();

    }

    public static function notifyUserHasNotVisitAdvertising($titleEn="",$titleAr="",$messageEn="",$messageAr="",$repetitious=false)
    {
        $inactiveUsers=self::getUserHasNotVisitAdvertising($repetitious);
        $deviceTokens=self::pluckDeviceToken($inactiveUsers);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr,"UserHasNotVisitAdvertising");
    }

    public static function notifyInactiveUsers($titleEn="",$titleAr="",$messageEn="",$messageAr="",$repetitious=false)
    {
         $inactiveUsers=self::getInactiveUsers($repetitious);
         $deviceTokens=self::pluckDeviceToken($inactiveUsers);
         self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr,"InactiveUsers");
    }
    public static function notifyUserNotRegisteredComment($titleEn,$titleAr,$messageEn,$messageAr,$repetitious=false)
    {
        $userNotRegisteredComment=self::getUserNotRegisteredComment($repetitious);
        $deviceTokens=self::pluckDeviceToken($userNotRegisteredComment);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr,"NotRegisteredComment");
    }
    public static function notifyUserNotBocked($titleEn,$titleAr,$messageEn,$messageAr,$repetitious=false)
    {
        $list=self::getUserNotBocked($repetitious);
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr,"UserNotBocked");
    }
    public static function notifyUserHasNotSale($titleEn,$titleAr,$messageEn,$messageAr,$repetitious=false)
    {
        $list=self::getUserHasNotSale($repetitious);
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr,"UserHasNotSale");
    }
    public static function notifyAllUsers($titleEn,$titleAr,$messageEn,$messageAr)
    {
        $list=self::getAllMembers();
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr);
    }
    public static function notifyAllIndividualUsers($titleEn,$titleAr,$messageEn,$messageAr)
    {
        $list=self::getAllIndividualUsers();
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr);
    }
    public static function notifyAllCompanyUser($titleEn,$titleAr,$messageEn,$messageAr)
    {
        $list=self::getAllCompanyUsers();
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr);
    }

    public static function notifyPotentialUser($titleEn,$titleAr,$messageEn,$messageAr)
    {
        $list=self::getAllPotentialUsers();
        $deviceTokens=self::pluckDeviceToken($list);
        self::makeAndSendNotification($deviceTokens,$titleEn,$titleAr,$messageEn,$messageAr);
    }


    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function getIsCompanyAttribute()
    {
        return $this->type_usage === 'company';
    }
}

