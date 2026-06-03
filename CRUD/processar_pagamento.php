<?php
session_start();
require_once 'crud.php';

// Verifica se está logado e tem carrinho
if (!isset($_SESSION['usuario_nome']) || empty($_SESSION['carrinho'])) {
    header('Location: /hydroeletric-services/carrinho.php');
    exit;
}

// Aqui você processaria o pagamento com um gateway de pagamento
// Por enquanto, vamos apenas limpar o carrinho e mostrar sucesso

// Calcula valores
$valor_total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $valor_total += $item['preco'] * $item['quantidade'];
}

$metodo_pagamento = $_SESSION['metodo_pagamento'] ?? 'parcelado';
$quantidade_parcelas = $_SESSION['quantidade_parcelas'] ?? 12;

// TODO: Integrar com gateway de pagamento (Stripe, MercadoPago, etc)

// Limpa carrinho após processamento bem-sucedido
$_SESSION['carrinho'] = [];
unset($_SESSION['metodo_pagamento']);
unset($_SESSION['quantidade_parcelas']);

// Redireciona para página de sucesso
header('Location: ../pagamento_sucesso.php');
exit;
?>
