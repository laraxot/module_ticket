<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $department
 * @property integer $priority
 * @property integer $help_topic
 * @property string $email_address
 * @property string $email_name
 * @property string $user_name
 * @property string $password
 * @property string $fetching_host
 * @property string $fetching_port
 * @property string $fetching_protocol
 * @property string $fetching_encryption
 * @property string $mailbox_protocol
 * @property string $imap_config
 * @property string $folder
 * @property string $sending_host
 * @property string $sending_port
 * @property string $sending_protocol
 * @property string $sending_encryption
 * @property string $smtp_validate
 * @property string $smtp_authentication
 * @property string $internal_notes
 * @property boolean $auto_response
 * @property boolean $fetching_status
 * @property boolean $move_to_folder
 * @property boolean $delete_email
 * @property boolean $do_nothing
 * @property boolean $sending_status
 * @property boolean $authentication
 * @property boolean $header_spoofing
 * @property string $created_at
 * @property string $updated_at
 * @property Department $department
 * @property HelpTopic $helpTopic
 * @property TicketPriority $ticketPriority
 */
class Email extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['department', 'priority', 'help_topic', 'email_address', 'email_name', 'user_name', 'password', 'fetching_host', 'fetching_port', 'fetching_protocol', 'fetching_encryption', 'mailbox_protocol', 'imap_config', 'folder', 'sending_host', 'sending_port', 'sending_protocol', 'sending_encryption', 'smtp_validate', 'smtp_authentication', 'internal_notes', 'auto_response', 'fetching_status', 'move_to_folder', 'delete_email', 'do_nothing', 'sending_status', 'authentication', 'header_spoofing', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function helpTopic()
    {
        return $this->belongsTo('App\Models\HelpTopic', 'help_topic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketPriority()
    {
        return $this->belongsTo('App\Models\TicketPriority', 'priority', 'priority_id');
    }
}
