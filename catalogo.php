<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/catalogo.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <div>
               <img src="Images/logo2 (1).png" alt="Logo"> 
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
                <li class="btn-promocao"><a href="#">Promoções</a></li>
                <li class="btn-entrar"><a href="#">Entrar</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-promocao">
        <div class="text-promocao">
            <span>CATÁLOGO</span>
            <h1>Produtos em Destaque</h1>
            <p>Confira nossos principais materiais hidráulicos e elétricos com os melhores preços de São Paulo.</p>
        </div>
<!-- <?php echo $situacao === 'em-estoque' ? 'em-estoque' : 'fora-de-estoque'; ?> -->
        <div class="container-promocao">
            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-promocao">
                <p class="situacao em-estoque">Em Estoque</p>
                
                <div class="card-promocao-img">
                    <img src="Images/cabo-flexivel-2.5mm.jpeg" alt="Produto 1">
                </div>
                
                <div class="card-promocao-info">
                    <div class="card-promocao-info-details">
                        <span class="card-promocao-categoria">CABOS</span>
                        <h3>Kit Hidráulico Completo</h3>
                        <span class="card-promocao-descricao">CFL-025-001 - metro</span>
                    </div>
                    
                    <div class="card-promocao-linha">
                        <div class="card-promocao-preco">
                            <span class="card-promocao-descricao">Preço</span>
                            <p>R$ 4,50</p>
                        </div>
                        <span class="card-promocao-estoque">600 disp.</span>
                    </div>
                    
                    <div class="card-promocao-btn">
                        <a href="#" target="_blank">
                            <button class="btn-detalhes">Ver Detalhes</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>