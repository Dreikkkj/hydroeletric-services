<?php

    $pagina = 'estoque';

    require_once 'CRUD/crud.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($_FILES['capa']['type'], $tipos_permitidos)) {
        echo "Tipo de arquivo não permitido. Envie JPEG, PNG ou GIF.";
        exit;
    }

    $tamanho_max = 1 * 1024 * 1024; // 1MB

    if ($_FILES['capa']['size'] > $tamanho_max) {
        echo "O arquivo é muito grande. Máximo permitido: 1MB.";
        exit;
    }

    $extensao = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);

    $novonome = 'capa_' . uniqid() . "." . $extensao;

    $dir = 'uploads/';
    $file = $dir . $novonome;

    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (move_uploaded_file($_FILES['capa']['tmp_name'], $file)) {

        $produtoNovo = [
            'nome_produtos' => $_POST['produto'],
            'descricao' => $_POST['descricao'],
            'sku' => $_POST['sku'] = strtoupper($_POST['sku']),
            'categoria_id_produtos' => $_POST['categoria_id_produtos'],
            'preco' => $_POST['preco'],
            'estoque' => $_POST['estoque'],
            'capa' => $file
        ];

        $idprodutoNovo = create($pdo, 'produtos', $produtoNovo);

        if ($idprodutoNovo) {
            header('Location: estoque.php');
            exit;
        } else {
            echo "Erro ao cadastrar.";
        }
    } else { 
        echo "Erro ao enviar imagem."; 
    } 
};

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro de produtos</title>
    <link rel="stylesheet" href="CSS/cadastro_produto.css">
    <link rel="stylesheet" href="CSS/header_adm.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

    <?php
        include 'partials/header_admin.php';
    ?>

    <main>
        <section>
            <div class="border">

                <h2>Cadastro de produtos</h2>
                
                <form  method="POST" enctype="multipart/form-data" >
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