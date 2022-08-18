<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property boolean $group_status
 * @property boolean $can_create_ticket
 * @property boolean $can_edit_ticket
 * @property boolean $can_post_ticket
 * @property boolean $can_close_ticket
 * @property boolean $can_assign_ticket
 * @property boolean $can_transfer_ticket
 * @property boolean $can_delete_ticket
 * @property boolean $can_ban_email
 * @property boolean $can_manage_canned
 * @property boolean $can_manage_faq
 * @property boolean $can_view_agent_stats
 * @property boolean $department_access
 * @property string $admin_notes
 * @property string $created_at
 * @property string $updated_at
 * @property GroupAssignDepartment[] $groupAssignDepartments
 * @property User[] $users
 */
class Group extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'group_status', 'can_create_ticket', 'can_edit_ticket', 'can_post_ticket', 'can_close_ticket', 'can_assign_ticket', 'can_transfer_ticket', 'can_delete_ticket', 'can_ban_email', 'can_manage_canned', 'can_manage_faq', 'can_view_agent_stats', 'department_access', 'admin_notes', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupAssignDepartments()
    {
        return $this->hasMany('App\Models\GroupAssignDepartment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'assign_group');
    }
}
