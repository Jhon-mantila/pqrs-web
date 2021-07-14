-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2021 a las 15:48:43
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pqrs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_emp` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `nom_empresa` varchar(150) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_emp`, `nit`, `nom_empresa`, `activo`) VALUES
(1, 1234, 'ABC', 1),
(2, 3216, 'medica', 1),
(5, 1, 'empresa 1', 0),
(8, 63789, 'EMPRESA PRUEBA DOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion`
--

CREATE TABLE `peticion` (
  `id_pet` int(11) NOT NULL,
  `nom_peticion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peticion`
--

INSERT INTO `peticion` (`id_pet`, `nom_peticion`) VALUES
(1, 'Petición'),
(2, 'Queja'),
(3, 'Reclamo'),
(4, 'Sugerencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_r` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_r`, `rol`) VALUES
(1, 'Super Admin'),
(2, 'Gerente'),
(3, 'Operario'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_so` int(11) NOT NULL,
  `id_usurio` int(11) NOT NULL,
  `id_peticion` int(11) NOT NULL,
  `titulo_peticion` varchar(150) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `tiempo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `id_empre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_so`, `id_usurio`, `id_peticion`, `titulo_peticion`, `descripcion`, `tiempo`, `id_cliente`, `respuesta`, `id_empre`) VALUES
(1, 9, 1, 'petición nueva', 'petición nueva', '2021-07-14 07:22:12', 18, '', 1),
(2, 9, 2, 'queja', 'reclamo por dinero', '2021-07-14 07:22:18', 18, '', 1),
(3, 9, 1, 'CAMILO NUEVI', 'asdad', '2021-07-14 08:37:09', 18, '', 1),
(4, 9, 1, 'asd', 'asdad', '2021-07-14 10:22:28', 18, '', 1),
(5, 9, 1, 'prueba operacio', 'asdadasd', '2021-07-14 10:22:35', 1, '', 1),
(6, 19, 1, 'Solicitud Peticion', 'asdad', '2021-07-14 12:20:20', 1, '', 1),
(7, 19, 3, 'prueba reclamo', 'asda mas pruebas', '2021-07-14 10:23:25', 18, 'probando prueba reclamo parar ver', 1),
(8, 9, 1, 'pruba empresa', 'probando empresa', '2021-07-14 10:30:46', 1, 'comentario', 1),
(9, 28, 2, 'PETICIÓN DE LA QUEJA DE NO DORMIR', 'FALTA DE SUEÑO', '2021-07-14 13:47:20', 30, 'YA CASI ME DUERMO BN', 8),
(10, 27, 1, 'NUEVA PETICON PROBANDO OPERDORES', 'PROBADO OPERADORES', '2021-07-14 13:41:26', 30, '', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(11) NOT NULL,
  `cc` bigint(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `clave` varchar(400) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `ACTIVO_U` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `cc`, `nombre`, `correo`, `clave`, `id_empresa`, `id_rol`, `ACTIVO_U`) VALUES
(1, 1234, 'PRUEBA1', 'PPP@LLL.COM', '1234', 1, 4, 1),
(2, 1235, 'gerente medio', 'medio@SSS.co', '1234', 1, 2, 1),
(3, 1096187206, 'JHON MANTILLA', 'jhon.e.mantilla@gmail.com', '1234', 2, 1, 1),
(7, 111, 'ASDA', 'SS@A.S', '$2y$13$7fQPvZfulRb0Cn0sIPp4HebKKG1TbCpPitaHjEYG4ZqQnJRqGPgcq', 2, 2, 1),
(9, 1238, 'operador 1', '2222@ss.a', '$2y$13$znMekSPlIYs13PAivf1JDuBIfMznGVYQ.T00p9QTxdBsXPNxxfcZi', 1, 3, 1),
(18, 1237, 'cliente pruba', 'cliente@c.co', '$2y$13$nBYybwFUeJWtoc0u4OaA1.qqMUfKUmWgvkuhT4wKJ9NBiI/uHxPW.', 1, 4, 1),
(19, 123456, 'operador 2', 'ope@aa.c', '1234', 1, 3, 1),
(20, 123457, 'operador 3', 'opee@s.s', '1234', 5, 3, 1),
(21, 1234568, 'operador 4', 'op@ss.c', '1234', 5, 3, 1),
(22, 123456789, 'operador 5', 'asd@a.s', '1234', 5, 3, 1),
(23, 654321, 'operador 6', 'oper@s.sc', '1234', 2, 3, 1),
(24, 65438, 'operador 6', 'www@s.c', '1234', 2, 3, 1),
(26, 12313, 'GERENTE NUEVO', 'NUE@SS.C', '$2y$13$GM.n8z6/H14Ef75n0QabS.ThAF5Fj26vI2kzNTWNO4RmOKfeAgfGu', 8, 2, 1),
(27, 9876, 'OPERARIO NUEVO', 'ASDA@C.A', '$2y$13$yDZmKOBIxOP1d2VJllEECeDleQqvtlJbdXsHyD5J3CqsW/zbVDcAa', 8, 3, 1),
(28, 9875, '12313', 'SS@S.C', '$2y$13$HfsCHEByQvgBRSF3FD5G1e2OrT90/xzoVnqnUyIIKA9gwdZI0sF9a', 8, 3, 1),
(29, 9874, 'OPERARIO VIEJO', 'ASD@C.C', '$2y$13$2Vfv2UN8.c5G1RWhZIqdde/6IfBppKVCg.8t.7D11wVlyxBq.9SFm', 8, 3, 1),
(30, 87654, 'CLIENTE NUEVOSS', 'SS@AA.C', '$2y$13$zs2rv2RGbbLUQGYlo.hnTuMgE8LBl0jgkVZgoUiwLIavCjG/4q2I2', 8, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_emp`),
  ADD UNIQUE KEY `nit` (`nit`);

--
-- Indices de la tabla `peticion`
--
ALTER TABLE `peticion`
  ADD PRIMARY KEY (`id_pet`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_r`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_so`),
  ADD KEY `solicitud_usuario` (`id_usurio`),
  ADD KEY `solicitud_peticion` (`id_peticion`),
  ADD KEY `solicitud_cliente` (`id_cliente`),
  ADD KEY `solicitud_empresa` (`id_empre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `cedula` (`cc`),
  ADD KEY `usuario_rol` (`id_rol`),
  ADD KEY `usuario_empresa` (`id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `peticion`
--
ALTER TABLE `peticion`
  MODIFY `id_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_so` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id_usu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_empresa` FOREIGN KEY (`id_empre`) REFERENCES `empresa` (`id_emp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_peticion` FOREIGN KEY (`id_peticion`) REFERENCES `peticion` (`id_pet`) ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_usuario` FOREIGN KEY (`id_usurio`) REFERENCES `usuarios` (`id_usu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_emp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_r`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
