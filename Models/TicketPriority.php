<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket> $tickets
 * @property int|null $tickets_count
 *
 * @method static \Modules\Ticket\Database\Factories\TicketPriorityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority withoutTrashed()
 *
 * @property-read \Modules\Fixcity\Models\Profile|null $creator
 * @property-read \Modules\Fixcity\Models\Profile|null $updater
 *
 * @mixin \Eloquent
 */
class TicketPriority extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'is_default',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'priority_id', 'id')->withTrashed();
    }
}
