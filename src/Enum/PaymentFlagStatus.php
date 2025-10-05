<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore\Enum;

enum PaymentFlagStatus: string
{
    case SUCCESS = '00';
    case REJECTED = '01';
    case TIMEOUT = '02';
}
