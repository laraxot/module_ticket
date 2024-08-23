<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Xot\Datas\XotData;

/**
 * 
 *
 * @property string $id
 * @property int $user_id
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @property Project|null $project
 * @property \Modules\User\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFavorite whereUserId($value)
 * @property-read \Modules\Fixcity\Models\Profile|null $creator
 * @property-read \Modules\Fixcity\Models\Profile|null $updater
 * @mixin \Eloquent
 */
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
