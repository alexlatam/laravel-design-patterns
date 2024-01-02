<?php

namespace App\Enums;

enum ReviewStates
{
    case IN_PROGRESS;
    case APPROVED;
    case REJECTED;
}
