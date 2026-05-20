USE db_hydro;

CREATE TABLE categoria(
    id_categorias INT AUTO_INCREMENT PRIMARY KEY,
    nome_categorias VARCHAR(100) NOT NULL,
    quantidade INT
);

CREATE TABLE produtos(
    id_produtos INT AUTO_INCREMENT PRIMARY KEY,
    nome_produtos VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT,
    descricao TEXT,
    categoria_id_produtos INT,

    FOREIGN KEY (categoria_id_produtos)
    REFERENCES categoria(id_categorias)
);

INSERT INTO categoria(nome_categorias, quantidade)
VALUES
('Fios', 280),
('Disjuntores', 70),
('Tubulações', 140),
('Conexões', 220),
('Caixas d''água', 40);

SELECT * FROM categoria;

INSERT INTO produtos
(nome_produtos, preco, estoque, descricao, categoria_id_produtos)
VALUES
(
    'Cabo Flexível 10mm',
    89.90,
    20,
    'Cabo resistente para instalações industriais',
    1
);

SELECT * FROM produtos;