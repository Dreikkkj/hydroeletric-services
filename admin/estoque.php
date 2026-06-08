<?php
    $pagina = 'estoque';

    require_once 'CRUD/crud.php';

    $tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
    $lerProdutos = readAll($pdo, $tabela_join );
    $qt_min = 50;
    $categorias = readAll($pdo, 'categoria')
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../CSS/header_adm.css"> 
</head>
<body>

    <?php
        include 'partials/header_admin.php';
    ?>

    <a href="cadastro_produto.php" class="cproduto">+ Novo produto</a>
    <main>
        <section>
            <div class="inicio">
                <h2>Controle de Estoque</h2>
                <h4>Gerencie proutos, estoque e movimentações</h4>


                <div class="l">
                    <a href="" class="p">Produtos</a>
                    <a href="" class="m">Movimentações</a>
                </div>


                <div class="filtros">
                    <form method="GET">
                        <select name="categoria" onchange="this.form.submit()">
                            <option value="">Todas</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option
                                    value="<?= $categoria['id_categorias'] ?>"
                                    <?= (($_GET['categoria'] ?? '') == $categoria['id_categorias']) ? 'selected' : '' ?>
                                >
                                    <?= $categoria['nome_categorias'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>

            <div class="b_tabela">
                <table>
                    <thead>
                        <tr>
                            <th>PRODUTO</th>
                            <th class="sku">SKU</th>
                            <th>CATEGORIA</th>
                            <th>PREÇO</th>
                            <th>ESTOQUE</th>
                            <th>STATUS</th>
                            <th>PROMOÇÃO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            foreach($lerProdutos as $produtos){
                                
                                if ($produtos['estoque'] <= $qt_min) {
                                    $situacao = 'CRÍTICO';
                                    $cor = 'vermelho';
                                } else {
                                    $situacao = 'OK';
                                    $cor = 'verde';
                                };
                        ?>
                        <tr>
                            <td class="produto"><?= $produtos['nome_produtos'] ?></td>
                            <td><?= $produtos['sku'] ?></td>
                            <td class="categoria"><?= $produtos['nome_categorias'] ?></td>
                            <td class="preco">R$ <?= $produtos['preco'] ?></td>
                            <td class="estoque"><?= $produtos['estoque'] ?></td>
                            <td class="status"><span class="<?= $cor ?>"><?= $situacao ?></span></td>
                            <td class="acoes-promocao">
                                <form method="POST" action="CRUD/toggle_promocao.php" style="display:inline;">
                                    <input type="hidden" name="produto_id" value="<?= $produtos['id_produtos'] ?>">
                                    <button type="submit" class="btn-toggle-promocao" style="background-color: <?= ($produtos['em_promocao'] == 1) ? '#28a745' : '#dc3545' ?>">
                                        <?= ($produtos['em_promocao'] == 1) ? 'Ativo' : 'Inativo' ?>
                                    </button>
                                </form>
                            </td>
                            <td class="acoes">
                                <a href="alterar_produto.php?id=<?= $produtos['id_produtos'] ?>"><i class="bi bi-pencil"></i></a> <a href="delete.php?id=<?= $produtos['id_produtos'] ?>" onclick="return confirm('deseja excluir esste produto?')" ><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            };
                        ?>
                    </tbody>
                </table>
            </div>


        </section>
    </main>
</body>
</html>