<?php

declare(strict_types=1);

namespace Modules\Ticket\Observers;

use Illuminate\Support\Facades\Notification;
use Modules\LU\Models\User;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Notifications\AssignedTicketNotification;
use Modules\Ticket\Notifications\DataChangeEmailNotification;

class TicketActionObserver
{
    // public function created(Ticket $model) {
    //    $data = ['action' => 'New ticket has been created!', 'model_name' => 'Ticket', 'ticket' => $model];
    // non so se sia giusto fatto così
    // i ruoli li abbiamo sul profilo e non sull'utente quindi non saprei come sistemarlo bene.
    /* $users = User::whereHas('roles', function ($q) {
         return $q->where('title', 'Admin');
     })->get();*/

    //    return collect([]);
    // le notifiche mancano. probabilmente vanno fatte con le nostre notifiche. Intanto commento (oggi 2021-03-02)
    // Notification::send($users, new DataChangeEmailNotification($data));
    // }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function updated(Ticket $model)
    {
        // if ($model->isDirty('assigned_to_user_id')) {
        //     $user = $model->assigned_to_user;
        //     if ($user) {
        //         Notification::send($user, new AssignedTicketNotification($model));
        //     }
        // }
    }
}
