<?php
// login_processar.php
session_start(); // Ativa as sessões do PHP nesta página
require_once 'CRUD/crud.php'; // Seu arquivo de conexão e funções

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!empty($email) && !empty($senha)) {
    // Busca o usuário usando a sua função read()
    $emailSeguro = $pdo->quote($email);
    $usuario = read($pdo, 'usuarios', "email = $emailSeguro");

    // Verifica se o usuário existe e se a senha bate (exemplo usando texto limpo, ajuste se usar hash)
    if ($usuario && $senha === $usuario['senha']) {

        $_SESSION['usuario_id']   = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        if (isset($_SESSION['redirect_apos_login'])) {
            $redirect = $_SESSION['redirect_apos_login'];
            unset($_SESSION['redirect_apos_login']);
            header("Location: " . $redirect);
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Dados incorretos.";
    }
}
