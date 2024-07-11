<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Xot\Datas\XotData;

class ProjectFavorite extends BasePivot
{
    protected $fillable = [
        'user_id', 'project_id',
    ];

    public function user(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withTrashed();
    }
}
