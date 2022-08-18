<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class MailboxProtocol extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'value'];
}
