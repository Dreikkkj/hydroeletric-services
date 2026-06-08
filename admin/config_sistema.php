<?php
include 'conexao.php';

$status_msg = "";
$status_tipo = "";

// CADASTRAR CATEGORIA
if (isset($_POST['bt_cadastrar_categoria'])) {
    $nome_cat = mysqli_real_escape_string($conn, $_POST['nome_categoria']);
    if (!empty($nome_cat)) {
        $sql = "INSERT INTO categoria (nome_categorias) VALUES ('$nome_cat')";
        if (mysqli_query($conn, $sql)) {
            header("Location: config_sistema.php?status=sucesso_cad");
            exit();
        }
    }
}

// EXCLUIR CATEGORIA
if (isset($_GET['excluir_categoria'])) {
    $id_excluir = (int)$_GET['excluir_categoria'];
    $sql = "DELETE FROM categoria WHERE id_categorias = $id_excluir";
    if (mysqli_query($conn, $sql)) {
        header("Location: config_sistema.php?status=sucesso_del");
    } else {
        header("Location: config_sistema.php?status=erro_del");
    }
    exit();
}

// Mensagens de Feedback
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso_cad') {
        $status_msg = "Categoria cadastrada com sucesso!";
        $status_tipo = "sucesso";
    } elseif ($_GET['status'] == 'sucesso_del') {
        $status_msg = "Categoria removida com sucesso!";
        $status_tipo = "sucesso";
    } elseif ($_GET['status'] == 'erro_del') {
        $status_msg = "Erro: Existem produtos usando essa categoria!";
        $status_tipo = "erro";
    }
}

$sql_categorias = mysqli_query($conn, "SELECT * FROM categoria ORDER BY nome_categorias ASC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Configurações - Sistema</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/dashboard.css"> 
    <link rel="stylesheet" href="../CSS/config-style.css"> 
</head>
<body>

<div class="config-wrapper">
    <div class="config-header">
        <h1 style="font-size: 32px; font-weight: 700; color: #0f172a;">Configurações</h1>
        <p style="color: #64748b; font-size: 14px;">Gerencie as preferências do sistema</p>
    </div>

    <div class="config-container-layout">
        <?php include 'menu_configuracoes.php'; ?>

        <div class="conteudo-abas">
            <h3 style="font-size: 20px; color: #1e293b; margin-bottom: 5px;">Gerenciar Categorias</h3>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 25px;">Adicione ou remova as divisões de produtos do banco.</p>

            <?php if (!empty($status_msg)): ?>
                <div class="alerta-config alerta-<?php echo $status_tipo; ?>">
                    <?php echo $status_msg; ?>
                </div>
            <?php endif; ?>

            <form action="config_sistema.php" method="POST" style="display: flex; gap: 12px; margin-bottom: 30px;">
                <input type="text" name="nome_categoria" placeholder="Nome da nova categoria" required
                       style="flex: 1; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                <button type="submit" name="bt_cadastrar_categoria" 
                        style="background: #f59e0b; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer;">
                    Adicionar
                </button>
            </form>

            <table class="tabela-categorias">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nome da Categoria</th>
                        <th style="text-align: right; width: 100px;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($cat = mysqli_fetch_assoc($sql_categorias)): ?>
                        <tr>
                            <td style="color: #94a3b8;">#<?php echo $cat['id_categorias']; ?></td>
                            <td style="font-weight: 500; color: #334155;"><?php echo $cat['nome_categorias']; ?></td>
                            <td style="text-align: right;">
                                <a href="config_sistema.php?excluir_categoria=<?php echo $cat['id_categorias']; ?>" 
                                   class="btn-excluir-cat"
                                   onclick="return confirm('Deseja excluir?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>