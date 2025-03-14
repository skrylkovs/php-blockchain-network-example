<?php

require_once 'vendor/autoload.php';

use App\Blockchain\Blockchain;
use App\Blockchain\Block;
use App\Blockchain\Transaction;
use App\Blockchain\TransactionPool;

// *** Создание пула транзакций
$transactionPool = new TransactionPool();
$transactionPool->addTransaction(new Transaction('sergei', 'olga', 50.40));
$transactionPool->addTransaction(new Transaction('oleg', 'ignat', 10000));
$transactionPool->addTransaction(new Transaction('omar', 'ignat', 990));
$transactionPool->addTransaction(new Transaction('Alice', 'Bob', 100));
$transactionPool->addTransaction(new Transaction('Bob', 'Charlie', 50));

// *** Добавление блоков в блокчейн
$blockchain = new Blockchain();
$blockchain->transactionPool = $transactionPool;
//$blockchain->addBlock();

$miner = new \App\Blockchain\Miner\Miner();

// *** Проверка блокчейна
echo 'Is blockchain valid? ' . ($blockchain->isChainValid() ? 'Yes' : 'No') . "\n";

// *** Пример: Отображение блокчейна
function displayBlockchain(Blockchain $blockchain): void
{
    foreach ($blockchain->chain as $block) {
        echo "Index: " . $block->index . "\n";
        echo "Timestamp: " . $block->timestamp . "\n";
        echo "Previous Hash: " . $block->previousHash . "\n";
        echo "Hash: " . $block->hash . "\n\n";
    }
}

displayBlockchain($blockchain);

// *** Пример: Вмешательство в блокчейн и проверка
//$blockchain->chain[1]->transactions = [];

// Майним новый блок
$minerWaller = \App\Blockchain\Wallet\Wallet::createWallet();
$miner->mine($blockchain, $minerWaller);


echo print_r($blockchain->chain[1]->transactions, true) . "\n";
echo count($blockchain->chain) . "\n";

// Проверяем валидность цепочки
echo "Блокчейн валиден: " . ($blockchain->isChainValid() ? "Да" : "Нет") . "\n";

$tree = \App\Blockchain\MerkleTree::getMerkleRoot($blockchain->chain[1]->transactions);

echo 'merkle tree: ' . print_r($tree, true) . "\n";