<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Resources\TimesheetResource\Pages\EditTimesheet;
use Modules\Ticket\Filament\Resources\TimesheetResource\Pages\ListTimesheet;
use Modules\Ticket\Models\Activity;
use Modules\Ticket\Models\TicketHour;
use Webmozart\Assert\Assert;

class TimesheetResource extends Resource
{
    protected static ?string $model = TicketHour::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('Timesheet');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Timesheet');
    }

    public static function shouldRegisterNavigation(): bool
    {
        Assert::notNull(auth()->user());

        return auth()->user()->can('List timesheet data');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('activity_id')
                            ->label(__('Activity'))
                            ->searchable()
                            ->reactive()
                            ->options(static fn ($get, $set) => Activity::all()->pluck('name', 'id')->toArray()),
                        TextInput::make('value')
                            ->label(__('Time to log'))
                            ->numeric()
                            ->required(),

                        Textarea::make('comment')
                            ->label(__('Comment'))
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('Owner'))
                    ->sortable()
                    ->formatStateUsing(static fn ($record) => view('components.user-avatar', ['user' => $record->user]))
                    ->searchable(),

                TextColumn::make('value')
                    ->label(__('Hours'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('comment')
                    ->label(__('Comment'))
                    ->limit(50)
                    ->sortable()
                    ->searchable(),

                TextColumn::make('activity.name')
                    ->label(__('Activity'))
                    ->sortable(),

                TextColumn::make('ticket.name')
                    ->label(__('Ticket'))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTimesheet::route('/'),
            'edit' => EditTimesheet::route('/{record}/edit'),
        ];
    }
}
