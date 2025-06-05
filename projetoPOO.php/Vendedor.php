<?php

require_once 'Funcionario.php';

class Vendedor extends Funcionario {
    public function __construct(string $nome, int $idade, string $endereco, string $contato) {
        parent::__construct($nome, $idade, $endereco, $contato, 2800.00); 
    }
}