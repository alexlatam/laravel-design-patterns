<?php

namespace App\Enums;

enum ReviewEvents: string
{
    case ReviewCreated = 'review.created';
    case ReviewUpdated = 'review.updated';
    case ReviewDeleted = 'review.deleted';
}
