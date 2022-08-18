<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $provider
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class SocialMedia extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['provider', 'key', 'value', 'created_at', 'updated_at'];
}
