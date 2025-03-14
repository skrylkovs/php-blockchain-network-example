<?php

namespace App\Blockchain\Miner;

use App\Blockchain\Blockchain;
use App\Blockchain\Transaction;
use App\Blockchain\Wallet\Wallet;

class Miner
{
    private const REWARD = 10;

    public function mine(Blockchain $blockchain, Wallet $minerWallet): void
    {
        echo "⛏ Начинаем майнинг нового блока...\n";

        // Добавляем награду за майнинг
        $rewardTransaction = new Transaction("System", $minerWallet->getPublicKey(), self::REWARD);
        $blockchain->transactionPool->addTransaction($rewardTransaction);

        $blockchain->addBlock();
        echo "✅ Блок добавлен в цепочку!\n";
    }
}