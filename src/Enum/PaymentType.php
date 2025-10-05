<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore\Enum;

enum PaymentType: string
{
    case CASH = '1';
    case TRANSFER = '2';
}
