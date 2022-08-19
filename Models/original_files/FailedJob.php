<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $failed_at
 */
class FailedJob extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['connection', 'queue', 'payload', 'failed_at'];
}
