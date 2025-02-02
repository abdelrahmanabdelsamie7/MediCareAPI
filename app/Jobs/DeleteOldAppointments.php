<?php
namespace App\Jobs;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
class DeleteOldAppointments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct()
    {

    }
    public function handle(): void
    {
        Appointment::whereDate('day', '<', Carbon::today())->delete();
    }
}
