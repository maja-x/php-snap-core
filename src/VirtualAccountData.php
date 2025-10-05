<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

use Maja\PhpSnapCore\Enum\VirtualAccountTrxType;

class VirtualAccountData
{
    public string $partnerServiceId;
    public string $customerNo;
    public string $virtualAccountNo;
    public string $virtualAccountName;
    public ?string $virtualAccountEmail;
    public ?string $virtualAccountPhone;
    public ?Amount $totalAmount;
    /** @var Description **/
    public ?array $freeTexts;
    public ?string $trxId;
    /** @var BillDetail[] **/
    public ?array $billDetails;
    public ?VirtualAccountTrxType $virtualAccountTrxType;
    public ?Amount $feeAmount;
    public ?\DateTime $expiredDate;
    public ?array $additionalInfo;
    public ?\DateTime $lastUpdateDate;
    public ?\DateTime $paymentDate;
}
