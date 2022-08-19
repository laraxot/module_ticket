<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $ticket_status
 * @property boolean $ticket_admin_email
 * @property boolean $ticket_department_manager
 * @property boolean $ticket_department_member
 * @property boolean $ticket_organization_accmanager
 * @property boolean $message_status
 * @property boolean $message_last_responder
 * @property boolean $message_assigned_agent
 * @property boolean $message_department_manager
 * @property boolean $message_organization_accmanager
 * @property boolean $internal_status
 * @property boolean $internal_last_responder
 * @property boolean $internal_assigned_agent
 * @property boolean $internal_department_manager
 * @property boolean $assignment_status
 * @property boolean $assignment_assigned_agent
 * @property boolean $assignment_team_leader
 * @property boolean $assignment_team_member
 * @property boolean $transfer_status
 * @property boolean $transfer_assigned_agent
 * @property boolean $transfer_department_manager
 * @property boolean $transfer_department_member
 * @property boolean $overdue_status
 * @property boolean $overdue_assigned_agent
 * @property boolean $overdue_department_manager
 * @property boolean $overdue_department_member
 * @property boolean $system_error
 * @property boolean $sql_error
 * @property boolean $excessive_failure
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsAlertNotice extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ticket_status', 'ticket_admin_email', 'ticket_department_manager', 'ticket_department_member', 'ticket_organization_accmanager', 'message_status', 'message_last_responder', 'message_assigned_agent', 'message_department_manager', 'message_organization_accmanager', 'internal_status', 'internal_last_responder', 'internal_assigned_agent', 'internal_department_manager', 'assignment_status', 'assignment_assigned_agent', 'assignment_team_leader', 'assignment_team_member', 'transfer_status', 'transfer_assigned_agent', 'transfer_department_manager', 'transfer_department_member', 'overdue_status', 'overdue_assigned_agent', 'overdue_department_manager', 'overdue_department_member', 'system_error', 'sql_error', 'excessive_failure', 'created_at', 'updated_at'];
}
