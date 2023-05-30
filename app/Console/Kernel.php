<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {

            $hora = now()->subMinute(10);

            $invoices = Invoice::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

            foreach ($invoices as $invoice) {

                $items = json_decode($invoice->content);

                foreach ($items as $item) {
                increase($item);
                }

                $invoice->status = 5;

                $invoice->save();
            }

        })->everyMinute();
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
