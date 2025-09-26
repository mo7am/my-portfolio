<?php

namespace App\Enums;

enum UserType: string
{
    use Renderable;

    case ADMIN = 'admin';
    case CLIENT = 'client';

    public static function notAdminList(): array
    {
        return array_map(function ($item) {
            return $item->object();
        }, [self::CLIENT]);
    }
}
