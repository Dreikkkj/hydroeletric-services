<?php
require_once 'CRUD/crud.php';

try {
    // Verifica se a tabela usuarios existe
    $stmt = $pdo->query("DESCRIBE usuarios");
    $columns = $stmt->fetchAll();

    if ($columns) {
        echo "<h2>Tabela 'usuarios' existe</h2>";
        echo "<h3>Colunas:</h3>";
        echo "<ul>";
        foreach ($columns as $col) {
            echo "<li>{$col['Field']} ({$col['Type']})</li>";
        }
        echo "</ul>";

        // Verifica usuários existentes
        $usuarios = readAll($pdo, 'usuarios');
        echo "<h3>Usuários cadastrados (" . count($usuarios) . "):</h3>";

        if ($usuarios) {
            echo "<table border='1' style='border-collapse:collapse; margin:20px 0;'>";
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Tipo</th><th>Ações</th></tr>";
            foreach ($usuarios as $user) {
                echo "<tr>";
                echo "<td>{$user['id_user']}</td>";
                echo "<td>{$user['nome']}</td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['categoria']}</td>";
                echo "<td><a href='?delete={$user['id_user']}'>Deletar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum usuário cadastrado ainda.</p>";
        }

        // Criar usuários de teste
        if (isset($_POST['criar_teste'])) {
            $usuarios_teste = [
                [
                    'nome' => 'Admin Teste',
                    'email' => 'admin@test.com',
                    'senha' => '123456',
                    'categoria' => 'admin',
                    'cpf_cnpj' => '00000000000001',
                    'telefone' => '1199999999',
                    'img_user' => 'default.jpg'
                ],
                [
                    'nome' => 'Cliente Teste',
                    'email' => 'cliente@test.com',
                    'senha' => '123456',
                    'categoria' => 'cliente',
                    'cpf_cnpj' => '00000000000002',
                    'telefone' => '1199999998',
                    'img_user' => 'default.jpg'
                ],
                [
                    'nome' => 'Profissional Teste',
                    'email' => 'prof@test.com',
                    'senha' => '123456',
                    'categoria' => 'profissional',
                    'cpf_cnpj' => '00000000000003',
                    'telefone' => '1199999997',
                    'img_user' => 'default.jpg'
                ]
            ];

            foreach ($usuarios_teste as $user) {
                try {
                    create($pdo, 'usuarios', $user);
                    echo "<p>✓ Usuário {$user['nome']} criado com sucesso!</p>";
                } catch (Exception $e) {
                    echo "<p>✗ Erro ao criar {$user['nome']}: " . $e->getMessage() . "</p>";
                }
            }
        }

        // Deletar usuário
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            delete($pdo, 'usuarios', "id_user = $id");
            header("Refresh:0");
        }

        echo "<br><form method='POST'>";
        echo "<button type='submit' name='criar_teste' style='padding:10px 20px; background:#fca311; color:white; border:none; border-radius:5px; cursor:pointer;'>Criar Usuários de Teste</button>";
        echo "</form>";

    } else {
        echo "<h2 style='color:red;'>Erro: Tabela 'usuarios' não encontrada!</h2>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>Erro ao conectar ao banco:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Banco de Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        a {
            color: #023047;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #023047;
            color: white;
            border-radius: 5px;
        }
        a:hover {
            background: #fca311;
        }
    </style>
</head>
<body>
    <a href="index.php">← Voltar para Home</a>
</body>
</html>
