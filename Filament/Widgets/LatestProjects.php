<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Models\Project;
use Webmozart\Assert\Assert;

class LatestProjects extends BaseWidget
{
    protected static ?int $sort = 7;

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    public function mount(): void
    {
        self::$heading = __('Latest projects');
    }

    public static function canView(): bool
    {
        Assert::notNull(auth()->user());

        return auth()->user()->can('List projects');
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return Project::query()
            ->limit(5)
            ->where(static function ($query) {
                Assert::notNull(auth()->user());

                return $query->where('owner_id', auth()->id())
                    ->orWhereHas('users', static function ($query) {
                        Assert::notNull(auth()->user());

                        return $query->where('users.id', auth()->id());
                    });
            })
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label(__('Project name'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="w-full flex items-center gap-2">
                                <div style=\'background-image: url("'.$record->cover.'")\'
                                 class="w-8 h-8 bg-cover bg-center bg-no-repeat"></div>
                                '.$record->name.'
                            </div>
                        ')),

            TextColumn::make('owner.name')
                ->label(__('Project owner')),

            TextColumn::make('status.name')
                ->label(__('Project status'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->status->color.'"></span>
                                <span>'.$record->status->name.'</span>
                            </div>
                        ')),
        ];
    }
}
