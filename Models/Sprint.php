<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $starts_at
 * @property \Illuminate\Support\Carbon $ends_at
 * @property string|null $description
 * @property int|null $project_id
 * @property int|null $epic_id
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $ended_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property Epic|null $epic
 * @property Project|null $project
 * @property mixed $remaining
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket> $tickets
 * @property int|null $tickets_count
 *
 * @method static \Modules\Ticket\Database\Factories\SprintFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereEpicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sprint withoutTrashed()
 *
 * @property-read \Modules\Fixcity\Models\Profile|null $creator
 * @property-read \Modules\Fixcity\Models\Profile|null $updater
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

    public static function boot()
    {
        parent::boot();

        static::created(function (Sprint $item) {
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
            get: function () {
                if ($this->starts_at && $this->ends_at && $this->started_at && ! $this->ended_at) {
                    return $this->ends_at->diffInDays(now()) + 1;
                }

            }
        );
    }
}
