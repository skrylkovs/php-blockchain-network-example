<?php
namespace App\Blockchain;

class Transaction
{
    public string $sender;
    public string $receiver;
    public float $amount;
    public string $timestamp;

    public function __construct(string $sender, string $receiver, float $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    /**
     * Возвращает JSON-представление транзакции для хеширования.
     */
    public function toJson(): string
    {
        return json_encode([
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'amount' => $this->amount,
            'timestamp' => $this->timestamp,
        ]);
    }
}