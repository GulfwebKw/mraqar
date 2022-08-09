<?php


namespace App\Models;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NotificationMessage extends Model
{
    protected $guarded=['id'];
    public $table="notification_message";

}
