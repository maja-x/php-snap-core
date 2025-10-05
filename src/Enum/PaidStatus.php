<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore\Enum;

enum PaidStatus: string
{
    case UNPAID = 'N';
    case PAID = 'Y';
}
