<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $pagination
 * @property string $created_at
 * @property string $updated_at
 */
class KbSetting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['pagination', 'created_at', 'updated_at'];
}
