<?php

namespace Modules\Ticket\Models;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property integer $source
 * @property string $poster
 * @property integer $reply_rating
 * @property integer $rating_count
 * @property boolean $is_internal
 * @property string $title
 * @property string $body
 * @property string $format
 * @property string $ip_address
 * @property string $created_at
 * @property string $updated_at
 * @property TicketAttachment[] $ticketAttachments
 * @property Ticket $ticket
 * @property TicketSource $ticketSource
 * @property User $user
 */
class TicketThread extends BaseModelLang
{
    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id', 'source', 'poster', 'reply_rating', 'rating_count', 'is_internal', 'title', 'body', 'format', 'ip_address', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketAttachments()
    {
        return $this->hasMany(TicketAttachment::class, 'thread_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketSource()
    {
        return $this->belongsTo(TicketSource::class, 'source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
