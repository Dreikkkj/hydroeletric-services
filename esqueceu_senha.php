<?php
include 'admin/conexao.php';
$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["email"];
    $nova_senha = $_POST["nova_senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    if($nova_senha != $confirmar_senha){
        $mensagem = "As senhas não coincidem.";
    }else{
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $update = "UPDATE usuarios
                       SET senha='$nova_senha'
                       WHERE email='$email'";
            mysqli_query($conn, $update);
            $mensagem = "Senha alterada com sucesso!";
        }else{
            $mensagem = "E-mail não encontrado.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="CSS/esqueceu_senha.css">
</head>

<body>
<div class="container">

    <h1>Recuperar Senha</h1>

    <?php
    if(!empty($mensagem)){
        echo "<p class='mensagem'>$mensagem</p>";
    }
    ?>

    <form method="POST">
        <label>E-mail</label>
        <input
            type="email"
            name="email"
            required
        >

        <label>Nova senha</label>

        <input
            type="password"
            name="nova_senha"
            required
        >

        <label>Confirmar senha</label>

        <input
            type="password"
            name="confirmar_senha"
            required
        >

        <button type="submit">
            Alterar Senha
        </button>

    </form>

    <a href="login.php" class="voltar">
        Voltar para Login
    </a>
</div>
</body>
</html>