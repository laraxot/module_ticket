<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Webmozart\Assert\Assert;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\Ticket\Models\TicketStatus.
 *
 * @property string $name
 * @property bool $is_default
 * @property int $project_id
 * @property int $order
 *
 * @mixin \Eloquent
 */
class TicketStatus extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'is_default', 'order',
        'project_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function (TicketStatus $item) {
            Assert::notNull($item->project);
            if ($item->is_default) {
                $query = TicketStatus::where('id', '<>', $item->id)
                    ->where('is_default', true);
                if ($item->project_id) {
                    $query->where('project_id', $item->project->id);
                }
                $query->update(['is_default' => false]);
            }

            $query = TicketStatus::where('order', '>=', $item->order)->where('id', '<>', $item->id);
            if ($item->project_id) {
                $query->where('project_id', $item->project->id);
            }
            $toUpdate = $query->orderBy('order', 'asc')
                ->get();
            $order = $item->order;
            foreach ($toUpdate as $i) {
                if ($i->order == $order || $i->order == ($order + 1)) {
                    $i->order = $i->order + 1;
                    $i->save();
                    $order = $i->order;
                }
            }
        });
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'status_id', 'id')->withTrashed();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
