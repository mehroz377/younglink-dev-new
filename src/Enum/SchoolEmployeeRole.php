<?php

declare(strict_types=1);

namespace App\Enum;

enum SchoolEmployeeRole: string
{
    case DIRECTOR = 'DIRECTOR';
    case ADMINISTRATOR = 'ADMINISTRATOR';
    case PSYCHOLOGIST = 'PSYCHOLOGIST';
    case TEACHER = 'TEACHER';
}
