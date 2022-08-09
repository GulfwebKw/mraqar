<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyPushy
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $type;
    public $messageEn;
    public $messageAr;
    public $titleEn;
    public $titleAr;

    /**
     * Create a new job instance.
     *
     * @param $titleEn
     * @param $titleAr
     * @param $messageEn
     * @param $messageAr
     * @param $type
     */
    public function __construct($titleEn,$titleAr,$messageEn,$messageAr,$type)
    {
        $this->type=$type;
        $this->titleEn=$titleEn;
        $this->titleAr=$titleAr;
        $this->messageEn=$messageEn;
        $this->messageAr=$messageAr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("dispatch Notify Pushy");
        switch ($this->type){
            case "all_users":
                User::notifyAllUsers($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr);
                Log::info("all_users");
                break;
            case "all_company_users":
                User::notifyAllCompanyUser($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr);
                break;
            case "all_individual_users":
               // User::notifyAllUsers($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr);
                User::notifyAllIndividualUsers($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr);
                break;
            case "not_exist_buy":
                User::notifyUserHasNotSale($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr,true);
                break;
            case "not_exist_comment":
                User::notifyUserNotRegisteredComment($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr,true);
                break;
            case "not_exist_bocking":
                User::notifyUserNotBocked($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr,true);
                break;
            case "potential_customer":
                User::notifyPotentialUser($this->titleEn,$this->titleAr,$this->messageEn,$this->messageAr);
                break;

        }
    }


}
