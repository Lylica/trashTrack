/* 
CREATE DATABASE trashtrack;
USE trashtrack;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','user') DEFAULT 'user'
);

-- Usuário administrador padrão
INSERT INTO usuarios (nome, usuario, email, senha, tipo)
VALUES ('Administrador', 'admin', 'admin@trashtrack.com', 
        MD5('admin123'), 'admin');
 */