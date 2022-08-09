<?php


namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
    protected $guarded=['id'];
    public function advertising()
    {
        return $this->belongsTo(Advertising::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booker()
    {
        return $this->belongsTo(User::class,'booker_id');
    }
}
