<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\TicketCommentFactory;
use Modules\Ticket\Notifications\TicketCommented;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

/**
 * Modules\Ticket\Models\TicketComment.
 *
 * @property Ticket|null $ticket
 * @method static TicketCommentFactory  factory($count = null, $state = [])
 * @method static Builder|TicketComment newModelQuery()
 * @method static Builder|TicketComment newQuery()
 * @method static Builder|TicketComment onlyTrashed()
 * @method static Builder|TicketComment query()
 * @method static Builder|TicketComment withTrashed()
 * @method static Builder|TicketComment withoutTrashed()
 * @property int         $id
 * @property int         $ticket_id
 * @property int         $user_id
 * @property string      $content
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property User|null   $user
 * @method static Builder|TicketComment whereContent($value)
 * @method static Builder|TicketComment whereCreatedAt($value)
 * @method static Builder|TicketComment whereCreatedBy($value)
 * @method static Builder|TicketComment whereDeletedAt($value)
 * @method static Builder|TicketComment whereDeletedBy($value)
 * @method static Builder|TicketComment whereId($value)
 * @method static Builder|TicketComment whereTicketId($value)
 * @method static Builder|TicketComment whereUpdatedAt($value)
 * @method static Builder|TicketComment whereUpdatedBy($value)
 * @method static Builder|TicketComment whereUserId($value)
 * @mixin \Eloquent
 */
class TicketComment extends BaseModel
{
    protected $fillable = [
        'user_id', 'ticket_id', 'content',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(static function (TicketComment $item): void {
            Assert::notNull($item->ticket);
            foreach ($item->ticket->watchers as $user) {
                $user->notify(new TicketCommented($item));
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
