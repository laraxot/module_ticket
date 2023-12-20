<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ticket\Exports\ProjectHoursExport;
use Modules\Ticket\Filament\Resources\ProjectResource\Pages\CreateProject;
use Modules\Ticket\Filament\Resources\ProjectResource\Pages\EditProject;
use Modules\Ticket\Filament\Resources\ProjectResource\Pages\ListProjects;
use Modules\Ticket\Filament\Resources\ProjectResource\Pages\ViewProject;
use Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers\SprintsRelationManager;
use Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers\StatusesRelationManager;
use Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers\UsersRelationManager;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\ProjectFavorite;
use Modules\Ticket\Models\ProjectStatus;
use Modules\User\Models\User;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Projects');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make()
                            ->columns(3)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->label(__('Cover image'))
                                    ->image()
                                    ->helperText(
                                        __('If not selected, an image will be generated based on the project name')
                                    )
                                    ->columnSpan(1),

                                Grid::make()
                                    ->columnSpan(2)
                                    ->schema([
                                        Grid::make()
                                            ->columnSpan(2)
                                            ->columns(12)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label(__('Project name'))
                                                    ->required()
                                                    ->columnSpan(10)
                                                    ->maxLength(255),

                                                TextInput::make('ticket_prefix')
                                                    ->label(__('Ticket prefix'))
                                                    ->maxLength(3)
                                                    ->columnSpan(2)
                                                    ->unique(Project::class, column: 'ticket_prefix', ignoreRecord: true)
                                                    ->disabled(
                                                        static fn ($record): bool => $record && 0 !== $record->tickets()->count()
                                                    )
                                                    ->required(),
                                            ]),

                                        Select::make('owner_id')
                                            ->label(__('Project owner'))
                                            ->searchable()
                                            ->options(static fn () => User::all()->pluck('name', 'id')->toArray())
                                            ->default(static fn () => auth()->id())
                                            ->required(),

                                        Select::make('status_id')
                                            ->label(__('Project status'))
                                            ->searchable()
                                            ->options(static fn () => ProjectStatus::all()->pluck('name', 'id')->toArray())
                                            ->default(static fn () => ProjectStatus::where('is_default', true)->first()?->id)
                                            ->required(),
                                    ]),

                                RichEditor::make('description')
                                    ->label(__('Project description'))
                                    ->columnSpan(3),

                                Select::make('type')
                                    ->label(__('Project type'))
                                    ->searchable()
                                    ->options([
                                        'kanban' => __('Kanban'),
                                        'scrum' => __('Scrum'),
                                    ])
                                    ->reactive()
                                    ->default(static fn (): string => 'kanban')
                                    ->helperText(static function ($state) {
                                        if ('kanban' === $state) {
                                            return __('Display and move your project forward with issues on a powerful board.');
                                        }

                                        if ('scrum' === $state) {
                                            return __('Achieve your project goals with a board, backlog, and roadmap.');
                                        }

                                        return '';
                                    })
                                    ->required(),

                                Select::make('status_type')
                                    ->label(__('Statuses configuration'))
                                    ->helperText(
                                        __('If custom type selected, you need to configure project specific statuses')
                                    )
                                    ->searchable()
                                    ->options([
                                        'default' => __('Default'),
                                        'custom' => __('Custom configuration'),
                                    ])
                                    ->default(static fn (): string => 'default')
                                    ->disabled(static fn ($record): bool => $record && $record->tickets()->count())
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cover')
                    ->label(__('Cover image'))
                    ->formatStateUsing(static fn ($state): HtmlString => new HtmlString('
                            <div style=\'background-image: url("'.$state.'")\'
                                 class="w-8 h-8 bg-cover bg-center bg-no-repeat"></div>
                        ')),

                TextColumn::make('name')
                    ->label(__('Project name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('owner.name')
                    ->label(__('Project owner'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status.name')
                    ->label(__('Project status'))
                    ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->status->color.'"></span>
                                <span>'.$record->status->name.'</span>
                            </div>
                        '))
                    ->sortable()
                    ->searchable(),

                TagsColumn::make('users.name')
                    ->label(__('Affected users'))
                    ->limit(2),

                /*
                Tables\Columns\BadgeColumn::make('type')
                    ->enum([
                        'kanban' => __('Kanban'),
                        'scrum' => __('Scrum'),
                    ])
                    ->colors([
                        'secondary' => 'kanban',
                        'warning' => 'scrum',
                    ]),
                */
                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('owner_id')
                    ->label(__('Owner'))
                    ->multiple()
                    ->options(static fn () => User::all()->pluck('name', 'id')->toArray()),

                SelectFilter::make('status_id')
                    ->label(__('Status'))
                    ->multiple()
                    ->options(static fn () => ProjectStatus::all()->pluck('name', 'id')->toArray()),
            ])
            ->actions([
                Action::make('favorite')
                    ->label('')
                    ->icon('heroicon-o-star')
                    ->color(static fn ($record): string => auth()->user()?->favoriteProjects()
                        ->where('projects.id', $record->id)->count() ? 'success' : 'default')
                    ->action(static function ($record): void {
                        $projectId = $record->id;
                        $projectFavorite = ProjectFavorite::where('project_id', $projectId)
                            ->where('user_id', auth()->id())
                            ->first();
                        if ($projectFavorite) {
                            $projectFavorite->delete();
                        } else {
                            ProjectFavorite::create([
                                'project_id' => $projectId,
                                'user_id' => auth()->id(),
                            ]);
                        }

                        // Filament::notify('success', __('Project updated'));
                        Notification::make()
                            ->title(__('Project updated'))
                            ->success()
                            ->send();
                    }),

                ViewAction::make(),
                EditAction::make(),

                ActionGroup::make([
                    Action::make('exportLogHours')
                        ->label(__('Export hours'))
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('gray')
                        ->action(static fn ($record) => Excel::download(
                            new ProjectHoursExport($record),
                            'time_'.Str::slug($record->name).'.csv',
                            \Maatwebsite\Excel\Excel::CSV,
                            ['Content-Type' => 'text/csv']
                        )),

                    Action::make('kanban')
                        ->label(
                            static fn ($record) => ('scrum' === $record->type ? __('Scrum board') : __('Kanban board'))
                        )
                        ->icon('heroicon-o-view-columns')
                        ->color('gray')
                        ->url(static function ($record) {
                            if ('scrum' === $record->type) {
                                return route('filament.pages.scrum/{project}', ['project' => $record->id]);
                            }

                            return route('filament.pages.kanban/{project}', ['project' => $record->id]);
                        }),
                ])->color('gray'),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SprintsRelationManager::class,
            UsersRelationManager::class,
            StatusesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
