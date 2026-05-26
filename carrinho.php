<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="CSS/carrinho.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
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
                        <tr>
                            <td class="col-produto">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdP4Gy-14zORrHW9bJmZMBLoPFbEHPDh7DSQ&s" alt="Fio Rígido 6.00mm">
                                <h2 class="titulo-item">Fio Rígido 6.00mm 750V Vermelho - Corfio</h2>
                            </td>
                            <td class="col-quantidade">
                                <input type="number" value="1" min="1" class="entrada-quantidade">
                            </td>
                            <td class="col-preco">
                                <span class="preco-atual">R$ 499,99</span>
                            </td>
                            <td class="col-remover">
                                <button class="botao-remover" title="Remover item">✕</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="acoes-carrinho">
                <button class="botao-limpar-carrinho">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                    Limpar carrinho
                </button>
            </div>
        </main>

        <div class="coluna-lateral">
            
            <section class="lateral-resumo">
                <div class="cabecalho-resumo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    Resumo do pedido
                </div>
                
                <div class="conteudo-resumo">
                    <div class="linha-resumo">
                        <span>Valor dos Produtos</span>
                        <span>R$ 499,99</span>
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
                        <strong>R$ 588,22</strong>
                        <span>12x de R$ 49,02 s/ juros</span>
                    </div>
                </label>

                <label class="caixa-pagamento">
                    <input type="radio" name="metodo_pagamento" value="debito_pix">
                    <div class="icone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>
                    </div>
                    <div class="detalhes-pagamento">
                        <strong>R$ 499,99</strong>
                        <span>com desconto à vista no boleto ou pix</span>
                    </div>
                </label>
                <a href="confirmar-pagamento.php">
                    <button class="botao-continuar">CONTINUAR</button>
                </a>
            </section>

            <div class="card-cep">
                <p>Adicionar o cep: </p>
                <div class="caixa-cep">
                    <input type="number" class="cep">
                    <button class="btn-calcular">calcular</button>
                </div>
            </div>

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
        </div>
    </div>
    <?php
        include 'partials/footer.php';
    ?>
</body>
</html>