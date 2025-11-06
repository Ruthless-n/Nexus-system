<?php

namespace App\Jobs;

use App\Exports\ColaboradoresExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ColaboradoresExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filters;
    protected $userId;

    public function __construct($filters = [], $userId = null)
    {
        $this->filters = $filters;
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $fileName = 'colaboradores.xlsx';
        Excel::store(new ColaboradoresExport($this->filters), 'exports/' . $fileName);

        if ($this->userId) {
            $user = \App\Models\User::find($this->userId);
            if ($user) {
                $user->notify(new \App\Notifications\ReportReadyNotification($fileName));
            }
        }
    }
}