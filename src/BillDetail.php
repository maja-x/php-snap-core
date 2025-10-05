<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class BillDetail
{
    public ?string $billCode;
    public ?string $billNo;
    public ?string $billName;
    public ?string $billShortName;
    public Description $description;
    public ?string $billSubCompany;
    public Amount $billAmount;
    public array $additionalInfo;
}
