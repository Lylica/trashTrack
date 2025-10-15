
/*
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS trashtrack CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE trashtrack;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','user') DEFAULT 'user',
    avatar VARCHAR(255) DEFAULT 'avatar1.png'
) ENGINE=InnoDB;

-- Inserir usuário administrador padrão
INSERT INTO usuarios (nome, usuario, email, senha, tipo, avatar) 
VALUES ('Administrador', 'admin', 'admin@trashtrack.com', MD5('admin123'), 'admin', 'avatar1.png')
ON DUPLICATE KEY UPDATE usuario=usuario;

-- Tabela do fórum
CREATE TABLE IF NOT EXISTS forum (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT NOT NULL,
    autor VARCHAR(50) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (autor) REFERENCES usuarios(usuario) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO forum (titulo, conteudo, autor) 
VALUES
('Primeiro Post', 'Bem-vindo ao fórum!', 'admin'),
('Dicas de Descarte', 'Separe o lixo corretamente!', 'admin');

-- Tabela lixeiras
CREATE TABLE lixeiras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    nivel INT DEFAULT 0,
    status ENUM('vazia', 'meia', 'cheia') DEFAULT 'vazia'
);
