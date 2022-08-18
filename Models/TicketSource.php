<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $css_class
 * @property TicketThread[] $ticketThreads
 * @property Ticket[] $tickets
 */
class TicketSource extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'value', 'css_class'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketThreads()
    {
        return $this->hasMany('App\Models\TicketThread', 'source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'source');
    }
}
