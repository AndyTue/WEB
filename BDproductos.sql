-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 10:46:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BDproductos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenis_snk`
--

CREATE TABLE `tenis_snk` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `cantidad_existencia` int(11) NOT NULL DEFAULT 0,
  `ids` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tenis_snk`
--

INSERT INTO `tenis_snk` (`id`, `nombre`, `precio`, `imagen`, `cantidad_existencia`, `ids`) VALUES
(0, 'Air Force 1 High´07', 270.00, 'air.png', 20, 'tenis1'),
(2, 'Nike Space Hippie', 319.00, 'hippie.png', 0, 'tenis2'),
(3, 'Air Jordan 1 High', 134.00, 'jordan.png', 0, 'tenis3'),
(4, 'Nike Blazer Mid´77 Vintage', 179.00, 'blazer.png', 20, 'tenis4'),
(5, 'Nike Crater Impact', 190.00, 'crater.png', 5, 'tenis5'),
(6, 'Nike Dunk Low Retro', 134.00, 'dunk.png', 15, 'tenis6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tenis_snk`
--
ALTER TABLE `tenis_snk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tenis_snk`
--
ALTER TABLE `tenis_snk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
