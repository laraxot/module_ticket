<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\TicketTypeFactory;

/**
 * Modules\Ticket\Models\TicketType.
 *
 * @property Collection<int, Ticket> $tickets
 * @property int|null                $tickets_count
 * @method static TicketTypeFactory  factory($count = null, $state = [])
 * @method static Builder|TicketType newModelQuery()
 * @method static Builder|TicketType newQuery()
 * @method static Builder|TicketType onlyTrashed()
 * @method static Builder|TicketType query()
 * @method static Builder|TicketType withTrashed()
 * @method static Builder|TicketType withoutTrashed()
 * @property int         $id
 * @property string      $name
 * @property string      $icon
 * @property string      $color
 * @property int         $is_default
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @method static Builder|TicketType whereColor($value)
 * @method static Builder|TicketType whereCreatedAt($value)
 * @method static Builder|TicketType whereCreatedBy($value)
 * @method static Builder|TicketType whereDeletedAt($value)
 * @method static Builder|TicketType whereDeletedBy($value)
 * @method static Builder|TicketType whereIcon($value)
 * @method static Builder|TicketType whereId($value)
 * @method static Builder|TicketType whereIsDefault($value)
 * @method static Builder|TicketType whereName($value)
 * @method static Builder|TicketType whereUpdatedAt($value)
 * @method static Builder|TicketType whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class TicketType extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'icon', 'is_default',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'type_id', 'id')->withTrashed();
    }
}
