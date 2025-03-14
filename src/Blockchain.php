<?php

namespace App\Blockchain;

class Blockchain
{
    public array $chain;
    public TransactionPool $transactionPool;

    const DIFFICULTY = 3;

    public function __construct(public int $difficulty = self::DIFFICULTY)
    {
        $this->chain = [$this->createGenesisBlock()];
        $this->transactionPool = new TransactionPool();
    }

    private function createGenesisBlock(): Block
    {
        return new Block(0, '2023-01-01 00:00:00', [], '0');
    }

    public function getLatestBlock(): Block
    {
        return $this->chain[count($this->chain) - 1];
    }

    /**
     * Добавляет новый блок в блокчейн, выполняя майнинг.
     */
    public function addBlock(): void
    {
        $transactions = $this->transactionPool->getTransactions();

        if (empty($transactions)) {
            echo "❌ Нет транзакций для включения в блок.\n";
            return;
        }

        $newBlock = new Block(
            count($this->chain),
            date('Y-m-d H:i:s'),
            $transactions,
            $this->getLatestBlock()->hash,
            $this->difficulty
        );

        $newBlock->mineBlock(); // Выполняем майнинг
        $this->chain[] = $newBlock;
        $this->transactionPool->clear();
    }

    /**
     * Проверяет целостность блокчейна.
     */
    public function isChainValid(): bool
    {
        for ($i = 1, $chainLength = count($this->chain); $i < $chainLength; $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->hash) {
                return false;
            }
        }

        return true;
    }
}