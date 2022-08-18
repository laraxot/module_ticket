<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $thread_id
 * @property string $name
 * @property string $size
 * @property string $type
 * @property string $poster
 * @property string $created_at
 * @property string $updated_at
 * @property string $file
 * @property string $driver
 * @property string $path
 * @property TicketThread $ticketThread
 */
class TicketAttachment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['thread_id', 'name', 'size', 'type', 'poster', 'created_at', 'updated_at', 'file', 'driver', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketThread()
    {
        return $this->belongsTo('App\Models\TicketThread', 'thread_id');
    }
}
