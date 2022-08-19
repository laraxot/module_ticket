<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $days
 * @property integer $condition
 * @property integer $send_email
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class WorkflowClose extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['days', 'condition', 'send_email', 'status', 'created_at', 'updated_at'];
}
