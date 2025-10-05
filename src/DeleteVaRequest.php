<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class DeleteVaRequest
{
    public string $partnerServiceId;
    public string $customerNo;
    public string $virtualAccountNo;
    public string $trxId;
    public ?array $additionalInfo;
}
