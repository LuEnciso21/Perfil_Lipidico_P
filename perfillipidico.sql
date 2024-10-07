-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-10-2024 a las 07:37:37
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
('1002480112', 145, 140, 140, 140),
('1012345678', 140, 34, 180, 78),
('1012345679', 190, 60, 100, 180);

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
(1, '1012345678', 'CARLOS JULIAN', 'RAMIREZ TORRES', 45, 'Masculino', 'SURA'),
(2, '1012345679', 'LAURA', 'GOMEZ SANCHEZ', 30, 'FEMENINO', 'NUEVA EPS'),
(4, '1002480112', 'lU', 'D', 21, 'Femenino', 'Sanitas');

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
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
