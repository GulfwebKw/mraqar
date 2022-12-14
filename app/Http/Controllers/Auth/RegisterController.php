<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Setting;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }





    /**
     * all codes like mobile api for sms verification
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // first : user inputs validation and sending sms code
    /**
     * @param RegisterRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
//        dd($request->all());
        try{

            DB::beginTransaction();

            $package=Package::where("title_en","gift credit")->first();
            $package_id = $package->id ;

            $user= User::makeUser([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'type_usage'=>$request->type_usage,
                'mobile'=>$request->mobile,
                'lang'=>'en',
                'package_id'=>$package_id,
                'image_profile'=>'/images/main/profile.jpg'
            ]);
            /*
            if($request->verified_office==1){
                $user->verified_office=1;
                $user->save();
            }
            */

            $settings=Setting::whereIn('setting_key', ['free_normal_advertising', 'free_premium_advertising'])
                ->where('is_enable',1)->get()->keyBy('setting_key');
            if(isset($package) && $settings->count()>=1){
                $countDay=optional($package)->count_day;
                $today=   date("Y-m-d");
                $date = strtotime("+$countDay day", strtotime($today));
                $expireDate=date("Y-m-d",$date);
                $settings=$settings->toArray();
                $countNormal=array_key_exists('free_normal_advertising',$settings)?intval($settings['free_normal_advertising']['setting_value']):0;
                $countPremium=array_key_exists('free_premium_advertising',$settings)?intval($settings['free_premium_advertising']['setting_value']):0;
                PackageHistory::create([
                    'title_en'=>$package->title_en,
                    'title_ar'=>$package->title_ar,
                    'user_id'=>$user->id,
                    'type'=>"static",
                    'package_id'=>$package->id,
                    'date'=>date('Y-m-d'),
                    'is_payed'=>1,
                    'price'=>$package->price,
                    'count_day'=>$package->count_day,
                    'count_show_day'=>$package->count_show_day,
                    'count_advertising'=>$countNormal,
                    'count_premium'=>$countPremium,
                    'count'=>1,
                    'accept_by_admin'=>1,
                    'expire_at'=>$expireDate
                ]);
            }
            DB::commit();
            event(new UserRegistered($user));
            return $this->success(trans('main.register_success'));

        } catch (\Exception $exception) {
            DB::rollback();
            return $this->fail("");
        }

    }
    public function registerValidation(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|digits:8|unique:users',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users',
            'type_usage'=>'required|in:company,individual',
            'language'=>'required|in:ar,en',
        ]);
    }



    /**
     *
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:8', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type_usage' => ['required', 'in:company,individual'],
            'lang' => ['required', 'in:ar,en']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
