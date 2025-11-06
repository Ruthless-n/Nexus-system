<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExportComponent extends Component
{
    public function export()
    {
        ExportColaboradoresJob::dispatch([]);
        session()->flash('message', 'Exportação iniciada em background!');
    }

    public function render()
    {
        return view('livewire.export-component');
    }
}
