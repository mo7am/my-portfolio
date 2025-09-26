<?php

namespace App\Enums;

enum Status: string
{
    use Renderable;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
