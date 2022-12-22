<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Modules\LU\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int                $id
 * @property int                $ticket_id
 * @property int                $user_id
 * @property int                $source
 * @property string             $poster
 * @property int                $reply_rating
 * @property int                $rating_count
 * @property bool               $is_internal
 * @property string             $title
 * @property string             $body
 * @property string             $format
 * @property string             $ip_address
 * @property string             $created_at
 * @property string             $updated_at
 * @property TicketAttachment[] $ticketAttachments
 * @property Ticket             $ticket
 * @property TicketSource       $ticketSource
 * @property User               $user
 */
class TicketThread extends BaseModelLang {
    /**
     * @var array
     */
    protected $fillable = ['ticket_id',
    'user_id', 'source', 'poster', 'reply_rating',
    'rating_count', 'is_internal', 'title', 'body',
    'format', 'ip_address', 'created_at', 'updated_at'];

    /*
    public function ticketAttachments():HasMany {
        return $this->hasMany(TicketAttachment::class, 'thread_id');
    }*/

    public function ticket():BelongsTo {
        return $this->belongsTo(Ticket::class);
    }

    /*
    public function ticketSource():BelongsTo {
        return $this->belongsTo(TicketSource::class, 'source');
    }
    */

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}