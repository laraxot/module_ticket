<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $dept_id
 * @property integer $team_id
 * @property integer $priority_id
 * @property integer $sla
 * @property integer $help_topic_id
 * @property integer $status
 * @property integer $assigned_to
 * @property integer $source
 * @property string $ticket_number
 * @property boolean $rating
 * @property boolean $ratingreply
 * @property integer $flags
 * @property integer $ip_address
 * @property integer $lock_by
 * @property string $lock_at
 * @property integer $isoverdue
 * @property integer $reopened
 * @property integer $isanswered
 * @property integer $html
 * @property integer $is_deleted
 * @property integer $closed
 * @property boolean $is_transferred
 * @property string $transferred_at
 * @property string $reopened_at
 * @property string $duedate
 * @property string $closed_at
 * @property string $last_message_at
 * @property string $last_response_at
 * @property integer $approval
 * @property integer $follow_up
 * @property string $created_at
 * @property string $updated_at
 * @property TicketCollaborator[] $ticketCollaborators
 * @property TicketFormData[] $ticketFormDatas
 * @property TicketThread[] $ticketThreads
 * @property User $user
 * @property TicketPriority $ticketPriority
 * @property HelpTopic $helpTopic
 * @property User $user
 * @property TicketSource $ticketSource
 * @property Team $team
 * @property SlaPlan $slaPlan
 * @property TicketStatus $ticketStatus
 * @property Department $department
 */
class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'dept_id', 'team_id', 'priority_id', 'sla', 'help_topic_id', 'status', 'assigned_to', 'source', 'ticket_number', 'rating', 'ratingreply', 'flags', 'ip_address', 'lock_by', 'lock_at', 'isoverdue', 'reopened', 'isanswered', 'html', 'is_deleted', 'closed', 'is_transferred', 'transferred_at', 'reopened_at', 'duedate', 'closed_at', 'last_message_at', 'last_response_at', 'approval', 'follow_up', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketCollaborators()
    {
        return $this->hasMany('App\Models\TicketCollaborator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketFormDatas()
    {
        return $this->hasMany('App\Models\TicketFormData');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketThreads()
    {
        return $this->hasMany('App\Models\TicketThread');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketPriority()
    {
        return $this->belongsTo('App\Models\TicketPriority', 'priority_id', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function helpTopic()
    {
        return $this->belongsTo('App\Models\HelpTopic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketSource()
    {
        return $this->belongsTo('App\Models\TicketSource', 'source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slaPlan()
    {
        return $this->belongsTo('App\Models\SlaPlan', 'sla');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketStatus()
    {
        return $this->belongsTo('App\Models\TicketStatus', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'dept_id');
    }
}
