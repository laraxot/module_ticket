<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property boolean $status
 * @property boolean $type
 * @property string $publish_time
 * @property string $created_at
 * @property string $updated_at
 * @property KbArticleRelationship[] $kbArticleRelationships
 * @property KbComment[] $kbComments
 */
class KbArticle extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'status', 'type', 'publish_time', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kbArticleRelationships()
    {
        return $this->hasMany('App\Models\KbArticleRelationship', 'article_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kbComments()
    {
        return $this->hasMany('App\Models\KbComment', 'article_id');
    }
}
