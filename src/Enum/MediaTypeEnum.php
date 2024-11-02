<?php

declare(strict_types=1);

namespace App\Enum;

use App\Enum\Traits\UtilsTrait;

enum MediaTypeEnum: string
{
    use UtilsTrait;

    case MOVIE = 'movie';
    case TV_SHOW = 'tv_show';
}
