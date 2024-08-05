<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Xot\Datas\XotData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int                                                                                                        $id
 * @property string                                                                                                     $name
 * @property string|null                                                                                                $description
 * @property int|null                                                                                                   $owner_id
 * @property int                                                                                                        $status_id
 * @property string                                                                                                     $status_type
 * @property string                                                                                                     $type
 * @property string                                                                                                     $ticket_prefix
 * @property \Illuminate\Support\Carbon|null                                                                            $deleted_at
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property string|null                                                                                                $deleted_by
 * @property mixed                                                                                                      $contributors
 * @property mixed                                                                                                      $cover
 * @property mixed                                                                                                      $current_sprint
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Epic>                                 $epics
 * @property int|null                                                                                                   $epics_count
 * @property mixed                                                                                                      $epics_first_date
 * @property mixed                                                                                                      $epics_last_date
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property mixed                                                                                                      $next_sprint
 * @property \Modules\User\Models\User|null                                                                             $owner
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Sprint>                               $sprints
 * @property int|null                                                                                                   $sprints_count
 * @property ProjectStatus                                                                                              $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketStatus>                         $statuses
 * @property int|null                                                                                                   $statuses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket>                               $tickets
 * @property int|null                                                                                                   $tickets_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User>                                   $users
 * @property int|null                                                                                                   $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTicketPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Project extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'description', 'status_id', 'owner_id', 'ticket_prefix',
        'status_type', 'type',
    ];

    protected $appends = [
        'cover',
    ];

    public function owner(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'owner_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProjectStatus::class, 'status_id', 'id')->withTrashed();
    }

    public function users(): BelongsToMany
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsToMany($user_class, 'project_users', 'project_id', 'user_id')
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
                if (null !== $this->owner) {
                    $users->push($this->owner);
                }

                return $users->unique('id');
            }
        );
    }

    public function cover(): Attribute
    {
        return new Attribute(
            // get: fn () => $this->media('cover')?->first()?->getFullUrl()
            fn () => $this->getFirstMediaUrl('cover')
            // ??
            // 'https://ui-avatars.com/api/?background=3f84f3&color=ffffff&name='.$this->name
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

    /*
    public function nextSprint(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->currentSprint) {
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
    */
}
