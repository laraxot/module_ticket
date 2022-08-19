<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $message
 * @property string $type
 * @property string $icon_class
 * @property string $created_at
 * @property string $updated_at
 */
class NotificationType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['message', 'type', 'icon_class', 'created_at', 'updated_at'];
}
