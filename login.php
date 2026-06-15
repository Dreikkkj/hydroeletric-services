<?php
require_once 'CRUD/crud.php';
require_once 'login_processar.php';

if (isset($_GET['error'])) {
    $erro = $_GET['error'];
} else {
    $erro = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" type="image/x-icon" href="assets/icons/Icon_logo.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>
    <a href="index.php" class="h">
        <img src="assets/icons/icon_logo.png">
    </a>
    <main>
        <section>
            <?php if (!empty($erro)): ?>
                <div class="erro">
                    <p><?php echo '<i class="bi bi-x-circle"></i> ' . htmlspecialchars($erro); ?></p>
                </div>
            <?php endif; ?>
            <div class="border">
                <h2>Login</h2>
                <form method="POST" action="login_processar.php">

                    

                    <div class="e">
                        <label for="email">Email</label>
                    </div>
                    <input type="email" name="email" required>

                    <div class="s">
                        <label for="senha">Senha</label>
                    </div>
                    <input type="password" name="senha" required>

                    <p class="escS"><a href="esqueceu_senha.php">Esqueceu a senha?</a></p>

                    <button type="submit">Entrar</button>
                </form>
                <p class="cadastro">Não tem uma conta? <a href="./cadastro.php">Cadastre-se</a></p>
            </div>
        </section>
    </main>
</body>
</html>