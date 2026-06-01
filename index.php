<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'CRUD/crud.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/global.css">
    <title>Home - Hidroelétrica Services</title>
    <style>
        main {
            min-height: 70vh;
            padding: 40px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome {
            text-align: center;
            max-width: 600px;
        }
        .welcome h1 {
            font-size: 2.5em;
            color: #023047;
            margin-bottom: 20px;
        }
        .welcome p {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 30px;
        }
        .welcome-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .welcome-buttons a {
            padding: 12px 30px;
            background-color: #fca311;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }
        .welcome-buttons a:hover {
            background-color: #023047;
        }
    </style>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>

    <main>
        <div class="welcome">
            <?php if (isset($_SESSION['autenticado']) && $_SESSION['autenticado']): ?>
                <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
                <p>Você está logado como <strong><?php echo htmlspecialchars($_SESSION['tipo']); ?></strong></p>
            <?php else: ?>
                <h1>Bem-vindo à Hidroelétrica Services</h1>
                <p>Acesse sua conta para continuar</p>
                <div class="welcome-buttons">
                    <a href="login.php">Entrar</a>
                    <a href="cadastro.html">Cadastrar</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>
