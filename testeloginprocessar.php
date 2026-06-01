<?php
session_start();
require_once 'CRUD/crud.php';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$_POST['email']]);

$usuario = $stmt->fetch();

if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    $_SESSION['usuario_tipo'] = $usuario['tipo'];

    header("Location: detalhes.php");
    exit;
}
?>