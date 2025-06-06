<?php

require_once 'Dono.php';
require_once 'Cachorro.php';
require_once 'Gato.php';
require_once 'Passaro.php';
require_once 'Balconista.php';
require_once 'Veterinario.php';
require_once 'Vendedor.php';
require_once 'Produto.php';
require_once 'Venda.php';

$donos = [];
$produtosDisponiveis = [];

$balconista = new Balconista("Cláudia Ribeiro", 28, "Rua Principal, 100", "3211-0011");
$veterinario = new Veterinario("Dr. Fernando Moura", 50, "Av. Saúde, 200", "3211-0022");
$vendedor = new Vendedor("Lucas Almeida", 23, "Praça das Vendas, 30", "3211-0033");

$produtosDisponiveis[strtolower("Ração Premium Cães")] = new Produto("Ração Premium Cães", 120.50);
$produtosDisponiveis[strtolower("Ração Premium Gatos")] = new Produto("Ração Premium Gatos", 99.90);
$produtosDisponiveis[strtolower("Antipulgas")] = new Produto("Antipulgas", 45.00);
$produtosDisponiveis[strtolower("Brinquedo Ossinho")] = new Produto("Brinquedo Ossinho", 25.75);
$produtosDisponiveis[strtolower("Caixa de Areia")] = new Produto("Caixa de Areia", 60.00);
$produtosDisponiveis[strtolower("Sementes para pássaros")] = new Produto("Sementes para pássaros", 15,00);

function lerEntrada(string $prompt): string {
    echo $prompt;
    return trim(fgets(STDIN));
}

function mostrarMenuPrincipal(): void {
    echo "\n--- Clínica Veterinária ---\n";
    echo "1. Registrar Dono de Animal\n";
    echo "2. Registrar Animal\n";
    echo "3. Acessar Dados da Balconista\n";
    echo "4. Acessar Dados do Veterinário\n";
    echo "5. Acessar Dados do Vendedor\n";
    echo "6. Realizar Venda\n";
    echo "7. Ver Histórico do Cliente\n";
    echo "8. Listar Donos Cadastrados\n";
    echo "9. Listar Produtos Disponíveis\n";
    echo "0. Sair\n";
    echo "-----------------------------------------\n";
}

while (true) {
    mostrarMenuPrincipal();
    $opcao = lerEntrada("Escolha uma opção: ");

    switch ($opcao) {
        case '1':
            echo "-- Registrar Novo Dono --\n";
            $nomeDono = lerEntrada("Nome do dono: ");
            if (isset($donos[$nomeDono])) {
                echo "Erro: Dono com este nome já cadastrado.\n";
                break;
            }
            $idadeDono = (int)lerEntrada("Idade do dono: ");
            $enderecoDono = lerEntrada("Endereço do dono: ");
            $contatoDono = lerEntrada("Contato: ");

            $novoDono = new Dono($nomeDono, $idadeDono, $enderecoDono, $contatoDono);
            $donos[$nomeDono] = $novoDono;
            echo "Dono '{$nomeDono}' registrado com sucesso!\n";
            break;

        case '2':
            echo "-- Registrar Novo Animal --\n";
            if (empty($donos)) {
                echo "Nenhum dono cadastrado. Registre um dono primeiro.\n";
                break;
            }
            $nomeDonoAnimal = lerEntrada("Nome do dono do animal: ");
            if (!isset($donos[$nomeDonoAnimal])) {
                echo "Erro: Dono '{$nomeDonoAnimal}' não encontrado. Cadastre o dono primeiro.\n";
                break;
            }
            $donoObj = $donos[$nomeDonoAnimal];

            $nomeAnimal = lerEntrada("Nome do animal: ");
            $racaAnimal = lerEntrada("Raça do animal: ");
            $qtdPatasAnimal = (int)lerEntrada("Quantidade de patas do animal: ");
            $corAnimal = lerEntrada("Cor do animal: ");
            $pesoAnimal = (float)lerEntrada("Peso do animal: ");
            $tamanhoAnimal = lerEntrada("Tamanho do animal (pequeno, médio, grande): ");

            echo "Tipo de animal (1-Cachorro, 2-Gato, 3-Pássaro): ";
            $tipoAnimalNum = lerEntrada("");
            
            $novoAnimal = null;
            switch ($tipoAnimalNum) {
                case '1':
                    $novoAnimal = new Cachorro($nomeAnimal, $racaAnimal, $qtdPatasAnimal, $corAnimal, $pesoAnimal, $tamanhoAnimal);
                    break;
                case '2':
                    $novoAnimal = new Gato($nomeAnimal, $racaAnimal, $qtdPatasAnimal, $corAnimal, $pesoAnimal, $tamanhoAnimal);
                    break;
                case '3':
                    $novoAnimal = new Passaro($nomeAnimal, $racaAnimal, $qtdPatasAnimal, $corAnimal, $pesoAnimal, $tamanhoAnimal);
                    break;
                default:
                    echo "Tipo de animal inválido.\n";
                    break;
            }

            if ($novoAnimal) {
                $donoObj->addAnimal($novoAnimal);
                echo "Animal '{$novoAnimal->getNome()}' (que faz '{$novoAnimal->falar()}') registrado para '{$donoObj->getNome()}' com sucesso!\n";
            }
            break;

        case '3':
            echo "-- Dados da Balconista --\n";
            echo $balconista->getInfo() . "\n";
            break;

        case '4':
            echo "-- Dados do Veterinário(a) --\n";
            echo $veterinario->getInfo() . "\n";
            break;

        case '5':
            echo "-- Dados do Vendedor(a) --\n";
            echo $vendedor->getInfo() . "\n";
            break;

        case '6':
            echo "-- Realizar Venda --\n";
            if (empty($donos)) {
                echo "Nenhum dono cadastrado para realizar uma venda.\n";
                break;
            }
            if (empty($produtosDisponiveis)) {
                echo "Nenhum produto disponível para venda.\n";
                break;
            }

            $nomeClienteVenda = lerEntrada("Nome do cliente (dono): ");
            if (!isset($donos[$nomeClienteVenda])) {
                echo "Erro: Cliente '{$nomeClienteVenda}' não encontrado.\n";
                break;
            }
            $clienteObj = $donos[$nomeClienteVenda];
            $novaVenda = new Venda($clienteObj);

            echo "Produtos disponíveis:\n";
            foreach ($produtosDisponiveis as $nomeProd => $prodObj) {
                echo "- {$prodObj->getNome()} (R$ " . number_format($prodObj->getPreco(), 2, ',', '.') . ")\n";
            }

            while (true) {
                $nomeProdutoVenda = lerEntrada("Digite o nome do produto para adicionar (ou 'fim' para finalizar): ");
                if (strtolower($nomeProdutoVenda) === 'fim') {
                    break;
                }
                if (!isset($produtosDisponiveis[$nomeProdutoVenda])) {
                    echo "Produto '{$nomeProdutoVenda}' não encontrado.\n";
                    continue;
                }
                $produtoObjVenda = $produtosDisponiveis[$nomeProdutoVenda];
                $quantidadeVenda = (int)lerEntrada("Quantidade de '{$produtoObjVenda->getNome()}': ");
                if ($quantidadeVenda > 0) {
                    $novaVenda->adicionarProduto($produtoObjVenda, $quantidadeVenda);
                    echo "{$quantidadeVenda}x {$produtoObjVenda->getNome()} adicionado(s) à venda.\n";
                } else {
                    echo "Quantidade inválida.\n";
                }
            }

            if (!empty($novaVenda->getItens())) {
                $clienteObj->addVenda($novaVenda);
                echo "Venda finalizada para {$clienteObj->getNome()}.\n";
                echo $novaVenda->getInfo() . "\n";
            } else {
                echo "Nenhum produto adicionado. Venda cancelada.\n";
            }
            break;

        case '7':
            echo "-- Histórico do Cliente --\n";
            $nomeClienteHist = lerEntrada("Nome do cliente (dono) para ver o histórico: ");
            if (!isset($donos[$nomeClienteHist])) {
                echo "Cliente '{$nomeClienteHist}' não foi cadastrado.\n";
                break;
            }
            $clienteHistObj = $donos[$nomeClienteHist];
            echo "\n--- Histórico de {$clienteHistObj->getNome()} ---\n";
            echo "Dados Pessoais: " . $clienteHistObj->getInfo() . "\n";

            echo "\nAnimais de {$clienteHistObj->getNome()}:\n";
            $animaisDoDono = $clienteHistObj->getAnimais();
            if (empty($animaisDoDono)) {
                echo "Nenhum animal cadastrado para este dono.\n";
            } else {
                foreach ($animaisDoDono as $animal) {
                    echo "- " . $animal->getInfo() . "\n";
                    echo $animal->falar() . "\n";
                }
            }

            echo "\nHistórico de Compras de {$clienteHistObj->getNome()}:\n";
            $vendasDoDono = $clienteHistObj->getHistoricoVendas();
            if (empty($vendasDoDono)) {
                echo "Nenhuma compra registrada para este dono.\n";
            } else {
                foreach ($vendasDoDono as $idx => $venda) {
                    echo "--- Venda " . ($idx + 1) . " ---\n";
                    echo $venda->getInfo() . "\n";
                }
            }
            echo "-----------------------------------------\n";
            break;

        case '8':
            echo "-- Donos Cadastrados --\n";
            if (empty($donos)) {
                echo "Nenhum dono cadastrado.\n";
            } else {
                foreach ($donos as $dono) {
                    echo "- " . $dono->getNome() . " (Contato: " . $dono->getContato() . ")\n";
                }
            }
            break;

        case '9':
            echo "-- Produtos Disponíveis --\n";
            if (empty($produtosDisponiveis)) {
                echo "Nenhum produto cadastrado.\n";
            } else {
                foreach ($produtosDisponiveis as $produto) {
                    echo "- " . $produto->getInfo() . "\n";
                }
            }
            break;

        case '0':
            echo "Saindo do sistema!\n";
            exit;

        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
}
?>