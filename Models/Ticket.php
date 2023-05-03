<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Traits\HasCategory;
use Modules\Comment\Models\Concerns\HasComments;
use Modules\LU\Models\User;
use Modules\Media\Models\Media;
use Modules\Ticket\Notifications\CommentEmailNotification;
use Modules\Ticket\Scopes\AgentScope;
use Modules\Ticket\Traits\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Modules\Ticket\Models\Ticket.
 *
 * @property int                                                                                  $id
 * @property string                                                                               $title
 * @property string                                                                               $txt
 * @property int                                                                                  $parent_id
 * @property string|null                                                                          $created_by
 * @property string|null                                                                          $updated_by
 * @property \Illuminate\Support\Carbon|null                                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                                      $updated_at
 * @property \Illuminate\Support\Carbon|null                                                      $deleted_at
 * @property int                                                                                  $category_id
 * @property string                                                                               $content
 * @property \Kalnoy\Nestedset\Collection<int, Category>                                          $categories
 * @property int|null                                                                             $categories_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Comment\Models\Comment>       $comments
 * @property int|null                                                                             $comments_count
 * @property Collection                                                                           $attachments
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property int|null                                                                             $media_count
 * @property \Modules\Ticket\Models\Priority|null                                                 $priority
 *
 * @method static Builder|Ticket filterTickets()
 * @method static Builder|Ticket newModelQuery()
 * @method static Builder|Ticket newQuery()
 * @method static Builder|Ticket onlyTrashed()
 * @method static Builder|Ticket query()
 * @method static Builder|Ticket whereCategoryId($value)
 * @method static Builder|Ticket whereContent($value)
 * @method static Builder|Ticket whereCreatedAt($value)
 * @method static Builder|Ticket whereCreatedBy($value)
 * @method static Builder|Ticket whereDeletedAt($value)
 * @method static Builder|Ticket whereId($value)
 * @method static Builder|Ticket whereParentId($value)
 * @method static Builder|Ticket whereTitle($value)
 * @method static Builder|Ticket whereTxt($value)
 * @method static Builder|Ticket whereUpdatedAt($value)
 * @method static Builder|Ticket whereUpdatedBy($value)
 * @method static Builder|Ticket withAllCategories($categories)
 * @method static Builder|Ticket withAnyCategories($categories)
 * @method static Builder|Ticket withCategories($categories)
 * @method static Builder|Ticket withTrashed()
 * @method static Builder|Ticket withoutAnyCategories()
 * @method static Builder|Ticket withoutCategories($categories)
 * @method static Builder|Ticket withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Ticket extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasComments;
    use HasCategory;
    // use HasTags;
    // use HasStatuses;

    /**
     * Undocumented variable.
     *
     * @var string
     */
    public $table = 'tickets';

    /**
     * Undocumented variable.
     *
     * @var array<string>
     */
    protected $appends = [
        'attachments',
    ];

    /**
     * Undocumented variable.
     *
     * @var array<string>
     */
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
    ];

    public static function boot()
    {
        parent::boot();

        // Ticket::observe(new \Modules\Ticket\Observers\TicketActionObserver);

        static::addGlobalScope(new AgentScope());
    }
    /*
    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }
    */
    /*
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id', 'id');
    }
    */

    public function getAttachmentsAttribute(): Collection
    {
        return $this->getMedia('attachments');
    }

    // mi sa che bisognerà usare laravel-model-status. Quindi per ora commento (oggi 2021-03-02)
    /*public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }*/

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    // non so se vada fatta così perchè c'è il trait HasCategory.
    // quindi per ora commento (oggi 2021-03-02)
    /*public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }*/

    // non mi convince nemmeno questa. User dev'essere certamente quello di LU
    // credo che comunque eventualmente vada assegnata al profilo (oggi 2021-03-02)
    /*public function assigned_to_user() {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }*/

    public function scopeFilterTickets(Builder $query): Builder
    {
        return $query->when(request()->input('priority'), function ($query) {
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

    // public function sendCommentNotification($comment) {
        // non può avere dipendenze da PFed su Profile quindi come lo faccio?
        /*$users = User::where(function ($q) {
            $q->role('roles', 'agent')
            ->where(function ($q) {
                $q->whereHas('comments', function ($q) {
                    return $q->whereTicketId($this->id);
                })
                ->orWhereHas('tickets', function ($q) {
                    return $q->whereId($this->id);
                });
            });
        })
            ->when(! $comment->user_id && ! $this->assigned_to_user_id, function ($q) {
                $q->orWhereHas('roles', function ($q) {
                    return $q->where('title', 'Admin');
                });
            })
            ->when($comment->user, function ($q) use ($comment) {
                $q->where('id', '!=', $comment->user_id);
            })
            ->get();
*/
        // bisogna cambiarla
        /*$notification = new CommentEmailNotification($comment);

        Notification::send($users, $notification);
        if ($comment->user_id && $this->author_email) {
            Notification::route('mail', $this->author_email)->notify($notification);
        }*/
    // }

    /**
     * This string will be used in notifications on what a new comment
     * was made.
     */
    public function commentableName(): string
    {
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
