<?php
require_once 'CRUD/crud.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha']; 

    if ($nome && $email && !empty($senha)) {
        $dadosUsuario = [
            'nome'          => $nome,
            'email'         => $email,
            'senha'         => $senha, 
            'tipo'          => 'Usuário',
            'ultimo_acesso' => date('Y-m-d'),
            'status'        => 'Ativo'          
        ];

        try {
            $idCriado = create($pdo, 'usuarios', $dadosUsuario);
            if ($idCriado) {
                $mensagem = "<p style='color: green; text-align: center; font-weight: bold; margin-bottom: 10px;'>Conta criada com sucesso!</p>";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $mensagem = "<p style='color: red; text-align: center; font-weight: bold; margin-bottom: 10px;'>Este e-mail já está cadastrado.</p>";
            } else {
                $mensagem = "<p style='color: red; text-align: center; font-weight: bold; margin-bottom: 10px;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
            }
        }
    } else {
        $mensagem = "<p style='color: red; text-align: center; font-weight: bold; margin-bottom: 10px;'>Por favor, preencha todos os campos obrigatórios.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="CSS/cadastro.css">
</head>
<body>
    <a href="index.php" class="h">
        <img src="assets/icons/Logo_i.png" alt="Logo">
    </a>
    <main>
        <section>
            <div class="border">
                <h2>Cadastro</h2>
                
                <?php echo $mensagem; ?>

                <form method="POST" action="cadastro.php">
                    <div class="f1">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" required>

                        <label for="dado">CPF / CNPJ</label>
                        <input type="text" name="dado" id="dado">

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="f2">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone">

                        <label for="cep">CEP</label>
                        <input type="text" name="cep" id="cep">

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" required>
                    </div>

                    <div class="termo">
                        <input type="checkbox" id="termo" required>
                        <p> Aceito os <a href="termos.php">Termos de serviço</a></p>
                    </div>

                    <button type="submit">Cadastrar</button>

                    <div class="voltar-login">
                        <span> Já tem uma conta? <a href="login.php"> Faça o Login</a></span>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>