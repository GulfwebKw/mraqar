<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view("dashboard");
    }
    public function charts()
    {
        try {
            $days=[];
            for($i=6; $i >=0 ; $i--){
                $days[]=Carbon::now()->subDay($i)->englishDayOfWeek;
            }

            $jobs=Advertising::where('status','1');
            $daysCount=[];
            for ($i=6; $i >=0 ; $i--) {
                $job=clone $jobs;
                $day1=Carbon::now()->subDay($i)->startOfDay();
                $day2=Carbon::now()->subDay($i)->endOfDay();
                $daysCount[]=$job->whereBetween('created_at',[$day1,$day2])->count();
            }

            $dailyChart = [
                'labels' => $days,
                'chartData' => $daysCount
            ];

            $month=[];
            $monthCount=[];
            for($i=12; $i >0 ; $i--){
                $month[]=Carbon::now()->subMonth($i)->englishMonth;
                $monthCount[]=0;
            }
            $totalChart = [
                'labels' =>  $month,
                'chartData' => $monthCount
            ];
            $dates=$this->getAdvertisingCurrentYar();
            foreach ($dates as $day) {
                $mo=date("F",strtotime($day->created_at));
                $mo=Carbon::now()->subMonth(intval($mo))->englishMonth;
                $index= array_search($mo,$month);
                $monthCount[$index]=$monthCount[$index]+1;
            }

            return response()->json([
                'status' => 'success',
                'data' => ['dates'=>$dates,'dailyChart' => $dailyChart, 'totalChart' => $totalChart]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }
    public function changeLocale($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    public function getDashboardInfo(Request $request)
    {
        return response()->json(['f'=>$this->getFirstAndEndWeekDay(),'individualUser'=>$this->getCountIndividualUser(),"companyUser"=>$this->getCountCompanyUser(),'payments'=>$this->getCountPayment(),"countAdvertising"=>$this->getCountAdvertising(),"countViewAdvertising"=>$this->getCountViewAdvertising(),"countClickAdvertising"=>$this->getCountClickAdvertising(),"countBookings"=>$this->getCountBocking(),"countComment"=>$this->getCountComments(),'countLikes'=>$this->getCountLikes()]);
    }

    private function getCountIndividualUser(){
        return Cache::remember('IndividualUserCount',5,function(){
                $date=$this->getFirstAndEndDayFormat();
                $dateWeek=$this->getFirstAndEndWeekDay();
                $dateMonth=$this->getFirstAndEndMonthDay();
                $userCountDay=   User::where("type_usage","individual")->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
                $userCountWeek=   User::where("type_usage","individual")->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
                $userCountMonth=   User::where("type_usage","individual")->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
                return[$userCountDay,$userCountWeek,$userCountMonth];

        });
  }
    private function getCountCompanyUser()
  {
      return Cache::remember('CompanyUser',5,function(){
          $date=$this->getFirstAndEndDayFormat();
          $dateWeek=$this->getFirstAndEndWeekDay();
          $dateMonth=$this->getFirstAndEndMonthDay();
          $userCountDay=   User::where("type_usage","company")->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
          $userCountWeek=   User::where("type_usage","company")->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
          $userCountMonth=   User::where("type_usage","company")->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
          return[$userCountDay,$userCountWeek,$userCountMonth];

      });

  }
    private function getCountPayment(){

        return Cache::remember('CountPaymentUser',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     Payment::where("status","completed")->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->select(DB::raw("SUM(price) as sum"),DB::raw("COUNT(id) as count"))->get();
            $userCountWeek=    Payment::where("status","completed")->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->select(DB::raw("SUM(price) as sum"),DB::raw("COUNT(id) as count"))->get();
            $userCountMonth=   Payment::where("status","completed")->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->select(DB::raw("SUM(price) as sum"),DB::raw("COUNT(id) as count"))->get();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });

    }
    private function getCountLikes(){
        return Cache::remember('CountLikes',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $countDay=     DB::table('advertising_like')->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $countWeek=    DB::table('advertising_like')->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $countMonth=   DB::table('advertising_like')->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$countDay,$countWeek,$countMonth];
        });
    }
    private function getCountAdvertising(){
        return Cache::remember('CountAdvertising',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     Advertising::where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $userCountWeek=    Advertising::where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $userCountMonth=   Advertising::where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });
    }
    public function getCountViewAdvertising()
    {
        return Cache::remember('CountViewAdvertising',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     DB::table('advertising_view')->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $userCountWeek=    DB::table('advertising_view')->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $userCountMonth=   DB::table('advertising_view')->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });
    }
    public function getCountClickAdvertising()
    {
        return Cache::remember('CountClickAdvertising',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     DB::table('log_visit_number')->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $userCountWeek=    DB::table('log_visit_number')->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $userCountMonth=   DB::table('log_visit_number')->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });
    }
    public function getCountBocking()
    {
        return Cache::remember('CountBockingAdvertising',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     DB::table('bookings')->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $userCountWeek=    DB::table('bookings')->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $userCountMonth=   DB::table('bookings')->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });

    }
    public function getCountComments()
    {
        return Cache::remember('CountCommentsAdvertising',5,function(){
            $date=$this->getFirstAndEndDayFormat();
            $dateWeek=$this->getFirstAndEndWeekDay();
            $dateMonth=$this->getFirstAndEndMonthDay();
            $userCountDay=     DB::table('comments')->where('created_at','>=',$date[0])->where('created_at','<=',$date[1])->count();
            $userCountWeek=    DB::table('comments')->where('created_at','<=',$dateWeek[0])->where('created_at','>=',$dateWeek[1])->count();
            $userCountMonth=   DB::table('comments')->where('created_at','<=',$dateMonth[0])->where('created_at','>=',$dateMonth[1])->count();
            return[$userCountDay,$userCountWeek,$userCountMonth];
        });

    }

    public function getAdvertisingCurrentYar()
    {
        return Cache::remember('IndividualUserCounts',200,function() {
          $start=date('Y-m-d h:i:s',strtotime(date('Y')."-01-01 00:00:00"));
          $end=date('Y-m-d h:i:s',strtotime(date('Y')."-12-30 23:59:59"));
           return   DB::table('advertisings')->where('created_at','>=',$start)->where('created_at','<=',$end)->select('created_at')->get();
        });
    }
    
    public function getFirstAndEndDayFormat()
    {
        $beginOfDay = strtotime("today", time());
        $endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;
        return [date('Y-m-d',$beginOfDay)." 00:00:00",date('Y-m-d h:i:s',$endOfDay)];
    }
    public function getFirstAndEndWeekDay()
    {
        $beginOfDay = strtotime("today", time());
        $endOfToDay   = strtotime("tomorrow", $beginOfDay) - 1;
        $endOfDay  = strtotime("-7 day",$endOfToDay);
        return [date('Y-m-d h:i:s',$endOfToDay),date('Y-m-d h:i:s',$endOfDay)];
    }
    public function getFirstAndEndMonthDay()
    {
        $beginOfDay = strtotime("today", time());
        $endOfToDay   = strtotime("tomorrow", $beginOfDay) - 1;
        $endOfDay  = strtotime("-30 day",strtotime("today", time()));
        return [date('Y-m-d h:i:s',$endOfToDay),date('Y-m-d h:i:s',$endOfDay)];
    }



}
