<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'CRUD/crud.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydroeletric Services - Home</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/global.css">
</head>
<body>
    <?php
        include 'partials/header.php';
    ?>
    <div class="parent">
        <div class="div1">
            <span class="destaque">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8"/>
                </svg>
                Materiais e Instalação em São Paulo
            </span>
            <h1>Soluções Completas em<br><span class="texto-amarelo">Hidráulica e Elétrica Predial</span></h1>
            <p>Especialistas na venda de materiais de alta qualidade e na prestação de serviços de instalação. De fios e disjuntores a tubulações completas, atendemos residências, condomínios e construtoras em toda a região de São Paulo.</p>
            <div class="buttons">
                <a href="produtos.php">
                    <button class="btn-produtos">Ver Produtos</button>
                </a>
                <a href="contato.php">
                    <button class="btn-contato">Fale Conosco</button>
                </a>
            </div>
        </div>
        <div class="div2">
            <h2 class="texto-amarelo-sobre">500+</h2>
            <p>produtos em estoque</p>
        </div>
        <div class="div3">
            <h2 class="texto-amarelo-sobre">5</h2>
            <p>categorias</p>
        </div>
        <div class="div4">
            <h2 class="texto-amarelo-sobre">20+</h2>
            <p>anos de experiência</p>
        </div>
        <div class="div5">
            <h2 class="texto-amarelo-sobre">SP</h2>
            <p>Atendimento e Instalação</p>
        </div>
    </div>
    
    <h1 class="texto-apresentacao">↓ Bem-vindo à Hydroeletric Services ↓</h1>

    <section class="sobre-empresa" id="sobre-nos">
        <div class="container-sobre">
            <h2 class="texto-amarelo-sobre">Quem Somos</h2>
            <p>Com mais de 20 anos de tradição no mercado, a <strong>Hydroeletric Services</strong> nasceu com o propósito de oferecer soluções definitivas e seguras para obras e reformas. Nossa expertise vai muito além de fornecer os melhores fios, cabos, disjuntores, tubulações e conexões hidráulicas. Nós entendemos que uma obra bem-sucedida precisa da combinação perfeita entre materiais de ponta e uma execução técnica impecável.</p>
            <img src="https://dudaxengenharia.com.br/wp-content/uploads/2022/11/srv-06-eletrica-e-hidraulica-v2.jpg" alt="imagem sobre a empresa" class="imagem-sobre">
            <p>É por isso que, além de nossa loja completa, oferecemos <strong>serviços especializados de instalação elétrica e hidráulica predial</strong>. Contamos com uma equipe de técnicos e engenheiros altamente capacitados, prontos para atuar em projetos residenciais, comerciais e industriais em toda a capital e Grande São Paulo.</p>

            <div class="parceiros-secao">
                <h3 class="texto-amarelo-sobre">Nossos Principais Parceiros</h3>
                <div class="carrossel-parceiros">
                    <div class="carrossel-track">
                        <div class="parceiro-logo"><img src="https://melhorindustria.com.br/media/image/82/ff/09/tigre-logo-2.png" alt="tigre"></div>
                        <div class="parceiro-logo"><img src="https://www.bahri.com.br/wp-content/uploads/2024/07/Logo-Krona-horizontal_-Maio-2017-1-1.png" alt="Krona"></div>
                        <div class="parceiro-logo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGAMAvSuU_FHROsO23eObVg1WJo66bzwL-Uw&s" alt="sil"></div>
                        <div class="parceiro-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/Tramontina-Logo.svg/1280px-Tramontina-Logo.svg.png" alt="tramontina"></div>
                        <div class="parceiro-logo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjmv2sYtlXdvsh7uH2YcGJjseZnZFeVEM1zA&s" alt="Cobrecom"></div>
                        
                        <div class="parceiro-logo"><img src="https://melhorindustria.com.br/media/image/82/ff/09/tigre-logo-2.png" alt="tigre"></div>
                        <div class="parceiro-logo"><img src="https://www.bahri.com.br/wp-content/uploads/2024/07/Logo-Krona-horizontal_-Maio-2017-1-1.png" alt="Krona"></div>
                        <div class="parceiro-logo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGAMAvSuU_FHROsO23eObVg1WJo66bzwL-Uw&s" alt="sil"></div>
                        <div class="parceiro-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/Tramontina-Logo.svg/1280px-Tramontina-Logo.svg.png" alt="tramontina"></div>
                        <div class="parceiro-logo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjmv2sYtlXdvsh7uH2YcGJjseZnZFeVEM1zA&s" alt="Cobrecom"></div>
                    </div>
                </div>
            </div>

            <div class="sobre-grid-2">
                <div class="card-sobre">
                    <h3 class="texto-amarelo-sobre">Nosso Objetivo</h3>
                    <p>Ser a maior referência técnica e comercial em infraestrutura predial do estado de São Paulo. Trabalhamos para simplificar a vida de quem constrói ou reforma, integrando a venda de materiais de alto padrão com uma mão de obra rigorosa e especializada, garantindo que o seu projeto saia do papel com perfeição.</p>
                </div>
                <div class="card-sobre">
                    <h3 class="texto-amarelo-sobre">Nosso Posicionamento</h3>
                    <p>Atuamos como um <strong>parceiro estratégico</strong>. Diferente de lojas comuns ou prestadores autônomos, nós preenchemos uma lacuna crítica no mercado: a <i>responsabilidade unificada</i>. Ao unir o fornecimento do material e a execução do serviço, eliminamos o atrito entre loja e instalador, entregando tranquilidade absoluta ao cliente.</p>
                </div>
            </div>

            <h3 class="texto-amarelo-sobre mt-lg">Nossos Valores</h3>
            <div class="valores-grid">
                <div class="valor-item">
                    <strong>Segurança em 1º Lugar</strong>
                    <span>Rigor absoluto às normas técnicas (NBRs).</span>
                </div>
                <div class="valor-item">
                    <strong>Transparência</strong>
                    <span>Orçamentos claros, sem custos ocultos ou surpresas.</span>
                </div>
                <div class="valor-item">
                    <strong>Qualidade Garantida</strong>
                    <span>Trabalhamos apenas com as melhores marcas do mercado.</span>
                </div>
                <div class="valor-item">
                    <strong>Eficiência</strong>
                    <span>Cumprimento de prazos para manter sua obra no cronograma.</span>
                </div>
            </div>

            <h3 class="texto-amarelo-sobre mt-lg">Nossa Abordagem e Metodologia</h3>
            <p>Acreditamos que o planejamento é a alma de qualquer projeto bem-sucedido. Nossa metodologia se baseia em quatro pilares:</p>
            <ul class="lista-metodologia">
                <li><strong>1. Consultoria e Diagnóstico:</strong> Avaliamos a planta ou o local da obra para entender a real necessidade de carga elétrica e demanda hidráulica.</li>
                <li><strong>2. Dimensionamento Inteligente:</strong> Calculamos exatamente a quantidade de materiais necessários, evitando desperdícios e compras desnecessárias.</li>
                <li><strong>3. Execução Normativa:</strong> Nossa equipe entra em ação aplicando técnicas modernas e garantindo conformidade com a NBR 5410 (elétrica) e NBR 5626 (hidráulica).</li>
                <li><strong>4. Entrega e Testes:</strong> Nenhuma obra é entregue sem antes passar por rigorosos testes de estanqueidade e medição de tensão/corrente.</li>
            </ul>

            <h3 class="texto-amarelo-sobre mt-lg">Soluções Personalizadas que Oferecemos</h3>
            <p>Adaptamo-nos à sua necessidade. Nossas soluções incluem:</p>
            <div class="tags-solucoes">
                <span>Projetos Elétricos de Baixa Tensão</span>
                <span>Montagem de Quadros de Distribuição (QDC)</span>
                <span>Instalações de Água Fria e Quente</span>
                <span>Redes de Esgoto e Captação Pluvial</span>
                <span>Retrofit e Modernização de Redes Antigas</span>
                <span>Manutenção Preventiva e Corretiva Predial</span>
            </div>

            <div class="sobre-destaque-final">
                <h3 class="texto-amarelo-sobre">Benefícios Tangíveis por nos Escolher</h3>
                <p>Optar pela Hydroeletric Services traz impactos diretos e mensuráveis para a sua obra:</p>
                <ul class="lista-beneficios">
                    <li>✓ <strong>Redução de Custos a Longo Prazo:</strong> Materiais bem dimensionados e instalados corretamente não exigem manutenções constantes.</li>
                    <li>✓ <strong>Garantia Unificada:</strong> Se houver qualquer problema, você resolve com uma única empresa (produto + serviço).</li>
                    <li>✓ <strong>Zero Desperdício:</strong> Você compra exatamente o que o nosso instalador calculou, economizando no orçamento final.</li>
                    <li>✓ <strong>Valorização do Imóvel:</strong> Uma infraestrutura bem feita aumenta o valor de mercado e a segurança do patrimônio.</li>
                </ul>

                <h2 class="mt-lg">Por que Escolher a <span class="texto-amarelo">Hydroeletric Services?</span></h2>
                <p>Porque nós centralizamos a responsabilidade. São mais de 20 anos de experiência, um estoque com mais de 500 produtos a pronta entrega, agilidade logística na Grande São Paulo e, acima de tudo, o respeito pelo seu investimento. Deixe a parte complexa da obra com quem realmente entende do assunto.</p>
        </div>
    </section>
    <?php
        include 'partials/footer.php';
    ?>
</body>
</html>
