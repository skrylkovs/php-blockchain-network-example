<?php

class UTXO
{
    private array $utxoPool = [];

    public function addUTXO(string $txId, int $index, float $amount): void
    {
        $this->utxoPool["$txId:$index"] = $amount;
    }

    public function spendUTXO(string $txId, int $index): void
    {
        unset($this->utxoPool["$txId:$index"]);
    }

    public function getBalance(): float
    {
        return array_sum($this->utxoPool);
    }
}