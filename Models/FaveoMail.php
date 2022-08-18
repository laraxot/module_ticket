<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $email_id
 * @property string $drive
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class FaveoMail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email_id', 'drive', 'key', 'value', 'created_at', 'updated_at'];
}
