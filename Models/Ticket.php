<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ticket\Notifications\TicketCreated;
use Modules\Ticket\Notifications\TicketStatusUpdated;
use Modules\Xot\Datas\XotData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Modules\Ticket\Models\Ticket.
 *
 * @property string $name
 * @property int $id
 * @property string $content
 * @property int $owner_id
 * @property int|null $responsible_id
 * @property int $status_id
 * @property string|null $code
 * @property string|null $ticket_prefix
 * @property int $order
 * @property int $priority_id
 * @property int|null $project_id
 * @property float|null $estimation
 * @property int|null $epic_id
 * @property int|null $sprint_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $type_id
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketActivity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketComment> $comments
 * @property-read int|null $comments_count
 * @property-read mixed $completude_percentage
 * @property-read \Modules\Ticket\Models\Epic|null $epic
 * @property-read mixed $estimation_for_humans
 * @property-read mixed $estimation_in_seconds
 * @property-read mixed $estimation_progress
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketHour> $hours
 * @property-read int|null $hours_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Modules\User\Models\User|null $owner
 * @property-read \Modules\Ticket\Models\TicketPriority|null $priority
 * @property-read \Modules\Ticket\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketRelation> $relations
 * @property-read int|null $relations_count
 * @property-read \Modules\User\Models\User|null $responsible
 * @property-read \Modules\Ticket\Models\Sprint|null $sprint
 * @property-read \Modules\Ticket\Models\Sprint|null $sprints
 * @property-read \Modules\Ticket\Models\TicketStatus|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User> $subscribers
 * @property-read int|null $subscribers_count
 * @property-read mixed $total_logged_hours
 * @property-read mixed $total_logged_in_hours
 * @property-read mixed $total_logged_seconds
 * @property-read \Modules\Ticket\Models\TicketType|null $type
 * @method static \Modules\Ticket\Database\Factories\TicketFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEpicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEstimation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereResponsibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket withoutTrashed()
 * @mixin \Eloquent
 */
class Ticket extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'content', 'owner_id', 'responsible_id',
        'status_id', 'project_id', 'code', 'order', 'type_id',
        'priority_id', 'estimation', 'epic_id', 'sprint_id',
        'latitude', 'longitude', // GEO
    ];

    public static function boot()
    {
        parent::boot();
        /*
        static::creating(function (Ticket $item) {
            $project = Project::where('id', $item->project_id)->first();
            $count = Ticket::where('project_id', $project->id)->count();
            $order = $project->tickets?->last()?->order ?? -1;
            $item->code = $project->ticket_prefix . '-' . ($count + 1);
            $item->order = $order + 1;
        });
        */
        static::created(function (Ticket $item) {
            if ($item->sprint_id && $item->sprint?->epic_id) {
                Ticket::where('id', $item->id)->update(['epic_id' => $item->sprint?->epic_id]);
            }
            foreach ($item->watchers ?? [] as $user) {
                $user->notify(new TicketCreated($item));
            }
        });

        static::updating(function (Ticket $item) {
            $old = Ticket::where('id', $item->id)->first();

            // Ticket activity based on status
            $oldStatus = $old?->status_id;
            if ($oldStatus != $item->status_id) {
                TicketActivity::create([
                    'ticket_id' => $item->id,
                    'old_status_id' => $oldStatus,
                    'new_status_id' => $item->status_id,
                    'user_id' => auth()->user()->id,
                ]);
                foreach ($item->watchers as $user) {
                    $user->notify(new TicketStatusUpdated($item));
                }
            }

            // Ticket sprint update
            $oldSprint = $old->sprint_id;
            if ($oldSprint && ! $item->sprint_id) {
                Ticket::where('id', $item->id)->update(['epic_id' => null]);
            } elseif ($item->sprint_id && $item->sprint->epic_id) {
                Ticket::where('id', $item->id)->update(['epic_id' => $item->sprint->epic_id]);
            }
        });
    }

    public function owner(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'owner_id', 'id');
    }

    public function responsible(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'responsible_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id')->withTrashed();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withTrashed();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id', 'id')->withTrashed();
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'id')->withTrashed();
    }

    public function activities(): HasMany
    {
        return $this->hasMany(TicketActivity::class, 'ticket_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class, 'ticket_id', 'id');
    }

    public function subscribers(): BelongsToMany
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsToMany($user_class, 'ticket_subscribers', 'ticket_id', 'user_id');
    }

    public function relations(): HasMany
    {
        return $this->hasMany(TicketRelation::class, 'ticket_id', 'id');
    }

    public function hours(): HasMany
    {
        return $this->hasMany(TicketHour::class, 'ticket_id', 'id');
    }

    public function epic(): BelongsTo
    {
        return $this->belongsTo(Epic::class, 'epic_id', 'id');
    }

    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id', 'id');
    }

    public function sprints(): BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id', 'id');
    }

    /*
    public function watchers(): Attribute
    {
        return new Attribute(
            get: function () {
                $users = $this->project->profiles;
                $users->push($this->owner);
                if ($this->responsible) {
                    $users->push($this->responsible);
                }

                return $users->unique('id');
            }
        );
    }
    */

    public function totalLoggedHours(): Attribute
    {
        return new Attribute(
            get: function () {
                $seconds = $this->hours->sum('value') * 3600;

                return CarbonInterval::seconds($seconds)->cascade()->forHumans();
            }
        );
    }

    public function totalLoggedSeconds(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->hours->sum('value') * 3600;
            }
        );
    }

    public function totalLoggedInHours(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->hours->sum('value');
            }
        );
    }

    public function estimationForHumans(): Attribute
    {
        return new Attribute(
            get: function () {
                return CarbonInterval::seconds($this->estimationInSeconds)->cascade()->forHumans();
            }
        );
    }

    public function estimationInSeconds(): Attribute
    {
        return new Attribute(
            get: function () {
                if (! $this->estimation) {
                    return null;
                }

                return $this->estimation * 3600;
            }
        );
    }

    public function estimationProgress(): Attribute
    {
        return new Attribute(
            get: function () {
                return (($this->totalLoggedSeconds ?? 0) / ($this->estimationInSeconds ?? 1)) * 100;
            }
        );
    }

    public function completudePercentage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->estimationProgress
        );
    }

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }
}
