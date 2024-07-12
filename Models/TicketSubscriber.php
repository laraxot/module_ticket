<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Modules\Xot\Datas\XotData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketSubscriber extends BaseModel
{
    protected $fillable = [
        'user_id', 'ticket_id',
    ];

    public function user(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'user_id', 'id');
    }
}
