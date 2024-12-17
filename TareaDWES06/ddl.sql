CREATE DATABASE IF NOT EXISTS CGC_books;

USE CGC_books;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    year INT NOT NULL
);

-- Crear usuario para gestionar la base de datos
CREATE USER 'usuCGC'@'localhost' IDENTIFIED BY 'Tokio2324';

-- Otorgar permisos al usuario
GRANT ALL PRIVILEGES ON CGC_books.* TO 'usuCGC'@'localhost';

-- Aplicar cambios
FLUSH PRIVILEGES;