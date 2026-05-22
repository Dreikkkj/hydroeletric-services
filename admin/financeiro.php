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
        $categoria = $produto['categoria_id_produtos'] ?? 'Outros';
        $valor_deste_item = $qtd * $preco;

        $valor_total_estoque += $valor_deste_item;
        $total_unidades += $qtd;

        if (!isset($dados_categoria[$categoria])) {
            $dados_categoria[$categoria] = [
                'valor' => 0,
                'qtd_produtos' => 0,
                'qtd_unidades' => 0,
                'slug' => strtolower(str_replace(' ', '-', (string)$categoria))
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
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="containerFIN">
        <header class="maintitle">
            <h1>Resumo Financeiro</h1>
            <p>Visão consolidada de receita, custos e lucratividade — maio/2026</p>
        </header>

        <section class="kpi-grid">
            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Receita Total</h2>
                    <span class="icon badge-receita">📈</span>
                </div>
                <p class="valor">R$ 67.400,00</p>
                <span class="mais">↑ 15.8% vs. mês anterior</span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Custo Total</h2>
                    <span class="icon badge-custo">🛍️</span>
                </div>
                <p class="valor">R$ 40.300,00</p>
                <span class="menos">↓ 14.8% vs. mês anterior</span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Lucro Bruto</h2>
                    <span class="icon badge-lucro">💵</span>
                </div>
                <p class="valor">R$ 27.100,00</p>
                <span class="mais">↑ 17.3% vs. mês anterior</span>
            </div>

            <div class="financeiro-card">
                <div class="card-header">
                    <h2>Margem Média</h2>
                    <span class="icon badge-margem">%</span>
                </div>
                <p class="valor">40.2%</p>
                <span class="categoria">Sobre todas as categorias</span>
            </div>
        </section>

        <div class="conteudo">

            <div class="valor-categoria card-categorias bloco">
                <div class="card-header">
                    <h3><img src="../assets/icons/graph.png" class="icon1" alt="Ícone">Valor por Categoria</h3>
                </div>

                <?php foreach ($dados_categoria as $nome_cat => $dados): ?>
                    <?php
                    $porcentagem = $valor_total_estoque > 0 ? ($dados['valor'] / $valor_total_estoque) * 100 : 0;
                    $slug_class = in_array($dados['slug'], ['Fios', 'Cabos', 'Disjuntores', 'Tubulações', 'Conexão Hidráulica', 'Caixas d\'água']) ? $dados['slug'] : 'default';
                    ?>
                    <div class="category-item">
                        <div class="item-header">
                            <div class="item-info">
                                <span class="badge badge-<?= $slug_class ?>"><?= htmlspecialchars($nome_cat) ?></span>
                                <span class="item-details"><?= $dados['qtd_produtos'] ?> produtos &middot;
                                    <?= $dados['qtd_unidades'] ?> un.</span>
                            </div>
                            <div class="item-value">R$ <?= number_format($dados['valor'], 2, ',', '.') ?></div>
                        </div>

                        <div class="progress-bg">
                            <div class="progress-fill fill-<?= $slug_class ?>"
                                style="width: <?= number_format($porcentagem, 1, '.', '') ?>%;"></div>
                        </div>

                        <div class="item-percentage"><?= number_format($porcentagem, 1, ',', '.') ?>% do total</div>
                    </div>
                <?php endforeach; ?>
            </div>

            <section class="bloco top">
                <div class="cabecalho">
                    <h2>Top Produtos</h2>
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