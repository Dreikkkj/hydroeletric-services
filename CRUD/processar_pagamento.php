<?php
session_start();
require_once 'crud.php';

if (!isset($_SESSION['usuario_nome']) || empty($_SESSION['carrinho'])) {
    header('Location: /hydroeletric-services/carrinho.php');
    exit;
}

$valor_total = 0;

foreach ($_SESSION['carrinho'] as $item) {
    $valor_total += $item['preco'] * $item['quantidade'];
    
    $id_produto = $item['id'];
    $quantidade_comprada = $item['quantidade'];

    $stmt_estoque = $pdo->prepare("SELECT estoque FROM produtos WHERE id_produtos = :id");
    $stmt_estoque->execute([':id' => $id_produto]);
    $produto = $stmt_estoque->fetch(PDO::FETCH_ASSOC);
    
    $estoque_anterior = $produto['estoque'];
    $estoque_atual = $estoque_anterior - $quantidade_comprada;

    $sql_update_estoque = "UPDATE produtos SET estoque = :estoque_atual WHERE id_produtos = :id";
    $stmt_update = $pdo->prepare($sql_update_estoque);
    $stmt_update->execute([
        ':estoque_atual' => $estoque_atual,
        ':id' => $id_produto
    ]);

    $sql_movimentacao = "INSERT INTO movimentacoes (produto_id, tipo_movimentacoes, quantidade, estoque_anterior, estoque_atual, motivo) 
                         VALUES (:produto_id, 'Saída', :quantidade, :estoque_anterior, :estoque_atual, :motivo)";
    $stmt_mov = $pdo->prepare($sql_movimentacao);
    $stmt_mov->execute([
        ':produto_id' => $id_produto,
        ':quantidade' => $quantidade_comprada,
        ':estoque_anterior' => $estoque_anterior,
        ':estoque_atual' => $estoque_atual,
        ':motivo' => 'Venda pelo site'
    ]);
}

$metodo_pagamento = $_SESSION['metodo_pagamento'] ?? 'parcelado';
$quantidade_parcelas = $_SESSION['quantidade_parcelas'] ?? 12;

$_SESSION['carrinho'] = [];
unset($_SESSION['metodo_pagamento']);
unset($_SESSION['quantidade_parcelas']);

header('Location: ../pagamento_sucesso.php');
exit;
?>