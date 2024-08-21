<?php

namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case RESTORED = 'restored';
    case USED = 'used';
    case AS_NEW = 'as_new';
}
