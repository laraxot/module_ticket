<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\TicketStatusFactory;
use Webmozart\Assert\Assert;

/**
 * Modules\Ticket\Models\TicketStatus.
 *
 * @property Project|null            $project
 * @property Collection<int, Ticket> $tickets
 * @property int|null                $tickets_count
 *
 * @method static TicketStatusFactory  factory($count = null, $state = [])
 * @method static Builder|TicketStatus newModelQuery()
 * @method static Builder|TicketStatus newQuery()
 * @method static Builder|TicketStatus onlyTrashed()
 * @method static Builder|TicketStatus query()
 * @method static Builder|TicketStatus withTrashed()
 * @method static Builder|TicketStatus withoutTrashed()
 *
 * @property int         $id
 * @property string      $name
 * @property string      $color
 * @property int         $is_default
 * @property int         $order
 * @property int|null    $project_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 *
 * @method static Builder|TicketStatus whereColor($value)
 * @method static Builder|TicketStatus whereCreatedAt($value)
 * @method static Builder|TicketStatus whereCreatedBy($value)
 * @method static Builder|TicketStatus whereDeletedAt($value)
 * @method static Builder|TicketStatus whereDeletedBy($value)
 * @method static Builder|TicketStatus whereId($value)
 * @method static Builder|TicketStatus whereIsDefault($value)
 * @method static Builder|TicketStatus whereName($value)
 * @method static Builder|TicketStatus whereOrder($value)
 * @method static Builder|TicketStatus whereProjectId($value)
 * @method static Builder|TicketStatus whereUpdatedAt($value)
 * @method static Builder|TicketStatus whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class TicketStatus extends BaseModel
{
    protected $fillable = [
        'name',
        'color',
        'is_default',
        'order',
        'project_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(static function (TicketStatus $item): void {
            Assert::isInstanceOf($item, TicketStatus::class);
            if (0 !== $item->is_default) {
                $query = TicketStatus::where('id', '<>', $item->id)
                    ->where('is_default', true);
                Assert::notNull($item->project);
                if ($item->project_id) {
                    $query->where('project_id', $item->project->id);
                }

                $query->update(['is_default' => false]);
            }

            $query = TicketStatus::where('order', '>=', $item->order)->where('id', '<>', $item->id);
            Assert::notNull($item->project);
            if ($item->project_id) {
                $query->where('project_id', $item->project->id);
            }

            $toUpdate = $query->orderBy('order', 'asc')
                ->get();
            $order = $item->order;
            foreach ($toUpdate as $i) {
                if ($i->order === $order || $i->order === ($order + 1)) {
                    ++$i->order;
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
