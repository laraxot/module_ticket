<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\ActionGroup;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ticket\Exports\TicketHoursExport;
use Modules\Ticket\Filament\Resources\TicketResource;
use Modules\Ticket\Models\Activity;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketComment;
use Modules\Ticket\Models\TicketHour;
use Modules\Ticket\Models\TicketSubscriber;
use Webmozart\Assert\Assert;

class ViewTicket extends ViewRecord implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = TicketResource::class;

    protected static string $view = 'ticket::filament.resources.tickets.view';

    public string $tab = 'comments';

    /**
     * @var array<string>
     */
    protected $listeners = ['doDeleteComment'];

    public ?string $selectedCommentId;

    public function mount(int|string $record): void
    {
        parent::mount($record);
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        if ($this->record == null) {
            return [];
        }
        Assert::isInstanceOf($this->record, Ticket::class);

        return [
            Actions\Action::make('toggleSubscribe')
                ->label(
                    fn () => $this->record->subscribers()->where('users.id', auth()->id())->count() ?
                        __('Unsubscribe')
                        : __('Subscribe')
                )
                ->color(
                    fn (): string => $this->record->subscribers()->where('users.id', auth()->id())->count() ?
                        'danger'
                        : 'success'
                )
                ->icon('heroicon-o-bell')
                ->button()
                ->action(function (): void {
                    Assert::isInstanceOf($this->record, Ticket::class);
                    if (
                        $sub = TicketSubscriber::where('user_id', auth()->id())
                            ->where('ticket_id', $this->record->id)
                            ->first()
                    ) {
                        $sub->delete();
                        // $this->notify('success', __('You unsubscribed from the ticket'));
                        Notification::make()
                            ->title(__('You unsubscribed from the ticket'))
                            ->success()
                            ->send();
                    } else {
                        TicketSubscriber::create([
                            'user_id' => auth()->id(),
                            'ticket_id' => $this->record->id,
                        ]);
                        // $this->notify('success', __('You subscribed to the ticket'));
                        Notification::make()
                            ->title(__('You subscribed to the ticket'))
                            ->success()
                            ->send();
                    }

                    $this->record->refresh();
                }),
            Actions\Action::make('share')
                ->label(__('Share'))
                ->color('gray')
                ->button()
                ->icon('heroicon-o-share')
                ->action(fn () => $this->dispatch('shareTicket', [
                    'url' => route('filament.resources.tickets.share', $this->record->code),
                ])),
            EditAction::make(),
            Actions\Action::make('logHours')
                ->label(__('Log time'))
                ->icon('heroicon-o-clock')
                ->color('warning')
                ->modalWidth('sm')
                ->modalHeading(__('Log worked time'))
                ->modalSubheading(__('Use the following form to add your worked time in this ticket.'))
                ->modalButton(__('Log'))
                ->visible(fn (): bool => \in_array(
                    auth()->id(),
                    [$this->record->owner_id, $this->record->responsible_id], true
                ))
                ->form([
                    TextInput::make('time')
                        ->label(__('Time to log'))
                        ->numeric()
                        ->required(),
                    Select::make('activity_id')
                        ->label(__('Activity'))
                        ->searchable()
                        ->reactive()
                        ->options(static fn ($get, $set) => Activity::all()->pluck('name', 'id')->toArray()),
                    Textarea::make('comment')
                        ->label(__('Comment'))
                        ->rows(3),
                ])
                ->action(function (Collection $records, array $data): void {
                    Assert::isInstanceOf($this->record, Ticket::class);
                    $value = $data['time'];
                    $comment = $data['comment'];
                    TicketHour::create([
                        'ticket_id' => $this->record->id,
                        'activity_id' => $data['activity_id'],
                        'user_id' => auth()->id(),
                        'value' => $value,
                        'comment' => $comment,
                    ]);
                    $this->record->refresh();
                    // $this->notify('success', __('Time logged into ticket'));
                    Notification::make()
                        ->title(__('Time logged into ticket'))
                        ->success()
                        ->send();
                }),
            ActionGroup::make([
                Actions\Action::make('exportLogHours')
                    ->label(__('Export time logged'))
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('warning')
                    ->visible(
                        fn (): bool => $this->record->watchers->where('id', auth()->id())->count()
                            && $this->record->hours()->count()
                    )
                    ->action(fn () => Excel::download(
                        new TicketHoursExport($this->record),
                        'time_'.str_replace('-', '_', (string) $this->record->code).'.csv',
                        \Maatwebsite\Excel\Excel::CSV,
                        ['Content-Type' => 'text/csv']
                    )),
            ])
                ->visible(fn (): bool => \in_array(
                    auth()->id(),
                    [$this->record->owner_id, $this->record->responsible_id], true
                ) || (
                    $this->record->watchers->where('id', auth()->id())->count()
                    && $this->record->hours()->count()
                ))
                ->color('gray'),
        ];
    }

    public function selectTab(string $tab): void
    {
        $this->tab = $tab;
    }

    protected function getFormSchema(): array
    {
        return [
            RichEditor::make('comment')
                ->disableLabel()
                ->placeholder(__('Type a new comment'))
                ->required(),
        ];
    }

    public function submitComment(): void
    {
        Assert::isInstanceOf($this->record, Ticket::class);
        $data = $this->form->getState();
        if ($this->selectedCommentId) {
            TicketComment::where('id', $this->selectedCommentId)
                ->update([
                    'content' => $data['comment'],
                ]);
        } else {
            TicketComment::create([
                'user_id' => auth()->id(),
                'ticket_id' => $this->record->id,
                'content' => $data['comment'],
            ]);
        }

        $this->record->refresh();
        $this->cancelEditComment();
        // $this->notify('success', __('Comment saved'));
        Notification::make()
            ->title(__('Comment saved'))
            ->success()
            ->send();
    }

    public function isAdministrator(): bool
    {
        Assert::isInstanceOf($this->record, Ticket::class);
        Assert::notNull($this->record->project);

        return $this->record
            ->project
            ->users()
            ->where('users.id', auth()->id())
            ->where('role', 'administrator')
            ->count() !== 0;
    }

    public function editComment(int $commentId): void
    {
        Assert::isInstanceOf($this->record, Ticket::class);
        $this->form->fill([
            'comment' => $this->record->comments->where('id', $commentId)->first()?->content,
        ]);
        $this->selectedCommentId = (string) $commentId;
    }

    public function deleteComment(int $commentId): void
    {
        Notification::make()
            ->warning()
            ->title(__('Delete confirmation'))
            ->body(__('Are you sure you want to delete this comment?'))
            ->actions([
                Action::make('confirm')
                    ->label(__('Confirm'))
                    ->color('danger')
                    ->button()
                    ->close()
                    ->emit('doDeleteComment', ['commentId' => $commentId]),
                Action::make('cancel')
                    ->label(__('Cancel'))
                    ->close(),
            ])
            ->persistent()
            ->send();
    }

    public function doDeleteComment(int $commentId): void
    {
        TicketComment::where('id', $commentId)->delete();
        Assert::isInstanceOf($this->record, Ticket::class);
        $this->record->refresh();
        // $this->notify('success', __('Comment deleted'));
        Notification::make()
            ->title(__('Comment deleted'))
            ->success()
            ->send();
    }

    public function cancelEditComment(): void
    {
        $this->form->fill();
        $this->selectedCommentId = null;
    }
}
