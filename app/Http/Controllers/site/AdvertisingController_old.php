<?php

namespace App\Http\Controllers\site;

use App\Events\NewAdvertising;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Advertising\StoreRequest;
use App\Models\Advertising;
use App\Models\AdvertisingView;
use App\Models\Amenities;
use App\Models\Area;
use App\Models\City;
use App\Models\InvalidKey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
//use function GuzzleHttp\Promise\all;

class AdvertisingController extends Controller
{
    public function search(Request $request)
    {
        $advertisings = $this->bindFilter($request);
        $advertisings = $advertisings->with(['user', 'city', 'area'])->paginate(9)->appends(request()->query());
        $cities = City::orderBy('name_en')->get();
        $areas = Area::orderBy('name_en')->get();
        if ($request->wantsJson()) {
            return $this->success("", $advertisings);
        }
//        return $advertisings;
        return view('site.search-result.search-result', compact('advertisings', 'cities', 'areas'));
    }

    /**
     * @param Request $request
     * @return Builder
     */
    private function bindFilter(Request $request): Builder
    {
        $advertising = Advertising::getValidAdvertising()->whereNotNull('expire_at')
            ->where('expire_at', '>', date('Y-m-d'))->whereHas("user");
//        dd($request->all());
//        if (isset($request->city_id) && $request->city_id != "-1") {
//            $advertising = $advertising->where("city_id", $request->city_id);
//        }
        if (isset($request->area) && $request->area != "-1") {
          $area=  Area::where('name_en',$request->area)->first();
            $advertising = $advertising->where("area_id", $area->id);
        }
        if (isset($request->advertising_type) && is_array($request->advertising_type)) {
            $advertising = $advertising->whereIn("advertising_type", $request->advertising_type);
        } elseif (isset($request->advertising_type) && $request->advertising_type != "") {
            $advertising = $advertising->where("advertising_type", $request->advertising_type);
        }
        if (isset($request->type) && is_array($request->type)) {
            $advertising = $advertising->whereIn("type", $request->type);
        } elseif (isset($request->type) && !is_null($request->type)) {
            $advertising = $advertising->where("type", $request->type);
        }

        if (isset($request->venue_type) && !is_null($request->venue_type)) {
            $advertising = $advertising->where("venue_type", $request->venue_type);
        }
        if (isset($request->rse) && !is_null($request->rse)) {
            $advertising = $advertising->where("rse", $request->rse);
        }
        if (isset($request->keyword) && !is_null($request->keyword)) {
            $advertising = $advertising->where(function ($r) use ($request) {
                $r->where('title_en', 'like', '%' . $request->keyword . '%')->orWhere('title_ar', 'like', '%' . $request->keyword . '%');
            });
        }
        if (isset($request->min_price) && $request->min_price != "") {
            $minPrice = floatval(trim(str_replace("KD", "", $request->min_price)));
            $advertising = $advertising->where("price", '>=', $minPrice);
        }
        if (isset($request->max_price) && $request->max_price != "") {
            $p = floatval(trim(str_replace("KD", "", $request->max_price)));
            $advertising = $advertising->where("price", '<=', $p);
        }
        if (isset($request->number_of_rooms) && is_numeric($request->number_of_rooms)) {
            $advertising = $advertising->where("number_of_rooms", $request->number_of_rooms);
        }

        if (isset($request->amenities) && is_array($request->amenities)) {
            $advertising = $advertising->whereHas("amenities", function ($r) use ($request) {
                $r->whereIn('id', $request->amenities);
            });
        }


        if (isset($request->property) && is_array($request->property)) {
            if (in_array('parking', $request->property)) {
                $advertising = $advertising->where("number_of_parking", '>=', 1);
            }
            if (in_array('balcony', $request->property)) {
                $advertising = $advertising->where("number_of_balcony", '>=', 1);
            }
            if (in_array('security', $request->property)) {
                $advertising = $advertising->where("security", 1);
            }
            if (in_array('pool', $request->property)) {
                $advertising = $advertising->where("pool", 1);
            }
        }
        return $advertising;
    }

    // add listing

    public function create()
    {
        return view('site.advertising.create');
    }

    /**
     *
     * residential ads menu
     *
     */


    public function residentials()
    {
        $residentials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function latestResidentials()
    {
        $residentials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function highestPriceResidentials()
    {
        $residentials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'desc')
            ->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Highest price Ads'
        ]);
    }

    public function lowestPriceResidentials()
    {
        $residentials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'asc')
            ->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Lowest price Ads'
        ]);
    }

    public function mostVisitedResidentials()
    {
        $residentials = Advertising::withCount('advertisingView')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_view_count', 'desc')->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Most Visited Ads'
        ]);
    }

    public function mostLikedResidentials()
    {
        $residentials = Advertising::withCount('advertisingLikes')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'residential')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_likes_count', 'desc')->paginate(18);

        return view('site.pages.residentials', [
            'residentials' => $residentials,
            'sort' => 'Most Liked Ads'
        ]);
    }


    /**
     *
     * industrial ads menu
     *
     */


    public function industrials()
    {
        $industrials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function latestIndustrials()
    {
        $industrials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function highestPriceIndustrials()
    {
        $industrials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'desc')
            ->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Highest price Ads'
        ]);
    }

    public function lowestPriceIndustrials()
    {
        $industrials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'asc')
            ->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Lowest price Ads'
        ]);
    }

    public function mostVisitedIndustrials()
    {
        $industrials = Advertising::withCount('advertisingView')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_view_count', 'desc')->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Most Visited Ads'
        ]);
    }

    public function mostLikedIndustrials()
    {
        $industrials = Advertising::withCount('advertisingLikes')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'industrial')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_likes_count', 'desc')->paginate(18);

        return view('site.pages.industrials', [
            'industrials' => $industrials,
            'sort' => 'Most Liked Ads'
        ]);
    }


    /**
     *
     * commercial ads menu
     *
     */


    public function commercials()
    {
        $commercials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function latestCommercials()
    {
        $commercials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Latest Ads'
        ]);
    }

    public function highestPriceCommercials()
    {
        $commercials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'desc')
            ->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Highest price Ads'
        ]);
    }

    public function lowestPriceCommercials()
    {
        $commercials = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'asc')
            ->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Lowest price Ads'
        ]);
    }

    public function mostVisitedCommercials()
    {
        $commercials = Advertising::withCount('advertisingView')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_view_count', 'desc')->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Most Visited Ads'
        ]);
    }

    public function mostLikedCommercials()
    {
        $commercials = Advertising::withCount('advertisingLikes')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'normal')
            ->where('type', 'commercial')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_likes_count', 'desc')->paginate(18);

        return view('site.pages.commercials', [
            'commercials' => $commercials,
            'sort' => 'Most Liked Ads'
        ]);
    }


    /**
     *
     * premium ads menu
     *
     */


    public function premiums()
    {
        $premiums = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Latest Ads'
        ]);
    }

    public function latestPremiums()
    {
        $premiums = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Latest Ads'
        ]);
    }

    public function highestPricePremiums()
    {
        $premiums = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'desc')
            ->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Highest price Ads'
        ]);
    }

    public function lowestPricePremiums()
    {
        $premiums = Advertising::where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('price', 'asc')
            ->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Lowest price Ads'
        ]);
    }

    public function mostVisitedPremiums()
    {
        $premiums = Advertising::withCount('advertisingView')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_view_count', 'desc')->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Most Visited Ads'
        ]);
    }

    public function mostLikedPremiums()
    {
        $premiums = Advertising::withCount('advertisingLikes')
            ->where('expire_at', '>', date('Y-m-d'))
            ->where('advertising_type', 'premium')
            ->whereNotNull('expire_at')
            ->orderBy('advertising_likes_count', 'desc')->paginate(18);

        return view('site.pages.premiums', [
            'premiums' => $premiums,
            'sort' => 'Most Liked Ads'
        ]);
    }

    //////////////////////////////////
    // delete Ads
    //////////////////////////////////

    public function delete(Request $request, Advertising $advertising)
    {
        $this->authorize('delete', $advertising);
        $ad = Advertising::find($request->adid);

        if ($ad->delete()) {
            return redirect()->route('Main.myAds',app()->getLocale())->with(['status' => 'success']);
        } else {
            return redirect()->route('Main.myAds',app()->getLocale())->with(['status' => 'unsuccess']);
        }
    }

    /////////////////////////////////
    /// advertising details
    /////////////////////////////////


    public function details($locale,$hashNumber)
    {
        $this->addView($hashNumber);
        $advertising = Advertising::where('hash_number', $hashNumber)->with(['user','city','area', 'amenities', 'comments' => function ($q) {
            $q->where('status', 1)->with(['user']);
        }, 'advertisingView', 'advertisingLikes', 'area', 'city'])->first();
//          dd(collect(json_decode($advertising->other_image))->toArray());
//        return $advertising->advertisingView;
        $relateds = Advertising::where('expire_at', '>=', Carbon::now())->orderBy('id', 'desc')->where('id', '!=', $advertising->id)->limit(6)->get();
        return view('site.advertising.details', compact('advertising', 'relateds'));
    }

    public function addView($hashNumber)
    {

        if (Auth::check()) {
            $advertising = Advertising::where('hash_number', $hashNumber)->with([ 'advertisingView'=>function($q){
                $q->where('user_id', Auth::user()->id)->orWhere('guest_ip', session()->get('user_guest'));
            }])->first();
//            dd(($advertising->advertisingView));
            if (count($advertising->advertisingView) === 0) {
                $advertising->advertisingView()->create([
                    'user_id' => Auth::user()->id,
                    'guest_ip' => session()->get('user_guest')
                ]);
            }
        } else {
            $advertising = Advertising::where('hash_number', $hashNumber)->with([ 'advertisingView'=>function($q){
                $q->Where('guest_ip', session()->get('user_guest'));
            }])->first();
            if (count($advertising->advertisingView) === 0) {
                $advertising->advertisingView()->create([
                    'guest_ip' =>session()->get('user_guest')
                ]);
            }
        }

    }

    public function payment_result()
    {
        dd(\request()->all());
    }

    public function getAmenities()
    {
        return Amenities::all();
    }

    public function getCities()
    {
//        dd(\request()->all());
        return City::orderBy('name_en')->get();
    }

    public function getAreas()
    {
        return Area::whereCityId(\request('city_id'))->orderBy('name_en')->get();
    }

    public function store(StoreRequest $request)
    {
        try {
            $result = $this->filterKeywords($request->description);

            if (!$result[0]) {
                return $this->fail("invalid Keyword (" . $result[1] . ")", -1, $request->all());
            }
            $result2 = $this->filterKeywords($request->title_en);

            if (!$result2[0]) {
                return $this->fail("invalid Keyword (" . $result2[1] . ")", -1, $request->all());
            }

            $user = auth()->user();
            $isValid = $this->isValidCreateAdvertising($user->id, $request->advertising_type);

            if ($isValid) {
                DB::beginTransaction();
                $advertising = new Advertising();
                $advertising = $this->saveAdvertising($request, $advertising);
                $countShowDay = $this->affectCreditUser($user->id, $request->advertising_type);
                $today = date("Y-m-d");
                $date = strtotime("+$countShowDay day", strtotime($today));
                $expireDate = date("Y-m-d", $date);
                $advertising->expire_at = $expireDate;
                $advertising->save();
                DB::commit();
                return $this->success("", ['advertising' => $advertising]);
            }
            return $this->fail(trans("main.expire_your_credit"));
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->fail($exception->getMessage(), -1, $request->all());
        }
    }

    /**
     * @param Request $request
     * @param $user
     * @param Advertising $advertising
     * @return Advertising
     */
    private function saveAdvertising(Request $request, Advertising $advertising): Advertising
    {
        $advertising->user_id = Auth::user()->id;
        $advertising->city_id = $request->city_id;
        $advertising->area_id = $request->area_id;
        $advertising->type = $request->type;
        $advertising->venue_type = $request->venue_type;
        $advertising->rse = $request->rse;
        $advertising->advertising_type = $request->advertising_type;
        $advertising->description = $request->description;
        $advertising->price = $request->price;
        $advertising->title_en = $request->title_en;
        $advertising->title_ar = $request->title_en;
        $advertising->number_of_rooms = $request->number_of_rooms ? $request->number_of_rooms : null;
        $advertising->number_of_bathrooms = $request->number_of_bathrooms ? $request->number_of_bathrooms : null;
        $advertising->number_of_master_rooms = $request->number_of_master_rooms ? $request->number_of_master_rooms : null;
        $advertising->number_of_parking = $request->number_of_parking ? $request->number_of_parking : null;
        $advertising->number_of_balcony = $request->number_of_balcony ? $request->number_of_balcony : null;
        $advertising->number_of_floor = $request->number_of_floor ? $request->number_of_floor : null;
        $advertising->number_of_miad_rooms = $request->number_of_miad_rooms ? $request->number_of_miad_rooms : null;
        $advertising->surface = $request->surface ? $request->surface : null;
        $advertising->gym = $request->gym;
        $advertising->pool = $request->pool;
        $advertising->furnished = $request->furnished;
        $advertising->security = $request->security;
        $advertising->location_lat = $request->location_lat;
        $advertising->location_long = $request->location_long;
        $advertising->hash_number = Advertising::makeHashNumber();

        if ($request->hasFile('main_image')) {
            $advertising->main_image = $this->saveImage($request->main_image);
        } else  {
            //dd($request);
            $advertising->main_image = $request->main_image;
        }

        if ($request->hasFile('floor_plan')) {
            $advertising->floor_plan = $this->saveImage($request->floor_plan);
        } elseif ($request->floor_plan == "false") {
            $advertising->floor_plan = "";
        }

        $otherImage = [];
        for ($i = 1; $i <= 6; $i++) {
            if ($request["other_image" . $i]) {
                $file = $request["other_image" . $i];
                if ($request->hasFile("other_image" . $i)) {
                    $path = $this->saveImage($request->file("other_image" . $i));
                } elseif (is_string($file)) {
                    $path = $file;
                } else {
                    $path = "";
                }
            } else {
                $path = "";
            }
            $otherImage["other_image" . $i] = $path;
        }

        if (count($otherImage) >= 1) {
            $otherImage = json_encode($otherImage);
            $advertising->other_image = $otherImage;
        }

        if (isset($request->video)) {
            if (!is_string($request->video)) {
                $video = $request->video;
                $advertising->video = $this->saveVideo($video);
            } elseif ($request->video == "false") {
                $advertising->video = "";
            }
        }


        $advertising->save();

        $selectedAmenities = json_decode($request->selectedAmenities);
        $amenitiesArray = (collect($selectedAmenities)->pluck('id'))->toArray();
        if (isset($amenitiesArray)) {
            $advertising->amenities()->sync($amenitiesArray, true);
        }
//        event(new NewAdvertising($advertising));
        return $advertising;
    }





    public function edit($locale,$hashNumber)
    {
        $advertising = Advertising::where('hash_number', $hashNumber)->with(['amenities'])->first();
//        $photo=collect(json_decode($advertising->other_image))->toArray();
//         dd($photo['other_image1']);
        return view('site.advertising.edit', compact('advertising'));
    }

    public function updateAdvertising(Request $request)
    {
        try {
            $advertising = Advertising::find($request->id);
            if (isset($advertising)) {
                $advertising = $this->saveAdvertising($request, $advertising);
                return $this->success("");
            }
            return $this->fail("not_found_advertising");

        } catch (\Exception $exception) {
            return $this->fail("server_error");
        }

    }

    public function destroyAdvertising()
    {
        $advertising = Advertising::whereId(\request('id'))->where('user_id', Auth::user()->id)->first();
//        dd($advertising);

        $massage = 'unsuccess';
        if ($advertising) {
            $advertising->amenities()->detach();
            $massage = 'success';
            $advertising->delete();
        }
        return redirect()->route('Main.myAds',app()->getLocale())->with('status', $massage);
    }

    public function simpleSaveVideo()
    {
        dd($i = 1);
//        dd(\request()->all());
    }

    public function advertisingLocation($locale,$hashNumber)
    {
        $advertising=Advertising::where('hash_number',$hashNumber)->first();
        return view('site.advertising.location',compact('advertising'));
    }
    public function advertisingDirection($locale,$hashNumber)
    {
        $advertising=Advertising::where('hash_number',$hashNumber)->first();
//        return $advertising;
        return view('site.advertising.direction',compact('advertising'));
    }
}
