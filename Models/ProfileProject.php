<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\Ticket\Models\ProfileProject.
 *
 * @property Project|null $project
 * @method static Builder|ProfileProject newModelQuery()
 * @method static Builder|ProfileProject newQuery()
 * @method static Builder|ProfileProject query()
 * @property Profile|null $profile
 * @mixin \Eloquent
 */
class ProfileProject extends BasePivot
{
    protected $fillable = [
        // 'user_id',
        'profile_id',
        'project_id',
        'role',
    ];

    /*
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')
            ->withTrashed();
    }
}
