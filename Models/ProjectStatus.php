<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\ProjectStatusFactory;

/**
 * Modules\Ticket\Models\ProjectStatus.
 *
 * @property Collection<int, Project> $projects
 * @property int|null                 $projects_count
 *
 * @method static ProjectStatusFactory  factory($count = null, $state = [])
 * @method static Builder|ProjectStatus newModelQuery()
 * @method static Builder|ProjectStatus newQuery()
 * @method static Builder|ProjectStatus onlyTrashed()
 * @method static Builder|ProjectStatus query()
 * @method static Builder|ProjectStatus withTrashed()
 * @method static Builder|ProjectStatus withoutTrashed()
 *
 * @property int         $id
 * @property string      $name
 * @property string      $color
 * @property int         $is_default
 * @property int|null    $project_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 *
 * @method static Builder|ProjectStatus whereColor($value)
 * @method static Builder|ProjectStatus whereCreatedAt($value)
 * @method static Builder|ProjectStatus whereCreatedBy($value)
 * @method static Builder|ProjectStatus whereDeletedAt($value)
 * @method static Builder|ProjectStatus whereDeletedBy($value)
 * @method static Builder|ProjectStatus whereId($value)
 * @method static Builder|ProjectStatus whereIsDefault($value)
 * @method static Builder|ProjectStatus whereName($value)
 * @method static Builder|ProjectStatus whereProjectId($value)
 * @method static Builder|ProjectStatus whereUpdatedAt($value)
 * @method static Builder|ProjectStatus whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
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
