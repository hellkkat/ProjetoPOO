<?php
use Nette\Utils\DateTime;

class Venda {
    private Dono $cliente;
    private array $itens = [];
    private float $valorTotal = 0.0;
    private \DateTime $dataVenda; 

    public function __construct(Dono $cliente) {
        $this->cliente = $cliente;
        $this->dataVenda = new \DateTime();
    }

    public function adicionarProduto(Produto $produto, int $quantidade): void {
        $precoUnitario = $produto->getPreco();
        $this->itens[] = [
            'produto' => $produto,
            'quantidade' => $quantidade,
            'precoUnitario' => $precoUnitario
        ];
        $this->valorTotal += $precoUnitario * $quantidade;
    }

    public function getCliente(): Dono {
        return $this->cliente;
    }

    public function getItens(): array {
        return $this->itens;
    }

    public function getValorTotal(): float {
        return $this->valorTotal;
    }

    public function getDataVenda(): string {
        return $this->dataVenda->format('d/m/Y H:i:s');
    }

    public function getInfo(): string {
        $info = "Venda para: {$this->cliente->getNome()} em {$this->getDataVenda()}\n";
        $info .= "Itens:\n";
        foreach ($this->itens as $item) {
            $info .= "- {$item['produto']->getNome()} (Qtd: {$item['quantidade']}) - Subtotal: R$ " . number_format($item['precoUnitario'] * $item['quantidade'], 2, ',', '.') . "\n";
        }
        $info .= "Valor Total: R$ " . number_format($this->valorTotal, 2, ',', '.');
        return $info;
    }
}