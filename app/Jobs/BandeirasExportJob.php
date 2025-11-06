<?php

namespace App\Jobs;

use App\Exports\BandeirasExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class BandeirasExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $fileName = 'bandeiras.xlsx';
        Excel::store(new BandeirasExport(), 'exports/' . $fileName);

        if ($this->userId) {
            $user = \App\Models\User::find($this->userId);
            if ($user) {
                $user->notify(new \App\Notifications\ReportReadyNotification($fileName));
            }
        }
    }
}