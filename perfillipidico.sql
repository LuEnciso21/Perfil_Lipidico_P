-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2024 a las 19:26:20
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
-- Base de datos: `perfillipidico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lipidico`
--

CREATE TABLE `lipidico` (
  `Documento identidad` varchar(10) NOT NULL,
  `CHOLT` float NOT NULL,
  `HDL` float NOT NULL,
  `LDL` float NOT NULL,
  `TRIG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lipidico`
--

INSERT INTO `lipidico` (`Documento identidad`, `CHOLT`, `HDL`, `LDL`, `TRIG`) VALUES
('1012345678', 210, 50, 120, 160),
('1012345679', 190, 60, 100, 140);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Consecutivo` int(11) NOT NULL,
  `Documento identidad` varchar(10) NOT NULL,
  `Nombres` text NOT NULL,
  `Apellidos` text NOT NULL,
  `Edad` int(11) NOT NULL,
  `Genero` text NOT NULL,
  `EPS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Consecutivo`, `Documento identidad`, `Nombres`, `Apellidos`, `Edad`, `Genero`, `EPS`) VALUES
(1, '1012345678', 'CARLOS ', 'RAMIREZ TORRES', 45, 'MASCULINO', 'SANITAS'),
(2, '1012345679', 'LAURA', 'GOMEZ SANCHEZ', 30, 'FEMENINO', 'NUEVA EPS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lipidico`
--
ALTER TABLE `lipidico`
  ADD PRIMARY KEY (`Documento identidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Consecutivo`),
  ADD UNIQUE KEY `Documento` (`Documento identidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
