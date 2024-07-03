<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Xot\Datas\XotData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends BaseModel implements HasMedia
{
    // use HasFactory, SoftDeletes, InteractsWithMedia;
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

    // *-- da portare in profiles
    //public function users(): BelongsToMany
    //{
        // $user_class = XotData::make()->getUserClass();
    //    $profile_class = XotData::make()->getProfileClass();

        // return $this->belongsToMany($user_class, 'project_users', 'project_id', 'user_id')
        //    ->withPivot(['role']);
    //    return $this->belongsToMany(
    //        related: $profile_class,
            /*
            table: 'profile_project',
            foreignPivotKey: 'project_id',
            relatedPivotKey: 'user_id',
            parentKey: 'id',
            relatedKey: 'user_id',
            relation: null,
            */
    //    )
    //        ->withPivot(['role']);
    //}
    // */

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

    /*
    public function contributors(): Attribute
    {
        return new Attribute(
            get: function () {
                $users = $this->profiles;
                $users->push($this->owner);

                return $users->unique('id');
            }
        );
    }
    */

    public function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->media('cover')?->first()?->getFullUrl()
                ??
                'https://ui-avatars.com/api/?background=3f84f3&color=ffffff&name='.$this->name
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
}
