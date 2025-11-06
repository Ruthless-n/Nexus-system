<?php

namespace App\Jobs;

use App\Exports\BandeirasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportBandeirasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    public function __construct($filename = 'bandeiras.xlsx')
    {
        $this->filename = $filename;
    }

    public function handle(): void
    {
        Excel::store(new BandeirasExport(), $this->filename, 'local');
    }
}
