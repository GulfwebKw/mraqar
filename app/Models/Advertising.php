<?php

namespace App\Models;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Advertising extends Model implements Feedable
{
    use SoftDeletes;

    const TYPES = [
        'RESIDENTIAL' => 'residential',
        'COMMERCIAL' => 'commercial',
        'INDUSTRIAL' => 'industrial',
    ];
    const RSE = [
        'Rent' => 'rent',
        'Sell' => 'sell',
        'Exchange' => 'exchange',
    ];
    const RESIDENTIALS = [
        'Apartment' => 'apartment',
        'Villa' => 'villa',
        'Rest_house' => 'rest_house',
    ];
    const COMMERCIALS = [
        'Shop' => 'shop',
        'Office' => 'office',
        'Land' => 'land',
        'Building' => 'building',
    ];
    const INDUSTRIALS = [
        'Shop' => 'shop',
        'Office' => 'office',
        'Building' => 'building',
    ];
    protected $guarded = ['id'];
    protected $appends = ['total', 'view_count'];


    /**
     * Get the user's first name.
     *
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }


    public function getExpireAtAttribute($value)
    {
        if (isset($value) && $value != null && $value != "null" && $value < date('Y-m-d'))
            return $value;
        // return Carbon::parse($value)->diffForHumans();

        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'amenities_advertising', 'advertising_id', 'amenities_id');
    }


    public static function getValidAdvertising($status = 1): Builder
    {
        $ad = Advertising::with(["user", "area", "city"])
            ->orderBy("advertising_type", "desc")->orderBy('id', 'desc');
        if ($status == 1) {
            $ad = $ad->where('status', 'accepted');
        }
        return $ad;

    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'advertising_id');
    }

    /**
     * @return array|\Spatie\Feed\FeedItem
     */
    public function toFeedItem()
    {
        $lang = request()->get('lang');
        if (empty($lang)) {
            $lang = 'en';
        }

        //dd(ApiBaseController::makePermImageFoRSS($this,$lang));
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->{'title_' . $lang},
            'summary' => $this->{'description_' . $lang} ?? '',
            'updated' => $this->updated_at,
            'link' => ApiBaseController::makePermImageFoRSS($this, $lang),
            'mobile' => $this->phone_number,
            'author' => optional($this->user)->name ?? '',
        ]);
    }

    public static function getFeedItems()
    {
        return Advertising::where('advertising_type', 'premium')->where('status', 'accepted')->where('expire_at', '>=', date('Y-m-d'))->orderBy('created_at', 'desc')->get();
    }

    public function advertisingLikes()
    {
        return $this->hasMany(AdvertisingLike::class);
    }

    public function advertisingView()
    {
        return $this->hasMany(AdvertisingView::class);
    }

    public function getTotalAttribute()
    {
        return sizeof(self::advertisingView()->get());
    }

    public function getViewCountAttribute($value)
    {
        return count($this->advertisingView);
    }

    public function getLikesCountAttribute($value)
    {
        return count($this->advertisingLikes);
    }

    public static  function makeHashNumber()
    {
        do {
            $hash = uniqid();
            $data = Advertising::where('hash_number',$hash)->first();
        }
        while ($data);

        return $hash;

    }


}
