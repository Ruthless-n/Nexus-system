<?php

namespace App\Jobs;

use App\Exports\UnidadesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportUnidadesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    public function __construct($filename = 'unidades.xlsx')
    {
        $this->filename = $filename;
    }

    public function handle(): void
    {
        Excel::store(new UnidadesExport(), $this->filename, 'local');
    }
}
