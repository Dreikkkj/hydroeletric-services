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
    <div class="container">
        <!-- Conteúdo do estoque -->
        <h1>Controle de Estoque</h1>
        <p>Gerencie produtos, estoque e movimentações.</p>

    </div>
    <div class="tabela-produtos">
        <table>
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
                        echo '<td>' . htmlspecialchars($produto['nome_produtos'] ?? '') . '</td>';
                        echo '<td>' . htmlspecialchars($produto['sku'] ?? '') . '</td>';
                        $categoriaTexto = $categorias[$produto['categoria_id_produtos']] ?? 'Desconhecido';
                        echo '<td>' . htmlspecialchars($categoriaTexto) . '</td>';
                        echo '<td>R$ ' . number_format(floatval($produto['preco'] ?? 0), 2, ',', '.') . '</td>';
                        echo '<td>' . intval($produto['estoque'] ?? 0) . '</td>';
                        $status = (intval($produto['estoque'] ?? 0) > 0) ? 'Disponível' : 'Esgotado';
                        echo '<td>' . $status . '</td>';
                        echo '<td><a href="editar_produto.php?id=' . intval($produto['id_produtos']) . '">Editar</a> | <a href="excluir_produto.php?id=' . intval($produto['id_produtos']) . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\')">Excluir</a></td>';
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