<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Models\Ticket;
use Webmozart\Assert\Assert;

class LatestTickets extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    public function mount(): void
    {
        self::$heading = __('Latest tickets');
    }

    public static function canView(): bool
    {
        Assert::notNull(auth()->user());

        return auth()->user()->can('List tickets');
    }

    protected function getTableQuery(): Builder
    {
        return Ticket::query()
            ->limit(5)
            ->where(static function ($query) {
                Assert::notNull(auth()->user());

                return $query->where('owner_id', auth()->id())
                    ->orWhere('responsible_id', auth()->id())
                    ->orWhereHas('project', static function ($query) {
                        Assert::notNull(auth()->user());

                        return $query->where('owner_id', auth()->id())
                            ->orWhereHas('users', static function ($query) {
                                Assert::notNull(auth()->user());

                                return $query->where('users.id', auth()->id());
                            });
                    });
            })
            ->latest();
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label(__('Ticket'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                    <div class="flex flex-col gap-1">
                        <span class="text-gray-400 font-medium text-xs">
                            '.$record->project->name.'
                        </span>
                        <span>
                            <a href="'.route('filament.resources.tickets.share', $record->code)
                    .'" target="_blank" class="text-primary-500 text-sm hover:underline">'
                    .$record->code
                    .'</a>
                            <span class="text-sm text-gray-400">|</span> '
                    .$record->name.'
                        </span>
                        '.($record->responsible ? '
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1 text-xs text-gray-400">'
                        .view('components.user-avatar', ['user' => $record->responsible])
                        .'<span>'.$record->responsible->name.'</span>'
                        .'</div>
                        </div>' : '').'
                    </div>
                ')),

            TextColumn::make('status.name')
                ->label(__('Status'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->status->color.'"
                                    title="'.$record->status->name.'"></span>
                            </div>
                        ')),

            TextColumn::make('type.name')
                ->label(__('Type'))
                ->formatStateUsing(static fn ($record) => view('components.ticket-type', ['type' => $record->type])),

            TextColumn::make('priority.name')
                ->label(__('Priority'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->priority->color.'"
                                    title="'.$record->priority->name.'"></span>
                            </div>
                        ')),
        ];
    }
}
