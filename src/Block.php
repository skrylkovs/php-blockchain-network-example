<?php

namespace App\Blockchain;

class Block
{
    public int $index;
    public string $timestamp;
    public array $transactions;
    public string $previousHash;
    public string $hash;
    public int $nonce;
    public int $difficulty;

    public function __construct(
        int    $index,
        string $timestamp,
        array  $transactions,
        string $previousHash,
        int    $difficulty = Blockchain::DIFFICULTY
    )
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;
        $this->nonce = 0;
        $this->difficulty = $difficulty;
        $this->hash = $this->calculateHash();
    }

    /**
     * Вычисляет хеш блока.
     */
    public function calculateHash(): string
    {
        return hash(
            'sha256',
            sprintf('%d%s%s%s%d',
                $this->index,
                $this->timestamp,
                $this->previousHash,
                json_encode($this->transactions),
                $this->nonce
            )
        );
    }

    /**
     * Выполняет майнинг блока, подбирая корректный nonce.
     */
    public function mineBlock(): void
    {
        $target = str_repeat('0', $this->difficulty); // Цель (число ведущих нулей)

        while (substr($this->hash, 0, $this->difficulty) !== $target) {
            $this->nonce++;
            $this->hash = $this->calculateHash();

            echo "nonce: {$this->nonce} hash: {$this->hash}\n";
        }

        echo "Блок {$this->index} намайнен: {$this->hash} (nonce: {$this->nonce})\n";
    }
}