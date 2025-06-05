<?php

require_once 'Humano.php';
require_once 'Animal.php';

class Dono extends Humano {
    private array $animais = [];
    private array $historicoVendas = [];

    public function __construct(string $nome, int $idade, string $endereco, string $contato) {
        parent::__construct($nome, $idade, $endereco, $contato);
    }

    public function addAnimal(Animal $animal): void {
        $this->animais[] = $animal;
        $animal->setDono($this); 
    }

    public function getAnimais(): array {
        return $this->animais;
    }

    public function addVenda(Venda $venda): void {
        $this->historicoVendas[] = $venda;
    }

    public function getHistoricoVendas(): array {
        return $this->historicoVendas;
    }

    public function getInfo(): string {
        $infoParent = parent::getInfo();
        $numAnimais = count($this->animais);
        return "{$infoParent} | Número de animais: {$numAnimais}";
    }
}