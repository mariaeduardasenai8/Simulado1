
CREATE DATABASE IF NOT EXISTS controle_estoque_construcao;
USE controle_estoque_construcao;


CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    perfil VARCHAR(20) NOT NULL
);


CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria VARCHAR(50) NOT NULL, 
    unidade_medida VARCHAR(10) NOT NULL, -- kg, m2, un, m3
    estoque_minimo INT DEFAULT 0,
    cor VARCHAR(30),
    textura VARCHAR(30),
    peso DECIMAL(10,2)
);


CREATE TABLE lotes_validade (
    id_lote INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    quantidade_atual INT NOT NULL,
    data_validade DATE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto) ON DELETE CASCADE
);


CREATE TABLE movimentacoes (
    id_movimentacao INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    id_usuario INT,
    tipo ENUM('ENTRADA', 'SAÍDA') NOT NULL,
    quantidade INT NOT NULL,
    data_operacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    motivo VARCHAR(255),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);


INSERT INTO usuarios (nome, login, senha, perfil) VALUES 
('Carlos Almoxarife', 'carlos.estoque', 'senha123', 'Almoxarife'),
('Ana Gerente', 'ana.admin', 'admin123', 'Admin');

INSERT INTO produtos (nome, descricao, categoria, unidade_medida, estoque_minimo, cor, textura, peso) VALUES 
('Cimento CP II 50kg', 'Cimento para uso geral', 'Estrutura', 'kg', 20, 'Cinza', 'Pó', 50.00),
('Argamassa ACIII 20kg', 'Argamassa para porcelanato', 'Acabamento', 'kg', 15, 'Cinza', 'Pó', 20.00),
('Tinta Acrílica Fosca 18L', 'Tinta branca para paredes internas', 'Acabamento', 'unidade', 5, 'Branco', 'Líquido', 24.00);

INSERT INTO lotes_validade (id_produto, quantidade_atual, data_validade) VALUES 
(1, 50, '2026-12-15'), 
(2, 40, '2027-03-20'), 
(3, 3, '2028-01-10');   

INSERT INTO movimentacoes (id_produto, id_usuario, tipo, quantidade, motivo) VALUES 
(1, 1, 'ENTRADA', 50, 'Entrada de NF 1024 fornecedor X'),
(3, 1, 'ENTRADA', 3, 'Compra inicial lote Y');

