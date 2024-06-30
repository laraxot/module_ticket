<?php

namespace Modules\Ticket\Models;

use Modules\Xot\Datas\XotData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ticket\Notifications\TicketCreated;
use Modules\Ticket\Notifications\TicketCommented;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ticket\Notifications\TicketStatusUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'ticket_id', 'content'
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function (TicketComment $item) {
            foreach ($item->ticket->watchers as $user) {
                $user->notify(new TicketCommented($item));
            }
        });
    }

    public function user(): BelongsTo
    {
        $user_class=XotData::make()->getUserClass();
        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
