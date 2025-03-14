<?php
namespace App\Blockchain;

class MerkleTree
{
    public static function getMerkleRoot(array $transactions): string
    {
        $hashes = array_map(fn($tx) => hash('sha256', json_encode($tx)), $transactions);

        while (count($hashes) > 1) {
            $hashes = array_chunk($hashes, 2);
            $hashes = array_map(fn($pair) => hash('sha256', implode('', $pair)), $hashes);
        }

        return $hashes[0] ?? '';
    }
}