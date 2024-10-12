-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-10-2024 a las 06:38:23
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perfillipidico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lipidico`
--

CREATE TABLE `lipidico` (
  `Documento_identidad` varchar(10) NOT NULL,
  `CHOLT` float NOT NULL,
  `HDL` float NOT NULL,
  `LDL` float NOT NULL,
  `TRIG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lipidico`
--

INSERT INTO `lipidico` (`Documento_identidad`, `CHOLT`, `HDL`, `LDL`, `TRIG`) VALUES
('1002480112', 190, 75, 80, 100),
('1005363859', 220, 55, 145, 170),
('1012345678', 200, 50, 120, 160),
('1012345679', 190, 60, 100, 140),
('1012345680', 220, 45, 130, 170),
('1012345681', 180, 65, 110, 130),
('1012345682', 195, 55, 115, 150),
('1012345683', 205, 50, 125, 160),
('1012345684', 230, 40, 135, 180),
('1012345685', 185, 60, 105, 140),
('1012345686', 235, 38, 145, 200),
('1012345687', 215, 55, 120, 170),
('1012345688', 200, 42, 110, 180),
('1012345689', 220, 55, 145, 170),
('1052410768', 190, 60, 100, 160);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Consecutivo` int(11) NOT NULL,
  `Documento_identidad` varchar(10) NOT NULL,
  `Nombres` text NOT NULL,
  `Apellidos` text NOT NULL,
  `Edad` int(11) NOT NULL,
  `Genero` text NOT NULL,
  `EPS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Consecutivo`, `Documento_identidad`, `Nombres`, `Apellidos`, `Edad`, `Genero`, `EPS`) VALUES
(17, '1002480112', 'LUISA FERNANDA', 'ENCISO FRANCO', 22, 'Femenino', 'Sanitas'),
(18, '1012345678', 'CARLOS JULIAN', 'RAMIREZ TORRES', 45, 'Masculino', 'Sanitas'),
(19, '1012345679', 'LAURA MARIA', 'GOMEZ SANCHEZ', 30, 'Femenino', 'Nueva EPS'),
(20, '1012345680', 'JUAN', 'MARTINEZ LOPEZ', 50, 'Masculino', 'SURA'),
(21, '1012345681', 'MARIA CAMILA', 'RODRIGUEZ PEREZ', 28, 'Femenino', 'Compensar'),
(22, '1012345682', 'ANDRES', 'CATRILLON MORA', 35, 'Masculino', 'Compensar'),
(23, '1012345683', 'NATALIA', 'SUAREZ PINEDA', 40, 'Femenino', 'Sanitas'),
(24, '1012345684', 'JUAN DIEGO', 'HERNANDEZ VERA', 33, 'Masculino', 'Compensar'),
(25, '1012345685', 'JULIANA', 'VARGAS DUARTE', 29, 'Femenino', 'Nueva EPS'),
(26, '1012345686', 'SEBASTIAN CAMILO', 'MUÑOZ QUINTERO', 55, 'Masculino', 'SURA'),
(27, '1012345687', 'DANIELA', 'OSPINA CARDENAS', 48, 'Femenino', 'Sanitas'),
(28, '1012345688', 'MARIA', 'MEDINA CARO', 22, 'Femenino', 'Nueva EPS'),
(29, '1012345689', 'JUAN', 'OSPINA OSPINA', 37, 'Otro', 'Compensar'),
(32, '1052410768', 'JUAN ANDRES', 'CARDENAS MOLINA', 74, 'Masculino', 'Sanitas'),
(33, '1005363859', 'ANDREA', 'CARDENAS MOLINA', 52, 'Femenino', 'Compensar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lipidico`
--
ALTER TABLE `lipidico`
  ADD PRIMARY KEY (`Documento_identidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Consecutivo`),
  ADD UNIQUE KEY `Documento` (`Documento_identidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
