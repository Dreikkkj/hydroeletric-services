DROP DATABASE IF EXISTS db_hydro;
CREATE DATABASE db_hydro;
USE db_hydro;

CREATE TABLE categoria(
    id_categorias INT AUTO_INCREMENT PRIMARY KEY,
    nome_categorias VARCHAR(100) NOT NULL
);

CREATE TABLE produtos(
    id_produtos INT AUTO_INCREMENT PRIMARY KEY,
    nome_produtos VARCHAR(100) NOT NULL,
    sku VARCHAR(100) NOT NULL,
    categoria_id_produtos INT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT,
    descricao TEXT,
    capa VARCHAR(500),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id_produtos)
    REFERENCES categoria(id_categorias)
);

INSERT INTO categoria(nome_categorias)
VALUES
('Fios'),
('Cabos'),
('Disjuntores'),
('Tubulações'),
('Conexão Hidráulica'),
('Caixas d''água');

SELECT * FROM categoria;

INSERT INTO produtos(nome_produtos, sku, categoria_id_produtos, preco, estoque, descricao, capa) VALUES
('Cabo flexível 2,5mm²', 'CFL-025-001', 2, 4.50, 850, 'Cabo elétrico flexível de 2,5mm², ideal para circuitos de tomadas de uso geral, iluminação residencial e comercial. Possui isolamento antichama.', 'https://static.casadoeletricistasc.com.br/public/casadoeletricista/imagens/produtos/cabo-flexivel-750v-2-5mm2-antichama-azul-cobrecom-rolo-100m-661050e6956ef.png'),
('Cabo flexível 4mm²', 'CFL-040-001', 2, 6.80, 620, 'Cabo elétrico flexível de 4mm², indicado para circuitos que exigem maior capacidade de corrente, como chuveiros de média potência e micro-ondas.', 'https://static.casadoeletricistasc.com.br/public/casadoeletricista/imagens/produtos/cabo-flexivel-750v-4mm2-antichama-azul-corfio-metro-65cf5aa13064d.png'),
('Cabo flexivel 6mm²', 'CFL-060-001', 2, 9.90, 480, 'Cabo elétrico flexível de 6mm², perfeito para conexões de aparelhos de alta potência, como sistemas de ar-condicionado central e chuveiros elétricos grandes.', 'https://cdn.dooca.store/3118/products/uiz8aqfds61tscwpwz03quom9ptihydxsb4c_640x640+fill_ffffff.jpg?v=1640290377&webp=0'),
('Caixa d’agua 1000L', 'CXA-1000-001', 6, 329.90, 30, 'Caixa d''água de polietileno com capacidade de 1000 litros. Alta durabilidade, proteção UV e tampa com travamento seguro para manter a água limpa.', 'https://images.tcdn.com.br/img/img_prod/614225/caixa_d_agua_com_tampa_aberta_1000_litros_fortlev_66259_1_4ea5f1a61b1c3cadbaeaaed3011e3f4b_20250212094623.jpg'),
('Caixa d’agua 2000L', 'CXA-2000-001', 6, 549.90, 18, 'Caixa d''água de grande porte com capacidade de 2000 litros. Ideal para residências maiores ou comércios. Material resistente e vedação perfeita.', 'https://www.333obra.com.br/media/catalog/product/9/6/96e94d9870_xnxz5sfjmpm8hikx.jpg?optimize=high&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700'),
('Curva 90 eletroduto 3/4', 'ELT-CRV-034', 5, 6.19, 200, 'Curva de 90 graus para eletroduto rígido de 3/4 polegadas. Fabricada em PVC antichama, essencial para a mudança de direção segura de fios e cabos.', 'https://cdn.awsli.com.br/2500x2500/2541/2541980/produto/263689513/design-sem-nome---2024-04-15t165550-643-so3eitge07.png'),
('Disjuntor bipolar 20A', 'DJB-020-001', 3, 36.90, 120, 'Disjuntor termomagnético bipolar de 20A curva C. Garante a proteção de circuitos bifásicos contra sobrecargas elétricas e curtos-circuitos.', 'https://images.tcdn.com.br/img/img_prod/793097/disjuntor_bipolar_20a_curva_c_sdd62c20_steck_1962007783_1_490169bf5965b6b9c5e944421fb94f3c.jpg'),
('Disjuntor tripolar 50A', 'DJT-050-001', 3, 69.90, 150, 'Disjuntor termomagnético tripolar de 50A. Projetado para redes trifásicas, ideal para proteção de motores e circuitos comerciais de alta demanda.', 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRh5ReF2MjHMQYUsELueNCRWUJk4GL2Dp0xEKStZLi_A9VamAHIfLxfD1o3hbKATXuim0H8XaV-VcatxU-kB7rDLVpbIlZw-hQ5JA_1Tc52xBZhtkIEeHQshPUE60GLl_SIbk4GBzI&usqp=CAc'),
('Eletroduto PVC 3/4 - 3m', 'ELT-034-001', 4, 21.90, 200, 'Eletroduto rígido de PVC de 3/4 polegadas com barra de 3 metros. Proteção mecânica isolante para fiações elétricas embutidas ou aparentes.', 'https://www.lojaeletrica.com.br/media/catalog/product/2/4/2490904150037_eletroduto_pvc_3_4__sold_vel_branco_3_metros_kript.jpg?optimize=high&bg-color=255,255,255&fit=bounds&height=642&width=643&canvas=643:642'),
('Fio cabo pp 3x1,5mm²', 'CPP-315-001', 1, 35.15, 150, 'Cabo PP com 3 vias interna de 1,5mm². Altamente flexível e com dupla isolação, recomendado para extensões, ferramentas elétricas e eletrodomésticos.', 'https://cdn.awsli.com.br/2500x2500/2059/2059267/produto/347714445/bcd00f3d36e83157c2babc2edd68497f-4ksu9sss4y.jpg'),
('Fio cabo PP 3x2,5mm', 'CPP-325-001', 1, 39.69, 174, 'Cabo PP industrial com 3 vias de 2,5mm². Excelente resistência mecânica e flexibilidade, ideal para extensões pesadas e equipamentos móveis.', 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRsk-HMRZrlIztKhcLXRKTk1mLq4qYR_fkt45ieqQLyhufxOX8KAZlQfHay1jdX4WmfTkb4Lf5gc7UqGP4qCxsCQKDgDORX7pL38OUx7KobK_Fu8XMxfg6D2XuvqfAeJXOXlZQVoyYBvLg&usqp=CAc'),
('Joelho 90º PVC 25mm', 'HID-JLH-025', 5, 11.32, 500, 'Joelho de 90 graus em PVC soldável marrom de 25mm. Utilizado para fazer desvios de ângulo reto em linhas residenciais de água fria.', 'https://cdn.awsli.com.br/600x450/941/941759/produto/35299461eecbd83e21.jpg'),
('Registro de esfera 25mm', 'HID-REG-025', 5, 17.44, 450, 'Registro de esfera compacto em PVC soldável de 25mm. Essencial para o microbloqueio ou liberação rápida do fluxo de água em encanamentos de água fria.', 'https://images.tcdn.com.br/img/img_prod/624414/registro_esfera_pvc_soldavel_compacto_de_25mm_112_1_20180602120256.jpg'),
('Te PVC 25mm', 'HID-TEE-025', 5, 1.52, 340, 'Conexão Tê de 90 graus em PVC marrom soldável de 25mm. Permite criar uma ramificação ou derivação limpa na rede de água do projeto.', 'https://cdn.awsli.com.br/800x800/1078/1078966/produto/43548503/22200208_te_sold_vel_iso_1-n5yzizmaka.jpg'),
('Tubo PVC 25mm - 2/3 m', 'HID-TUB-025', 4, 12.90, 370, 'Tubo de PVC rígido marrom soldável de 25mm para condução segura de água fria. Suporta a pressão interna de instalações hidráulicas prediais.', 'https://lojasolar.vtexassets.com/arquivos/ids/263317-800-auto?v=638962574588970000&width=800&height=auto&aspect=true');

CREATE TABLE carrinho (
    id_carrinho INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    FOREIGN KEY (produto_id) REFERENCES produtos(id_produtos) ON DELETE CASCADE
);

CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    tipo_movimentacoes ENUM('Entrada', 'Saída') NOT NULL,
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
    tipo ENUM('Admin', 'Estoque', 'Vendas') NOT NULL,
    ultimo_acesso DATE,
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo'
);

INSERT INTO categoria (id_categorias, nome_categorias, quantidade) VALUES
(1, 'Fios', 850),        
(2, 'Disjuntores', 120),  
(3, 'Tubulações', 250),   
(4, 'Conexões', 0),
(5, 'Caixas', 93);        


INSERT INTO movimentacoes (produto_id, tipo_movimentacoes, quantidade, estoque_anterior, estoque_atual, motivo, data_hora) VALUES
(4, 'Entrada', 200, 650, 850, 'Reposição fornecedor', '2026-05-10 11:30:00'),
(4, 'Saída', 50, 900, 850, 'Venda cliente #4521', '2026-05-09 07:15:00'),
(5, 'Entrada', 30, 90, 120, 'Novo lote Siemens', '2026-05-08 13:00:00'),
(6, 'Saída', 40, 290, 250, 'Pedido construtora Martins', '2026-05-07 06:30:00'),
(3, 'Saída', 5, 50, 45, 'Venda final de semana', '2026-05-06 08:00:00');

INSERT INTO configuracoes_loja (id, nome_empresa, cnpj, telefone, email_comercial, endereco, cidade, estado, cep, horario_funcionamento)
VALUES (1, 'Grupo 3 — Material Elétrico e Hidráulico', '12.345.678/0001-99', '(11) 98765-4321', 'hydroeletric@gmail.com', 'Rua das Indústrias, 450', 'São Paulo', 'SP', '01310-100', 'Seg-Sex: 08h-18h | Sáb: 08h-13h');

INSERT INTO configuracoes_sistema (id, alerta_estoque, alerta_venda, relatorio_diario, dois_fatores)
VALUES (1, 1, 1, 0, 1);

INSERT INTO usuarios (nome, email, senha, tipo, ultimo_acesso, status) VALUES
('Administrador', 'admin@grupo3.com.br', '123', 'Admin', '2026-05-14', 'Ativo'),
('Carlos Ferreira', 'carlos@grupo3.com.br', '123456', 'Estoque', '2026-05-13', 'Ativo'),
('Ana Souza', 'ana@grupo3.com.br', '123456', 'Vendas', '2026-05-12', 'Ativo'),
('Pedro Lima', 'pedro@grupo3.com.br', '123456', 'Vendas', '2026-05-01', 'Inativo');

ALTER TABLE produtos ADD COLUMN em_promocao TINYINT(1) DEFAULT 0 AFTER capa;

UPDATE produtos SET em_promocao = 1 WHERE id_produtos IN (1,2,3,4,5,6,7,8);
