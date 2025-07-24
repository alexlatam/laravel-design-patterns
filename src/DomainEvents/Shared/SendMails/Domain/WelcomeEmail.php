<?php

namespace DomainEvents\Shared\SendMails\Domain;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\AggregateRoot;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserId;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserName;
use DomainEvents\Shared\SendMails\Domain\Events\WelcomeEmailSentDomainEvent;

final class WelcomeEmail extends AggregateRoot
{
    private const FROM = 'support@info.com';

    private function __construct(
        private readonly EmailId      $id,
        private readonly EmailAddress $from,
        private readonly EmailAddress $to,
        private readonly EmailBody    $body,
        private readonly UserId       $user_id,
        private readonly UserName     $user_name,
    ) {}

    public static function send(string $id, string $user_id, string $name, string $email): self
    {
        $from = new EmailAddress(self::FROM);
        $body = self::generateBody($user_id, $name);

        $email = new self(
            id: new EmailId($id),
            from: $from,
            to: new EmailAddress($email),
            body: $body,
            user_id: new UserId($user_id),
            user_name: new UserName($name),
        );

        /**
         * Registramos el evento de dominio en el agregado.
         * El evento registrado es: Email de Bienvenida creado [WelcomeEmailSentDomainEvent]
         */
        $email->record(new WelcomeEmailSentDomainEvent(
            aggregateId: $email->id->value(),
            userId: $email->user_id->value(),
            name: $email->user_name->value(),
            fromEmailAddress: $email->from->value(),
            toEmailAddress: $email->to->value(),
            body: $email->body->value(),
        ));

        return $email;
    }

    private function generateBody(string $user_id, string $name): EmailBody
    {
        return new EmailBody("Hola {$name}, bienvenido a nuestra plataforma. Tu id de usuario es: {$user_id}");
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->value(),
            'from' => $this->from->value(),
            'to' => $this->to->value(),
            'body' => $this->body->value(),
            'userId' => $this->user_id->value(),
            'userName' => $this->user_name->value(),
        ];
    }

    public function getId(): string
    {
        return $this->id->value();
    }

    public function getFrom(): string
    {
        return $this->from->value();
    }

    public function getTo(): string
    {
        return $this->to->value();
    }

    public function getBody(): string
    {
        return $this->body->value();
    }

    public function getUserId(): string
    {
        return $this->user_id->value();
    }

    public function getUserName(): string
    {
        return $this->user_name->value();
    }
}
