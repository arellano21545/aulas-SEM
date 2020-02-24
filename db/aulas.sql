-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2020 a las 18:12:06
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aulas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones_a`
--

CREATE TABLE `reservaciones_a` (
  `id` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1500) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora_ini` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservaciones_a`
--

INSERT INTO `reservaciones_a` (`id`, `usuario`, `nombre`, `descripcion`, `year`, `mes`, `dia`, `hora_ini`, `hora_fin`) VALUES
('%gTSsYXW5zJv', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', '<zzxz<z<x<z', 2020, 2, 5, 1, 11),
('edO19sEcaUoj', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', '<zzxz<z<x<z', 2020, 2, 6, 1, 11),
('GHgnAYgKxbtm', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones nueva', 'hola', 2020, 2, 27, 1, 7),
('iZVLvVqCL3k3', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones nueva', 'hola', 2020, 2, 26, 1, 7),
('O$31pDnP$yE%', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones nueva', 'hola', 2020, 2, 28, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones_b`
--

CREATE TABLE `reservaciones_b` (
  `id` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1500) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora_ini` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservaciones_b`
--

INSERT INTO `reservaciones_b` (`id`, `usuario`, `nombre`, `descripcion`, `year`, `mes`, `dia`, `hora_ini`, `hora_fin`) VALUES
('CwijbJM3mI#n', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'jjsdljdkljdlsajdlasjdl', 2020, 2, 1, 1, 5),
('R#catCmvKzTS', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'jjsdljdkljdlsajdlasjdl', 2020, 2, 2, 1, 5),
('zr9F$04CykFo', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'jjsdljdkljdlsajdlasjdl', 2020, 2, 3, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones_c`
--

CREATE TABLE `reservaciones_c` (
  `id` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1500) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora_ini` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservaciones_c`
--

INSERT INTO `reservaciones_c` (`id`, `usuario`, `nombre`, `descripcion`, `year`, `mes`, `dia`, `hora_ini`, `hora_fin`) VALUES
('$VAtyJznu&b#', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'ejjljljsaljdlasjdlja\r\ndjsajdklajdjsdljasldj\r\nsajkljdlasjdlasjldsja\r\nsdaklsjaldasjldjasldjasljdalsjdsklajd\r\nldlasjdljasldaldjsakldjlajdla', 2020, 2, 14, 1, 10),
('gq%9oYSQSasz', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'ejjljljsaljdlasjdlja\r\ndjsajdklajdjsdljasldj\r\nsajkljdlasjdlasjldsja\r\nsdaklsjaldasjldjasldjasljdalsjdsklajd\r\nldlasjdljasldaldjsakldjlajdla', 2020, 2, 12, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones_d`
--

CREATE TABLE `reservaciones_d` (
  `id` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1500) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora_ini` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservaciones_d`
--

INSERT INTO `reservaciones_d` (`id`, `usuario`, `nombre`, `descripcion`, `year`, `mes`, `dia`, `hora_ini`, `hora_fin`) VALUES
('FkLTcIfqZokw', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'sfsafczc', 2020, 2, 12, 1, 7),
('SvVE2ldGkB7X', 'Juan Dos Tres Cuatro', 'Es una prueba para el nombre de las reservaciones', 'sfsafczc', 2020, 2, 11, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `privilegio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `privilegio`, `correo`) VALUES
('admin_uno', 'juan', 'hol4', 'Juan Dos Tres Cuatro', 'admin', 'juan@email.com'),
('uaOhrlnTniGN', 'privilegio', '12345', 'usuario privilegiado dos tres', 'usuario_p', 'hola@gmail.com'),
('usere_1', 'juan_e', 'b1e', 'Juan Dos Tres Cuatro', 'usuario_e', 'hola@hotmail.com'),
('userp_1', 'juan_p', 'ad1os', 'Juan Dos Tres Cuatro', 'usuario_p', 'user@gmail.com'),
('WdmuAGgY9Cmi', 'estandar', '12345', 'usuario estandar primero segundo', 'usuario_e', 'ejemplo@hotmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservaciones_a`
--
ALTER TABLE `reservaciones_a`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservaciones_b`
--
ALTER TABLE `reservaciones_b`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservaciones_c`
--
ALTER TABLE `reservaciones_c`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservaciones_d`
--
ALTER TABLE `reservaciones_d`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
