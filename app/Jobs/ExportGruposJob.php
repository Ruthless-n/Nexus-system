<?php

namespace App\Jobs;

use App\Exports\GruposExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportGruposJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    public function __construct($filename = 'grupos.xlsx')
    {
        $this->filename = $filename;
    }

    public function handle(): void
    {
        Excel::store(new GruposExport(), $this->filename, 'local');
    }
}
