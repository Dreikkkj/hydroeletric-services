<?php
require_once 'db.php';
include 'header_adm.html';

$tab_ativa = $_GET['tab'] ?? 'loja';
$mensagem = "";

/* =========================================
   LÓGICA DOS USUÁRIOS (CADASTRAR / EDITAR / EXCLUIR)
   ========================================= */

// 1. Excluir Usuário (via GET)
if (isset($_GET['excluir_usuario'])) {
    $id_excluir = (int)$_GET['excluir_usuario'];
    
    // Evita que o usuário logado se auto-exclua (opcional, mas seguro)
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $id_excluir]);
    
    header("Location: ?tab=usuarios&msg=sucesso_del");
    exit();
}

// Mensagens vindas de redirecionamento GET
if (isset($_GET['msg']) && $_GET['msg'] === 'sucesso_del') {
    $mensagem = "Usuário removido com sucesso!";
}

// 2. Salvar ou Atualizar Usuário (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_usuario'])) {
    $id_usuario = $_POST['id_usuario'] ?? '';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $status = $_POST['status'];
    $senha = $_POST['senha'];

    if (!empty($id_usuario)) {
        // Ação: EDITAR
        if (!empty($senha)) {
            // Se preencheu o campo senha, altera ela também
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo, status = :status WHERE id = :id";
            $params = [':nome' => $nome, ':email' => $email, ':senha' => $senha, ':tipo' => $tipo, ':status' => $status, ':id' => $id_usuario];
        } else {
            // Se deixou a senha em branco, mantém a senha atual
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo, status = :status WHERE id = :id";
            $params = [':nome' => $nome, ':email' => $email, ':tipo' => $tipo, ':status' => $status, ':id' => $id_usuario];
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $mensagem = "Usuário atualizado com sucesso!";
    } else {
        // Ação: NOVO CADASTRO
        $senha_padrao = !empty($senha) ? $senha : '123456';
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo, status) VALUES (:nome, :email, :senha, :tipo, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha_padrao, ':tipo' => $tipo, ':status' => $status]);
        $mensagem = "Novo usuário cadastrado com sucesso!";
    }
}

/* =========================================
   SALVAR DADOS DA LOJA E SISTEMA
   ========================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['salvar_loja'])) {
        $sql = "UPDATE configuracoes_loja SET
            nome_empresa = :nome_empresa,
            cnpj = :cnpj,
            telefone = :telefone,
            email_comercial = :email_comercial,
            endereco = :endereco,
            cidade = :cidade,
            estado = :estado,
            cep = :cep,
            horario_funcionamento = :horario_funcionamento
            WHERE id = 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome_empresa' => $_POST['nome_empresa'],
            ':cnpj' => $_POST['cnpj'],
            ':telefone' => $_POST['telefone'],
            ':email_comercial' => $_POST['email_comercial'],
            ':endereco' => $_POST['endereco'],
            ':cidade' => $_POST['cidade'],
            ':estado' => $_POST['estado'],
            ':cep' => $_POST['cep'],
            ':horario_funcionamento' => $_POST['horario_funcionamento'] ?? ''
        ]);

        $mensagem = "Dados da loja atualizados com sucesso!";
    }

    if (isset($_POST['salvar_sistema'])) {
        $stmt = $pdo->prepare("
            UPDATE configuracoes_sistema SET
            alerta_estoque = :alerta_estoque,
            alerta_venda = :alerta_venda,
            relatorio_diario = :relatorio_diario,
            dois_fatores = :dois_fatores
            WHERE id = 1
        ");
        $stmt->execute([
            ':alerta_estoque' => isset($_POST['alerta_estoque']) ? 1 : 0,
            ':alerta_venda' => isset($_POST['alerta_venda']) ? 1 : 0,
            ':relatorio_diario' => isset($_POST['relatorio_diario']) ? 1 : 0,
            ':dois_fatores' => isset($_POST['dois_fatores']) ? 1 : 0
        ]);

        $mensagem = "Preferências salvas com sucesso!";
    }
}

/* =========================
   BUSCAR DADOS PARA EXIBIÇÃO
========================= */
$dadosLoja = $pdo->query("SELECT * FROM configuracoes_loja WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
$dadosSistema = $pdo->query("SELECT * FROM configuracoes_sistema WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
$listaUsuarios = $pdo->query("SELECT * FROM usuarios ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Se estiver editando um usuário específico, busca os dados dele
$usuario_em_edicao = null;
if (isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id_user'])) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([(int)$_GET['id_user']]);
    $usuario_em_edicao = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Configurações</title>
    <link rel="stylesheet" href="../CSS/config-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="config-container">
    <div class="config-header">
        <span class="badge-admin">
            <i class="bi bi-shield-lock-fill"></i> ÁREA EXCLUSIVA ADMIN
        </span>
        <h1>Configurações</h1>
        <p class="subtitle">Gerencie as configurações do sistema e da loja</p>
    </div>

    <?php if (!empty($mensagem)): ?>
        <div class="alert-message"><?= $mensagem ?></div>
    <?php endif; ?>

    <div class="config-layout">
        <aside class="config-sidebar">
            <ul class="sidebar-menu">
                <li><a href="?tab=loja" class="menu-item <?= $tab_ativa == 'loja' ? 'active' : '' ?>"><i class="bi bi-shop"></i> Dados da Loja</a></li>
                <li><a href="?tab=seguranca" class="menu-item <?= $tab_ativa == 'seguranca' ? 'active' : '' ?>"><i class="bi bi-shield-check"></i> Segurança</a></li>
                <li><a href="?tab=usuarios" class="menu-item <?= $tab_ativa == 'usuarios' ? 'active' : '' ?>"><i class="bi bi-people"></i> Usuários</a></li>
                <li><a href="?tab=sistema" class="menu-item <?= $tab_ativa == 'sistema' ? 'active' : '' ?>"><i class="bi bi-gear"></i> Sistema</a></li>
            </ul>
        </aside>

        <main class="config-main-panel">
            <?php if ($tab_ativa == 'loja'): ?>
                <h2>Dados da Loja</h2>
                <form method="POST" class="form-loja">
                    <div class="form-group full-width">
                        <label>Nome da Empresa</label>
                        <input type="text" name="nome_empresa" value="<?= htmlspecialchars($dadosLoja['nome_empresa'] ?? '') ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>CNPJ</label><input type="text" name="cnpj" value="<?= htmlspecialchars($dadosLoja['cnpj'] ?? '') ?>"></div>
                        <div class="form-group"><label>Telefone</label><input type="text" name="telefone" value="<?= htmlspecialchars($dadosLoja['telefone'] ?? '') ?>"></div>
                    </div>
                    <div class="form-group full-width">
                        <label>E-mail Comercial</label>
                        <input type="email" name="email_comercial" value="<?= htmlspecialchars($dadosLoja['email_comercial'] ?? '') ?>">
                    </div>
                    <div class="form-group full-width">
                        <label>Endereço</label>
                        <input type="text" name="endereco" value="<?= htmlspecialchars($dadosLoja['endereco'] ?? '') ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Cidade</label><input type="text" name="cidade" value="<?= htmlspecialchars($dadosLoja['cidade'] ?? '') ?>"></div>
                        <div class="form-group"><label>Estado</label><input type="text" name="estado" value="<?= htmlspecialchars($dadosLoja['estado'] ?? '') ?>"></div>
                    </div>
                    <div class="form-group full-width">
                        <label>CEP</label>
                        <input type="text" name="cep" value="<?= htmlspecialchars($dadosLoja['cep'] ?? '') ?>">
                    </div>
                    <div class="form-group full-width">
                        <label>Horário de Funcionamento</label>
                        <input type="text" name="horario_funcionamento" value="<?= htmlspecialchars($dadosLoja['horario_funcionamento'] ?? '') ?>">
                    </div>
                    <button type="submit" name="salvar_loja" class="btn-save">Salvar Alterações</button>
                </form>

            <?php elseif ($tab_ativa == 'seguranca'): ?>
                <h2>Segurança</h2>
                <div class="security-card">
                    <div class="form-group"><label>Senha Atual</label><input type="password"></div>
                    <div class="form-group"><label>Nova Senha</label><input type="password"></div>
                    <div class="form-group"><label>Confirmar Nova Senha</label><input type="password"></div>
                    <button class="btn-save">Atualizar Senha</button>
                </div>

            <?php elseif ($tab_ativa == 'usuarios'): ?>
                
                <?php if (isset($_GET['acao']) && ($_GET['acao'] === 'novo' || $_GET['acao'] === 'editar')): ?>
                    <div class="users-header">
                        <div>
                            <h2><?= $_GET['acao'] === 'editar' ? 'Editar Usuário' : 'Novo Usuário' ?></h2>
                            <p>Preencha as credenciais e permissões de acesso.</p>
                        </div>
                        <a href="?tab=usuarios" class="btn-save" style="background: #6b7280; text-decoration: none;">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>

                    <form method="POST" class="form-loja">
                        <input type="hidden" name="id_usuario" value="<?= $usuario_em_edicao['id'] ?? '' ?>">

                        <div class="form-row">
                            <div class="form-group">
                                <label>Nome Completo</label>
                                <input type="text" name="nome" required value="<?= htmlspecialchars($usuario_em_edicao['nome'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" required value="<?= htmlspecialchars($usuario_em_edicao['email'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Senha <?= $_GET['acao'] === 'editar' ? '<small style="color:#888;">(opcional)</small>' : '' ?></label>
                                <input type="password" name="senha" <?= $_GET['acao'] === 'novo' ? 'required' : '' ?>>
                            </div>
                            <div class="form-group">
                                <label>Tipo de Acesso</label>
                                <select name="tipo" required>
                                    <option value="Admin" <?= (isset($usuario_em_edicao['tipo']) && $usuario_em_edicao['tipo'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="Estoque" <?= (isset($usuario_em_edicao['tipo']) && $usuario_em_edicao['tipo'] == 'Estoque') ? 'selected' : '' ?>>Estoque</option>
                                    <option value="Vendas" <?= (isset($usuario_em_edicao['tipo']) && $usuario_em_edicao['tipo'] == 'Vendas') ? 'selected' : '' ?>>Vendas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status da Conta</label>
                            <select name="status" required>
                                <option value="Ativo" <?= (isset($usuario_em_edicao['status']) && $usuario_em_edicao['status'] == 'Ativo') ? 'selected' : '' ?>>Ativo</option>
                                <option value="Inativo" <?= (isset($usuario_em_edicao['status']) && $usuario_em_edicao['status'] == 'Inativo') ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>

                        <button type="submit" name="salvar_usuario" class="btn-save">
                            <i class="bi bi-check-circle"></i> Salvar Usuário
                        </button>
                    </form>

                <?php else: ?>
                    <div class="users-header">
                        <div>
                            <h2>Gerenciar Usuários</h2>
                            <p>Controle de acesso e permissões do sistema</p>
                        </div>
                        <a href="?tab=usuarios&acao=novo" class="btn-save" style="text-decoration: none;">
                            <i class="bi bi-person-plus-fill"></i> Novo Usuário
                        </a>
                    </div>

                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>USUÁRIO</th>
                                <th>E-MAIL</th>
                                <th>TIPO</th>
                                <th>STATUS</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($listaUsuarios as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['nome']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <span class="tipo-badge"><?= $user['tipo'] ?></span>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: <?= $user['status'] === 'Ativo' ? '#166534' : '#991b1b' ?>;">
                                        <?= $user['status'] ?>
                                    </span>
                                </td>
                                <td class="actions-td">
                                    <a href="?tab=usuarios&acao=editar&id_user=<?= $user['id'] ?>" title="Editar" style="color: #666; transition: .2s;"><i class="bi bi-pencil"></i></a>
                                    <a href="?tab=usuarios&excluir_usuario=<?= $user['id'] ?>" title="Excluir" style="color: #dc2626; transition: .2s;" onclick="return confirm('Tem certeza que deseja remover o usuário <?= htmlspecialchars($user['nome']) ?>?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            <?php elseif ($tab_ativa == 'sistema'): ?>
                <form method="POST">
                    <h2>Preferências do Sistema</h2>
                    <div class="system-option">
                        <div>
                            <strong>Alerta de Estoque Baixo</strong>
                            <p>Notificar quando atingir o mínimo</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="alerta_estoque" <?= $dadosSistema['alerta_estoque'] ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="system-option">
                        <div>
                            <strong>Nova Venda</strong>
                            <p>Notificar ao registrar nova venda</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="alerta_venda" <?= $dadosSistema['alerta_venda'] ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="system-option">
                        <div>
                            <strong>Relatório Diário</strong>
                            <p>Receber resumo financeiro diário</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="relatorio_diario" <?= $dadosSistema['relatorio_diario'] ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <button type="submit" name="salvar_sistema" class="btn-save">Salvar Preferências</button>
                </form>
            <?php endif; ?>
        </main>
    </div>
</div>

</body>
</html>