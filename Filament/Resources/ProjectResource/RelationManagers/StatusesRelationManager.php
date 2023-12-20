<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Ticket\Models\TicketStatus;

class StatusesRelationManager extends RelationManager
{
    protected static string $relationship = 'statuses';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Access to an undefined property Illuminate\Database\Eloquent\Model::$status_type.
        return 'custom' === $ownerRecord->status_type;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Status name'))
                    ->required()
                    ->maxLength(255),

                ColorPicker::make('color')
                    ->label(__('Status color'))
                    ->required(),

                Checkbox::make('is_default')
                    ->label(__('Default status'))
                    ->helperText(
                        __('If checked, this status will be automatically affected to new projects')
                    ),

                TextInput::make('order')
                    ->label(__('Status order'))
                    ->integer()
                    ->default(static fn ($livewire): int => TicketStatus::where('project_id', $livewire->ownerRecord->id)->count() + 1
                    )
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label(__('Status order'))
                    ->sortable()
                    ->searchable(),

                ColorColumn::make('color')
                    ->label(__('Status color'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label(__('Status name'))
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_default')
                    ->label(__('Default status'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('order');
    }

    protected function canAttach(): bool
    {
        return false;
    }
}
