<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\SprintFactory;

/**
 * Modules\Ticket\Models\Sprint.
 *
 * @property Epic|null               $epic
 * @property Project|null            $project
 * @property Collection<int, Ticket> $tickets
 * @property int|null                $tickets_count
 *
 * @method static SprintFactory  factory($count = null, $state = [])
 * @method static Builder|Sprint newModelQuery()
 * @method static Builder|Sprint newQuery()
 * @method static Builder|Sprint onlyTrashed()
 * @method static Builder|Sprint query()
 * @method static Builder|Sprint withTrashed()
 * @method static Builder|Sprint withoutTrashed()
 *
 * @property int         $id
 * @property string      $name
 * @property Carbon      $starts_at
 * @property Carbon      $ends_at
 * @property string|null $description
 * @property int|null    $project_id
 * @property int|null    $epic_id
 * @property Carbon|null $started_at
 * @property Carbon|null $ended_at
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property Carbon|null $remaining
 * @property Carbon|null $nextSprint
 *
 * @method static Builder|Sprint whereCreatedAt($value)
 * @method static Builder|Sprint whereCreatedBy($value)
 * @method static Builder|Sprint whereDeletedAt($value)
 * @method static Builder|Sprint whereDeletedBy($value)
 * @method static Builder|Sprint whereDescription($value)
 * @method static Builder|Sprint whereEndedAt($value)
 * @method static Builder|Sprint whereEndsAt($value)
 * @method static Builder|Sprint whereEpicId($value)
 * @method static Builder|Sprint whereId($value)
 * @method static Builder|Sprint whereName($value)
 * @method static Builder|Sprint whereProjectId($value)
 * @method static Builder|Sprint whereStartedAt($value)
 * @method static Builder|Sprint whereStartsAt($value)
 * @method static Builder|Sprint whereUpdatedAt($value)
 * @method static Builder|Sprint whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Sprint extends BaseModel
{
    protected $fillable = [
        'name', 'starts_at', 'ends_at', 'description',
        'project_id', 'started_at', 'ended_at',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(static function (Sprint $item): void {
            $epic = Epic::create([
                'name' => $item->name,
                'starts_at' => $item->starts_at,
                'ends_at' => $item->ends_at,
                'project_id' => $item->project_id,
            ]);
            $item->epic_id = $epic->id;
            $item->save();
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'sprint_id', 'id');
    }

    public function epic(): BelongsTo
    {
        return $this->belongsTo(Epic::class, 'epic_id', 'id');
    }

    public function remaining(): Attribute
    {
        return new Attribute(
            get: function (): ?int {
                if (! $this->starts_at) {
                    return null;
                }

                if (! $this->ends_at) {
                    return null;
                }

                if (! $this->started_at instanceof Carbon) {
                    return null;
                }

                if ($this->ended_at instanceof Carbon) {
                    return null;
                }

                return $this->ends_at->diffInDays(now()) + 1;
            }
        );
    }
}
