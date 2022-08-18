<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $new_ticket
 * @property boolean $agent_new_ticket
 * @property boolean $submitter
 * @property boolean $participants
 * @property boolean $overlimit
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsAutoResponse extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['new_ticket', 'agent_new_ticket', 'submitter', 'participants', 'overlimit', 'created_at', 'updated_at'];
}
