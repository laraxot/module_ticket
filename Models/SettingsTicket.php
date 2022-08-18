<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $num_format
 * @property string $num_sequence
 * @property string $priority
 * @property string $sla
 * @property string $help_topic
 * @property string $max_open_ticket
 * @property string $collision_avoid
 * @property string $lock_ticket_frequency
 * @property string $captcha
 * @property boolean $status
 * @property boolean $claim_response
 * @property boolean $assigned_ticket
 * @property boolean $answered_ticket
 * @property boolean $agent_mask
 * @property boolean $html
 * @property boolean $client_update
 * @property boolean $max_file_size
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsTicket extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['num_format', 'num_sequence', 'priority', 'sla', 'help_topic', 'max_open_ticket', 'collision_avoid', 'lock_ticket_frequency', 'captcha', 'status', 'claim_response', 'assigned_ticket', 'answered_ticket', 'agent_mask', 'html', 'client_update', 'max_file_size', 'created_at', 'updated_at'];
}
