<?php

namespace App\Observers;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuditObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function createAudit($model, string $event)
    {
        $userId = Auth::id();

        // capture only attributes (not relations)
        $old = $model->getOriginal();
        $new = $model->getAttributes();

        // For created event, old should be null
        if ($event === 'created') {
            $old = null;
        }

        // For deleted event, new should be null
        if ($event === 'deleted') {
            $new = null;
        }

        Audit::create([
            'user_id' => $userId,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => $event,
            'old_values' => $old ? $old : null,
            'new_values' => $new ? $new : null,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
        ]);
    }

    public function created($model)
    {
        $this->createAudit($model, 'created');
    }

    public function updated($model)
    {
        // only store changed fields to keep payload small
        $changes = $model->getChanges();
        if (empty($changes)) {
            return;
        }

        // create a temporary model to read original values
        $original = $model->getOriginal();

        Audit::create([
            'user_id' => Auth::id(),
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => 'updated',
            'old_values' => array_intersect_key($original, $changes),
            'new_values' => $changes,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
        ]);
    }

    public function deleted($model)
    {
        $this->createAudit($model, 'deleted');
    }
}
