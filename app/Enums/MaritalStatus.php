<?php

namespace App\Enums;

enum MaritalStatus: string
{
    use Renderable;

    case MARRIED = 'Married';
    case SINGLE = 'Single';
}
