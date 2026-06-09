<?php
    require_once 'CRUD/crud.php';

    if (!isset($_GET['id'])) {
        header('Location: produtos.php');
        exit;
    }

    $produto_id = (int)$_GET['id'];
    $tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
    $produto = read($pdo, $tabela_join, "produtos.id_produtos = $produto_id");

    if (!$produto) {
        header('Location: produtos.php');
        exit;
    }

    $estoque_texto = $produto["estoque"] > 0 ? "Em estoque" : "Esgotado";
    $percentual_desconto = 0.20; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/detalhes.css">
    <link rel="stylesheet" href="CSS/global.css">
    <title><?php echo htmlspecialchars($produto['nome_produtos']); ?> - Detalhes</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>

    <main class="prod-main">

        <div class="prod-container">

            <div class="prod-gallery">
                <p class="indicador"><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="detalhes.php?id=<?php echo $produto_id; ?>"><?php echo htmlspecialchars($produto['nome_produtos']); ?></a></p>

                <div class="main-img">
                    <img src="<?php echo htmlspecialchars($produto['capa']); ?>" id="mainImg" alt="<?php echo htmlspecialchars($produto['nome_produtos']); ?>">
                </div>

                <div class="mini-img">
                    <img src="<?php echo htmlspecialchars($produto['capa']); ?>" onclick="document.getElementById('mainImg').src=this.src" alt="Imagem do produto">
                </div>
            </div>

            <div class="prod-info">
                <div class="categoria-item"><?php echo htmlspecialchars($produto['nome_categorias']); ?></div>

                <h1><?php echo htmlspecialchars($produto['nome_produtos']); ?></h1>
                <span class="sku-item"><?php echo htmlspecialchars($produto['sku']); ?></span>

                <?php
                    $preco_exibir = $produto['preco'];
                    $com_desconto = false;
                    
                    if (isset($produto['em_promocao']) && $produto['em_promocao'] == 1) {
                        $com_desconto = true;
                        
                        if (!empty($produto['preco_promocao'])) {
                            $preco_exibir = $produto['preco_promocao'];
                        } else {
                            $preco_exibir = $produto['preco'] * (1 - $percentual_desconto); // Aplica os 20% de desconto
                        }
                    }
                ?>

                <?php if ($com_desconto): ?>
                    <h2 class="preco" style="text-decoration: line-through; color: #ccc; font-size: 0.9em;">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </h2>
                    <h2 class="preco" style="color: #28a745; font-weight: bold;">
                        R$ <?php echo number_format($preco_exibir, 2, ',', '.'); ?>
                    </h2>
                <?php else: ?>
                    <h2 class="preco">R$ <?php echo number_format($preco_exibir, 2, ',', '.'); ?></h2>
                <?php endif; ?>

                <div class="desc">
                    <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                </div>

                <?php if ($produto["estoque"] > 0): ?>
                <form action="CRUD/controle_carrinho.php" method="POST">
                    <input type="hidden" name="acao" value="adicionar">
                    <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
                    <input type="hidden" name="redirect" value="../carrinho.php">
                    <div class="buy-section">
                        <input type="number" name="quantidade" value="1" min="1" max="<?php echo $produto['estoque']; ?>" style="width: 60px; padding: 8px;">
                        <button type="submit" class="btn-buy">ADICIONAR AO CARRINHO <i class="bi bi-cart-plus"></i></button>
                    </div>
                </form>
                <?php else: ?>
                <button class="btn-buy" disabled style="opacity: 0.5; cursor: not-allowed;">PRODUTO ESGOTADO</button>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>
