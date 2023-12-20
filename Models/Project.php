<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Media\Models\Media;
use Modules\Ticket\Database\Factories\ProjectFactory;
use Modules\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Webmozart\Assert\Assert;

/**
 * Modules\Ticket\Models\Project.
 *
 * @property Collection<int, Epic>         $epics
 * @property int|null                      $epics_count
 * @property MediaCollection<int, Media>   $media
 * @property int|null                      $media_count
 * @property User|null                     $owner
 * @property Collection<int, Sprint>       $sprints
 * @property int|null                      $sprints_count
 * @property ProjectStatus|null            $status
 * @property Collection<int, TicketStatus> $statuses
 * @property int|null                      $statuses_count
 * @property Collection<int, Ticket>       $tickets
 * @property int|null                      $tickets_count
 *
 * @method static ProjectFactory  factory($count = null, $state = [])
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project onlyTrashed()
 * @method static Builder|Project query()
 * @method static Builder|Project withTrashed()
 * @method static Builder|Project withoutTrashed()
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $description
 * @property int|null    $owner_id
 * @property int         $status_id
 * @property string      $status_type
 * @property string      $type
 * @property string      $ticket_prefix
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property Sprint|null $currentSprint
 * @property Sprint|null $nextSprint
 * @property Carbon|null $epicsFirstDate
 * @property Carbon|null $epicsLastDate
 *
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereCreatedBy($value)
 * @method static Builder|Project whereDeletedAt($value)
 * @method static Builder|Project whereDeletedBy($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project whereOwnerId($value)
 * @method static Builder|Project whereStatusId($value)
 * @method static Builder|Project whereStatusType($value)
 * @method static Builder|Project whereTicketPrefix($value)
 * @method static Builder|Project whereType($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUpdatedBy($value)
 *
 * @property Collection<int, User> $users
 * @property int|null              $users_count
 *
 * @mixin \Eloquent
 */
class Project extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'owner_id',
        'ticket_prefix',
        'status_type',
        'type',
    ];

    protected $appends = [
        'cover',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProjectStatus::class, 'status_id', 'id')
            ->withTrashed();
    }

    // -- da fare passando per profile
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_users', 'project_id', 'user_id')
            ->withPivot(['role']);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'project_id', 'id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(TicketStatus::class, 'project_id', 'id');
    }

    public function epics(): HasMany
    {
        return $this->hasMany(Epic::class, 'project_id', 'id');
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class, 'project_id', 'id');
    }

    public function epicsFirstDate(): Attribute
    {
        return new Attribute(
            get: function () {
                $firstEpic = $this->epics()->orderBy('starts_at')->first();
                if ($firstEpic) {
                    return $firstEpic->starts_at;
                }

                return now();
            }
        );
    }

    public function epicsLastDate(): Attribute
    {
        return new Attribute(
            get: function () {
                $firstEpic = $this->epics()->orderBy('ends_at', 'desc')->first();
                if ($firstEpic) {
                    return $firstEpic->ends_at;
                }

                return now();
            }
        );
    }

    public function contributors(): Attribute
    {
        return new Attribute(
            get: function () {
                $users = $this->users;
                Assert::notNull($this->owner);
                $users->push($this->owner);

                return $users->unique('id');
            }
        );
    }

    public function cover(): Attribute
    {
        Assert::notNull($this->media()->first());

        return new Attribute(
            // get: fn () => $this->media('cover')?->first()->getFullUrl()
            get: fn () => $this->getFirstMediaUrl('cover')
            // ??
            //  'https://ui-avatars.com/api/?background=3f84f3&color=ffffff&name='.$this->name
        );
    }

    public function currentSprint(): Attribute
    {
        return new Attribute(
            get: fn () => $this->sprints()
                ->whereNotNull('started_at')
                ->whereNull('ended_at')
                ->first()
        );
    }

    public function nextSprint(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->currentSprint instanceof Sprint) {
                    return $this->sprints()
                        ->whereNull('started_at')
                        ->whereNull('ended_at')
                        ->where('starts_at', '>=', $this->currentSprint->ends_at)
                        ->orderBy('starts_at')
                        ->first();
                }

                return null;
            }
        );
    }
}
