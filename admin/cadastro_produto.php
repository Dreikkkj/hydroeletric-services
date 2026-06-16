<?php

$pagina = 'estoque';

require_once __DIR__ . '/../CRUD/crud.php';
require_once __DIR__ . '/../CRUD/cadastro_produto_processar.php';

if (isset($_GET['error'])) {
    $erro = $_GET['error'];
} else {
    $erro = '';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro de produtos</title>
    <link rel="stylesheet" href="../CSS/cadastro_produto.css">
    <link rel="stylesheet" href="../CSS/header_admin.css">
    <link rel="icon" type="image/x-icon" href="../assets/icons/Icon_logo.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <?php
    require_once __DIR__ . '/../partials/header_admin.php';
    ?>

    <main>
        <section>
            <div class="border">

                <h2>Cadastro de produtos</h2>

                <?php if (!empty($erro_imagem)): ?>
                    <div class="erro">
                        <p><i class="bi bi-x-circle"></i> <?php echo htmlspecialchars($erro_imagem); ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <label for="produto">Nome do produto</label>
                    <input type="text" name="produto" required>

                    <label for="descricao">Descrição do produto</label>
                    <textarea name="descricao" required></textarea>

                    <div class="sc">
                        <div class="s">
                            <label for="sku">SKU</label>
                            <input type="text" name="sku" class="sku">
                        </div>

                        <div class="c">
                            <label for="categoria_id_produtos" class="c">Categoria</label>
                            <select name="categoria_id_produtos" required>
                                <option disabled selected></option>
                                <option value="1">Fios</option>
                                <option value="2">Cabos</option>
                                <option value="3">Disjuntores</option>
                                <option value="4">Tubulaçoes</option>
                                <option value="5">Conexão Hidráulica</option>
                                <option value="6">Caixas d'água</option>
                            </select>
                        </div>
                    </div>

                    <label for="preco">Preço unitário</label>
                    <input type="number" min="1" step="0.01" name="preco" required>

                    <label for="estoque">Estoque do produto</label>
                    <input type="number" min="1" name="estoque" required>

                    <div class="file">
                        <label for="arquivo">Imagem do produto</label>

                        <label for="arquivo" class="caixa-file">
                            <p>Clique para enviar uma imagem</p>
                        </label>

                        <input type="file" id="arquivo" name="capa" accept="image/*" required>
                    </div>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>