<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rating_id
 * @property integer $ticket_id
 * @property integer $thread_id
 * @property integer $rating_value
 * @property string $created_at
 * @property string $updated_at
 */
class RatingRef extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rating_id', 'ticket_id', 'thread_id', 'rating_value', 'created_at', 'updated_at'];
}
