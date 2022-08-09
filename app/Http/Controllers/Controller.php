<?php

namespace App\Http\Controllers;

use App\Models\InvalidKey;
use App\Models\PackageHistory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveFile($file,$type="file")
    {
        $fileName = time() . '.' . $file->getClientOriginalName();
        $file->move('resources/assets/images/user_image/', $fileName);
        return '/resources/assets/images/user_image/'.$fileName;
    }

    public static function returnDateTimeFormat($date)
    {
        $time=strtotime($date);
        return date("Y-m-d H:i:s",$time);
    }

    public static function sendPushNotification($data, $to, $options,$notification=null)
    {
        $apiKey =env('PUSHY_KEY');
        $post = $options ?: array();
        $post['to'] = $to;
        $post['data'] = $data;
        if($notification!=null){
            $post['notification'] = $notification;
        }
        $headers = array(
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.pushy.me/push?api_key=' . $apiKey);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
        }
        return $result;

    }

    public static function returnDateFormat($date)
    {
        $time=strtotime($date);
        return date("Y-m-d",$time);
    }

    public static function getNotificationMessage()
    {
      return  DB::table("notification_message")->select("*")->get()->keyBy("key");
    }

    public static  function sendSms($message,$mobile)
    {
        $post="msg=".urlencode($message)."&number=".$mobile."&key=".env('SMS_API_KEY')."&dezsmsid=".env('DEZSMS_ID')."&senderid=".env('SENDER_ID')."&xcode=965";
        return  self::__curl($post);
    }
    public static function __curl($post){
        try{
            $ch = curl_init(env('API_SMS_URL'));
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,  $post);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER , 1);
            $result= curl_exec ($ch);
            curl_close ($ch);
            unset($ch);
            if($result==100){
                unset($result);
                return true;
            }
            return false;
        }catch (\Exception $exception){
            return false;
        }

    }

    public function makeSocialImage($post)
    {
        $path="/images/template_image.jpeg";
        $id=3;



        $image=File::get(public_path($path));
        $p=explode("/",$path);
        $name=end($p);
        array_pop($p);
        $basePath=implode('/',$p);
        $midImageUrl =$basePath.'/'.$id.'_post_'.$name;
        $img=\Image::make($image)->resize(1000,1000);
        $text="this is window this is  szdmkmd skdlkjsk skdjsk dsdmskk m dsdksd skdjskd \n sdksjdkmsd skdksd sdjksjd \n sdskdks skdjsk sdkjksd skdjksd sdksjd sdksjdkjskdj asdasd asdasd asdasdasd asdasdsad asdasdas sadd eeeeeeeend ";

        $width       = 1000 ;
        $height      = 800;
        $center_x    = $width / 2;
        $center_y    = $height / 2;
        $max_len     = 90;
        $font_size   = 17;
        $font_height = 12;
        $lines = explode("\n", wordwrap($text, $max_len));
        $y     = $center_y - ((count($lines) - 1) * $font_height);

        $img->text('For rent yyyyyy in xxxxx ', 500,300, function($font) {
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

        $img->text('66444569 ',500,600, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/Helvetica-Bold.ttf'));
            $font->size(17);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $img->save(public_path($midImageUrl));

        dd($midImageUrl);
    }
    public function success($message, $data=null, $status=1)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
    public function fail($message, $status=-1, $errors=null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors
        ]);
    }
    public function isValidCreateAdvertising($userId,$type)
    {
        $result= $this->getCreditUser($userId);
        if(count($result)>=1){
            if($type=="normal"){
                if($result["count_normal_advertising"]>=1){
                    return true;
                }
            }elseif($type=="premium" && $result["count_premium_advertising"]>=1){
                return true;
            }
            return false;
        }
        return false;
    }
    public function getCreditUser($userId)
    {
        $date=date("Y-m-d");
        $packages=DB::table("user_package_history")
            ->where("expire_at",'>',$date)
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

    public function affectCreditUser($userId,$type)
    {
        $listBalance= PackageHistory::where("user_id",$userId)
            ->where("expire_at",">",date("Y-m-d"))
            ->where("accept_by_admin",1)
            ->where('is_payed',1)
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
            return $listBalance->count_show_day;
        }
    }
    public function saveImage($image)
    {
        $mainImageFile = $image;
        $fileName = $mainImageFile->getClientOriginalName();
        $storeName = uniqid(time()).$fileName;
        $path ='/resources/uploads/images/'.$storeName;
//        $mainImageFile->store('/resources/uploads/images/',config('filesystems.public'));
//        Storage::put(('public/resources/uploads/images/'),$mainImageFile  );
        $mainImageFile->move(public_path('resources/uploads/images/'), $storeName);
        return $path;
    }
    public function saveVideo($video)
    {
        $extension = $video->getClientOriginalExtension();
        $storeName = time().uniqid().".". $extension;
        $path = 'resources/uploads/videos/'. $storeName;
        $video->move(public_path('resources/uploads/videos/'), $storeName);
        return $path;

    }
    public static function uploadBase64Image($inputName, $path)
    {
        $image_64 = \request($inputName);  // your base64 encoded
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10).'.'.$extension;
        Storage::put($path. '/' . $imageName, base64_decode($image));
        return $imageName;


    }
    public function filterKeywords($text)
    {
        $keys = explode(" ", $text);
        $invalidKeys = $this->getInvalidKeys();
        foreach ($keys as $key) {
            if (in_array($key, $invalidKeys)) {
                return [false, $key];
            }
        }
        return [true];
    }
    private function getInvalidKeys()
    {
        $keys = InvalidKey::first();
        if (isset($keys)) {
            $items = json_decode($keys->key_title);
        } else {
            $items = [];
        }
        return $items;
    }
}
