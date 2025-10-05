<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

use DateTime;

class SignatureOptions
{
    public string $signatureType;
    public string $httpMethod;
    public string $endpointUrl;
    public ?string $accessToken;
    public DateTime $timestamp;
    public VirtualAccountData | DeleteVaRequest $body;
}
