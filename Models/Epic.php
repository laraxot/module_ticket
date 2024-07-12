<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $project_id
 * @property string $name
 * @property \Illuminate\Support\Carbon $starts_at
 * @property \Illuminate\Support\Carbon $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @property-read Epic|null $parent
 * @property-read \Modules\Ticket\Models\Project|null $project
 * @property-read \Modules\Ticket\Models\Sprint|null $sprint
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Modules\Ticket\Database\Factories\EpicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Epic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Epic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epic withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Epic withoutTrashed()
 * @mixin \Eloquent
 */
class Epic extends BaseModel
{
    protected $fillable = [
        'name',
        'project_id',
        'starts_at', 'ends_at',
        'parent_id',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'epic_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Epic::class, 'parent_id', 'id');
    }

    public function sprint(): HasOne
    {
        return $this->hasOne(Sprint::class, 'epic_id', 'id');
    }
}
