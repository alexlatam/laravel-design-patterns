<?php

namespace App\Entities;

use App\Enums\ReviewStates;
use App\Exceptions\ReviewNotUpdatableException;
use DateTime;

final class Review
{
    public function __construct(
        private readonly string   $id,

        private ReviewStates      $state,
        private int               $score,
        private string            $extra,
        private int               $idError,
        private string            $auction,
        private string            $assignee,
        private readonly DateTime $createdAt,
    ) {
    }

    public function setExtra(string $extra): void
    {
        $this->extra = $extra;
    }

    public function getExtra(): string
    {
        return $this->extra;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setState(ReviewStates $state): void
    {
        $this->state = $state;
    }

    public function setAuction(string $auction): void
    {
        $this->auction = $auction;
    }

    public function setAssignee(string $assignee): void
    {
        $this->assignee = $assignee;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getIdError(): int
    {
        return $this->idError;
    }

    public function getState(): ReviewStates
    {
        return $this->state;
    }

    /**
     * @throws ReviewNotUpdatableException
     */
    public function update(array $data): self
    {
        if($this->getState() != ReviewStates::IN_PROGRESS) {
            throw new ReviewNotUpdatableException('Review is not updatable');
        }
        $data['extra'] = serialize(json_decode($data['extra']));

        if (isset($data['score'])) {
            $this->setScore($data['score']);
        }
        if (isset($data['idError'])) {
            $this->setIdError($data['id_error']);
        }

        return new self(
            $data['id'],
            $data['state'],
            $data['score'],
            $data['extra'],
            $data['id_error'],
            $data['auction'],
            $data['assignee'],
            $data['created_at'],
        );
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function setIdError(int $error): void
    {
        $this->idError = $error;
    }

    public function getAuction(): self
    {
        return $this;
    }

    public function getAssignee(): self
    {
        return $this;
    }

    public function getUuid(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [];
    }

}
