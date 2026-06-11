<?php
require_once 'crud.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['arquivo'])) {
    echo "Erro: Nenhum arquivo foi enviado.";
    exit;
}