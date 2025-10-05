<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

use DateTime;
use Maja\PhpSnapCore\Enum\VirtualAccountTrxType;

class CreateVaRequest
{
    public string $partnerServiceId;
    public string $customerNo;
    public string $virtualAccountNo;
    public string $virtualAccountName;
    public ?string $virtualAccountEmail;
    public ?string $virtualAccountPhone;
    public string $trxId;
    public Amount $totalAmount;
    /** @var BillDetail[] */
    public array $billDetails;
    /** @var Description[] */
    public array $freeTexts;
    public VirtualAccountTrxType $virtualAccountTrxType;
    public ?Amount $feeAmount;
    public ?DateTime $expiredDate;
    public ?array $additionalInfo;
}
