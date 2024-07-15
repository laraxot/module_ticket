<?php

declare(strict_types=1);

namespace Modules\Ticket\Notifications;

use Webmozart\Assert\Assert;
use Illuminate\Bus\Queueable;
use Modules\User\Models\User;
use Modules\Ticket\Models\TicketComment;
use Filament\Notifications\Actions\Action;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Notifications\Notification as FilamentNotification;

class TicketCommented extends Notification implements ShouldQueue
{
    use Queueable;

    private TicketComment $ticketComment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TicketComment $ticketComment)
    {
        $this->ticketComment = $ticketComment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(User $notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail(User $notifiable)
    {
        Assert::notNull($this->ticketComment->ticket);

        return (new MailMessage())
            ->line(
                __(
                    'A new comment has been added to the ticket :ticket by :name.',
                    [
                        'ticket' => $this->ticketComment->ticket->name ?? '-',
                        'name' => $this->ticketComment->user->name ?? '-',
                    ]
                )
            )
            ->line(__('See more details of this ticket by clicking on the button below:'))
            ->action(
                __('View details'),
                route('filament.resources.tickets.share', $this->ticketComment->ticket->code)
            );
    }

    public function toDatabase(User $notifiable): array
    {
        Assert::notNull($this->ticketComment->ticket);

        return FilamentNotification::make()
            ->title(
                __(
                    'Ticket :ticket commented',
                    [
                        'ticket' => $this->ticketComment->ticket->name,
                    ]
                )
            )
            ->icon('heroicon-o-ticket')
            ->body(fn () => __('by :name', ['name' => $this->ticketComment->user?->name ?? '-']))
            ->actions([
                Action::make('view')
                    ->link()
                    ->icon('heroicon-s-eye')
                    ->url(fn () => route('filament.resources.tickets.share', $this->ticketComment->ticket->code)),
            ])
            ->getDatabaseMessage();
    }
}
