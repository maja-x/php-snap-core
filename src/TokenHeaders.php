<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

use DateTime;

class TokenHeaders
{
    public string $contentType = "application/json";
    public string $authorization;
    public DateTime $xTimestamp;
    public string $xSignature;
    public ?string $xClientKey;
}
