<?php

$pagina = 'estoque';

require_once __DIR__ . '/../CRUD/crud.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($_FILES['capa']['type'], $tipos_permitidos)) {
        $erro = "Tipo de arquivo não permitido. Use JPEG, PNG ou GIF.";
        header("Location: cadastro_produto.php?error=" . urlencode($erro));
        exit;
    }

    $tamanho_max = 1 * 1024 * 1024; // 1MB

    if ($_FILES['capa']['size'] > $tamanho_max) {
        $erro = "O arquivo é muito grande. Máximo permitido: 1MB.";
        header("Location: cadastro_produto.php?error=" . urlencode($erro));
        exit;
    }

    $extensao = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);

    $novonome = 'capa_' . uniqid() . "." . $extensao;

    $dir = __DIR__ . '/../uploads/';
    $file = $dir . $novonome;
    $capa = 'uploads/' . $novonome;

    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (move_uploaded_file($_FILES['capa']['tmp_name'], $file)) {

        $sku = strtoupper($_POST['sku']);

        $produtoNovo = [
            'nome_produtos' => $_POST['produto'],
            'descricao' => $_POST['descricao'],
            'sku' => $sku,
            'categoria_id_produtos' => $_POST['categoria_id_produtos'],
            'preco' => $_POST['preco'],
            'estoque' => $_POST['estoque'],
            'capa' => $capa
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
}

?>