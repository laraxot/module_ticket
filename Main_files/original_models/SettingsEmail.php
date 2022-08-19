<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $template
 * @property string $sys_email
 * @property string $alert_email
 * @property string $admin_email
 * @property string $mta
 * @property boolean $email_fetching
 * @property boolean $notification_cron
 * @property boolean $strip
 * @property boolean $separator
 * @property boolean $all_emails
 * @property boolean $email_collaborator
 * @property boolean $attachment
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsEmail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['template', 'sys_email', 'alert_email', 'admin_email', 'mta', 'email_fetching', 'notification_cron', 'strip', 'separator', 'all_emails', 'email_collaborator', 'attachment', 'created_at', 'updated_at'];
}
