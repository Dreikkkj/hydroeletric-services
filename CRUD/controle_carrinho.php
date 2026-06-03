<?php
session_start();
require_once '../CRUD/crud.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

if ($acao === 'adicionar' && isset($_POST['produto_id'])) {
    $produto_id = (int)$_POST['produto_id'];
    $quantidade = (int)($_POST['quantidade'] ?? 1);

    if ($produto_id > 0 && $quantidade > 0) {
        $produto = read($pdo, 'produtos', "id_produtos = $produto_id");

        if ($produto) {
            if (isset($_SESSION['carrinho'][$produto_id])) {
                $_SESSION['carrinho'][$produto_id]['quantidade'] += $quantidade;
            } else {
                $_SESSION['carrinho'][$produto_id] = [
                    'id' => $produto['id_produtos'],
                    'nome' => $produto['nome_produtos'],
                    'preco' => $produto['preco'],
                    'imagem' => $produto['capa'],
                    'quantidade' => $quantidade
                ];
            }
        }
    }

    header('Location: ' . ($_POST['redirect'] ?? '../carrinho.php'));
    exit;
}

if ($acao === 'atualizar' && isset($_POST['produto_id'])) {
    $produto_id = (int)$_POST['produto_id'];
    $quantidade = (int)$_POST['quantidade'];

    if ($quantidade > 0) {
        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade'] = $quantidade;
        }
    }

    header('Location: ../carrinho.php');
    exit;
}

if ($acao === 'remover' && isset($_GET['produto_id'])) {
    $produto_id = (int)$_GET['produto_id'];

    if (isset($_SESSION['carrinho'][$produto_id])) {
        unset($_SESSION['carrinho'][$produto_id]);
    }

    header('Location: ../carrinho.php');
    exit;
}

if ($acao === 'limpar') {
    $_SESSION['carrinho'] = [];
    header('Location: ../carrinho.php');
    exit;
}
?>