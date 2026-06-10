<header class="admin-topbar">
        <nav>
            <div class="sites">
                <a href="dashboard.php" class="<?= $pagina == 'dashboard' ? 'active' : '' ?>"><i class="bi bi-grid"></i>Dashboard</a>
                <a href="estoque.php" class="<?= $pagina == 'estoque' ? 'active' : '' ?>"><i class="bi bi-archive"></i> Estoque</a>
                <a href="financeiro.php" class="<?= $pagina == 'financeiro' ? 'active' : '' ?>"><i class="bi bi-graph-up"></i> Financeiro</a>
                <a href="configuracoes.php" class="<?= $pagina == 'configuracoes' ? 'active' : '' ?>"><i class="bi bi-gear"></i> configurações</a>
                <a href="ver_loja.php" class="<?= $pagina == 'ver_loja' ? 'active' : '' ?>"><i class="bi bi-shop-window"></i> Ver Loja</a>
            </div>
            <div class="user">
                <div class="adm">
                    <i class="bi bi-person"></i>
                    <p>admininistrador</p>
                </div>
                <a href="../logout.php" class="s">sair</a>
            </div>
        </nav>
</header>