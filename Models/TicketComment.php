<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Modules\Ticket\Notifications\TicketCommented;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketComment extends BaseModel
{
    protected $fillable = [
        'user_id', 'ticket_id', 'content',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (TicketComment $item) {
            Assert::notNull($item->ticket);
            foreach ($item->ticket->watchers as $user) {
                $user->notify(new TicketCommented($item));
            }
        });
    }

    public function user(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
