<?php

namespace App\Console;

use App\Console\Commands\CreateLog;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
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
        //$schedule->command('queue:restart')->everyThirtyMinutes();
        //$schedule->command('queue:restart')->everyMinute();
        $schedule->call(function () {
            $files = File::allFiles(public_path('resources/tempUploads/'));
            foreach ($files as $file){
                if ( time() - $file->getCTime() > 5 * 60 * 60 )
                    unlink($file->getRealPath());
            }
        })->daily()->at('3:30');
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
