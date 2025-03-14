<?php

require_once 'vendor/autoload.php';

use App\Blockchain\Blockchain;
use App\Blockchain\Transaction;

// Создаём блокчейн
$blockchain = new Blockchain();

// Создаём транзакции
$transaction1 = new Transaction('Alice', 'Bob', 50);
$transaction2 = new Transaction('Bob', 'Charlie', 20);

// Добавляем транзакции в пул
$blockchain->transactionPool->addTransaction($transaction1);
$blockchain->transactionPool->addTransaction($transaction2);

// Добавляем новый блок с транзакциями
$blockchain->addBlock();

// Проверяем целостность блокчейна
echo "Блокчейн валиден: " . ($blockchain->isChainValid() ? "Да" : "Нет") . "\n";

// Выводим цепочку блоков
print_r($blockchain->chain);