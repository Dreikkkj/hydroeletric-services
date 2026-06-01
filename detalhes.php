<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/detalhes.css">
    <link rel="stylesheet" href="CSS/global.css">
    <title>Detalhes do Produto - Hidroelétrica Services</title>
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'CRUD/crud.php';
    require_once 'partials/header.php';

    $produto = null;
    $produto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($produto_id > 0) {
        $sql = "SELECT p.*, c.nome_categorias FROM produtos p
                LEFT JOIN categoria c ON p.categoria_id_produtos = c.id_categorias
                WHERE p.id_produtos = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$produto):
    ?>
        <main class="prod-main">
            <div class="prod-container">
                <div style="text-align: center; padding: 40px;">
                    <h2>Produto não encontrado</h2>
                    <p>Desculpe, o produto solicitado não existe ou foi removido.</p>
                    <a href="index.php" class="btn-back">← Voltar para Home</a>
                </div>
            </div>
        </main>
    <?php else: ?>
        <main class="prod-main">
            <div class="prod-container">
                <div class="prod-gallery">
                    <p class="indicador">
                        <a href="index.php">Home</a> |
                        <a href="produtos.php">Produtos</a> |
                        <a href="detalhes.php?id=<?php echo $produto['id_produtos']; ?>">
                            <?php echo htmlspecialchars($produto['nome_produtos']); ?>
                        </a>
                    </p>

                    <div class="main-img">
                        <?php if (!empty($produto['capa'])): ?>
                            <img src="<?php echo htmlspecialchars($produto['capa']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produtos']); ?>" id="mainImg">
                        <?php else: ?>
                            <div style="display: flex; align-items: center; justify-content: center; height: 400px; background: #f0f0f0;">
                                <i class="bi bi-box" style="font-size: 3em; color: #ccc;"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="prod-info">
                    <div class="categoria-item">
                        <?php echo htmlspecialchars($produto['nome_categorias'] ?? 'Geral'); ?>
                    </div>

                    <h1><?php echo htmlspecialchars($produto['nome_produtos']); ?></h1>
                    <span class="sku-item">SKU: <?php echo htmlspecialchars($produto['sku']); ?></span>

                    <h2 class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></h2>

                    <div class="desc">
                        <p><?php echo htmlspecialchars($produto['descricao'] ?? 'Sem descrição disponível'); ?></p>
                    </div>

                    <div class="estoque-info">
                        <p>
                            <strong>Estoque:</strong>
                            <?php
                            if ($produto['estoque'] > 0) {
                                echo $produto['estoque'] . ' unidades disponíveis';
                            } else {
                                echo '<span style="color: #d9534f;">Indisponível</span>';
                            }
                            ?>
                        </p>
                    </div>

                    <?php if ($produto['estoque'] > 0): ?>
                        <button class="btn-buy"><a href="carrinho.php?add=<?php echo $produto['id_produtos']; ?>">ADICIONAR AO CARRINHO <i class="bi bi-cart-plus"></i></a></button>
                    <?php else: ?>
                        <button class="btn-buy" disabled style="opacity: 0.5; cursor: not-allowed;">INDISPONÍVEL</button>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    <?php endif; ?>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>
