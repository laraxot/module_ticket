<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property integer $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property KbArticle $kbArticle
 * @property KbCategory $kbCategory
 */
class KbArticleRelationship extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'category_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kbArticle()
    {
        return $this->belongsTo('App\Models\KbArticle', 'article_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kbCategory()
    {
        return $this->belongsTo('App\Models\KbCategory', 'category_id');
    }
}
