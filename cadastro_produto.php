<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro de produtos</title>
    <link rel="stylesheet" href="CSS/cadastro_produto.css">
    <link rel="stylesheet" href="CSS/header_adm.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

    <?php
        include 'partials/header_admin.php';
    ?>

    <main>
        <section>
            <div class="border">
                <h2>Cadastro de produtos</h2>
                <form  method="" >
                    <label for="produto">Nome do produto</label>
                    <input type="text" name="produto" required>

                    <label for="descricao">Descrição do produto</label>
                    <textarea name="descricao" required></textarea>

                    <div class="sc">
                        <div class="s">
                            <label for="sku">SKU</label>
                            <input type="text" name="sku">
                        </div>

                        <div class="c">
                            <label for="categoria" class="c">Categoria</label>
                            <select name="categoria_id_produtos" required>
                                <option disabled selected></option>
                                <option value="">fios</option>
                                <option value="">disjuntores</option>
                                <option value="">tubulaçoes</option>
                                <option value="">conexoes</option>
                                <option value="">Caixas d'água</option>
                            </select>
                        </div>
                    </div>

                    <label for="preco">Preço unitário</label>
                    <input type="number" min="1" step="0.01" name="preco" required>

                    <label for="estoque">Estoque do produto</label>
                    <input type="number" min="1" name="estoque" required>

                    <div class="file">
                        <label for="arquivo">Imagem do produto</label>

                        <label for="arquivo" class="caixa-file">
                            <p>Clique para enviar uma imagem</p>
                        </label>

                        <input type="file" id="arquivo" name="arquivo">
                    </div>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>