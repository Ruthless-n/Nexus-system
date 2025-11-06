<?php

namespace App\Jobs;

use App\Exports\ColaboradoresExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportColaboradoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filters;
    protected $filename;

    public function __construct($filters = [], $filename = 'colaboradores.xlsx')
    {
        $this->filters = $filters;
        $this->filename = $filename;
    }

    public function handle(): void
    {
        Excel::store(new ColaboradoresExport($this->filters), $this->filename, 'local');
    }
}
