<?php

namespace App\Enum;

use App\Enum\Traits\UtilsTrait;

enum AccountStatusEnum: string
{
    use UtilsTrait;

    case Provisional = 'provisional';
    case Active = 'active';
}
