<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $formname
 * @property string $created_at
 * @property string $updated_at
 * @property HelpTopic[] $helpTopics
 */
class CustomForm extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['formname', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'custom_form');
    }
}
