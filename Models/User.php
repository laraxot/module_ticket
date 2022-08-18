<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $assign_group
 * @property integer $primary_dpt
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 * @property boolean $gender
 * @property string $email
 * @property boolean $ban
 * @property string $password
 * @property integer $active
 * @property boolean $is_delete
 * @property string $ext
 * @property integer $country_code
 * @property string $phone_number
 * @property string $mobile
 * @property string $agent_sign
 * @property string $account_type
 * @property string $account_status
 * @property string $agent_tzone
 * @property string $daylight_save
 * @property string $limit_access
 * @property string $directory_listing
 * @property string $vacation_mode
 * @property string $company
 * @property string $role
 * @property string $internal_note
 * @property string $profile_pic
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_language
 * @property CannedResponse[] $cannedResponses
 * @property Department[] $departments
 * @property HelpTopic[] $helpTopics
 * @property Organization[] $organizations
 * @property TeamAssignAgent[] $teamAssignAgents
 * @property Team[] $teams
 * @property TicketCollaborator[] $ticketCollaborators
 * @property TicketThread[] $ticketThreads
 * @property Ticket[] $tickets
 * @property Ticket[] $tickets
 * @property UserAssignOrganization[] $userAssignOrganizations
 * @property Group $group
 * @property Department $department
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['assign_group', 'primary_dpt', 'user_name', 'first_name', 'last_name', 'gender', 'email', 'ban', 'password', 'active', 'is_delete', 'ext', 'country_code', 'phone_number', 'mobile', 'agent_sign', 'account_type', 'account_status', 'agent_tzone', 'daylight_save', 'limit_access', 'directory_listing', 'vacation_mode', 'company', 'role', 'internal_note', 'profile_pic', 'remember_token', 'created_at', 'updated_at', 'user_language'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cannedResponses()
    {
        return $this->hasMany('App\Models\CannedResponse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany('App\Models\Department', 'manager');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'auto_assign');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {
        return $this->hasMany('App\Models\Organization', 'head');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamAssignAgents()
    {
        return $this->hasMany('App\Models\TeamAssignAgent', 'agent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany('App\Models\Team', 'team_lead');
    }

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
    public function ticketThreads()
    {
        return $this->hasMany('App\Models\TicketThread');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'assigned_to');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAssignOrganizations()
    {
        return $this->hasMany('App\Models\UserAssignOrganization');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'assign_group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'primary_dpt');
    }
}
