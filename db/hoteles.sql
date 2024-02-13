-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2024 a las 15:57:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hoteles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `num_habitacion` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `id_hotel`, `num_habitacion`, `tipo`, `precio`, `descripcion`) VALUES
(1, 1, 1, 'individual', 50, 'Habitación individual con vistas a la ciudad'),
(2, 1, 2, 'doble', 75, 'Habitación doble con vistas a la montaña'),
(3, 2, 1, 'suite', 100, 'Suite con terraza y vistas al mar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `num_habitaciones` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `foto` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`id`, `nombre`, `direccion`, `ciudad`, `pais`, `num_habitaciones`, `descripcion`, `foto`) VALUES
(1, 'Hotel 1', 'Calle 1', 'Madrid', 'España', 10, 'Este es un hotel de lujo en el centro de Madrid', NULL),
(2, 'Hotel 2', 'Calle 2', 'Barcelona', 'España', 20, 'Este es un hotel con piscina en la playa de Barcelona', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_usuario`, `id_hotel`, `id_habitacion`, `fecha_entrada`, `fecha_salida`) VALUES
(1, 1, 1, 1, '2022-01-10', '2022-01-15'),
(2, 1, 2, 3, '2022-01-20', '2022-01-25'),
(3, 2, 1, 2, '2022-02-01', '2022-02-05'),
(4, 2, 1, 2, '2024-02-13', '2024-02-17'),
(12, 2, 1, 1, '2024-02-23', '2024-02-25'),
(13, 2, 1, 1, '2024-06-20', '2024-06-27'),
(14, 2, 1, 1, '2024-02-13', '2024-02-14'),
(15, 2, 1, 1, '2024-05-14', '2024-05-16'),
(16, 2, 2, 3, '2024-02-22', '2024-02-24'),
(17, 2, 1, 2, '2024-02-28', '2024-03-02'),
(18, 1, 1, 1, '2024-02-28', '2024-02-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contraseña`, `fecha_registro`, `rol`) VALUES
(1, 'juan', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '2022-01-01 00:00:00', 1),
(2, 'maria', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-01-02 00:00:00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_hotel` (`id_hotel`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
