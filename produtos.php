<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="./CSS/produtos.css">
</head>
<body>
    <header>
        <nav>
            <div>
               <img src="assets/icons/Logo2.png" alt="Logo"> 
            </div>   
            
            <div class="search-header">
                <input type="text" placeholder="Pesquisar...">
                <i class="bi bi-search"></i>
            </div>
            
            <ul>
                <li class="header-itens"><a href="#">Home</a></li>
                <li class="header-itens"><a href="#">Produtos</a></li>
                <li class="header-itens"><a href="#">Contato</a></li>
                <li class="header-cart">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                        </svg>
                    </a>
                </li>
                <li class="btn-promocao"><a href="#">Catálogo</a></li>
                <li class="btn-entrar"><a href="#">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <main class="container-streaming">
        <section class="categoria">
            <h2 class="titulo-categoria">Veja nossos produtos:</h2>
            
            <div class="layout-principal">
                
                <aside class="caixa-filtros">
                    <h3 class="titulo-filtros">Filtrar por:</h3>
                    
                    <details open>
                        <summary>Categoria</summary>
                        <div class="conteudo-filtro">
                            <label><input type="checkbox" checked> Cabos</label>
                            <label><input type="checkbox"> Ferramentas</label>
                            <label><input type="checkbox"> Iluminação</label>
                        </div>
                    </details>

                    <details>
                        <summary>Disponibilidade</summary>
                        <div class="conteudo-filtro">
                            <label><input type="radio" name="disponibilidade" checked> Em estoque</label>
                            <label><input type="radio" name="disponibilidade"> Esgotado</label>
                        </div>
                    </details>

                    <details>
                        <summary>Faixa de Preço</summary>
                        <div class="conteudo-filtro">
                            <label><input type="checkbox"> Até R$ 50,00</label>
                            <label><input type="checkbox"> R$ 50 a R$ 150</label>
                            <label><input type="checkbox"> Acima de R$ 150</label>
                        </div>
                    </details>
                </aside>

                <div class="grid-produtos">
                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                    
                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>

                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>

                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>

                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>

                    <div class="card">
                        <p class="estado-produto">Em estoque</p>
                        <img src="https://eletrorastro.fbitsstatic.net/img/p/fio-rigido-6-00mm-750v-vermelho-rolo-com-25-metros-corfio-93852/284540.jpg?w=800&h=800&v=202604131433" alt="produto" class="imagem-produto">
                        <p class="categoria-produto">Cabo</p>
                        <h3 class="nome-produto">Fio Rígido 6.00mm 750V Vermelho - Corfio</h3>
                        <p class="codigo-produto">Código: 93852</p>
                        <p class="texto-produto">Preço</p>
                        <div class="linha-card">
                            <p class="preco-produto">R$ 150,00</p>
                            <p class="quantidade-produto">600 disp.</p>
                        </div>
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="barraFooter">
            <div class="parteFooter">
                <div class="TituloFooter">
                    <img src="assets/icons/Icon_logo.png" alt="Logo da empresa">
                    <h3>HydroEletric</h3>
                </div>
                <a href="#">Sobre nós</a>
                <p>Colocar o sobre a empresa, em resumo.</p>
                <a href="./website/paginas/cadastro/termos.html">Termos e condições</a>
            </div>

            <div class="linhaFooter"></div>

            <div class="parteFooter">
                <h3>Links</h3>
                <ul style="list-style: none;">
                    <li><a href="#">home</a></li>
                    <li><a href="#">Produtos</a></li>
                    <li><a href="#">Contato</a></li>
                    <li><a href="#">catálogo</a></li>
                </ul>
            </div>

            <div class="linhaFooter"></div>

            <div class="parteFooter">
                <h3>Contato</h3>
                <ul style="list-style: none;">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                        Rua Exemplo, 123 - São Paulo, SP
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                        </svg>
                        contato@HydroEletric.com.br
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>
                        (11) 93056-9806
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Seg-Sex, das 9h às 18h <br> Sab: 9h às 13h
                    </li>
                </ul>
            </div>

            <div class="linhaFooter"></div>
            
            <div class="parteFooter">
                <h3>Redes Sociais</h3>
                <ul style="list-style: none;">
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>

        <div class="DireitosReservados">
            <p>Copyright © 2026 HydroEletric. Todos os direitos reservados.</p>
        </div>
    </footer> 
</body>
</html>