<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\User;

/**
 * Modules\Ticket\Models\ProjectUser.
 *
 * @property Project|null $project
 * @method static Builder|ProjectUser newModelQuery()
 * @method static Builder|ProjectUser newQuery()
 * @method static Builder|ProjectUser query()
 * @property int         $id
 * @property int         $user_id
 * @property int         $project_id
 * @property string      $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @method static Builder|ProjectUser whereCreatedAt($value)
 * @method static Builder|ProjectUser whereCreatedBy($value)
 * @method static Builder|ProjectUser whereDeletedAt($value)
 * @method static Builder|ProjectUser whereDeletedBy($value)
 * @method static Builder|ProjectUser whereId($value)
 * @method static Builder|ProjectUser whereProjectId($value)
 * @method static Builder|ProjectUser whereRole($value)
 * @method static Builder|ProjectUser whereUpdatedAt($value)
 * @method static Builder|ProjectUser whereUpdatedBy($value)
 * @method static Builder|ProjectUser whereUserId($value)
 * @property User|null $user
 * @mixin \Eloquent
 */
class ProjectUser extends BasePivot
{
    protected $fillable = [
        'user_id', 'project_id', 'role',
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
