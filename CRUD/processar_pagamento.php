<?php
session_start();
require_once 'crud.php';

if (!isset($_SESSION['usuario_nome']) || empty($_SESSION['carrinho'])) {
    header('Location: /hydroeletric-services/carrinho.php');
    exit;
}

foreach ($_SESSION['carrinho'] as $produto_id => $item) {
    $quantidade_comprada = (int)$item['quantidade'];

    $produto_banco = read($pdo, 'produtos', "id_produtos = $produto_id");

    if ($produto_banco) {
        $estoque_anterior = (int)$produto_banco['estoque'];
        
        $estoque_atual = $estoque_anterior - $quantidade_comprada;
        if ($estoque_atual < 0) {
            $estoque_atual = 0; 
        }

        update($pdo, 'produtos', ['estoque' => $estoque_atual], "id_produtos = $produto_id");

        $dados_movimentacao = [
            'produto_id'       => $produto_id,
            'tipo'             => 'Saída',
            'quantidade'       => $quantidade_comprada,
            'estoque_anterior' => $estoque_anterior,
            'estoque_atual'    => $estoque_atual,
            'motivo'           => 'Venda cliente: ' . $_SESSION['usuario_nome']
        ];
        create($pdo, 'movimentacoes', $dados_movimentacao);
    }
}

$_SESSION['carrinho'] = [];
unset($_SESSION['metodo_pagamento']);
unset($_SESSION['quantidade_parcelas']);
unset($_SESSION['adicionar_instalacao']);

header('Location: ../pagamento_sucesso.php');
exit;
?>