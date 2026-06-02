CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    tipo ENUM('Entrada', 'Saída') NOT NULL,
    quantidade INT NOT NULL,
    estoque_anterior INT NOT NULL,
    estoque_atual INT NOT NULL,
    motivo VARCHAR(255),
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id_produtos) ON DELETE CASCADE
);

CREATE TABLE configuracoes_loja (
    id INT PRIMARY KEY, 
    nome_empresa VARCHAR(150) NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email_comercial VARCHAR(100) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    horario_funcionamento VARCHAR(150) NOT NULL
);

CREATE TABLE configuracoes_sistema (
    id INT PRIMARY KEY,
    moeda VARCHAR(50) DEFAULT 'BRL — Real Brasileiro',
    idioma VARCHAR(50) DEFAULT 'Português (Brasil)',
    alerta_estoque BOOLEAN DEFAULT 1,
    alerta_venda BOOLEAN DEFAULT 1,
    relatorio_diario BOOLEAN DEFAULT 0,
    dois_fatores BOOLEAN DEFAULT 1
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('Admin', 'Estoque', 'Vendas') NOT NULL,
    ultimo_acesso DATE,
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo'
);

INSERT INTO movimentacoes (produto_id, tipo, quantidade, estoque_anterior, estoque_atual, motivo, data_hora) VALUES
(4, 'Entrada', 200, 650, 850, 'Reposição fornecedor', '2026-05-10 11:30:00'),
(4, 'Saída', 50, 900, 850, 'Venda cliente #4521', '2026-05-09 07:15:00'),
(5, 'Entrada', 30, 90, 120, 'Novo lote Siemens', '2026-05-08 13:00:00'),
(6, 'Saída', 40, 290, 250, 'Pedido construtora Martins', '2026-05-07 06:30:00'),
(3, 'Saída', 5, 50, 45, 'Venda final de semana', '2026-05-06 08:00:00');

INSERT INTO configuracoes_loja (id, nome_empresa, cnpj, telefone, email_comercial, endereco, cidade, estado, cep, horario_funcionamento)
VALUES (1, 'Grupo 3 — Material Elétrico e Hidráulico', '12.345.678/0001-99', '(11) 98765-4321', 'hydroeletric@gmail.com', 'Rua das Indústrias, 450', 'São Paulo', 'SP', '01310-100', 'Seg-Sex: 08h-18h | Sáb: 08h-13h');

INSERT INTO configuracoes_sistema (id, moeda, idioma, alerta_estoque, alerta_venda, relatorio_diario, dois_fatores)
VALUES (1, 'BRL — Real Brasileiro', 'Português (Brasil)', 1, 1, 0, 1);

INSERT INTO usuarios (nome, email, senha, perfil, ultimo_acesso, status) VALUES
('Administrador', 'admin@grupo3.com.br', '123456', 'Admin', '2026-05-14', 'Ativo'),
('Carlos Ferreira', 'carlos@grupo3.com.br', '123456', 'Estoque', '2026-05-13', 'Ativo'),
('Ana Souza', 'ana@grupo3.com.br', '123456', 'Vendas', '2026-05-12', 'Ativo'),
('Pedro Lima', 'pedro@grupo3.com.br', '123456', 'Vendas', '2026-05-01', 'Inativo');