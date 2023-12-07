-- Base de datos: `usuarios_bd`
CREATE DATABASE usuarios_bd;

USE usuarios_bd;
-- Tabla para usuarios
CREATE TABLE `usuarios` (
                            `id` INT(11) NOT NULL AUTO_INCREMENT,
                            `usuario` VARCHAR(50) NOT NULL,
                            `contrasena` VARCHAR(255) NOT NULL,
                            `correo` VARCHAR(100) NOT NULL,
                            `rol` ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos de ejemplo para usuarios y administradores
INSERT INTO `usuarios` (`usuario`, `contrasena`, `correo`, `rol`)
VALUES ('user1', 'password1', 'user1@email.com', 'usuario'),
       ('user2', 'password2', 'user2@email.com', 'usuario'),
       ('admin1', 'adminpass1', 'admin1@gmail.com', 'admin');

