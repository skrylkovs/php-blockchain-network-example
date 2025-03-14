<?php
namespace App\Blockchain;

class TransactionPool
{
    private array $transactions = [];

    /**
     * Добавляет транзакцию в пул.
     */
    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * Получает все транзакции в пуле.
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * Очищает пул транзакций после включения в блок.
     */
    public function clear(): void
    {
        $this->transactions = [];
    }
}