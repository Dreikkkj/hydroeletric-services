<?php

session_start();
require_once 'CRUD/crud.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!empty($email) && !empty($senha)) {
    $emailSeguro = $pdo->quote($email);
    $usuario = read($pdo, 'usuarios', "email = $emailSeguro");

    if ($usuario && $senha === $usuario['senha']) {

        $_SESSION['usuario_id']   = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        header("Location: index.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos.";
        header("Location: login.php?error=" . urlencode($erro));
        exit;
    }
}
