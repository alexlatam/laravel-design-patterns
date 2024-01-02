<?php

namespace App\Repositories;

use App\Entities\Review as ReviewEntity;
use App\Exceptions\ReviewDoesNotExistException;
use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * @throws ReviewDoesNotExistException
     */
    public function findOrFail(int $id): ReviewEntity
    {
        $review = Review::find($id);
        if (is_null($review)) {
            throw new ReviewDoesNotExistException('Review does not exist');
        }
        return self::toEntity($review);
    }

    public static function toEntity(Review $review): ReviewEntity
    {
        return new ReviewEntity(
            id: $review->id,
            state: $review->state,
            score: $review->score,
            extra: $review->extra,
            idError: $review->id_error,
            auction: $review->auction,
            assignee: $review->assignee,
            createdAt: $review->created_at,
        );
    }

    /**
     * @throws ReviewDoesNotExistException
     */
    public function save(ReviewEntity $review): void
    {
        $reviewModel = Review::find($review->getUuid());
        if (is_null($reviewModel)) {
            throw new ReviewDoesNotExistException('Review does not exist');
        }
        $reviewModel->id = $review->getUuid();
        $reviewModel->state = $review->getState();
        $reviewModel->score = $review->getScore();
        $reviewModel->extra = $review->getExtra();
        $reviewModel->id_error = $review->getIdError();
        $reviewModel->auction = $review->getAuction();
        $reviewModel->assignee = $review->getAssignee();
        $reviewModel->created_at = $review->getCreatedAt();
        $reviewModel->save();
    }
}
