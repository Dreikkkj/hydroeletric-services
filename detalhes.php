<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/detalhes.css">
    <link rel="stylesheet" href="CSS/global.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>

    <main class="prod-main">
        
        <div class="prod-container">
            
            <div class="prod-gallery">
                <p class="indicador"><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="detalhes.php">Cabo Flexível 2,5mm²</a></p>
                
                <div class="main-img">
                    <img src="assets/icons/Logo.png" id="mainImg">
                </div>
                
                <div class="mini-img">
                    <img src="assets/icons/Logo.png">
                    <img src="assets/icons/Logo.png">
                </div>
            </div>

            <div class="prod-info">
                <div class="categoria-item">Cabos</div>

                <h1>Cabo Flexível 2,5mm²</h1>
                <span class="sku-item">CFL-025-001</span>

                <h2 class="preco">R$ 4,50</h2>

                <div class="desc">
                    <p>
                    O cabo flexível 2,5mm² é ideal para aplicações elétricas de baixa tensão.
                    Sua construção resistente garante durabilidade e segurança.
                    </p>

                    <p>
                    Equipado com amortecimento Air visível, proporciona leveza e
                    absorção de impacto para o dia a dia.
                    </p>
                </div>

                <button class="btn-buy"><a href="carrinho.php">ADICIONAR AO CARRINHO <i class="bi bi-cart-plus"></i></a></button>
            </div>
        </div>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>