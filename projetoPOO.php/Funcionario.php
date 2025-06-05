<?php

require_once 'Humano.php';

abstract class Funcionario extends Humano {
    protected float $salario;

    public function __construct(string $nome, int $idade, string $endereco, string $contato, float $salario) {
        parent::__construct($nome, $idade, $endereco, $contato);
        $this->salario = $salario;
    }

    public function getSalario(): float {
        return $this->salario;
    }

    public function getInfo(): string {
        $infoParent = parent::getInfo();
        return "{$infoParent} | Salário: R$ " . number_format($this->salario, 2, ',', '.');
    }
}