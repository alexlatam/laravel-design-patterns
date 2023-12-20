<?php

namespace App\Listeners;

use App\Events\App\NewProductCreated;
use App\Mail\ProductCreatedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewProductNotifyUserByEmailListener
{
    /**
     * Handle the event.
     */
    public function handle(NewProductCreated $event): void
    {
        Mail::to($event->user->email)
            ->send(
                new ProductCreatedEmail($event->product)
            );
    }
}
