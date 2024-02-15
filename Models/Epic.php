<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\EpicFactory;

/**
 * Modules\Ticket\Models\Epic.
 *
 * @property Epic|null               $parent
 * @property Project|null            $project
 * @property Sprint|null             $sprint
 * @property Collection<int, Ticket> $tickets
 * @property int|null                $tickets_count
 * @method static EpicFactory  factory($count = null, $state = [])
 * @method static Builder|Epic newModelQuery()
 * @method static Builder|Epic newQuery()
 * @method static Builder|Epic onlyTrashed()
 * @method static Builder|Epic query()
 * @method static Builder|Epic withTrashed()
 * @method static Builder|Epic withoutTrashed()
 * @property int         $id
 * @property int|null    $parent_id
 * @property int         $project_id
 * @property string      $name
 * @property Carbon      $starts_at
 * @property Carbon      $ends_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @method static Builder|Epic whereCreatedAt($value)
 * @method static Builder|Epic whereCreatedBy($value)
 * @method static Builder|Epic whereDeletedAt($value)
 * @method static Builder|Epic whereDeletedBy($value)
 * @method static Builder|Epic whereEndsAt($value)
 * @method static Builder|Epic whereId($value)
 * @method static Builder|Epic whereName($value)
 * @method static Builder|Epic whereParentId($value)
 * @method static Builder|Epic whereProjectId($value)
 * @method static Builder|Epic whereStartsAt($value)
 * @method static Builder|Epic whereUpdatedAt($value)
 * @method static Builder|Epic whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Epic extends BaseModel
{
    protected $fillable = [
        'name', 'project_id', 'starts_at', 'ends_at',
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
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function sprint(): HasOne
    {
        return $this->hasOne(Sprint::class, 'epic_id', 'id');
    }
}
