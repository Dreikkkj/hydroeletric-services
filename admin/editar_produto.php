<?php
require_once __DIR__ . '/../CRUD/crud.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../assets/css/edicao.css">
</head>

<body>
    <div class="containerFORM">
        <h1>Editar Produto</h1>
        <!-- Formulário de edição do produto -->
        <form action="salvar_edicao.php" method="POST">
            <input type="hidden" name="id_produtos">
            <!-- Outros campos do formulário -->
            <label for="nome_produtos">Nome do Produto *</label>
            <input type="text" id="nome_produtos" name="nome_produtos" placeholder="Cabo Flexível 2.5mm²" required>

            <label for="SKU">SKU *</label>
            <input type="text" id="SKU" name="SKU" placeholder="CFL-025-001" required>

            <label for="categoria">Categoria *</label>
            <select id="categoria" name="categoria_id_produtos" required>
                <option value="" disabled selected hidden>Selecione uma categoria</option>
                <!-- Opções de categoria para ser selecionado-->
                <option value="1">Fios</option>
                <option value="2">Conectores</option>
                <option value="3">Disjuntores</option>
                <option value="4">Tubulações</option>
                <option value="5">Conexão Hidráulica</option>
                <option value="6">Caixas d'água</option>
            </select>
            <!--Outras opções-->
            <label for="preco">Preço (R$) *</label>
            <input type="number" id="preco" name="preco" placeholder="0.00" step="0.01" required>

            <label for="estoque">Estoque Inicial *</label>
            <input type="number" id="estoque" name="estoque" placeholder="0" min="0" required>

            <select id="unidade" name="unidade" required>
                <option value="" disabled selected hidden>Selecione a unidade de medida</option>
                <option value="metros">Metros</option>
                <option value="peças">Barra</option>
                <option value="litros">Litros</option>
                <option value="quilos">Quilograma</option>
            </select>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao"
                placeholder="em PVC. Ideal para instalações elétricas residenciais e comerciais"></textarea>

            <button type="cancel" class="btn-cancelar">Cancelar</button>
            <button type="submit" class="btn-salvar">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>