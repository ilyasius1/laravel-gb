<?php

declare(strict_types=1);

namespace App\Enums;

enum ParserType: string
{
    case NEWS = 'news';
    case RATE = 'rate';

    public static function all(): array
    {
        return [
            self::NEWS->value,
            self::RATE->value,
        ];
    }
}
