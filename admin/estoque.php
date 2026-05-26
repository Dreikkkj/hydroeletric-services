<?php
require_once __DIR__ . '/../CRUD/crud.php';

$estoque_minimo = 50;
?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="maintitleEST">
        <!-- Conteúdo do estoque -->
        <h1>Controle de Estoque</h1>
        <p>Gerencie produtos, estoque e movimentações.</p>
    </div>
    <div class="filtros">
        <button class="produtos"><?php echo 'Produtos'; ?></button>
        <button class="movimentacoes"><?php echo 'Movimentações'; ?></button>
    </div>

    <div class="search-container">
        <input type="text" placeholder="Buscar Produtos" id="searchInput">
        <select class="filtroclass">
            <option value="">Todas as categorias</option>
            <option value="1">Fios</option>
            <option value="2">Cabos</option>
            <option value="3">Disjuntores</option>
            <option value="4">Tubulações</option>
            <option value="5">Conexão Hidráulica</option>
            <option value="6">Caixas d'água</option>
        </select>

        <select class="filtroclass" id="sortSelect">
            <option value="">Ordenar por</option>
            <option value="nome_asc">Nome (A-Z)</option>
            <option value="nome_desc">Nome (Z-A)</option>
            <option value="preco_asc">Preço (Menor para Maior)</option>
            <option value="preco_desc">Preço (Maior para Menor)</option>
        </select>

    </div>

    <div class="tabela-produtos">
        <table class="estoque-table">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>SKU</th>
                    <th>CATEGORIA</th>
                    <th>PREÇO</th>
                    <th>ESTOQUE</th>
                    <th>STATUS</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $produtos = [];
                if (isset($pdo)) {
                    $produtos = readAll($pdo, 'produtos');
                }
                // Transformar o id da categoria em texto
                $categorias = [
                    1 => 'Fios',
                    2 => 'Cabos',
                    3 => 'Disjuntores',
                    4 => 'Tubulações',
                    5 => 'Conexão Hidráulica',
                    6 => 'Caixas d\'água',
                ];
                //Printar a tabela de produtos
                if (!empty($produtos) && is_array($produtos)) {
                    foreach ($produtos as $produto) {
                        echo '<tr>';
                        $fotoProduto = !empty($produto['capa']) ? $produto['capa'] : '../assets/icons/noimage.png';
                        echo '<td><img src="' . htmlspecialchars($fotoProduto) . '" alt="imagem do produto" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; vertical-align: middle;">' . htmlspecialchars($produto['nome_produtos'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($produto['sku'] ?? '') . '</td>';
                        $categoriaTexto = $categorias[$produto['categoria_id_produtos']] ?? 'Desconhecido';
                        echo '<td>' . htmlspecialchars($categoriaTexto) . '</td>';
                        echo '<td>R$ ' . number_format(floatval($produto['preco'] ?? 0), 2, ',', '.') . '</td>';
                        echo '<td>' . intval($produto['estoque'] ?? 0) . '</td>';
                        $status = (intval($produto['estoque'] ?? 0) > 0) ? 'Disponível' : 'Esgotado';
                        echo '<td>' . $status . '</td>';
                        echo '<td class="acoes-icones"><a href="registrarmovimentacao.php?id=' . intval($produto['id_produtos']) . '"><div class="iconedit"><img src="../assets/icons/arrow.png" alt="Registrar Movimentação"></div></a><a href="editar_produto.php?id=' . intval($produto['id_produtos']) . '"><div class="iconedit"><img src="../assets/icons/edit.png" alt="Editar"></div></a><a href="excluir_produto.php?id=' . intval($produto['id_produtos']) . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\')"><div class="iconedit"><img src="../assets/icons/delete.png" alt="Excluir"></div></a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Nenhum produto cadastrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>