

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <main>
        <section>
            <div class="border">
                <h2>Login</h2>
                <form method="POST" action="testeloginprocessar.php">

                    <div class="e">
                        <label for="email">Email</label>
                    </div>
                    <input type="email" name="email" required>

                    <div class="s">
                        <label for="senha">Senha</label>
                    </div>
                    <input type="password" name="senha" required>

                    <p class="escS"><a href="">Esqueceu a senha?</a></p>

                    <button type="submit">Entrar</button>
                </form>
                <p class="cadastro">Não tem uma conta? <a href="./cadastro.html">Cadastre-se</a></p>
            </div>
        </section>
    </main>
</body>
</html>