<?php

namespace App\Enums;

use BackedEnum;

enum TaskPriority: string
{
    case Low = 'low';

    case Medium = 'medium';

    case High = 'high';

    public static function names(): array
    {
        return array_column(TaskPriority::cases(), 'name');
    }

    public static function values(): array
    {
        $cases = TaskPriority::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value')
            : array_column($cases, 'name');
    }
}
