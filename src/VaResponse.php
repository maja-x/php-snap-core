<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class VaResponse
{
    public string $responseCode;
    public string $responseMessage;
    public VirtualAccountData $virtualAccountData;
}
