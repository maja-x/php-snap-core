<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore\Enum;

enum FlagAdvise: string
{
    case RETRY_NOTIFICATION = 'Y';
    case NEW_NOTIFICATION = 'N';
}
