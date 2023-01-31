<?php

namespace Modules\Ticket\Models;

use Spatie\MediaLibrary\HasMedia;
use Modules\Ticket\Traits\Auditable;
use Modules\Ticket\Scopes\AgentScope;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\Traits\HasCategory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Models\Concerns\HasComments;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Ticket\Notifications\CommentEmailNotification;

class Ticket extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasComments;
    use HasCategory;
    // use HasTags;
    // use HasStatuses;

    public $table = 'tickets';

    protected $appends = [
        'attachments',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'content',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'priority_id',
        'category_id',
        'author_name',
        'author_email',
        'assigned_to_user_id',
    ];

    public static function boot()
    {
        parent::boot();

        //Ticket::observe(new \Modules\Ticket\Observers\TicketActionObserver);

        static::addGlobalScope(new AgentScope());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }
    /*
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id', 'id');
    }
    */

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function scopeFilterTickets($query)
    {
        $query->when(request()->input('priority'), function ($query) {
            $query->whereHas('priority', function ($query) {
                $query->whereId(request()->input('priority'));
            });
        })
            ->when(request()->input('category'), function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->whereId(request()->input('category'));
                });
            })
            ->when(request()->input('status'), function ($query) {
                $query->whereHas('status', function ($query) {
                    $query->whereId(request()->input('status'));
                });
            });
    }

    public function sendCommentNotification($comment)
    {
        $users = \App\User::where(function ($q) {
            $q->whereHas('roles', function ($q) {
                return $q->where('title', 'Agent');
            })
            ->where(function ($q) {
                $q->whereHas('comments', function ($q) {
                    return $q->whereTicketId($this->id);
                })
                ->orWhereHas('tickets', function ($q) {
                    return $q->whereId($this->id);
                });
            });
        })
            ->when(!$comment->user_id && !$this->assigned_to_user_id, function ($q) {
                $q->orWhereHas('roles', function ($q) {
                    return $q->where('title', 'Admin');
                });
            })
            ->when($comment->user, function ($q) use ($comment) {
                $q->where('id', '!=', $comment->user_id);
            })
            ->get();
        $notification = new CommentEmailNotification($comment);

        Notification::send($users, $notification);
        if ($comment->user_id && $this->author_email) {
            Notification::route('mail', $this->author_email)->notify($notification);
        }
    }



     /**
    * This string will be used in notifications on what a new comment
    * was made.
    */
    public function commentableName(): string
    {
        //
        return '---commentableName--';
    }

        /**
    * This URL will be used in notifications to let the user know
    * where the comment itself can be read.
    */
        public function commentUrl(): string
        {
            return '---commentUrl--';
        }
}
