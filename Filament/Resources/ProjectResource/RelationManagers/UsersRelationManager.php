<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $inverseRelationship = 'projectsAffected';

    public static function attach(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('User full name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pivot.role')
                    ->label(__('User role')),
                // BadgeColumn::make('pivot.role')
                //     ->label(__('User role'))
                //     ->enum(config('system.projects.affectations.roles.list'))
                //     ->colors(config('system.projects.affectations.roles.colors'))
                //     ->searchable()
                //     ->sortable(),
            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(static fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Select::make('role')
                            ->label(__('User role'))
                            ->searchable()
                            ->default(static fn () => config('system.projects.affectations.roles.default'))
                            ->options(static fn () => config('system.projects.affectations.roles.list'))
                            ->required(),
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->modalWidth('xl')
                    ->form(static fn (EditAction $action): array => [
                        Select::make('role')
                            ->label(__('User role'))
                            ->searchable()
                            ->options(static fn () => config('system.projects.affectations.roles.list'))
                            ->required(),
                    ]),
                DeleteAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                DetachBulkAction::make(),
            ]);
    }

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canDelete(Model $record): bool
    {
        return false;
    }

    protected function canDeleteAny(): bool
    {
        return false;
    }
}
