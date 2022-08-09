<?php

namespace App\Console;

use App\Console\Commands\CreateLog;
use App\Console\Commands\NotifyUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         NotifyUser::class,
         CreateLog::class
     ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        ///usr/local/bin/php /home/ajrnnaxa/private/artisan schedule:run
        //$schedule->command('queue:work --queue=notifyUser --force --memory=500')->everyMinute();
       // $schedule->command('queue:work --queue=notifyUser --force --memory=150')->everyMinute();
        //$schedule->command('queue:restart')->everyThirtyMinutes();
        //$schedule->command('queue:restart')->everyMinute();
      // $schedule->command('notify:user')->weekly();

       // /usr/local/bin/php /home/ajrnnaxa/private/artisan queue:work --queue=notifyUser --force --memory=340 --stop-when-empty >> /dev/null 2>&1
       // 0	11	6	*	0,6	/usr/local/bin/php /home/ajrnnaxa/private/artisan notify:user
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
