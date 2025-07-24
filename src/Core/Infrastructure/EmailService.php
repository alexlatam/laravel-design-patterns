<?php

namespace Core\Infrastructure;

use DomainEvents\Shared\SendMails\Domain\Contracts\EmailSenderInterface;
use DomainEvents\Shared\SendMails\Domain\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

final class EmailService implements EmailSenderInterface
{
    public function __construct(private Mail $mail)
    {}

    public function send(WelcomeEmail $mail): void
    {
        // send email
        $this->mail->to($mail->getTo())->send($mail->getBody());
    }
}
