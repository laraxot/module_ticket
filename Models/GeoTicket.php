<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Modules\Ticket\Enums\GeoTicketStatusEnum;
use Modules\Ticket\Enums\GeoTicketTypeEnum;
use Modules\Ticket\Enums\TicketPriorityEnum;

/**
 * 
 *
 * @property int $id
 * @property string $name
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
 * @property GeoTicketStatusEnum $status
 * @property \Modules\Ticket\Models\TicketPriority|null $priority
 * @property \Modules\Ticket\Models\TicketType|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketActivity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketComment> $comments
 * @property-read int|null $comments_count
 * @property-read mixed $completude_percentage
 * @property-read \Modules\Ticket\Models\Epic|null $epic
 * @property-read mixed $estimation_for_humans
 * @property-read int|null $estimation_in_seconds
 * @property-read float $estimation_progress
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketHour> $hours
 * @property-read int|null $hours_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Modules\User\Models\User|null $owner
 * @property-read \Modules\Ticket\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\TicketRelation> $relations
 * @property-read int|null $relations_count
 * @property-read \Modules\User\Models\User|null $responsible
 * @property-read \Modules\Ticket\Models\Sprint|null $sprint
 * @property-read \Modules\Ticket\Models\Sprint|null $sprints
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status> $statuses
 * @property-read int|null $statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User> $subscribers
 * @property-read int|null $subscribers_count
 * @property-read mixed $total_logged_hours
 * @property-read mixed $total_logged_in_hours
 * @property-read mixed $total_logged_seconds
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket currentStatus(...$names)
 * @method static \Modules\Ticket\Database\Factories\GeoTicketFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereEpicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereEstimation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereResponsibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereSprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereTicketPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoTicket withoutTrashed()
 * @mixin \Eloquent
 */
class GeoTicket extends Ticket
{
    protected $table = 'tickets';

    public function casts(): array
    {
        $data = parent::casts();
        $my = [
            'status' => GeoTicketStatusEnum::class,
            'priority' => TicketPriorityEnum::class,
            'type' => GeoTicketTypeEnum::class,
        ];

        return array_merge($data, $my);
    }
}
