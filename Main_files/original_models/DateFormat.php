<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $format
 * @property SettingsSystem[] $settingsSystems
 */
class DateFormat extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['format'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settingsSystems()
    {
        return $this->hasMany('App\Models\SettingsSystem', 'date_format');
    }
}
