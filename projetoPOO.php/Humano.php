<?php

class Humano {
    protected string $nome;
    protected int $idade;
    protected string $endereco;
    protected string $contato;

    public function __construct(string $nome, int $idade, string $endereco, string $contato) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->endereco = $endereco;
        $this->contato = $contato;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getIdade(): int {
        return $this->idade;
    }

    public function getEndereco(): string {
        return $this->endereco;
    }

    public function getContato(): string {
        return $this->contato;
    }

    public function getInfo(): string {
        return "Nome: {$this->nome}, Idade: {$this->idade}, Endereço: {$this->endereco}, Contato: {$this->contato}";
    }
}
