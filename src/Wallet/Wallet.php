<?php

namespace App\Blockchain\Wallet;

class Wallet
{
    private string $privateKey;
    private string $publicKey;

    public function __construct()
    {
        $this->generateKeys();
    }

    public static function createWallet()
    {
        return new self;
    }

    /**
     * Генерирует приватный и публичный ключи.
     */
    private function generateKeys(): void
    {
        $this->privateKey = bin2hex(random_bytes(32)); // Генерация случайного приватного ключа
        $this->publicKey = hash('sha256', $this->privateKey); // Создание публичного ключа
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * Подписывает транзакцию (в реальной системе должна использоваться криптография).
     */
    public function signTransaction(string $data): string
    {
        return hash_hmac('sha256', $data, $this->privateKey);
    }
}