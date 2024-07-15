<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int                                                                           $id
 * @property string                                                                        $name
 * @property string                                                                        $color
 * @property int                                                                           $is_default
 * @property int|null                                                                      $project_id
 * @property \Illuminate\Support\Carbon|null                                               $deleted_at
 * @property \Illuminate\Support\Carbon|null                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                               $updated_at
 * @property string|null                                                                   $updated_by
 * @property string|null                                                                   $created_by
 * @property string|null                                                                   $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Project> $projects
 * @property int|null                                                                      $projects_count
 * @method static \Modules\Ticket\Database\Factories\ProjectStatusFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectStatus     withoutTrashed()
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
