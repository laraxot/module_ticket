<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Models\TicketComment;
use Webmozart\Assert\Assert;

class LatestComments extends BaseWidget
{
    protected static ?int $sort = 8;

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    public function mount(): void
    {
        self::$heading = __('Latest tickets comments');
    }

    public static function canView(): bool
    {
        Assert::notNull(auth()->user());

        return auth()->user()->can('List tickets');
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return TicketComment::query()
            ->limit(5)
            ->whereHas('ticket', static function ($query) {
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

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('ticket')
                ->label(__('Ticket'))
                ->formatStateUsing(static fn ($state): HtmlString => new HtmlString('
                    <div class="flex flex-col gap-1">
                        <span class="text-gray-400 font-medium text-xs">
                            '.$state->project->name.'
                        </span>
                        <span>
                            <a href="'.route('filament.resources.tickets.share', $state->code)
                    .'" target="_blank" class="text-primary-500 text-sm hover:underline">'
                    .$state->code
                    .'</a>
                            <span class="text-sm text-gray-400">|</span> '
                    .$state->name.'
                        </span>
                    </div>
                ')),

            TextColumn::make('user.name')
                ->label(__('Owner'))
                ->formatStateUsing(static fn ($record) => view('components.user-avatar', ['user' => $record->user])),

            TextColumn::make('created_at')
                ->label(__('Commented at'))
                ->dateTime(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->label(__('View'))
                ->icon('heroicon-s-eye')
                ->color('gray')
                ->modalHeading(__('Comment details'))
                ->modalButton(__('View ticket'))
                ->form([
                    RichEditor::make('content')
                        ->label(__('Content'))
                        ->default(static fn ($record) => $record->content)
                        ->disabled(),
                ])
                ->action(
                    static fn ($record) => redirect()->to(route('filament.resources.tickets.share', $record->ticket->code))
                ),
        ];
    }
}
