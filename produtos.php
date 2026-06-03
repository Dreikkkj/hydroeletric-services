<?php
    require_once 'CRUD/crud.php';
    $clausulas_condicao = [];

    if (!empty($_GET['categoria'])) {
        $id_categoria = (int)$_GET['categoria'];
        if ($id_categoria > 0) {
            $clausulas_condicao[] = "produtos.categoria_id_produtos = $id_categoria";
        }
    }

    if (!empty($_GET['disponibilidade'])) {
        if ($_GET['disponibilidade'] === 'estoque') {
            $clausulas_condicao[] = "produtos.estoque > 0";
        } elseif ($_GET['disponibilidade'] === 'esgotado') {
            $clausulas_condicao[] = "produtos.estoque <= 0";
        }
    }

    if (!empty($_GET['preco'])) {
        if ($_GET['preco'] === 'ate-50') {
            $clausulas_condicao[] = "produtos.preco <= 50";
        } elseif ($_GET['preco'] === '50-150') {
            $clausulas_condicao[] = "produtos.preco > 50 AND produtos.preco <= 150";
        } elseif ($_GET['preco'] === 'acima-150') {
            $clausulas_condicao[] = "produtos.preco > 150";
        }
    }

    $condicao = implode(' AND ', $clausulas_condicao);

    $tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
    $lista_produtos = readAll($pdo, $tabela_join, $condicao);

    $lista_categorias = readAll($pdo, 'categoria');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/produtos.css">
    <link rel="stylesheet" href="CSS/global.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <main class="container">
        <section class="categoria">
            <h2 class="titulo-categoria">Veja nossos produtos:</h2>
            
            <div class="layout-principal">
                
                <form method="GET" action="produtos.php" class="caixa-filtros">
                    <h3 class="titulo-filtros">Filtrar por:</h3>
                    
                    <details open>
                        <summary>Categoria</summary>
                        <div class="conteudo-filtro">
                            <label>
                                <input type="radio" name="categoria" value="" <?= empty($_GET['categoria']) ? 'checked' : '' ?>> 
                                Todas
                            </label>
                            
                            <?php foreach($lista_categorias as $cat): ?>
                                <?php $marcado = (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id_categorias']) ? 'checked' : ''; ?>
                                <label>
                                    <input type="radio" name="categoria" value="<?= $cat['id_categorias'] ?>" <?= $marcado ?>> 
                                    <?= htmlspecialchars($cat['nome_categorias']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </details>

                    <details open>
                        <summary>Disponibilidade</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="disponibilidade" value="" <?= empty($_GET['disponibilidade']) ? 'checked' : '' ?>> Todos</label>
                            <label><input type="radio" name="disponibilidade" value="estoque" <?= (isset($_GET['disponibilidade']) && $_GET['disponibilidade'] === 'estoque') ? 'checked' : '' ?>> Em estoque</label>
                            <label><input type="radio" name="disponibilidade" value="esgotado" <?= (isset($_GET['disponibilidade']) && $_GET['disponibilidade'] === 'esgotado') ? 'checked' : '' ?>> Esgotado</label>
                        </div>
                    </details>

                    <details open>
                        <summary>Faixa de Preço</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="preco" value="" <?= empty($_GET['preco']) ? 'checked' : '' ?>> Todos os preços</label>
                            <label><input type="radio" name="preco" value="ate-50" <?= (isset($_GET['preco']) && $_GET['preco'] === 'ate-50') ? 'checked' : '' ?>> Até R$ 50,00</label>
                            <label><input type="radio" name="preco" value="50-150" <?= (isset($_GET['preco']) && $_GET['preco'] === '50-150') ? 'checked' : '' ?>> R$ 50 a R$ 150</label>
                            <label><input type="radio" name="preco" value="acima-150" <?= (isset($_GET['preco']) && $_GET['preco'] === 'acima-150') ? 'checked' : '' ?>> Acima de R$ 150</label>
                        </div>
                    </details>
                    
                    <button type="submit" class="btn-aplicar">
                        Aplicar Filtros
                    </button>
                </form>
                
                <div class="grid-produtos">
                    <?php

                    foreach ($lista_produtos as $produto) {
                        
                        if ($produto["estoque"] > 0) {
                            $estoque_texto = "Em estoque";
                        } else {
                            $estoque_texto = "Esgotado";
                        }

                        echo "<div class='card'>";
                        echo "<p class='estado-produto'>" . $estoque_texto . "</p>";
                        echo "<img src='" . $produto["capa"] . "' alt='produto' class='imagem-produto'>";
                        echo "<p class='categoria-produto'>" . htmlspecialchars($produto["nome_categorias"]) . "</p>";
                        echo "<h3 class='nome-produto'>" . htmlspecialchars($produto["nome_produtos"]) . "</h3>";
                        echo "<p class='codigo-produto'>Código: " . $produto["sku"] . "</p>";
                        echo "<p class='texto-produto'>Preço</p>";
                        echo "<div class='linha-card'>";
                        echo "<p class='preco-produto'>R$ " . number_format($produto["preco"], 2, ',', '.') . "</p>";
                        echo "<p class='quantidade-produto'>" . $produto["estoque"] . " disp.</p>";
                        echo "</div>";
                        echo "<a href='#' target='_blank'>";
                        echo "<button class='btn-detalhes'>Ver Detalhes</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <?php include 'partials/footer.php'; ?>
</body>
</html>