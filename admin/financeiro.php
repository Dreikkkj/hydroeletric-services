<?php
require_once __DIR__ . '/../CRUD/crud.php';

$produtos = [];
if (isset($pdo)) {
    try {
        $produtos = readAll($pdo, 'produtos');
    } catch (Exception $e) {
        $produtos = [];
    }
}

$categorias = [
    1 => 'Fios',
    2 => 'Cabos',
    3 => 'Disjuntores',
    4 => 'Tubulações',
    5 => 'Conexão Hidráulica',
    6 => 'Caixas d\'água',
];

$valor_total_estoque = 0;
$total_unidades = 0;
$produtos_cadastrados = 0;
$dados_categoria = [];
$ranking_produtos = [];

if (!empty($produtos) && is_array($produtos)) {
    $produtos_cadastrados = count($produtos);

    foreach ($produtos as $produto) {
        $qtd = isset($produto['estoque']) ? intval($produto['estoque']) : 0;
        $preco = isset($produto['preco']) ? floatval($produto['preco']) : 0;
        $categoriaId = isset($produto['categoria_id_produtos']) ? intval($produto['categoria_id_produtos']) : null;
        $categoria = $categorias[$categoriaId] ?? 'Outros';
        $valor_deste_item = $qtd * $preco;

        $valor_total_estoque += $valor_deste_item;
        $total_unidades += $qtd;

        if (!isset($dados_categoria[$categoria])) {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $categoria)));
            $slug = trim($slug, '-');
            $dados_categoria[$categoria] = [
                'valor' => 0,
                'qtd_produtos' => 0,
                'qtd_unidades' => 0,
                'slug' => $slug ?: 'default'
            ];
        }
        $dados_categoria[$categoria]['valor'] += $valor_deste_item;
        $dados_categoria[$categoria]['qtd_produtos'] += 1;
        $dados_categoria[$categoria]['qtd_unidades'] += $qtd;


        $ranking_produtos[] = [
            'nome' => $produto['nome_produtos'] ?? '',
            'valor_total' => $valor_deste_item,
            'quantidade' => $qtd,
            'preco' => $preco
        ];
    }
    usort($ranking_produtos, function ($a, $b) {
        return $b['valor_total'] <=> $a['valor_total'];
    });
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo Financeiro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style_admin.css">
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <?php
    require_once __DIR__ . '/../partials/header_admin.php';
    ?>

    <div class="containerFIN">
        <header class="maintitle">
            <h1>Resumo Financeiro</h1>
            <p>Visão consolidada de receita, custos e lucratividade — maio/2026</p>
        </header>

        <section class="kpi-grid">
            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Receita Total</h2>
                    <span class="icon badge-receita"><img src="../assets/icons/show_chart.png"
                            alt="Ícone de gráfico"></span>
                </div>
                <p class="valor">R$ <?php echo number_format($valor_total_estoque, 2, ',', '.'); ?></p>
                <span class="mais"><?php echo '↑ 15.8% vs. mês anterior'; ?></span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Custo Total</h2>
                    <span class="icon badge-custo"><img src="../assets/icons/bag.png" alt="Ícone de sacola"></span>
                </div>
                <p class="valor">R$ <?php echo number_format(40300, 2, ',', '.'); ?></p>
                <span class="menos">↓ 14.8% vs. mês anterior</span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Lucro Bruto</h2>
                    <span class="icon badge-lucro"><img src="../assets/icons/moeda.png" alt="Ícone de moeda"></span>
                </div>
                <p class="valor">R$ <?php echo number_format(27100, 2, ',', '.'); ?></p>
                <span class="mais">↑ 17.3% vs. mês anterior</span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Margem Média</h2>
                    <span class="icon badge-margem"><img src="../assets/icons/percent.png"
                            alt="Ícone de porcentagem"></span>
                </div>
                <p class="valor">40.2%</p>
                <span class="categoria">Sobre todas as categorias</span>
            </div>
        </section>

        <div class="conteudo">

            <div class="valor-categoria card-categorias bloco">
                <div class="card-header-cat">
                    <h3>Performance por Categoria</h3>
                    <p class="subtitulo-cat">Receita, custo e margem por categoria no mês</p>
                </div>

                <div class="categorias-list">
                    <?php foreach ($dados_categoria as $nome_cat => $dados): ?>
                        <?php
                        $porcentagem = $valor_total_estoque > 0 ? ($dados['valor'] / $valor_total_estoque) * 100 : 0;

                        $margem = "39.1%";
                        $custo = $dados['valor'] * 0.60;
                        $lucro = $dados['valor'] - $custo;
                        ?>

                        <div class="category-item">
                            <div class="item-header">
                                <span class="category-name"><?= htmlspecialchars($nome_cat) ?></span>
                                <div class="item-metrics">
                                    <span class="metrics-un"><?= number_format($dados['qtd_unidades'], 0, '', '.') ?>
                                        un.</span>
                                    <span class="metrics-margin"><?= $margem ?></span>
                                    <span class="metrics-revenue">R$
                                        <?= number_format($dados['valor'], 2, ',', '.') ?></span>
                                </div>
                            </div>

                            <div class="progress-bg">
                                <div class="progress-fill" style="width: <?= number_format($porcentagem, 1, '.', '') ?>%;">
                                </div>
                            </div>

                            <div class="item-footer">
                                <span class="metrics-cost">Custo: R$ <?= number_format($custo, 2, ',', '.') ?></span>
                                <span class="metrics-profit">Lucro: R$ <?= number_format($lucro, 2, ',', '.') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <section class="bloco top">
                <div class="cabecalho">
                    <h2>Top Produtos <span class="icon badge-top trophy-icon"><img src="../assets/icons/trophy.png"
                                alt="Ícone de troféu"></span></h2>
                    <p class="subtitulo">Por receita no mês atual</p>
                </div>

                <div class="top-produtos-list">
                    <?php
                    $top_5 = array_slice($ranking_produtos, 0, 5);
                    foreach ($top_5 as $index => $item):
                        $rank_class = ($index === 0) ? 'rank-first' : 'rank-other';
                        ?>

                        <div class="top-item">
                            <div class="top-item-left">
                                <div class="top-rank <?= $rank_class ?>">
                                    <?= $index + 1 ?>
                                </div>

                                <div class="top-info">
                                    <div class="top-name"> <?= htmlspecialchars($item['nome']) ?>
                                    </div>

                                    <div class="top-subtext"><?= $item['quantidade'] ?> un. &times;
                                        R$<?= number_format($item['preco'], 2, ',', '.') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="top-value">R$<?= number_format($item['valor_total'], 2, ',', '.') ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

    </div>

</body>

</html>