<?php
session_start();
require_once 'CRUD/crud.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$mostrar_instalacao = false;
$cep_digitado = '';
$valor_total = 0;
$quantidade_total = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cep'])) {
    $cep_digitado = preg_replace('/[^0-9]/', '', $_POST['cep']);

    if (strlen($cep_digitado) > 0) {
        $primeiro_digito = substr($cep_digitado, 0, 1);

        if ($primeiro_digito === '0' || $primeiro_digito === '1') {
            $mostrar_instalacao = true;
        }
    }
}

$percentual_desconto = 0.20; 

foreach ($_SESSION['carrinho'] as $item) {
    $preco_item = $item['preco'];
    
    // Se o item estiver em promoção, aplica o desconto no cálculo
    if (isset($item['em_promocao']) && $item['em_promocao'] == 1) {
        $preco_item = $item['preco'] * (1 - $percentual_desconto);
    }

    $valor_total += $preco_item * $item['quantidade'];
    $quantidade_total += $item['quantidade'];
}

$valor_com_taxa = $valor_total * 1.177;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/carrinho.css">
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="icon" type="image/x-icon" href="assets/icons/Icon_logo.ico">
</head>
<body>
    <?php
        include 'partials/header.php';
    ?>
    <div class="conteiner">
        <main class="carrinho-principal">
            <div class="caixa-carrinho">
                <div class="cabecalho-carrinho">
                    Carrinho
                </div>
                
                <table class="tabela-carrinho">
                    <tbody>
                        <?php if (empty($_SESSION['carrinho'])): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: #999;">
                                Seu carrinho está vazio
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($_SESSION['carrinho'] as $produto_id => $item): ?>
                        <tr>
                            <td class="col-produto">
                                <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                                <h2 class="titulo-item"><?php echo htmlspecialchars($item['nome']); ?></h2>
                            </td>
                            <td class="col-quantidade">
                                <form action="CRUD/controle_carrinho.php" method="POST" style="display: flex; gap: 5px;">
                                    <input type="hidden" name="acao" value="atualizar">
                                    <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
                                    <input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" min="1" class="entrada-quantidade" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="col-preco">
                                <?php 
                                $preco_final_item = $item['preco'];
                                
                                if (isset($item['em_promocao']) && $item['em_promocao'] == 1): 
                                    $preco_final_item = $item['preco'] * (1 - $percentual_desconto);
                                ?>
                                    <span class="preco-antigo" style="text-decoration: line-through; color: #888; font-size: 13px; display: block; margin-bottom: 2px;">
                                        R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <span class="preco-atual">R$ <?php echo number_format($preco_final_item * $item['quantidade'], 2, ',', '.'); ?></span>
                            </td>
                            <td class="col-remover">
                                <a href="CRUD/controle_carrinho.php?acao=remover&produto_id=<?php echo $produto_id; ?>" onclick="return confirm('Tem certeza que deseja remover este item?');">
                                    <button type="button" class="botao-remover" title="Remover item">✕</button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="acoes-carrinho">
                <?php if (!empty($_SESSION['carrinho'])): ?>
                <a href="CRUD/controle_carrinho.php?acao=limpar" onclick="return confirm('Tem certeza que deseja limpar o carrinho?');">
                    <button type="button" class="botao-limpar-carrinho">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        Limpar carrinho
                    </button>
                </a>
                <?php endif; ?>
            </div>
        </main>

        <div class="coluna-lateral">
            
            <form method="POST" action="CRUD/verificar_pagamento.php">
            <section class="lateral-resumo">
                <div class="cabecalho-resumo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    Resumo do pedido
                </div>
                
                <div class="conteudo-resumo">
                    <div class="linha-resumo">
                        <span>Valor dos Produtos</span>
                        <span>R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="linha-resumo">
                        <span>Frete</span>
                        <span>R$ 0,00</span>
                    </div>
                </div>

                <label class="caixa-pagamento">
                    <input type="radio" name="metodo_pagamento" value="parcelado" checked>
                    <div class="icone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div class="detalhes-pagamento">
                        <strong>R$ <?php echo number_format($valor_com_taxa, 2, ',', '.'); ?></strong>
                        <select name="quantidade_parcelas" class="select-parcelas" onclick="event.stopPropagation();">
                            <?php
                            $max_parcelas = 12;

                            for ($i = 1; $i <= $max_parcelas; $i++) {
                                $valor_parcela = $valor_com_taxa / $i;
                                $valor_formatado = number_format($valor_parcela, 2, ',', '.');
                                $selected = ($i == 12) ? 'selected' : '';

                                echo "<option value=\"$i\" $selected>{$i}x de R$ {$valor_formatado} s/ juros</option>";
                            }
                            ?>
                        </select>
                    </div>
                </label>

                <label class="caixa-pagamento">
                    <input type="radio" name="metodo_pagamento" value="debito_pix">
                    <div class="icone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>
                    </div>
                    <div class="detalhes-pagamento">
                        <strong>R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></strong>
                        <span>com desconto à vista no boleto ou pix</span>
                    </div>
                </label>
                <button type="submit" class="botao-continuar">CONTINUAR</button>
                </form>
            </section>

            <div class="card-cep">
                <p>Adicionar o CEP: </p>
                <form method="POST">
                    <div class="caixa-cep">
                        <input type="text" name="cep" class="cep" value="<?php echo htmlspecialchars($cep_digitado); ?>" placeholder="00000-000" required>
                        <button type="submit" class="btn-calcular">calcular</button>
                    </div>
                </form>
            </div>

            <?php if ($mostrar_instalacao): ?>
                <div class="card-instalacao">
                    <label class="caixa-instalacao">
                        <input type="checkbox" name="adicionar_instalacao" value="sim">
                        <div class="icone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                        </div>
                        <div class="detalhes-instalacao">
                            <strong>Contratar Instalação Profissional</strong>
                            <span>Adicione o serviço por um valor fixo</span>
                        </div>
                    </label>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
        include 'partials/footer.php';
    ?>
</body>
</html>