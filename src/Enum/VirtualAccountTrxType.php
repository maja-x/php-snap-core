<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore\Enum;

enum VirtualAccountTrxType: string
{
    case CLOSED_PAYMENT = 'c';
    case OPEN_PAYMENT = 'o';
    case PARTIAL = "i";
    case MINIMUM = "m";
    case MAXIMUM = "l";
    case OPEN_MINIMUM = "n";
    case OPEN_MAXIMUM = "x";
    case BILL_VARIABLE = "v";
    case MULTI_BILL_VARIABLE = "w";
}
