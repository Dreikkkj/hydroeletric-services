<?php
    require_once 'CRUD/crud.php';

    $id = $_GET['id'] ?? null;

    $linhas = delete($pdo, 'produtos', 'id_produtos = ' . $id);

    if ($linhas > 0) {
        header("Location: estoque.php");
        exit;
    } else {
        echo "Erro ao deletar.";
    }