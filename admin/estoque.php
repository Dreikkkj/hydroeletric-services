<?php
$pagina = 'estoque';

require_once __DIR__ . '/../CRUD/crud.php';

$tabela_join = "produtos INNER JOIN categoria ON produtos.categoria_id_produtos = categoria.id_categorias";
$lerProdutos = readAll($pdo, $tabela_join);
$qt_min = 50;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estoque</title>
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="stylesheet" href="../CSS/estoque.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <?php
    require_once __DIR__ . '/../partials/header_admin.php';
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
                    <form>
                        <input type="search" placeholder="🔍︎ Buscar produto">
                        <select>
                            <option value="">Todos</option>
                            <option value="">Fios</option>
                            <option value="">Cabos</option>
                            <option value="">Disjuntores</option>
                            <option value="">Tubulaçoes</option>
                            <option value="">Conexão Hidráulica</option>
                            <option value="">Caixas d'água</option>
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
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($lerProdutos as $produtos) {

                            if ($produtos['estoque'] <= $qt_min) {
                                $situacao = 'CRÍTICO';
                                $cor = 'vermelho';
                            } else {
                                $situacao = 'OK';
                                $cor = 'verde';
                            }
                            ;
                            ?>
                            <tr>
                                <td class="produto"><?= $produtos['nome_produtos'] ?></td>
                                <td><?= $produtos['sku'] ?></td>
                                <td class="categoria"><?= $produtos['nome_categorias'] ?></td>
                                <td class="preco">R$ <?= $produtos['preco'] ?></td>
                                <td class="estoque"><?= $produtos['estoque'] ?></td>
                                <td class="status"><span class="<?= $cor ?>"><?= $situacao ?></span></td>
                                <td class="acoes">
                                    <a href="alterar_produto.php?id=<?= $produtos['id_produtos'] ?>"><i
                                            class="bi bi-pencil"></i></a> <a
                                        href="delete.php?id=<?= $produtos['id_produtos'] ?>"
                                        onclick="return confirm('deseja excluir esste produto?')"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ;
                        ?>
                    </tbody>
                </table>
            </div>


        </section>
    </main>
</body>

</html>