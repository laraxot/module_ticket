<?php

declare(strict_types=1);

namespace Modules\Ticket\Notifications;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Ticket\Models\TicketComment;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

class TicketCommented extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private readonly TicketComment $ticketComment)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(User $notifiable): array
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
        Assert::notNull($this->ticketComment->user);

        return (new MailMessage())
            ->line(
                __(
                    'A new comment has been added to the ticket :ticket by :name.',
                    [
                        'ticket' => $this->ticketComment->ticket->name,
                        'name' => $this->ticketComment->user->name,
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
        Assert::notNull($this->ticketComment->user);

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
            ->body(fn () => __('by :name', ['name' => $this->ticketComment->user->name]))
            ->actions([
                Action::make('view')
                    ->link()
                    ->icon('heroicon-s-eye')
                    ->url(fn () => route('filament.resources.tickets.share', $this->ticketComment->ticket->code)),
            ])
            ->getDatabaseMessage();
    }
}
