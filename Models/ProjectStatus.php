<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectStatus extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'is_default',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'status_id', 'id')->withTrashed();
    }
}
