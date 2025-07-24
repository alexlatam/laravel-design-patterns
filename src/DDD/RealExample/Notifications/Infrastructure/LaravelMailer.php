<?php

namespace DDD\RealExample\Notifications\Infrastructure;

use DDD\RealExample\Notifications\Domain\MailerInterface;
use Illuminate\Support\Facades\Mail;

class LaravelMailer implements MailerInterface
{
    public function sendWelcomeEmail(string $email, array $data): void
    {
        Mail::send('emails.welcome', $data, function ($message) use ($email) {
            $message->to($email)->subject('Welcome to our platform');
        });
    }
}
