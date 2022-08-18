<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property SettingsSystem[] $settingsSystems
 */
class Timezone extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'location'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settingsSystems()
    {
        return $this->hasMany('App\Models\SettingsSystem', 'time_zone');
    }
}
