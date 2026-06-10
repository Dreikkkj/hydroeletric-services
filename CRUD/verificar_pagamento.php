<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['metodo_pagamento'] = $_POST['metodo_pagamento'] ?? 'parcelado';
    $_SESSION['quantidade_parcelas'] = (int)($_POST['quantidade_parcelas'] ?? 12);
    $_SESSION['adicionar_instalacao'] = isset($_POST['adicionar_instalacao']) ? true : false;
}

if (!isset($_SESSION['usuario_nome'])) {
    $_SESSION['redirect_apos_login'] = '/hydroeletric-services/confirmar_pagamento.php';
    header('Location: /hydroeletric-services/login.php');
    exit;
}

header('Location: /hydroeletric-services/confirmar_pagamento.php');
exit;