<?php
    require_once __DIR__ . '/../CRUD/crud.php';

    $pagina = 'estoque';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id_produtos'];

        $sku = strtoupper($_POST['sku']);

        $produtoAnterior = read($pdo, 'produtos', 'id_produtos = ' . $id);
        $estoqueAnterior = $produtoAnterior['estoque'];
        $novoEstoque = $_POST['estoque'];

        $produtososAtualizados = [
            'nome_produtos' => $_POST['produto'],
            'descricao' => $_POST['descricao'],
            'sku' => $sku ,
            'categoria_id_produtos' => $_POST['categoria_id_produtos'],
            'preco' => $_POST['preco'],
            'estoque' => $novoEstoque
        ];

        if ($_FILES['capa']['error'] == 0) {

            $extensao = pathinfo(
                $_FILES['capa']['name'], PATHINFO_EXTENSION
            );

            $novoNome = 'capa_' . uniqid() . '.' . $extensao;
            $dir = __DIR__ . '/../uploads/';

            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $file = $dir . $novoNome;
            $capa = 'uploads/' . $novoNome; 
            

            move_uploaded_file(
                $_FILES['capa']['tmp_name'], $file
            );
            $produtososAtualizados['capa'] = $capa;
        }

        update($pdo, 'produtos', $produtososAtualizados, 'id_produtos = ' . $id);

        $estoqueAnteriorInt = (int)$estoqueAnterior;
        $novoEstoqueInt = isset($_POST['estoque']) ? (int)$_POST['estoque'] : $estoqueAnteriorInt;

        $diferenca = $novoEstoqueInt - $estoqueAnteriorInt;

        if ($diferenca !== 0) {
            $tipoMovimentacao = $diferenca > 0 ? 'Entrada' : 'Saída';
            $quantidadeMovida = abs($diferenca);

            $movimentacao = [
                'produto_id' => (int)$id,
                'tipo_movimentacoes' => $tipoMovimentacao,
                'quantidade' => $quantidadeMovida,
                'estoque_anterior' => $estoqueAnteriorInt,
                'estoque_atual' => $novoEstoqueInt,
                'motivo' => 'Ajuste de estoque (Edição manual)'
            ];

            create($pdo, 'movimentacoes', $movimentacao);
        }

        header('Location: estoque.php');
        exit;
    }

    $id = $_GET['id'] ?? null;

    $produtos = read($pdo, 'produtos', 'id_produtos = ' . $id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar produtos</title>
    <link rel="stylesheet" href="../CSS/alterar_produto.css">
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="icon" type="image/x-icon" href="../assets/icons/Icon_logo.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

    <?php
        require_once __DIR__ . '/../partials/header_admin.php';
    ?>
    
    <main>
        <section>
            <div class="border">

                <h2>Alterar produtos</h2>

                <form  method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="id_produtos" value="<?= $id ?>">

                    <label for="produto">Nome do produto</label>
                    <input type="text" name="produto" value="<?= $produtos['nome_produtos'] ?>">

                    <label for="descricao">Descrição do produto</label>
                    <textarea name="descricao"><?= $produtos['descricao'] ?></textarea>

                    <div class="sc">
                        <div class="s">
                            <label for="sku">SKU</label>
                            <input type="text" name="sku" value="<?= $produtos['sku'] ?>" class="sku">
                        </div>

                        <div class="c">
                            <label for="categoria_id_produtos" class="c">Categoria</label>
                            <select name="categoria_id_produtos">
                                <option disabled selected></option>
                                <option value="1" <?= ($produtos['categoria_id_produtos'] == '1') ? 'selected' : '' ?>>Fios</option>
                                <option value="2" <?= ($produtos['categoria_id_produtos'] == '2') ? 'selected' : '' ?>>Cabos</option>
                                <option value="3" <?= ($produtos['categoria_id_produtos'] == '3') ? 'selected' : '' ?>>Disjuntores</option>
                                <option value="4" <?= ($produtos['categoria_id_produtos'] == '4') ? 'selected' : '' ?>>Tubulaçoes</option>
                                <option value="5" <?= ($produtos['categoria_id_produtos'] == '5') ? 'selected' : '' ?>>Conexão Hidráulica</option>
                                <option value="6" <?= ($produtos['categoria_id_produtos'] == '6') ? 'selected' : '' ?>>Caixas d'água</option>
                            </select>
                        </div>
                    </div>

                    <label for="preco">Preço unitário</label>
                    <input type="number" min="1" step="0.01" name="preco" value="<?= $produtos['preco'] ?>">

                    <label for="estoque">Estoque do produto</label>
                    <input type="number" min="1" name="estoque" value="<?= $produtos['estoque'] ?>">

                    <div class="file">
                        <label for="arquivo">Imagem do produto</label>

                        <label for="arquivo" class="caixa-file">
                            <p>Clique para enviar uma imagem</p>
                        </label>

                        <input type="file" id="arquivo" name="capa" accept="image/*">
                    </div>

                    <button type="submit">Alterar</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>