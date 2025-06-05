<?php

require_once 'Animal.php';

class Cachorro extends Animal {
    public function __construct(string $nome, string $raca, int $qtdPatas, string $cor, float $peso, string $tamanho) {
        parent::__construct($nome, $raca, $qtdPatas, $cor, $peso, $tamanho);
    }

    public function falar(): string {
        return "{$this->nome} diz: Au au!";
    }
}