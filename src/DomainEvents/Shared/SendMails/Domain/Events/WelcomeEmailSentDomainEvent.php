<?php

namespace DomainEvents\Shared\SendMails\Domain\Events;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\DomainEvent;

final class WelcomeEmailSentDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $aggregateId,
        private readonly string $userId,
        private readonly string $name,
        private readonly string $fromEmailAddress,
        private readonly string $toEmailAddress,
        private readonly string $body,
        string                  $eventId = null,
        string                  $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->aggregateId,
            'userId' => $this->userId,
            'name' => $this->name,
            'fromEmailAddress' => $this->fromEmailAddress,
            'toEmailAddress' => $this->toEmailAddress,
            'body' => $this->body,
        ];
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self(
            $aggregateId,
            $body['userId'],
            $body['name'],
            $body['fromEmailAddress'],
            $body['toEmailAddress'],
            $body['body'],
            $eventId,
            $occurredOn
        );
    }

    public static function eventName(): string
    {
        return 'application_name.email.welcome_email.sent';
    }

}
