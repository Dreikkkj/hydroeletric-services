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
foreach ($_SESSION['carrinho'] as $item) {
    $valor_total += $item['preco'] * $item['quantidade'];
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
    <link rel="stylesheet" href="CSS/confirmar_pagamento.css">
    <link rel="stylesheet" href="CSS/global.css">
    <style>
        .conteiner {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card-pagamento {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .titulo-secao {
            color: var(--primaryBlue);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primaryOrange);
            padding-bottom: 10px;
        }

        .usuario-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
            color: var(--primaryBlue);
        }

        .tabela-itens {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabela-itens thead {
            background: var(--primaryBlue);
            color: white;
        }

        .tabela-itens th,
        .tabela-itens td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .tabela-itens tbody tr:hover {
            background: #f9f9f9;
        }

        .totais {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .linha-total {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: var(--primaryBlue);
        }

        .linha-total.total {
            font-size: 1.2rem;
            font-weight: 700;
            border-top: 2px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .metodo-pagamento {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            color: var(--primaryBlue);
        }

        .acoes-pagamento {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }

        .botao-confirmar,
        .botao-voltar {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .botao-confirmar {
            background: var(--primaryOrange);
            color: white;
        }

        .botao-confirmar:hover {
            background: #e6920f;
        }

        .botao-voltar {
            background: #ccc;
            color: #333;
            text-decoration: none;
            display: inline-block;
        }

        .botao-voltar:hover {
            background: #bbb;
        }
    </style>
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
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
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
