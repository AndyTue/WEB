-- Conéctate a MySQL
CREATE DATABASE BDcrud;

-- Selecciona la base de datos
USE DBcrud;

-- Crea la tabla de usuarios
CREATE TABLE usuarios2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL
);

