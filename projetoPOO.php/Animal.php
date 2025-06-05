<?php

abstract class Animal {
    protected string $nome;
    protected string $raca;
    protected int $qtdPatas;
    protected string $cor;
    protected float $peso;
    protected string $tamanho;
    protected ?Dono $dono = null;

    public function __construct(string $nome, string $raca, int $qtdPatas, string $cor, float $peso, string $tamanho) {
        $this->nome = $nome;
        $this->raca = $raca;
        $this->qtdPatas = $qtdPatas;
        $this->cor = $cor;
        $this->peso = $peso;
        $this->tamanho = $tamanho;
    }

    abstract public function falar(): string;

    public function setDono(Dono $dono): void {
        $this->dono = $dono;
    }

    public function getDono(): ?Dono {
        return $this->dono;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getInfo(): string {
        $infoDono = $this->dono ? $this->dono->getNome() : "Dono não registrado";
        return "Animal: {$this->nome}, Raça: {$this->raca}, Patas: {$this->qtdPatas}, Cor: {$this->cor}, Peso: {$this->peso}kg, Tamanho: {$this->tamanho}, Dono: {$infoDono}";
    }

    public function getRaca(): string {
        return $this->raca;
    }

    public function getQtdPatas(): int {
        return $this->qtdPatas;
    }

    public function getCor(): string {
        return $this->cor;
    }

    public function getPeso(): float {
        return $this->peso;
    }

    public function getTamanho(): string {
        return $this->tamanho;
    }
}