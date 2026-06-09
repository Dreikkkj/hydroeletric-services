<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/catalogo.css">
    <link rel="stylesheet" href="CSS/global.css">
    <title>Catálogo</title>
</head>
<body>
    <?php
    require_once 'partials/header.php';
    require_once 'CRUD/crud.php';

    $tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
    $lista_promocoes = readAll($pdo, $tabela_join, "em_promocao = 1 LIMIT 8");

    if (empty($lista_promocoes)) {
        $lista_promocoes = readAll($pdo, $tabela_join, "LIMIT 8");
    }
    ?>

    <main class="main-promocao">
        <div class="text-promocao">
            <span>CATÁLOGO</span>
            <h1>Produtos em Destaque</h1>
            <p>Confira nossos principais materiais hidráulicos e elétricos com os melhores preços de São Paulo.</p>
        </div>

        <div class="container-promocao">
            <?php foreach ($lista_promocoes as $produto):
                $preco_original = $produto['preco'];
                
                $preco_exibir = $preco_original * 0.80; 
                $com_desconto = true;
            ?>
            <div class="card-promocao">
                <p class="situacao <?= ($produto['estoque'] > 0) ? 'em-estoque' : 'fora-estoque' ?>">
                    <?= ($produto['estoque'] > 0) ? 'Em Estoque' : 'Fora de Estoque' ?>
                </p>

                <div class="card-promocao-img">
                    <img src="<?= htmlspecialchars($produto['capa']) ?>" alt="<?= htmlspecialchars($produto['nome_produtos']) ?>">
                </div>

                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria"><?= htmlspecialchars($produto['nome_categorias']) ?></span>
                        <h3><?= htmlspecialchars($produto['nome_produtos']) ?></h3>
                        <span class="card-promocao-descricao"><?= htmlspecialchars($produto['sku']) ?> - metro</span>
                    </div>

                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <?php if ($com_desconto): ?>
                                <p style="text-decoration: line-through; color: #888; font-weight: normal; font-size: 0.9em; margin: 0;">
                                    R$ <?= number_format($preco_original, 2, ',', '.') ?>
                                </p>
                                <p style="color: #28a745; font-weight: bold; margin: 0;">
                                    R$ <?= number_format($preco_exibir, 2, ',', '.') ?>
                                </p>
                            <?php else: ?>
                                <p>R$ <?= number_format($preco_exibir, 2, ',', '.') ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="card-promocao-estoque"><?= $produto['estoque'] ?> disp.</span>
                    </div>

                    <div class="card-promocao-btn">
                        <a href="detalhes.php?id=<?= $produto['id_produtos'] ?>" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>