<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Audit;

class AuditLog extends Component
{
    use WithPagination;

    public $model;
    public $user_id;

    public function render()
    {
        $query = Audit::query()->latest();

        if ($this->model) {
            $query->where('auditable_type', $this->model);
        }

        if ($this->user_id) {
            $query->where('user_id', $this->user_id);
        }

        return view('livewire.audit-log', [
            'audits' => $query->paginate(15),
        ]);
    }
}
