<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdmin = isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'Admin';
?>

<header class="<?php echo $isAdmin ? 'header-admin' : ''; ?>">
    <nav>
        <div>
            <a href="index.php">
                <img src="assets/icons/Logo2.png" alt="Logo">
            </a>
        </div>

        <div class="search-header">
            <form action="busca.php" method="GET" class="search-header">
                <input type="text" name="q" placeholder="Pesquisar..." required>
            </form>
        </div>

        <ul>
            <li class="header-itens"><a href="index.php">Home</a></li>
            <li class="header-itens"><a href="produtos.php">Produtos</a></li>
            <li class="header-itens"><a href="contato.php">Contato</a></li>
            <li class="header-cart">
                <a href="carrinho.php">
                    <i class="bi bi-cart4"></i>
                </a>
            </li>

            <?php if ($isAdmin): ?>
            <li class="header-admin-icon">
                <a href="../admin/dashboard.php" title="Painel Admin">
                    <i class="bi bi-gear-fill"></i>
                </a>
            </li>
            <?php endif; ?>

            <li class="btn-promocao"><a href="catalogo.php">Catálogo</a></li>
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <li class="btn-entrar"><a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>)</a></li>
            <?php else: ?>
                <li class="btn-entrar"><a href="login.php">Entrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
