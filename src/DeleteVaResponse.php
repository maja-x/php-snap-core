<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class DeleteVaResponse
{
    public string $responseCode;
    public string $responseMessage;
    public DeleteVaRequest $virtualAccountData;
}
