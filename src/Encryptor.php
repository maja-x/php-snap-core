<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class Encryptor
{
    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $privateKey = "",
    ) {
    }
}
