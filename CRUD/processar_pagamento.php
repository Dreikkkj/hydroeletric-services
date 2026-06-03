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
}

$metodo_pagamento = $_SESSION['metodo_pagamento'] ?? 'parcelado';
$quantidade_parcelas = $_SESSION['quantidade_parcelas'] ?? 12;

$_SESSION['carrinho'] = [];
unset($_SESSION['metodo_pagamento']);
unset($_SESSION['quantidade_parcelas']);

header('Location: ../pagamento_sucesso.php');
exit;
?>