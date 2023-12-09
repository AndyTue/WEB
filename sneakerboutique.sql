-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2023 a las 02:54:49
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
-- Base de datos: `sneakerboutique`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenis_snk`
--

CREATE TABLE `tenis_snk` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Sin Categoría',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tenis_snk`
--

INSERT INTO `tenis_snk` (`id`, `name`, `details`, `category`, `price`, `image`) VALUES
(4, 'Air Force 1 High´07', 'ererererer', 'Caballero', 22.00, 'air.png'),
(5, 'Nike Space Hippie', 'lololo', 'Dama', 4848.00, 'hippie.png'),
(6, 'Nike Blazer Mid´77 Vintage', 'kokoko', 'Niño', 488448.00, 'blazer.png'),
(7, 'Nike Crater Impact', 'eoe', 'Dama', 555.00, 'crater.png'),
(8, 'Nike Dunk Low Retro', 'kllk', 'Caballero', 888.00, 'dunk.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tenis_snk`
--
ALTER TABLE `tenis_snk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tenis_snk`
--
ALTER TABLE `tenis_snk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
