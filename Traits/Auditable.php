<?php

declare(strict_types=1);

namespace Modules\Ticket\Traits;

use Illuminate\Database\Eloquent\Model;
use Modules\Ticket\Models\AuditLog;

trait Auditable {
    public static function bootAuditable(): void {
        static::created(function (Model $model) {
            self::audit('created', $model);
        });

        static::updated(function (Model $model) {
            self::audit('updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('deleted', $model);
        });
    }

    protected static function audit(string $description, Model $model): AuditLog {
        return AuditLog::create([
            'description' => $description,
            'subject_id' => $model->id ?? null,
            // Expression on left side of ?? is not nullable
            'subject_type' => get_class($model),
            'user_id' => auth()->id() ?? null,
            // Variable $model on left side of ?? always exists and is not nullable.
            'properties' => $model,
            'host' => request()->ip() ?? null,
        ]);
    }
}
