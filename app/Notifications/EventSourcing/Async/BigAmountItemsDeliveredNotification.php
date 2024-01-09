<?php

namespace App\Notifications\EventSourcing\Async;

use App\Models\EventSourcing\Async\Citizen;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BigAmountItemsDeliveredNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Citizen $citizen, private readonly int $amount)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line("El usuario {$this->citizen->user->name} ha entregado demasiados elementos de una vez")
                    ->line("La cantidad de elementeos entregada ha sido {$this->amount}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
