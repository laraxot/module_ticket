<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $notification_id
 * @property integer $user_id
 * @property integer $is_read
 * @property string $created_at
 * @property string $updated_at
 */
class UserNotification extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['notification_id', 'user_id', 'is_read', 'created_at', 'updated_at'];
}
