<?php

namespace App\Blockchain\P2PNetwork;

use App\Blockchain\Block;
use App\Blockchain\Transaction;

class P2PNetwork
{
    private array $nodes = [];

    public function __construct(array $initialNodes = [])
    {
        $this->nodes = $initialNodes;
    }

    public function addNode(string $node): void
    {
        if (!in_array($node, $this->nodes)) {
            $this->nodes[] = $node;
        }
    }

    public function broadcastTransaction(Transaction $transaction): void
    {
        echo "📡 Распространяем транзакцию в сети...\n";
        foreach ($this->nodes as $node) {
            echo "Отправка транзакции на узел: $node\n";
        }
    }

    public function broadcastBlock(Block $block): void
    {
        echo "📡 Распространяем новый блок в сети...\n";
        foreach ($this->nodes as $node) {
            echo "Отправка блока на узел: $node\n";
        }
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }
}