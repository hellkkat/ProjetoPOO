<?php

require_once 'Funcionario.php';

class Balconista extends Funcionario {
    public function __construct(string $nome, int $idade, string $endereco, string $contato) {
        parent::__construct($nome, $idade, $endereco, $contato, 2500.00);
    }
}