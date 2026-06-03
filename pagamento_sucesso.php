<?php
session_start();

if (!isset($_SESSION['usuario_nome'])) {
    header('Location: /hydroeletric-services/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Realizado com Sucesso</title>
    <link rel="stylesheet" href="CSS/confirmar_pagamento.css">
    <link rel="stylesheet" href="CSS/global.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <div class="container" style="padding: 40px 20px;">
        <div class="card">
            <div class="header">
                <div class="div_image_v">
                    <div class="image">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>

                    <span class="title">Pedido Concluído!</span>
                    <p class="message">Obrigado pela sua compra. Seu pacote será entregue dentro de 2 dias úteis após confirmação do pagamento.</p>
                </div>

                <div class="content">
                    <div class="content-info">
                        <div class="linha linha-separacao">
                            <span>Número do Pedido:</span>
                            <p><?php echo strtoupper(substr($_SESSION['usuario_nome'], 0, 3)) . '-' . date('Ymd') . substr(rand(1000, 9999), 0, 4); ?></p>
                        </div>

                        <div class="linha">
                            <span>Data e Hora:</span>
                            <p><?php echo date('d/m/Y - H:i'); ?></p>
                        </div>

                        <div class="linha">
                            <span>Status:</span>
                            <p>Aguardando Confirmação de Pagamento</p>
                        </div>

                        <a href="index.php" class="content-info-btn">Voltar ao Site</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
</body>
</html>
