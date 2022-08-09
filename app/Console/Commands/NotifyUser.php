<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         Log::info("notify user (on cron job)".date("Y-m-d H:i:s"));
         $items= Controller::getNotificationMessage();
         User::notifyInactiveUsers($items['InactiveUsers']->title_en,$items['InactiveUsers']->title_ar,$items['InactiveUsers']->message_en,$items['InactiveUsers']->message_ar);
         User::notifyUserHasNotSale($items['UserHasNotSale']->title_en,$items['UserHasNotSale']->title_ar,$items['UserHasNotSale']->message_en,$items['UserHasNotSale']->message_ar);
         User::notifyUserNotRegisteredComment($items['UserNotRegisteredComment']->title_en,$items['UserNotRegisteredComment']->title_ar,$items['UserNotRegisteredComment']->message_en,$items['UserNotRegisteredComment']->message_ar);
         User::notifyUserNotBocked($items['UserNotBocked']->title_en,$items['UserNotBocked']->title_ar,$items['UserNotBocked']->message_en,$items['UserNotBocked']->message_ar);
         User::notifyUserHasNotVisitAdvertising($items['UserHasNotVisitAdvertising']->title_en,$items['UserHasNotVisitAdvertising']->title_ar,$items['UserHasNotVisitAdvertising']->message_en,$items['UserHasNotVisitAdvertising']->message_ar);

    }





}
