<?php
require_once 'crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produto_id = (int)$_POST['produto_id'];

    $produto = read($pdo, 'produtos', "id_produtos = $produto_id");

    $novo_status = ($produto['em_promocao'] == 0) ? 1 : 0;

    update($pdo, 'produtos', ['em_promocao' => $novo_status], "id_produtos = $produto_id");

    header('Location: ../admin/estoque.php');
    exit;
}
?>
