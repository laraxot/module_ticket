<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\User;

/**
 * Modules\Ticket\Models\TicketSubscriber.
 *
 * @property Ticket|null $ticket
 * @property User|null   $user
 * @method static Builder|TicketSubscriber newModelQuery()
 * @method static Builder|TicketSubscriber newQuery()
 * @method static Builder|TicketSubscriber query()
 * @property int         $id
 * @property int         $user_id
 * @property int         $ticket_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @method static Builder|TicketSubscriber whereCreatedAt($value)
 * @method static Builder|TicketSubscriber whereCreatedBy($value)
 * @method static Builder|TicketSubscriber whereDeletedAt($value)
 * @method static Builder|TicketSubscriber whereDeletedBy($value)
 * @method static Builder|TicketSubscriber whereId($value)
 * @method static Builder|TicketSubscriber whereTicketId($value)
 * @method static Builder|TicketSubscriber whereUpdatedAt($value)
 * @method static Builder|TicketSubscriber whereUpdatedBy($value)
 * @method static Builder|TicketSubscriber whereUserId($value)
 * @mixin \Eloquent
 */
class TicketSubscriber extends BasePivot
{
    protected $fillable = [
        'user_id', 'ticket_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'user_id', 'id');
    }
}
