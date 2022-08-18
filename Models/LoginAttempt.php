<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $User
 * @property string $IP
 * @property string $Attempts
 * @property string $LastLogin
 * @property string $created_at
 * @property string $updated_at
 */
class LoginAttempt extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['User', 'IP', 'Attempts', 'LastLogin', 'created_at', 'updated_at'];
}
