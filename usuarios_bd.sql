-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS usuarios_bd;

USE usuarios_bd;

-- Tabla para usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `usuario` VARCHAR(50) NOT NULL,
    `contrasena` VARCHAR(255) NOT NULL,
    `correo` VARCHAR(100) NOT NULL,
    `rol` ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos de ejemplo para usuarios y administradores
INSERT INTO `usuarios` (`usuario`, `contrasena`, `correo`, `rol`)
VALUES 
    ('user1', 'password1', 'user1@email.com', 'usuario'),
    ('user2', 'password2', 'user2@email.com', 'usuario'),
    ('admin1', 'adminpass1', 'admin1@gmail.com', 'admin');

-- Ajustar los IDs después de eliminar registros
ALTER TABLE `usuarios` MODIFY COLUMN `id` INT(11) NOT NULL; -- Eliminar la restricción AUTO_INCREMENT

ALTER TABLE `usuarios` ADD COLUMN `new_id` INT(11) FIRST; -- Agregar nueva columna para almacenar temporalmente la secuencia de IDs

SET @counter = 0;
UPDATE `usuarios` SET `new_id` = @counter:=@counter + 1; -- Actualizar la nueva columna new_id con secuencia consecutiva

ALTER TABLE `usuarios` DROP COLUMN `id`; -- Eliminar la columna id

ALTER TABLE `usuarios` CHANGE COLUMN `new_id` `id` INT(11) NOT NULL AUTO_INCREMENT; -- Renombrar la columna new_id y establecerla como AUTO_INCREMENT
