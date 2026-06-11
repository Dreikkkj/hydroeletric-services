<?php
require_once '../CRUD/crud.php';


// 1. IDENTIFICAR O FILTRO ESCOLHIDO PELA URL (Padrão: semana)
$filtro = $_GET['filtro'] ?? 'semana';

// Configurações das variáveis baseadas no filtro
if ($filtro === 'mes') {
    $activeSemana = "";
    $activeMes = "active";

    // Conta movimentações do mês atual
    $sqlCardMov = "SELECT COUNT(*) FROM movimentacoes WHERE MONTH(data_hora) = MONTH(CURRENT_DATE()) AND YEAR(data_hora) = YEAR(CURRENT_DATE())";
    $subtituloMov = "Neste mês";

    // Busca movimentações da tabela filtrando pelo mês atual
    $sqlTabelaMov = "SELECT m.*, m.tipo_movimentacoes AS tipo, p.nome_produtos, DATE_FORMAT(m.data_hora, '%d/%m, %H:%i') as data_formatada 
                     FROM movimentacoes m 
                     JOIN produtos p ON m.produto_id = p.id_produtos 
                     WHERE MONTH(m.data_hora) = MONTH(CURRENT_DATE()) AND YEAR(m.data_hora) = YEAR(CURRENT_DATE())
                     ORDER BY m.data_hora DESC LIMIT 10";
} else {
    $activeSemana = "active";
    $activeMes = "";

    // Conta movimentações dos últimos 7 dias reais
    $sqlCardMov = "SELECT COUNT(*) FROM movimentacoes WHERE data_hora >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $subtituloMov = "Últimos 7 dias";

    // Busca movimentações da tabela filtrando pelos últimos 7 dias reais
    $sqlTabelaMov = "SELECT m.*, p.nome_produtos, DATE_FORMAT(m.data_hora, '%d/%m, %H:%i') as data_formatada 
                     FROM movimentacoes m 
                     JOIN produtos p ON m.produto_id = p.id_produtos 
                     WHERE m.data_hora >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                     ORDER BY m.data_hora DESC LIMIT 10";
}

// 2. CARDS DE RESUMO FIXOS (Estoque atual)
$totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();

$novosEsteMes = $pdo->query("SELECT COUNT(*) FROM produtos WHERE MONTH(data_cadastro) = MONTH(CURRENT_DATE()) AND YEAR(data_cadastro) = YEAR(CURRENT_DATE())")->fetchColumn();

$valorEstoque = $pdo->query("SELECT SUM(estoque * preco) FROM produtos")->fetchColumn() ?? 0;
$estoqueBaixo = $pdo->query("SELECT COUNT(*) FROM produtos WHERE estoque < 50")->fetchColumn();

// Executa a query de contagem de movimentações baseada no filtro
$movimentacoesRecentes = $pdo->query($sqlCardMov)->fetchColumn();

// 3. GRÁFICO DINÂMICO
$categoriasGrafico = ['Fios' => 0, 'Disjuntores' => 0, 'Tubulações' => 0, 'Conexões' => 0, 'Caixas' => 0];
$queryGrafico = $pdo->query("SELECT c.nome_categorias, SUM(p.estoque) as total 
                             FROM produtos p 
                             JOIN categoria c ON p.categoria_id_produtos = c.id_categorias 
                             GROUP BY c.nome_categorias");

while ($row = $queryGrafico->fetch(PDO::FETCH_ASSOC)) {
    if (array_key_exists($row['nome_categorias'], $categoriasGrafico)) {
        $categoriasGrafico[$row['nome_categorias']] = $row['total'];
    }
}
$maxGrafico = 2800;

// 4. ESTOQUE CRÍTICO
$stmtCritico = $pdo->query("SELECT nome_produtos, estoque FROM produtos WHERE estoque < 50 ORDER BY estoque ASC LIMIT 3");
$produtosCriticos = $stmtCritico->fetchAll(PDO::FETCH_ASSOC);

// 5. TABELA DE MOVIMENTAÇÕES (Executa a query baseada no filtro)
$stmtMov = $pdo->query($sqlTabelaMov);
$movimentacoes = $stmtMov->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <title>Dashboard - Gestão de Estoque</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <?php
    require_once __DIR__ . '/../partials/header_admin.php';
    ?>

    <div class="main-container">

        <div class="dashboard-header">
            <div>
                <h1>Dashboard</h1>
                <p class="subtitle">Visão geral do estoque e movimentações</p>
            </div>

            <div class="filter-buttons">
                <a href="dashboard.php?filtro=semana" class="btn-filter <?= $activeSemana ?>">Esta Semana</a>
                <a href="dashboard.php?filtro=mes" class="btn-filter <?= $activeMes ?>">Este Mês</a>
            </div>
        </div>

        <div class="cards-grid">
            <div class="card">
                <p class="card-title">Total de Produtos</p>
                <p class="card-value"><?= $totalProdutos ?></p>
                <p class="card-sub positive">+<?= $novosEsteMes ?> este mês</p>
            </div>
            <div class="card">
                <p class="card-title">Valor em Estoque</p>
                <p class="card-value">R$ <?= number_format($valorEstoque, 2, ',', '.') ?></p>
                <p class="card-sub">Atualizado agora</p>
            </div>
            <div class="card">
                <p class="card-title">Estoque Baixo</p>
                <p class="card-value"><?= $estoqueBaixo ?></p>
                <p class="card-sub negative">Necessita atenção</p>
            </div>
            <div class="card">
                <p class="card-title">Movimentações</p>
                <p class="card-value"><?= $movimentacoesRecentes ?></p>
                <p class="card-sub"><?= $subtituloMov ?></p>
            </div>
        </div>

        <div class="content-row">
            <div class="chart-card">
                <h3>Estoque por Categoria</h3>
                <p class="subtitle">Quantidade total de itens em estoque por categoria</p>
                <div class="chart-container">
                    <div class="chart-y-axis">
                        <span>2800</span>
                        <span>2100</span>
                        <span>1400</span>
                        <span>700</span>
                        <span>0</span>
                    </div>
                    <div class="chart-area">
                        <?php foreach ($categoriasGrafico as $cat => $qtd):
                            $alturaPorcentagem = ($qtd / $maxGrafico) * 100;
                            if ($alturaPorcentagem > 100)
                                $alturaPorcentagem = 100;
                            ?>
                            <div class="chart-bar-wrapper">
                                <div class="chart-bar" style="height: <?= $alturaPorcentagem ?>%;"></div>
                                <span class="chart-label"><?= $cat ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="critical-card">
                <h3>Estoque Crítico</h3>
                <p class="subtitle">Itens com menos de 50 unidades</p>

                <div class="critical-list">
                    <?php if (empty($produtosCriticos)): ?>
                        <p class="empty-critical">Nenhum item abaixo de 50 unidades.</p>
                    <?php else: ?>
                        <?php foreach ($produtosCriticos as $prod): ?>
                            <div class="critical-item">
                                <div class="item-info">
                                    <span class="item-name"><?= htmlspecialchars($prod['nome_produtos']) ?></span>
                                    <span class="item-code">Código do Produto</span>
                                </div>
                                <span class="item-qty"><?= $prod['estoque'] ?> uni.</span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a href="estoque.php" class="btn-link">Ir para Controle de Estoque &rarr;</a>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div>
                    <h3>Últimas Movimentações</h3>
                    <p class="subtitle">Registro das últimas alterações no estoque</p>
                </div>
                <a href="historico.php" class="view-all">Ver Todas</a>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>DATA</th>
                        <th>PRODUTO</th>
                        <th>AÇÃO</th>
                        <th>QTD.</th>
                        <th>ESTOQUE</th>
                        <th>MOTIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($movimentacoes)): ?>
                        <tr>
                            <td colspan="6" class="table-empty-message">Nenhuma movimentação para o período selecionado.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($movimentacoes as $mov):
                            $badgeClass = ($mov['tipo_movimentacoes'] == 'Entrada') ? 'badge-entrada' : 'badge-saida';
                            $prefixo = ($mov['tipo_movimentacoes'] == 'Entrada') ? '+' : '-';
                            ?>
                            <tr>
                                <td><?= $mov['data_formatada'] ?></td>
                                <td><strong><?= htmlspecialchars($mov['nome_produtos']) ?></strong></td>
                                <td><span class="badge <?= $badgeClass ?> notranslate"><?= $mov['tipo_movimentacoes'] ?></span>
                                </td>
                                <td><strong><?= $prefixo . $mov['quantidade'] ?></strong></td>
                                <td class="table-stock"><?= $mov['estoque_anterior'] ?> &rarr; <?= $mov['estoque_atual'] ?></td>
                                <td class="table-reason"><?= htmlspecialchars($mov['motivo']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>