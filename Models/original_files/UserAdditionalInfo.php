<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $owner
 * @property string $service
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class UserAdditionalInfo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['owner', 'service', 'key', 'value', 'created_at', 'updated_at'];
}
