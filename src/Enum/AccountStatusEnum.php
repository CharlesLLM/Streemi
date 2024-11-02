<?php

declare(strict_types=1);

namespace App\Enum;

use App\Enum\Traits\UtilsTrait;

enum AccountStatusEnum: string
{
    use UtilsTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BLOCKED = 'blocked';
    CASE BANNED = 'banned';
}
