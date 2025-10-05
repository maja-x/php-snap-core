<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

use DateTime;

class TransactionHeaders extends TokenHeaders
{
    public string $contentType = "application/json";
    public string $authorization;
    public DateTime $xTimestamp;
    public string $xSignature;
    public string $xPartnerId;
    public ?string $xExternalId;
    public ?string $xIpAddress;
    public ?string $xDeviceId;
    public ?string $channelId;
    public ?string $xLatitude;
    public ?string $xLongitude;
    public ?string $origin;
}
