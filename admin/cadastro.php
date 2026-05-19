<html>

<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<!--enctype="multipart/form-data-->
<body>
    <!--Página de cadastro do usuário, onde o mesmo irá inserir seus dados para criar uma conta.-->
    <div class="containerCAD">
        <img src="./assets/icons/Logo.png" alt="Logo da Empresa" class="logo">
    <h1>Realize o seu cadastro.</h1>
    <form action="cadastro.php" method="post" ">
        <input type="text" id="nome" name="nome" placeholder="Nome Completo" required><br><br>

        <input type="email" id="email" name="email" placeholder="Email" required><br><br>

        <input type="text" id="CPF" name="CPF" placeholder="CPF" required><br><br>

        <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
    </div>

</body>
</html>