<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Garante que a sessão está ativa para ler o "crachá"
}

// Verifica se existe alguém logado e se esse alguém é admin
$isAdmin = isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin';
?>

<header class="<?php echo $isAdmin ? 'header-admin' : ''; ?>">
    <nav>
        <div>
            <img src="assets/icons/Logo2.png" alt="Logo"> 
        </div>   
        
        <div class="search-header">
            <input type="text" placeholder="Pesquisar...">
            <i class="bi bi-search"></i>
        </div>
        
        <ul>
            <li class="header-itens"><a href="index.php">Home</a></li>
            <li class="header-itens"><a href="produtos.php">Produtos</a></li>
            <li class="header-itens"><a href="contato.php">Contato</a></li>
            <li class="header-cart">
                <a href="carrinho.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                    </svg>
                </a>
            </li>

            <?php if ($isAdmin): ?>
            <li class="header-admin-icon">
                <a href="admin_dashboard.php" title="Painel Admin">
                    <i class="bi bi-gear-fill"></i>
                </a>
            </li>
            <?php endif; ?>

            <li class="btn-promocao"><a href="catalogo.php">Catálogo</a></li>
            <li class="btn-entrar"><a href="login.php">Entrar</a></li>
        </ul>
    </nav>
</header>