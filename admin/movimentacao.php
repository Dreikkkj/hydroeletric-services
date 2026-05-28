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
                    $movimentacoes = [
                        ["data" => "10/05/2026, 11:30", "produto" => "Cabo Flexível 2,5mm²", "acao" => "Entrada", "qtd" => "+200", "anterior" => 650, "novo" => 850, "motivo" => "Reposição fornecedor"],
                        ["data" => "09/05/2026, 07:15", "produto" => "Cabo Flexível 2,5mm²", "acao" => "Saída", "qtd" => "-50", "anterior" => 900, "novo" => 850, "motivo" => "Venda cliente #4521"],
                        ["data" => "08/05/2026, 13:00", "produto" => "Disjuntor Bipolar 20A", "acao" => "Entrada", "qtd" => "+30", "anterior" => 90, "novo" => 120, "motivo" => "Novo lote Siemens"],
                        ["data" => "07/05/2026, 06:30", "produto" => "Tubo PVC 25mm - 3m", "acao" => "Saída", "qtd" => "-40", "anterior" => 290, "novo" => 250, "motivo" => "Pedido construtora Martins"],
                        ["data" => "06/05/2026, 08:00", "produto" => "Caixa d'Água 500L", "acao" => "Saída", "qtd" => "-5", "anterior" => 50, "novo" => 45, "motivo" => "Venda final de semana"],
                        ["data" => "05/05/2026, 10:45", "produto" => "Joelho 90° PVC 25mm", "acao" => "Entrada", "qtd" => "+100", "anterior" => 450, "novo" => 550, "motivo" => "Reposição automática"],
                        ["data" => "04/05/2026, 12:20", "produto" => "Caixa d'Água 1000L", "acao" => "Ajuste", "qtd" => "+2", "anterior" => 32, "novo" => 30, "motivo" => "Correção inventário"],
                        ["data" => "03/05/2026, 06:00", "produto" => "Cabo Flexível 6mm²", "acao" => "Saída", "qtd" => "-70", "anterior" => 550, "novo" => 480, "motivo" => "Pedido grande - Construtora ABC"],
                        ["data" => "02/05/2026, 14:00", "produto" => "Disjuntor Bipolar 32A", "acao" => "Entrada", "qtd" => "+20", "anterior" => 75, "novo" => 95, "motivo" => "Reposição regular"],
                        ["data" => "01/05/2026, 09:00", "produto" => "Registro de Esfera 25mm", "acao" => "Saída", "qtd" => "-10", "anterior" => 160, "novo" => 150, "motivo" => "Venda mista"],
                    ];

                    function badgeAcao($acao) {
                        $classe = 'movimentacao-badge';
                        if ($acao === 'Entrada') $classe .= ' movimentacao-badge-entrada';
                        if ($acao === 'Saída') $classe .= ' movimentacao-badge-saida';
                        if ($acao === 'Ajuste') $classe .= ' movimentacao-badge-ajuste';

                        return '<span class="' . $classe . '">' . htmlspecialchars($acao) . '</span>';
                    }

                    foreach ($movimentacoes as $mov) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($mov["data"]) . '</td>';
                        echo '<td>' . htmlspecialchars($mov["produto"]) . '</td>';
                        echo '<td>' . badgeAcao($mov["acao"]) . '</td>';
                        $qtdClass = ($mov["acao"] === 'Entrada' || $mov["acao"] === 'Ajuste') ? 'movimentacao-qtd-positiva' : 'movimentacao-qtd-negativa';
                        echo '<td class="' . $qtdClass . '">' . htmlspecialchars($mov["qtd"]) . '</td>';
                        echo '<td>' . htmlspecialchars($mov["anterior"]) . '</td>';
                        echo '<td><b>' . htmlspecialchars($mov["novo"]) . '</b></td>';
                        echo '<td>' . htmlspecialchars($mov["motivo"]) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>