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

    $sql_estoque = "UPDATE produtos SET estoque = estoque - :quantidade WHERE id_produtos = :id";
    $stmt = $pdo->prepare($sql_estoque);
    $stmt->execute([
        ':quantidade' => $quantidade_comprada,
        ':id' => $id_produto
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