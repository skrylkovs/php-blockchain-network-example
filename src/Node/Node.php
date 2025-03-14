<?php

namespace App\Blockchain\Node;

use App\Blockchain\Blockchain;
use App\Blockchain\Miner\Miner;
use App\Blockchain\Transaction;

class Node {
    public Blockchain $blockchain;

    public function __construct() {
        $this->blockchain = new Blockchain();
    }

    public function addTransaction($sender, $receiver, $amount) {
        $transaction = new Transaction($sender, $receiver, $amount);
        $this->blockchain->transactionPool->addTransaction($transaction);
    }

    public function minePendingTransactions() {
        $miner = new Miner($this->blockchain);
        $miner->mine();
    }

    public function showBlockchain() {
        echo json_encode($this->blockchain->chain, JSON_PRETTY_PRINT);
    }
}