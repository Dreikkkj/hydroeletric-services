<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estoque</title>
    <link rel="stylesheet" href="./css/header_adm.css">
    <link rel="stylesheet" href="./css/estoque.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

    <?php
        include 'partials/header_admin.php';
    ?>

    <a href="" class="cproduto">+ Novo produto</a>
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
                    <input type="search" placeholder="🔍︎ Buscar produto">
                    <select>
                        <option value="">Todas as Categorias</option>
                        <option value="">fios</option>
                        <option value="">disjuntores</option>
                        <option value="">tubulaçoes</option>
                        <option value="">conexoes</option>
                        <option value="">Caixas d'água</option>
                    </select>
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
                        <tr>
                            <td class="produto">Cabo Fleível 2,5mm²</td>
                            <td>CFL-025-001</td>
                            <td class="categoria">Cabos</td>
                            <td class="preco">R$4,50</td>
                            <td class="estoque">850</td>
                            <td class="status"><span>Ok</span></td>
                            <td class="acoes">
                                <div>
                                    <button>+</button> 
                                    <button>-</button>
                                </div>
                                <a href=""><i class="bi bi-pencil"></i></a> <a href=""><i class="bi bi-trash"></i></a> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </section>
    </main>
</body>
</html>