<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $lockout_message
 * @property integer $backlist_offender
 * @property integer $backlist_threshold
 * @property integer $lockout_period
 * @property integer $days_to_keep_logs
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsSecurity extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lockout_message', 'backlist_offender', 'backlist_threshold', 'lockout_period', 'days_to_keep_logs', 'created_at', 'updated_at'];
}
