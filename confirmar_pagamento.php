<?php
session_start();
require_once 'CRUD/crud.php';

if (!isset($_SESSION['usuario_nome'])) {
    header('Location: /hydroeletric-services/login.php');
    exit;
}

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: /hydroeletric-services/carrinho.php');
    exit;
}

$valor_total = 0;
$quantidade_total = 0;
$percentual_desconto = 0.20;

foreach ($_SESSION['carrinho'] as $item) {
    $preco_item = $item['preco'];
    
    // Se o item estiver em promoção, aplica o desconto no cálculo
    if (isset($item['em_promocao']) && $item['em_promocao'] == 1) {
        $preco_item = $item['preco'] * (1 - $percentual_desconto);
    }

    $valor_total += $preco_item * $item['quantidade'];
    $quantidade_total += $item['quantidade'];
}

$valor_com_taxa = $valor_total * 1.177;
$metodo_pagamento = $_SESSION['metodo_pagamento'] ?? 'parcelado';
$quantidade_parcelas = $_SESSION['quantidade_parcelas'] ?? 12;
$adicionar_instalacao = $_SESSION['adicionar_instalacao'] ?? false;
$valor_instalacao = $adicionar_instalacao ? 150 : 0;
$valor_final = $valor_com_taxa + $valor_instalacao;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pagamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/confirmar_pagamento.css">
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="icon" type="image/x-icon" href="assets/icons/Icon_logo.ico">
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <div class="conteiner">
        <div class="card-pagamento">
            <h1 class="titulo-secao">Confirmar Pagamento</h1>


            <div>
                <h2 class="titulo-secao" style="font-size: 1.2rem; margin-top: 0;">Resumo do Pedido</h2>
                <table class="tabela-itens">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrinho'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nome']); ?></td>
                            <td><?php echo $item['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($preco_item, 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($preco_item * $item['quantidade'], 2, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="totais">
                    <div class="linha-total">
                        <span>Subtotal:</span>
                        <strong>R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></strong>
                    </div>
                    <div class="linha-total">
                        <span>Taxa de processamento:</span>
                        <strong>R$ <?php echo number_format($valor_com_taxa - $valor_total, 2, ',', '.'); ?></strong>
                    </div>
                    <?php if ($adicionar_instalacao): ?>
                    <div class="linha-total">
                        <span>Instalação Profissional:</span>
                        <strong>R$ <?php echo number_format($valor_instalacao, 2, ',', '.'); ?></strong>
                    </div>
                    <?php endif; ?>
                    <div class="linha-total total">
                        <span>Total a Pagar:</span>
                        <strong>R$ <?php echo number_format($valor_final, 2, ',', '.'); ?></strong>
                    </div>
                </div>
            </div>

            <div class="metodo-pagamento">
                <h2 style="font-size: 1.1rem; margin-bottom: 15px;">Método de Pagamento</h2>
                <?php if ($metodo_pagamento === 'parcelado'): ?>
                    <p><strong>Crédito (Parcelado)</strong></p>
                    <p><?php echo $quantidade_parcelas; ?>x de R$ <?php echo number_format($valor_final / $quantidade_parcelas, 2, ',', '.'); ?> (sem juros)</p>
                    <p style="font-size: 0.9rem; color: #666; margin-top: 10px;">Total: R$ <?php echo number_format($valor_final, 2, ',', '.'); ?></p>
                <?php else: ?>
                    <p><strong>Pix / Boleto (à vista)</strong></p>
                    <p style="color: var(--primaryOrange); font-weight: 600;">Total com desconto: R$ <?php echo number_format($valor_total + $valor_instalacao, 2, ',', '.'); ?></p>
                    <p style="font-size: 0.9rem; color: #666; margin-top: 10px;">Economia: R$ <?php echo number_format($valor_com_taxa - $valor_total, 2, ',', '.'); ?></p>
                <?php endif; ?>
            </div>

            <div class="acoes-pagamento">
                <form action="CRUD/processar_pagamento.php" method="POST" style="width: 100%;">
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button type="submit" class="botao-confirmar">Confirmar Pagamento</button>
                        <a href="carrinho.php" class="botao-voltar">Voltar ao Carrinho</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
</body>
</html>