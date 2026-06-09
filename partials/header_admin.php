<header>
        <nav>
            <div class="sites">
                <a href="#" class="<?= $pagina == 'dashboard' ? 'active' : '' ?>"><i class="bi bi-grid"></i>Dashboard</a>
                <a href="estoque.php" class="<?= $pagina == 'estoque' ? 'active' : '' ?>"><i class="bi bi-archive"></i> Estoque</a>
                <a href="#" class="<?= $pagina == 'financeiro' ? 'active' : '' ?>"><i class="bi bi-graph-up"></i> Financeiro</a>
                <a href="#" class="<?= $pagina == 'configuracoes' ? 'active' : '' ?>"><i class="bi bi-gear"></i> configurações</a>
                <a href="#" class="<?= $pagina == 'ver_loja' ? 'active' : '' ?>"><i class="bi bi-shop-window"></i> Ver Loja</a>
            </div>
            <div class="user">
                <div class="adm">
                    <i class="bi bi-person"></i>
                    <p>admininistrador</p>
                </div>
                <a href="logout.php" class="s">sair</a>
            </div>
        </nav>
</header>