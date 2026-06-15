<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'CRUD/crud.php';
include 'partials/header.php';

$termo_pesquisa = isset($_GET['q']) ? trim($_GET['q']) : '';
$resultados = [];

if (!empty($termo_pesquisa)) {
    $sql = "SELECT * FROM produtos WHERE nome_produtos LIKE ?";
    $stmt = $pdo->prepare($sql);
    $termo_busca = '%' . $termo_pesquisa . '%';
    $stmt->execute([$termo_busca]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$percentual_desconto = 0.20;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="stylesheet" href="CSS/busca.css">
    <title>Resultados da Busca - Hidroelétrica Services</title>
</head>
<body>
<main class="busca-main">
    <div class="busca-container">
        <h2>Resultados da busca para: "<span class="termo"><?php echo htmlspecialchars($termo_pesquisa); ?></span>"</h2>

        <?php if (empty($termo_pesquisa)): ?>
            <div class="busca-vazia">
                <p><i class="bi bi-search"></i> Por favor, digite algo na barra de pesquisa.</p>
            </div>

        <?php elseif (count($resultados) > 0): ?>
            <div class="busca-resultados">
                <?php foreach ($resultados as $produto): ?>
                    <a href="detalhes.php?id=<?php echo $produto['id_produtos']; ?>" class="produto-card">
                        <div class="produto-imagem">
                            <?php if (!empty($produto['capa'])): ?>
                                <img src="<?php echo htmlspecialchars($produto['capa']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produtos']); ?>">
                            <?php else: ?>
                                <i class="bi bi-box"></i>
                            <?php endif; ?>
                        </div>
                        <div class="produto-info">
                            <h3><?php echo htmlspecialchars($produto['nome_produtos']); ?></h3>
                            <p class="sku">SKU: <?php echo htmlspecialchars($produto['sku']); ?></p>
                            <p class="descricao"><?php echo substr(htmlspecialchars($produto['descricao'] ?? ''), 0, 80); ?>...</p>
                            <div class="produto-footer">
                                <?php if ($produto['em_promocao'] == 1) {
                                    $preco_com_desconto = $produto['preco'] * (1 - $percentual_desconto);
                                    echo "<span class='preco-antigo' style='text-decoration: line-through; color: #ccc; font-size: 0.9em; margin: 0;'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</span>";
                                    echo "<span class='preco-promocao' style='color: #28a745; font-weight: bold; margin: 0;'>R$ " . number_format($preco_com_desconto, 2, ',', '.') . "</span>";
                                } else {
                                    echo "<span class='preco'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</span>";
                                }
                                ?>
                                <span class="estoque">
                                    <?php echo $produto['estoque'] > 0 ? 'Em estoque' : 'Indisponível'; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="busca-vazia">
                <p><i class="bi bi-inbox"></i> Nenhum produto encontrado para "<?php echo htmlspecialchars($termo_pesquisa); ?>".</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once 'partials/footer.php'; ?>
</body>
</html>