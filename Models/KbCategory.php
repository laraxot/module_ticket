<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property boolean $status
 * @property integer $parent
 * @property string $created_at
 * @property string $updated_at
 * @property KbArticleRelationship[] $kbArticleRelationships
 */
class KbCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'status', 'parent', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kbArticleRelationships()
    {
        return $this->hasMany('App\Models\KbArticleRelationship', 'category_id');
    }
}
