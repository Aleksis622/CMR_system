<?php

namespace App\Models\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->recordAudit('created', [], $model->getAttributes());
        });

        static::updating(function ($model) {
            $model->recordAudit('updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            $model->recordAudit('deleted', $model->getOriginal(), []);
        });
    }

    protected function recordAudit($action, $old, $new)
    {
        AuditLog::create([
            'user_id'       => Auth::id(),
            'auditable_type'=> get_class($this),
            'auditable_id'  => $this->getKey(),
            'action'        => $action,
            'old_values'    => $old ?: null,
            'new_values'    => $new ?: null,
            'ip'            => Request::ip(),
            'user_agent'    => Request::userAgent(),
        ]);
    }
}