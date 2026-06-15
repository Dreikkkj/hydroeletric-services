<?php

$pagina = 'estoque';
$nome = 'movimentacao';

require_once __DIR__ . '/../CRUD/crud.php';

$estoque_minimo = 50;

$busca = $_GET['busca'] ?? '';
$categoria_filtro = $_GET['categoria'] ?? '';

$condicoes = [];

if (!empty($busca)) {
    $busca_escaped = $pdo->quote('%' . $busca . '%');
    $condicoes[] = "(produtos.nome_produtos LIKE $busca_escaped OR produtos.sku LIKE $busca_escaped)";
}

if (!empty($categoria_filtro)) {
    $categoria_id = (int) $categoria_filtro;
    $condicoes[] = "produtos.categoria_id_produtos = $categoria_id";
}

$where = !empty($condicoes) ? implode(' AND ', $condicoes) : null;

$tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
$lerProdutos = readAll($pdo, $tabela_join, $where);
$categorias = readAll($pdo, 'categoria');

try {
    $query = "SELECT
                m.data_hora,
                p.nome_produtos AS produto,
                p.sku AS sku,
                m.tipo_movimentacoes AS acao,
                m.quantidade AS qtd,
                m.estoque_anterior AS anterior,
                m.estoque_atual AS novo,
                m.motivo
FROM movimentacoes m
INNER JOIN produtos p ON m.produto_id = p.id_produtos";

    $queryParams = [];
    $queryConditions = [];

    if (!empty($busca)) {
        $queryConditions[] = "(p.nome_produtos LIKE :busca OR p.sku LIKE :busca)";
        $queryParams[':busca'] = '%' . $busca . '%';
    }

    if (!empty($queryConditions)) {
        $query .= " WHERE " . implode(' AND ', $queryConditions);
    }

    $query .= " ORDER BY m.data_hora DESC";

    $stmt = $pdo->prepare($query);
    foreach ($queryParams as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }
    $stmt->execute();
    $movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $movCount = is_array($movimentacoes) ? count($movimentacoes) : 0;

} catch (PDOException $e) {

    $movimentacoes = [];
    $movCount = 0;
    echo "<script>console.error('Erro ao buscar movimentações: " . addslashes($e->getMessage()) . "');</script>";
}

function badgeAcao($acao)
{
    $classe = 'movimentacao-badge';
    if ($acao === 'Entrada')
        $classe .= ' movimentacao-badge-entrada';
    if ($acao === 'Saída')
        $classe .= ' movimentacao-badge-saida';
    if ($acao === 'Ajuste')
        $classe .= ' movimentacao-badge-ajuste';

    return '<span class="' . $classe . '">' . htmlspecialchars($acao) . '</span>';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="stylesheet" href="../CSS/estoque.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/icons/Icon_logo.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <?php
    require_once __DIR__ . '/../partials/header_admin.php';
    ?>
    <main>
        <section>
            <div class="inicio">
                <h2>Controle de Estoque</h2>
                <h4>Gerencie proutos, estoque e movimentações</h4>

                <div class="l">
                    <a href="../admin/estoque.php"  class="<?= $nome == 'produtos' ? 'pagina' : 'm' ?>">Produtos</a>
                    <a href="../admin/movimentacao.php" class="<?= $nome == 'movimentacao' ? 'pagina' : 'm' ?>">Movimentações</a>
                </div>

                <div class="filtros">
                    <form method="GET" action="">
                        <input type="search" name="busca" placeholder="🔍︎ Buscar produto ou SKU" value="<?= htmlspecialchars($busca) ?>">
                    </form>
                </div>
            </div>

            <div class="b_tabela">
                <table>
                    <thead>
                        <tr>
                            <th>DATA</th>
                            <th>PRODUTO</th>
                            <th>AÇÃO</th>
                            <th>QTD.</th>
                            <th>ANTERIOR</th>
                            <th>NOVO</th>
                            <th>MOTIVO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($movimentacoes)) {
                            foreach ($movimentacoes as $mov) {
                                $dataFormatada = date('d/m/Y, H:i', strtotime($mov["data_hora"]));

                                $sinal = ($mov["acao"] === 'Entrada') ? '+' : (($mov["acao"] === 'Saída') ? '-' : '');

                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($dataFormatada) . '</td>';
                                echo '<td>' . htmlspecialchars($mov["produto"]) . '</td>';
                                echo '<td>' . badgeAcao($mov["acao"]) . '</td>';

                                $qtdClass = ($mov["acao"] === 'Entrada') ? 'movimentacao-qtd-positiva' : 'movimentacao-qtd-negativa';
                                echo '<td class="' . $qtdClass . '">' . htmlspecialchars($sinal . $mov["qtd"]) . '</td>';

                                echo '<td>' . htmlspecialchars($mov["anterior"]) . '</td>';
                                echo '<td><b>' . htmlspecialchars($mov["novo"]) . '</b></td>';
                                echo '<td>' . htmlspecialchars($mov["motivo"]) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7" style="text-align:center; color:#999; padding: 20px;">Nenhuma movimentação registrada no banco de dados.</td></tr>';
                            if (isset($_GET['debug']) && $_GET['debug'] == '1') {
                                echo '<tr><td colspan="7" style="text-align:left; color:#333; padding: 20px; background:#fff;"><pre style="white-space:pre-wrap;">';
                                echo "Query: " . htmlspecialchars($query) . "\n\n";
                                echo "Row count: " . intval($movCount) . "\n\n";
                                try {
                                    $err = $stmt->errorInfo();
                                    echo "PDO errorInfo: " . htmlspecialchars(print_r($err, true)) . "\n\n";
                                } catch (Exception $e) {
                                    echo "No statement error info available.\n";
                                }
                                echo "Fetched data:\n" . htmlspecialchars(print_r($movimentacoes, true));
                                echo '</pre></td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>