<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\Ticket\Models\ProfileProject.
 *
 * @property Project|null $project
 *
 * @method static Builder|ProfileProject newModelQuery()
 * @method static Builder|ProfileProject newQuery()
 * @method static Builder|ProfileProject query()
 *
 * @property Profile|null $profile
 * @property string $id
 * @property string|null $user_id
 * @property string|null $profile_id
 * @property int $project_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static Builder|ProfileProject whereCreatedAt($value)
 * @method static Builder|ProfileProject whereCreatedBy($value)
 * @method static Builder|ProfileProject whereDeletedAt($value)
 * @method static Builder|ProfileProject whereDeletedBy($value)
 * @method static Builder|ProfileProject whereId($value)
 * @method static Builder|ProfileProject whereProfileId($value)
 * @method static Builder|ProfileProject whereProjectId($value)
 * @method static Builder|ProfileProject whereRole($value)
 * @method static Builder|ProfileProject whereUpdatedAt($value)
 * @method static Builder|ProfileProject whereUpdatedBy($value)
 * @method static Builder|ProfileProject whereUserId($value)
 *
 * @property-read \Modules\Fixcity\Models\Profile|null $creator
 * @property-read \Modules\Fixcity\Models\Profile|null $updater
 *
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
