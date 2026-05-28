<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="CSS/produtos.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
</head>
<body>
    <?php
        include 'partials/header.php';
    ?>
    <main class="container">
        <section class="categoria">
            <h2 class="titulo-categoria">Veja nossos produtos:</h2>
            
            <div class="layout-principal">
                
                <aside class="caixa-filtros">
                    <h3 class="titulo-filtros">Filtrar por:</h3>
                    
                    <details open>
                        <summary>Categoria</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="categoria" checked> Cabos</label>
                            <label><input type="radio" name="categoria"> Ferramentas</label>
                            <label><input type="radio" name="categoria"> Iluminação</label>
                        </div>
                    </details>

                    <details>
                        <summary>Disponibilidade</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="disponibilidade" checked> Em estoque</label>
                            <label><input type="radio" name="disponibilidade"> Esgotado</label>
                        </div>
                    </details>

                    <details>
                        <summary>Faixa de Preço</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="preco" checked> Até R$ 50,00</label>
                            <label><input type="radio" name="preco"> R$ 50 a R$ 150</label>
                            <label><input type="radio" name="preco"> Acima de R$ 150</label>
                        </div>
                    </details>
                </aside>
                
                <div class="grid-produtos">
                    <?php
                    require_once 'CRUD/crud.php';
                    $produtos = readAll($pdo, 'produtos');

                    foreach ($produtos as $produtos) {
                        echo "<div class='card'>";
                        echo "<p class='estado-produto'>" . $produtos["estado"] . "</p>";
                        echo "<img src='" . $produtos["capa"] . "' alt='produto' class='imagem-produto'>";
                        echo "<p class='categoria-produto'>" . $produtos["categoria_id_produtos"] . "</p>";
                        echo "<h3 class='nome-produto'>" . $produtos["nome_produtos"] . "</h3>";
                        echo "<p class='codigo-produto'>Código: " . $produtos["sku"] . "</p>";
                        echo "<p class='texto-produto'>Preço</p>";
                        echo "<div class='linha-card'>";
                        echo "<p class='preco-produto'>R$ " . number_format($produtos["preco"], 2, ',', '.') . "</p>";
                        echo "<p class='quantidade-produto'>" . $produtos["estoque"] . " disp.</p>";
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
    <?php
        include 'partials/footer.php';
    ?>
</body>
</html>