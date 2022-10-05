<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LU\Models\User;

/**
 * @property int                  $id
 * @property int                  $user_id
 * @property int                  $dept_id
 * @property int                  $team_id
 * @property int                  $priority_id
 * @property int                  $sla
 * @property int                  $help_topic_id
 * @property int                  $status
 * @property int                  $assigned_to
 * @property int                  $source
 * @property string               $ticket_number
 * @property bool                 $rating
 * @property bool                 $ratingreply
 * @property int                  $flags
 * @property int                  $ip_address
 * @property int                  $lock_by
 * @property string               $lock_at
 * @property int                  $isoverdue
 * @property int                  $reopened
 * @property int                  $isanswered
 * @property int                  $html
 * @property int                  $is_deleted
 * @property int                  $closed
 * @property bool                 $is_transferred
 * @property string               $transferred_at
 * @property string               $reopened_at
 * @property string               $duedate
 * @property string               $closed_at
 * @property string               $last_message_at
 * @property string               $last_response_at
 * @property int                  $approval
 * @property int                  $follow_up
 * @property string               $created_at
 * @property string               $updated_at
 * @property TicketCollaborator[] $ticketCollaborators
 * @property TicketFormData[]     $ticketFormDatas
 * @property TicketThread[]       $ticketThreads
 * @property User                 $user
 * @property TicketPriority       $ticketPriority
 * @property HelpTopic            $helpTopic
 * @property User                 $user
 * @property TicketSource         $ticketSource
 * @property Team                 $team
 * @property SlaPlan              $slaPlan
 * @property TicketStatus         $ticketStatus
 * @property Department           $department
 */
class Ticket extends BaseModel {
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'dept_id', 'team_id', 'priority_id', 'sla', 'help_topic_id', 'status', 'assigned_to', 'source', 'ticket_number', 'rating', 'ratingreply', 'flags', 'ip_address', 'lock_by', 'lock_at', 'isoverdue', 'reopened', 'isanswered', 'html', 'is_deleted', 'closed', 'is_transferred', 'transferred_at', 'reopened_at', 'duedate', 'closed_at', 'last_message_at', 'last_response_at', 'approval', 'follow_up', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketCollaborators() {
        return $this->hasMany(TicketCollaborator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketFormDatas() {
        return $this->hasMany(TicketFormData::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketThreads() {
        return $this->hasMany(TicketThread::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketPriority() {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function helpTopic() {
        return $this->belongsTo(HelpTopic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /*public function user()
    {
        return $this->belongsTo(User::class);
    }*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketSource() {
        return $this->belongsTo(TicketSource::class, 'source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team() {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slaPlan() {
        return $this->belongsTo(SlaPlan::class, 'sla');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketStatus() {
        return $this->belongsTo(TicketStatus::class, 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /*
     * @return Illuminate\Database\Eloquent\Casts\Attribute
     */
    /*protected function user_id(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Auth::id(),
            set: fn ($value) => Auth::id(),
        );
    }*/
}
