<?php

namespace App\Jobs;

use App\Exports\UnidadesExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class UnidadesExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $fileName = 'unidades.xlsx';
        Excel::store(new UnidadesExport(), 'exports/' . $fileName);

        if ($this->userId) {
            $user = \App\Models\User::find($this->userId);
            if ($user) {
                $user->notify(new \App\Notifications\ReportReadyNotification($fileName));
            }
        }
    }
}