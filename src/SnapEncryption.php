<?php

declare(strict_types=1);

namespace Maja\PhpSnapCore;

class SnapEncryption
{
    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $privateKey,
    ) {
    }

    public function generateTokenSignature(TokenHeaders $headers, string $encoding = "hex"): string
    {
        $stringToSign = $headers->xClientKey . "|" . $headers->xTimestamp->format("c");
        return hash_hmac('sha256', $stringToSign, $this->clientSecret, $encoding === "hex" ? false : true);
    }

    public function generateSignature(SignatureOptions $data, string $encoding = "hex"): string
    {
        return match ($data->signatureType) {
            'symetric' => $this->generateSymetricSignature($data, $encoding),
            'asymetric' => $this->generateAsymetricSignature($data, $encoding),
            default => throw new \InvalidArgumentException("Unsupported signature type: " . $data->signatureType),
        };
    }

    public function generateSymetricSignature(SignatureOptions $data, string $encoding = "hex"): string
    {
        if ($data->signatureType !== "symetric") {
            throw new \InvalidArgumentException("Unsupported signature type: " . $data->signatureType);
        }

        if (empty($data->accessToken)) {
            throw new \InvalidArgumentException("Access token is required for symetric signature");
        }

        $httpMethod = strtoupper($data->httpMethod);
        $jsonBody = json_encode($data->body);
        $hashedBody = hash('sha256', $jsonBody);
        $lowerCaseHashedBody = strtolower($hashedBody);
        $stringToSign = $httpMethod . ":" . $data->endpointUrl . ":" . $data->accessToken . ":" . $lowerCaseHashedBody . ":" . $data->timestamp->format("c");

        return hash_hmac('sha512', $stringToSign, $this->clientSecret, $encoding === "hex" ? false : true);
    }

    public function generateAsymetricSignature(SignatureOptions $data, string $encoding = "hex"): string
    {
        if ($data->signatureType !== "asymetric") {
            throw new \InvalidArgumentException("Unsupported signature type: " . $data->signatureType);
        }

        $httpMethod = strtoupper($data->httpMethod);
        $jsonBody = json_encode($data->body);
        $hashedBody = hash('sha256', $jsonBody);
        $lowerCaseHashedBody = strtolower($hashedBody);
        $stringToSign = $httpMethod . ":" . $data->endpointUrl . ":" . $this->clientId . ":" . $lowerCaseHashedBody . ":" . $data->timestamp->format("c");

        $pkeyid = openssl_get_privatekey($this->privateKey);
        if ($pkeyid === false) {
            throw new \RuntimeException("Failed to get private key");
        }

        $signature = '';
        $success = openssl_sign($stringToSign, $signature, $pkeyid, OPENSSL_ALGO_SHA512);
        return $encoding === "hex" ? bin2hex($signature) : base64_encode($signature);
    }
}
