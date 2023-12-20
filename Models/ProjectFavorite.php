<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\User;

/**
 * Modules\Ticket\Models\ProjectFavorite.
 *
 * @property Project|null $project
 *
 * @method static Builder|ProjectFavorite newModelQuery()
 * @method static Builder|ProjectFavorite newQuery()
 * @method static Builder|ProjectFavorite query()
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static Builder|ProjectFavorite whereCreatedAt($value)
 * @method static Builder|ProjectFavorite whereCreatedBy($value)
 * @method static Builder|ProjectFavorite whereDeletedAt($value)
 * @method static Builder|ProjectFavorite whereDeletedBy($value)
 * @method static Builder|ProjectFavorite whereId($value)
 * @method static Builder|ProjectFavorite whereProjectId($value)
 * @method static Builder|ProjectFavorite whereUpdatedAt($value)
 * @method static Builder|ProjectFavorite whereUpdatedBy($value)
 * @method static Builder|ProjectFavorite whereUserId($value)
 *
 * @property User|null $user
 *
 * @mixin \Eloquent
 */
class ProjectFavorite extends BasePivot
{
    protected $fillable = [
        'user_id', 'project_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withTrashed();
    }
}
