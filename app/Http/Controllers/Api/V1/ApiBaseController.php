<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\PackageHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Johntaa\Arabic\I18N_Arabic;
class ApiBaseController extends Controller
{
    public function __construct()
    {
        if(\request()->get('language')){
           app()->setLocale(strtolower(request()->get('language')));
        }
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
    public function saveImage($image)
    {
        $mainImageFile = $image;
        $fileName = $mainImageFile->getClientOriginalName();
        $storeName = uniqid(time()).$fileName;
        $path ='/resources/uploads/images/'.$storeName;
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
	public static function mb_strrev($str){
    $r = '';
    for ($i = mb_strlen($str); $i>=0; $i--) {
        $r .= mb_substr($str, $i, 1);
    }
    return $r;
    }
    public static function makePermImageFoRSS($advertising,$lang='en')
    {
        $path="/images/template_image.png";
        $id=$advertising->id;
        $advTitle=$advertising->{'title_'.$lang};
        $area=optional($advertising->area)->{'name_'.$lang};
        $mobile=optional($advertising->user)->mobile??$advertising->phone_number;


        $image=File::get(public_path($path));
        $p=explode("/",$path);
        $name=end($p);
        array_pop($p);
        $basePath=implode('/',$p);
        $midImageUrl =$basePath.'/'.$id.'_post_'.$name;
        $img=\Image::make($image)->resize(990,1100);
       // $text=$advertising->{'description_'.$lang};
        $text =  !empty($advertising->description)?$advertising->description:'Details not available';
 
        $width       = 990 ;
        $height      = 1100;
        $center_x    = $width / 2;
        $center_y    = $height / 2;
        $max_len     = 500;
        $font_size   = 30;
        $font_height = 10;
        $lines       = explode("\n", wordwrap($text, $max_len));
        $y           = $center_y - ((count($lines) - 1) * $font_height);
		
        $Arabic = new I18N_Arabic('Glyphs');

        $rt=$advTitle;
        $title = $Arabic->utf8Glyphs($rt);
		//$t='For rent '.$title.' in '.$area;
		$t=$title;
		/*
		$aligntxt = '';
        if($lang=="en"){
        $t='For rent '.$title.' in '.$area;
		$aligntxt = 'center';
		}else{
		$t='للإيجار '.$title.' في '.$area;
		$aligntxt = 'center';
		}*/
        $aligntxt = 'center';
        $img->text($t, 500,275, function($font) use($aligntxt) {
            $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
            $font->size(38);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        foreach ($lines as $line) {
            $line = $Arabic->utf8Glyphs($line);
            $img->text($line, $center_x, $y, function ($font)use ($font_size,$aligntxt) {
                $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
                $font->size($font_size);
                $font->align('center');
                $font->valign('center');
                $font->angle(0);
            });
            $y += $font_height * 2;
        }

        $img->text($mobile,500,850, function($font) {
            $font->file(public_path('fonts/Helvetica-Font/main2.ttf'));
            $font->size(38);
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $img->save(public_path($midImageUrl));
        $advertising->rss_image=$midImageUrl;
        $advertising->save();
        return $midImageUrl;
    }
}
