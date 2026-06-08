<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="CSS/contato.css">
    <link rel="stylesheet" href="CSS/global.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    
    <main class="main-contato">
        <div class="text-contato">
            <span>FALE COMIGO</span>
            <h1>Entre em Contato</h1>
            <p>Solicite orçamentos, tire dúvidas ou peça informações sobre nossos produtos.</p>
        </div>

        <div class="container-contato">

            <div class="info-contato">
                <p class="info-contato-title">Informações de Contato</p>
        
                <div class="dado    s-loja">
                    <div class="item-dado">
                        <span><i class="bi bi-geo-alt-fill"></i></span>
                        <p><span class="item-dado-title">Endereço:</span><br>Rua da Tecnologia, 123 - Res. Hipica Jaguari</p>
                    </div>

                    <div class="item-dado">
                        <span><i class="bi bi-telephone-fill"></i></span>
                        <p><span class="item-dado-title">Telefone:</span><br>(11) 93056-9806</p>
                    </div>

                    <div class="item-dado">
                        <span><i class="bi bi-envelope-fill"></i></span>
                        <p><span class="item-dado-title">Contato:</span><br>contato@hydroletrics.com</p>
                    </div>

                    <div class="item-dado">
                        <span><i class="bi bi-clock-fill"></i></span>
                        <p><span class="item-dado-title">Horário de Funcionamento:</span><br>Seg a Sex: 06h às 20h<br>Sáb e Dom: 07h às 18h
                        </p>
                    </div>
                    
                </div>

                <div class="mapa">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3674.7520892168877!2d-46.54837292377783!3d-22.92251313843503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ceca48b2829c27%3A0xc39c99c79af4184!2sR.%20da%20Tecnologia%2C%20123%20-%20Res.%20Hipica%20Jaguari%2C%20Bragan%C3%A7a%20Paulista%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1780424076698!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="form-contato">
                <form>
                    <div class="grupo-input">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" placeholder="Seu nome completo">
                    </div>

                    <div class="grupo-input">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" placeholder="Seu e-mail">
                    </div>

                    <div class="grupo-input">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" placeholder="Seu telefone">
                    </div>

                    <div class="grupo-input">
                        <label for="assunto">Assunto</label>
                        <select id="assunto">
                            <option value="">Selecione um assunto</option>
                            <option value="atraso">Atraso na Entrega</option>
                            <option value="defeito">Produto defeituoso</option>
                            <option value="trabalhe">Trabalhe Conosco</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="grupo-input">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" rows="5" placeholder="Como podemos ajudar?"></textarea>
                    </div>

                    <button type="submit" class="btn-enviar">Enviar Mensagem</button>
                </form>
            </div>

        </div>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>
</html>