<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Webmozart\Assert\Assert;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int                                                                          $id
 * @property string                                                                       $name
 * @property string                                                                       $color
 * @property int                                                                          $is_default
 * @property int                                                                          $order
 * @property int|null                                                                     $project_id
 * @property \Illuminate\Support\Carbon|null                                              $deleted_at
 * @property \Illuminate\Support\Carbon|null                                              $created_at
 * @property \Illuminate\Support\Carbon|null                                              $updated_at
 * @property string|null                                                                  $updated_by
 * @property string|null                                                                  $created_by
 * @property string|null                                                                  $deleted_by
 * @property Project|null                                                                 $project
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket> $tickets
 * @property int|null                                                                     $tickets_count
 * @method static \Modules\Ticket\Database\Factories\TicketStatusFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus     withoutTrashed()
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
