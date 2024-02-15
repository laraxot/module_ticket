<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\TicketPriorityFactory;

/**
 * Modules\Ticket\Models\TicketPriority.
 *
 * @property Collection<int, Ticket> $tickets
 * @property int|null                $tickets_count
 * @method static TicketPriorityFactory  factory($count = null, $state = [])
 * @method static Builder|TicketPriority newModelQuery()
 * @method static Builder|TicketPriority newQuery()
 * @method static Builder|TicketPriority onlyTrashed()
 * @method static Builder|TicketPriority query()
 * @method static Builder|TicketPriority withTrashed()
 * @method static Builder|TicketPriority withoutTrashed()
 * @property int         $id
 * @property string      $name
 * @property string      $color
 * @property int         $is_default
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @method static Builder|TicketPriority whereColor($value)
 * @method static Builder|TicketPriority whereCreatedAt($value)
 * @method static Builder|TicketPriority whereCreatedBy($value)
 * @method static Builder|TicketPriority whereDeletedAt($value)
 * @method static Builder|TicketPriority whereDeletedBy($value)
 * @method static Builder|TicketPriority whereId($value)
 * @method static Builder|TicketPriority whereIsDefault($value)
 * @method static Builder|TicketPriority whereName($value)
 * @method static Builder|TicketPriority whereUpdatedAt($value)
 * @method static Builder|TicketPriority whereUpdatedBy($value)
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
