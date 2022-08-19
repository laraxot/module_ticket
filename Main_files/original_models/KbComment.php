<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $comment
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property KbArticle $kbArticle
 */
class KbComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'name', 'email', 'website', 'comment', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kbArticle()
    {
        return $this->belongsTo('App\Models\KbArticle', 'article_id');
    }
}
