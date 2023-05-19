<?php

namespace App\Enums;

enum ArticleStatus: int
{
    case Approved = 1;
    case Pending = 2;
    case Rejected = 3;

    public static function forMigration(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                if (property_exists($enum, 'value')) return $enum->value;
                return $enum->name;
            })
            ->values()
            ->toArray();
    }
}
