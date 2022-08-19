<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class QueueService extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'short_name', 'status', 'created_at', 'updated_at'];
}
