<?php

class Produto {
    private string $nome;
    private float $preco;

    public function __construct(string $nome, float $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getPreco(): float {
        return $this->preco;
    }

    public function getInfo(): string {
        return "Produto: {$this->nome}, Preço: R$ " . number_format($this->preco, 2, ',', '.');
    }
}
