<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $time_farmat
 * @property integer $date_format
 * @property integer $date_time_format
 * @property integer $time_zone
 * @property boolean $status
 * @property string $url
 * @property string $name
 * @property string $department
 * @property string $page_size
 * @property string $log_level
 * @property string $purge_log
 * @property integer $api_enable
 * @property integer $api_key_mandatory
 * @property string $api_key
 * @property string $name_format
 * @property string $day_date_time
 * @property string $content
 * @property string $version
 * @property string $created_at
 * @property string $updated_at
 * @property DateTimeFormat $dateTimeFormat
 * @property Timezone $timezone
 * @property DateFormat $dateFormat
 * @property TimeFormat $timeFormat
 */
class SettingsSystem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['time_farmat', 'date_format', 'date_time_format', 'time_zone', 'status', 'url', 'name', 'department', 'page_size', 'log_level', 'purge_log', 'api_enable', 'api_key_mandatory', 'api_key', 'name_format', 'day_date_time', 'content', 'version', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dateTimeFormat()
    {
        return $this->belongsTo('App\Models\DateTimeFormat', 'date_time_format');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timezone()
    {
        return $this->belongsTo('App\Models\Timezone', 'time_zone');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dateFormat()
    {
        return $this->belongsTo('App\Models\DateFormat', 'date_format');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timeFormat()
    {
        return $this->belongsTo('App\Models\TimeFormat', 'time_farmat');
    }
}
