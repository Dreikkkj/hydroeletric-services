<div class="menu-lateral-abas">
    <?php $pagina_atual = basename($_SERVER['PHP_SELF']); ?>

    <a href="configuracoes.php" class="aba-btn <?php echo ($pagina_atual == 'configuracoes.php') ? 'ativa' : ''; ?>">
        <span class="material-icons">storefront</span> Dados da Loja
    </a>
    <a href="config_seguranca.php" class="aba-btn <?php echo ($pagina_atual == 'config_seguranca.php') ? 'ativa' : ''; ?>">
        <span class="material-icons">encrypted</span> Segurança
    </a>
    <a href="config_usuarios.php" class="aba-btn <?php echo ($pagina_atual == 'config_usuarios.php') ? 'ativa' : ''; ?>">
        <span class="material-icons">group</span> Usuários
    </a>
    <a href="config_sistema.php" class="aba-btn <?php echo ($pagina_atual == 'config_sistema.php') ? 'ativa' : ''; ?>">
        <span class="material-icons">settings</span> Sistema
    </a>
</div>