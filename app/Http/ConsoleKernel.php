<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\EmailOtp;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Clean up expired OTPs every 30 minutes
        $schedule->call(function () {
            $deleted = EmailOtp::where('expires_at', '<', Carbon::now())->delete();
            \Log::info("Scheduled cleanup: Deleted {$deleted} expired OTP records");
        })->everyThirtyMinutes()->name('cleanup-expired-otps');

        // You can also add other scheduled tasks here
        // Example: Clean up old sessions
        $schedule->command('session:gc')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}