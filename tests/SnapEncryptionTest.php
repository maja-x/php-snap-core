<?php

declare(strict_types=1);

use Maja\PhpSnapCore\SignatureOptions;
use Maja\PhpSnapCore\TokenHeaders;
use Maja\PhpSnapCore\VirtualAccountData;
use PHPUnit\Framework\TestCase;
use Maja\PhpSnapCore\SnapEncryption;

class SnapEncryptionTest extends TestCase // phpcs:ignore
{
    private string $clientId = 'testClientId';
    private string $clientSecret = 'testSecret';
    private string $privateKeyPath;

    protected function setUp(): void
    {
        // Generate a temporary private key for testing
        $res = openssl_pkey_new(['private_key_bits' => 2048]);
        openssl_pkey_export($res, $privateKey);
        $this->privateKeyPath = tempnam(sys_get_temp_dir(), 'key');
        file_put_contents($this->privateKeyPath, $privateKey);
    }

    protected function tearDown(): void
    {
        unlink($this->privateKeyPath);
    }

    public function testGenerateTokenSignature(): void
    {
        $headers = new TokenHeaders();
        $headers->xClientKey = 'abc';
        $headers->xTimestamp = new DateTime();

        $snap = new SnapEncryption($this->clientId, $this->clientSecret, $this->privateKeyPath);
        $signature = $snap->generateTokenSignature($headers);

        $expected = hash_hmac('sha256', 'abc|1234567890', $this->clientSecret, false);
        $this->assertEquals($expected, $signature);
    }

    public function testGenerateSymetricSignature(): void
    {
        $data = new SignatureOptions();
        $data->signatureType = 'symetric';
        $data->httpMethod = 'POST';
        $data->endpointUrl = '/api/test';
        $body = new VirtualAccountData();
        $data->body = $body;
        $data->timestamp = new DateTime();
        $data->accessToken = 'token123';

        $snap = new SnapEncryption($this->clientId, $this->clientSecret, $this->privateKeyPath);
        $signature = $snap->generateSymetricSignature($data);

        $this->assertIsString($signature);
        $this->assertNotEmpty($signature);
    }

    public function testGenerateAsymetricSignature(): void
    {
        $data = new SignatureOptions();
        $data->signatureType = 'asymetric';
        $data->httpMethod = 'GET';
        $data->endpointUrl = '/api/test';
        $body = new VirtualAccountData();
        $data->body = $body;
        $data->timestamp = new DateTime();

        $snap = new SnapEncryption($this->clientId, $this->clientSecret, $this->privateKeyPath);
        $signature = $snap->generateAsymetricSignature($data);

        $this->assertIsString($signature);
        $this->assertNotEmpty($signature);
    }

    public function testGenerateSignatureThrowsOnUnsupportedType(): void
    {
        $data = new SignatureOptions();
        $data->signatureType = 'invalid';
        $data->httpMethod = 'GET';
        $data->endpointUrl = '/api/test';
        $data->body = new VirtualAccountData();
        $data->timestamp = new DateTime();

        $snap = new SnapEncryption($this->clientId, $this->clientSecret, $this->privateKeyPath);

        $this->expectException(InvalidArgumentException::class);
        $snap->generateSignature($data);
    }

    public function testSymetricSignatureThrowsWithoutAccessToken(): void
    {
        $data = new SignatureOptions();
        $data->signatureType = 'symetric';
        $data->httpMethod = 'POST';
        $data->endpointUrl = '/api/test';
        $data->body = new VirtualAccountData();
        $data->timestamp = new DateTime();

        $snap = new SnapEncryption($this->clientId, $this->clientSecret, $this->privateKeyPath);

        $this->expectException(InvalidArgumentException::class);
        $snap->generateSymetricSignature($data);
    }
}
