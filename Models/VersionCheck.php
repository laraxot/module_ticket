<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $current_version
 * @property string $new_version
 * @property string $created_at
 * @property string $updated_at
 */
class VersionCheck extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['current_version', 'new_version', 'created_at', 'updated_at'];
}
