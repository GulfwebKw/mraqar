<?php


namespace App\Models;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    protected $guarded=['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function advertising()
    {
        return $this->belongsTo(Advertising::class,"advertising_id");
    }



    public function reply()
    {
        return $this->belongsTo(Comment::class,"comment_id");
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
