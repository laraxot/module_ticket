<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $log
 * @property string $created_at
 * @property string $updated_at
 */
class LogNotification extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['log', 'created_at', 'updated_at'];
}
