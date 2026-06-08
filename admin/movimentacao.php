<?php
require_once __DIR__ . '/../CRUD/crud.php';

$estoque_minimo = 50;

try {
    $query = "SELECT
                m.data_hora,
                p.nome_produtos AS produto,
                m.tipo AS acao,
                m.quantidade AS qtd,
                m.estoque_anterior AS anterior,
                m.estoque_atual AS novo,
                m.motivo
FROM movimentacoes m
INNER JOIN produtos p ON m.produto_id = p.id_produtos
ORDER BY m.data_hora DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    $movimentacoes = [];
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
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <button class="tab-btn">Produtos</button>
            <button class="tab-btn active">Movimentações</button>
        </div>

        <div class="tabela-produtos">
            <table class="estoque-table">
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>