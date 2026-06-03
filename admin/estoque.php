<?php
require_once __DIR__ . '/../CRUD/crud.php';

$estoque_minimo = 50;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../CSS/header_adm.css"> 
</head>

<body>
    <div class="container-estoque">

        <div class="header-estoque">
            <div class="maintitleEST">
                <h1>Controle de Estoque</h1>
                <p>Gerencie produtos, estoque e movimentações.</p>
            </div>
        </div>

        <div class="filtros">
            <button class="tab-btn active">Produtos</button>
            <button class="tab-btn">Movimentações</button>
        </div>

        <div class="search-container">
            <input type="text" placeholder="Buscar produto..." id="searchInput">

            <select class="filtroclass">
                <option value="">Todas as Categorias</option>
                <option value="1">Fios</option>
                <option value="2">Cabos</option>
                <option value="3">Disjuntores</option>
                <option value="4">Tubulações</option>
                <option value="5">Conexão Hidráulica</option>
                <option value="6">Caixas d'água</option>
            </select>

            <select class="filtroclass" id="sortSelect">
                <option value="nome_asc">Nome A-Z</option>
                <option value="nome_desc">Nome Z-A</option>
                <option value="preco_asc">Preço (Menor para Maior)</option>
                <option value="preco_desc">Preço (Maior para Menor)</option>
            </select>
        </div>

        <div class="tabela-produtos">
            <table class="estoque-table">
                <thead>
                    <tr>
                        <th>PRODUTO</th>
                        <th>SKU</th>
                        <th>CATEGORIA</th>
                        <th>PREÇO</th>
                        <th>ESTOQUE</th>
                        <th>STATUS</th>
                        <th style="text-align: right;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $produtos = [];
                    if (isset($pdo)) {
                        $produtos = readAll($pdo, 'produtos');
                    }

                    $categorias = [
                        1 => 'Fios',
                        2 => 'Cabos',
                        3 => 'Disjuntores',
                        4 => 'Tubulações',
                        5 => 'Conexão Hidráulica',
                        6 => 'Caixas d\'água',
                    ];
                    // Estoque
                    if (!empty($produtos) && is_array($produtos)) {
                        foreach ($produtos as $produto) {
                            $qtdEstoque = intval($produto['estoque'] ?? 0);

                            if ($qtdEstoque == 0) {
                                $statusClass = 'status-critico';
                                $statusTexto = 'Esgotado';
                            } elseif ($qtdEstoque <= $estoque_minimo) {
                                $statusClass = 'status-critico';
                                $statusTexto = 'Crítico';
                            } elseif ($qtdEstoque <= 150) {
                                $statusClass = 'status-medio';
                                $statusTexto = 'Médio';
                            } else {
                                $statusClass = 'status-ok';
                                $statusTexto = 'OK';
                            }

                            echo '<tr>';
                            $fotoProduto = !empty($produto['capa']) ? $produto['capa'] : '../assets/icons/noimage.png';
                            echo '<td>
                                    <div class="produto-cell">
                                        <img src="' . htmlspecialchars($fotoProduto) . '" alt="imagem do produto">
                                        <div class="produto-info">
                                            <span class="produto-nome">' . htmlspecialchars($produto['nome_produtos'] ?? '') . '</span>
                                            <span class="produto-sub">unidade</span>
                                        </div>
                                    </div>
                                </td>';
                            echo '<td class="sku-cell">' . htmlspecialchars($produto['sku'] ?? '') . '</td>';
                            $categoriaTexto = $categorias[$produto['categoria_id_produtos']] ?? 'Geral';
                            echo '<td><span class="badge-categoria">' . htmlspecialchars($categoriaTexto) . '</span></td>';
                            echo '<td class="preco-cell">R$ ' . number_format(floatval($produto['preco'] ?? 0), 2, ',', '.') . '</td>';
                            echo '<td class="estoque-cell">' . $qtdEstoque . '</td>';
                            echo '<td><span class="badge-status ' . $statusClass . '">' . $statusTexto . '</span></td>';
                            echo '<td>
                                    <div class="acoes-icones">
                                        <a href="registrarmovimentacao.php?id=' . intval($produto['id_produtos']) . '" title="Movimentar"><div class="iconedit"><img src="../assets/icons/arrow.png" alt="Trocar"></div></a>
                                        <a href="editar_produto.php?id=' . intval($produto['id_produtos']) . '" title="Editar"><div class="iconedit"><img src="../assets/icons/edit.png" alt="Editar"></div></a>
                                        <a href="excluir_produto.php?id=' . intval($produto['id_produtos']) . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\')" title="Excluir"><div class="iconedit"><img src="../assets/icons/delete.png" alt="Excluir"></div></a>
                                    </div> </td>';

                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="7" style="text-align:center; padding: 30px;">Nenhum produto cadastrado.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>