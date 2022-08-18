<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $ban_status
 * @property string $email_address
 * @property string $internal_notes
 * @property string $created_at
 * @property string $updated_at
 */
class Banlist extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ban_status', 'email_address', 'internal_notes', 'created_at', 'updated_at'];
}
