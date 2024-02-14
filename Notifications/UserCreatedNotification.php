<?php

declare(strict_types=1);

namespace Modules\Ticket\Notifications;

use Illuminate\Bus\Queueable;
use Modules\User\Models\User;
use Modules\Xot\Datas\MetatagData;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public User $user)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail(User $notifiable)
    {


        return (new MailMessage())
            ->subject(__('Validate your account'))
            ->line(__('Welcome to :app platform.', ['app' => MetatagData::make()->sitename]))
            ->line(__('To complete the creation of your account, please use the below button to choose a password and verify your user account.'))
            //->action(__('Verify my account'), route('validate-account', $this->user->creation_token))
            ;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(User $notifiable): array
    {
        return [
        ];
    }
}
