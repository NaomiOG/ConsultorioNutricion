-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2020 a las 02:31:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutricion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_paciente` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tipo_cita` int(11) NOT NULL,
  `status_pago` varchar(20) DEFAULT NULL,
  `tipo_pago` varchar(13) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `asistencia` char(2) DEFAULT NULL,
  `empleado_agendo` int(11) NOT NULL,
  `empleado_atendio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_paciente`, `id_cita`, `fecha`, `hora`, `tipo_cita`, `status_pago`, `tipo_pago`, `observaciones`, `asistencia`, `empleado_agendo`, `empleado_atendio`) VALUES
(1, 1, '2020-06-17', '15:00:00', 3, 'Pendiente', NULL, NULL, NULL, 2, NULL),
(2, 1, '2020-06-17', '11:30:00', 1, 'Pagado', 'Efectivo', 'Ninguna observación', 'Si', 2, 2),
(3, 1, '2020-06-17', '17:30:00', 1, 'Pendiente', NULL, NULL, NULL, 1, NULL),
(4, 1, '2020-06-17', '19:30:00', 4, 'Pendiente', NULL, NULL, NULL, 1, NULL),
(5, 1, '2020-06-18', '13:30:00', 4, 'Pendiente', NULL, NULL, NULL, 1, NULL),
(6, 1, '2020-06-17', '17:00:00', 2, 'Pendiente', NULL, NULL, NULL, 3, NULL),
(8, 1, '2020-06-17', '17:30:00', 3, 'Pendiente', NULL, NULL, NULL, 3, NULL),
(9, 1, '2020-06-17', '10:00:00', 2, 'Pagado', 'Transferencia', 'Ninguna', 'Si', 2, 2),
(9, 2, '2020-06-24', '12:00:00', 3, 'Pendiente', NULL, NULL, NULL, 1, NULL),
(9, 3, '2020-07-01', '12:00:00', 3, 'Pendiente', NULL, NULL, NULL, 1, NULL),
(9, 4, '2020-07-08', '12:00:00', 3, 'Pendiente', NULL, NULL, NULL, 3, NULL),
(9, 6, '2020-07-15', '12:30:00', 1, 'Pendiente', NULL, NULL, NULL, 2, NULL),
(10, 1, '2020-06-18', '18:30:00', 3, 'Pendiente', NULL, NULL, NULL, 3, NULL),
(12, 1, '2020-06-18', '11:30:00', 4, 'Pendiente', NULL, NULL, NULL, 3, NULL),
(12, 2, '2020-06-25', '17:00:00', 3, 'Pendiente', NULL, NULL, NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_medicamento`
--

CREATE TABLE `cita_medicamento` (
  `id_paciente` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_medicamento` int(11) NOT NULL,
  `indicaciones` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita_medicamento`
--

INSERT INTO `cita_medicamento` (`id_paciente`, `id_cita`, `id_medicamento`, `indicaciones`) VALUES
(2, 1, 1, 'Tomar un tableta c/hora'),
(9, 1, 10, 'Tomar 3 veces al día');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

CREATE TABLE `dieta` (
  `id_paciente` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `desayuno` text NOT NULL,
  `almuerzo` text NOT NULL,
  `comida` text NOT NULL,
  `colacion` text NOT NULL,
  `cena` text NOT NULL,
  `alimentos` text NOT NULL,
  `indicaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_paciente`, `id_cita`, `desayuno`, `almuerzo`, `comida`, `colacion`, `cena`, `alimentos`, `indicaciones`) VALUES
(2, 1, '-Té al gusto, 1 rebanada de pan tostado y 1 manzana', '-2 quesadillas(queso panela y tortilla de maíz), una fruta y té', '-Salpicón(200gr de carne de res o pollo), 2 tostadas, 1/2 taza de arroz, 1 fruta y agua o té', '-1 gelatina y 1 fruta', 'Yogurth para beber, 1 fruta y gelatina', 'Acelgas, berenjena, cilantro, alcachofa, berro, calabacitas, col.', 'En caso de estreñimiento tomar té de ciruela pasa dos veces al día'),
(9, 1, '-Té al gusto, 1 rebanada de pan tostado y 1 manzana', '-2 quesadillas(queso panela y tortilla de maíz), una fruta y té', '-Salpicón(200gr de carne de res o pollo), 2 tostadas, 1/2 taza de arroz, 1 fruta y agua o té', '-1 gelatina y 1 fruta', '-Yogurth para beber, 1 fruta y gelatina', 'Acelgas, berenjena, cilantro, alcachofa, berro, calabacitas, col.', 'En caso de estreñimiento tomar té de ciruela pasa dos veces al día');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `sueldo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellidos`, `telefono`, `sueldo`) VALUES
(1, 'Luz María', 'Gasca Torres', '4611213589', '1600.00'),
(2, 'Guadalupe', 'Gasca Gasca', '4611212545', '2300.00'),
(3, 'Naomi', 'Ortiz González', '4611212331', '1100.00'),
(4, 'Prueba', 'Prueba', '46112558447', '1000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id_paciente` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_tipomedida` int(11) NOT NULL,
  `medida` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `expediente`
--

INSERT INTO `expediente` (`id_paciente`, `id_cita`, `id_tipomedida`, `medida`) VALUES
(2, 1, 1, '1.65'),
(2, 1, 2, '89.00'),
(2, 1, 3, '91.00'),
(2, 1, 4, '70.00'),
(2, 1, 5, '90.00'),
(2, 1, 6, '91.00'),
(2, 1, 7, '35.00'),
(9, 1, 1, '1.61'),
(9, 1, 2, '89.00'),
(9, 1, 3, '91.00'),
(9, 1, 4, '61.00'),
(9, 1, 5, '101.00'),
(9, 1, 6, '91.00'),
(9, 1, 7, '35.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id_medicamento` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `laboratorio` varchar(50) NOT NULL,
  `inventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id_medicamento`, `descripcion`, `laboratorio`, `inventario`) VALUES
(1, 'Acxion', 'Pharmalife', 8),
(2, 'Senósidos', 'ABAMED PHARMA', 50),
(3, 'Metformina', 'ABELLO LINDE', 20),
(4, 'Biomesina Compuesta', 'BIOMEP', 8),
(5, 'Saxenda', 'ALCON', 10),
(6, 'Redotex', 'Medix', 20),
(7, 'Redotex NF', 'Medix', 9),
(8, 'Reductil', 'Knoll', 10),
(9, 'Terfamex', 'Medix', 11),
(10, 'Orlistat', 'Colmet Internacional', 19),
(11, 'Prueba', 'asdf', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_Ingreso` date NOT NULL,
  `domicilio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre`, `apellidos`, `telefono`, `sexo`, `fecha_nacimiento`, `fecha_Ingreso`, `domicilio`) VALUES
(1, 'Saul Fabian', 'Cruces Anaya', '4613416436', 'M', '2000-11-12', '2020-06-17', 'Heriberto Jara #345'),
(2, 'Alaan Christian', 'Cruces Anaya', '4611254784', 'M', '1992-06-16', '2020-06-17', 'direccion1 #453'),
(3, 'Norma', 'Bravo', '4611254878', 'F', '1990-10-21', '2020-06-17', 'direccion1 #455'),
(4, 'Camila Yunuen', 'Ortiz Chávez', '4611258749', 'F', '2008-08-11', '2020-06-17', 'Av. Mexico #454'),
(5, 'Yeshua', 'Cruces Ramos', '4611251487', 'M', '1999-06-11', '2020-06-17', 'Benito Juarez #454'),
(6, 'Ariana', 'Cruces Anaya', '4611258474', 'F', '1986-01-21', '2020-06-17', 'Plan de San Luis #133'),
(7, 'Consuelo', 'Ramírez Sánchez', '4611251748', 'F', '1980-10-21', '2020-06-17', 'Hidalgo #345'),
(8, 'Martha', ' González Rodríguez ', '4611251478', 'F', '1967-10-12', '2020-06-17', 'Azalea #658'),
(9, 'Erick Yael', 'Ortiz González', '4611245145', 'M', '1995-09-18', '2020-06-17', 'Violeta #45'),
(10, 'Enrique', ' Ortiz Derramadero', '4611509020', 'M', '1961-02-05', '2020-06-17', 'Jazmin #45'),
(12, 'Jonathan ', 'Camacho Díaz', '4613211423', 'F', '0000-00-00', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cita`
--

CREATE TABLE `tipo_cita` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_cita`
--

INSERT INTO `tipo_cita` (`id_tipo`, `descripcion`, `costo`) VALUES
(1, 'Control', '600.00'),
(2, 'Retoma', '600.00'),
(3, 'Cavitacion', '0.00'),
(4, 'Primera vez', '700.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medida`
--

CREATE TABLE `tipo_medida` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_medida`
--

INSERT INTO `tipo_medida` (`id_tipo`, `descripcion`) VALUES
(1, 'Talla'),
(2, 'Peso'),
(3, 'Busto'),
(4, 'Cintura'),
(5, 'Cadera'),
(6, 'Muslo'),
(7, 'Brazo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` char(70) NOT NULL,
  `contraseña` varchar(42) NOT NULL,
  `tipo_usuario` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `contraseña`, `tipo_usuario`) VALUES
(1, 'lucy@gmail.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '1'),
(1, 'saul@gmail.com', '*8778D3593B8DB9E9D94FF55C43E48F0', '2'),
(2, 'alaan@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(2, 'lupita@gmail.com', '*A4B6157319038724E3560894F7F932C', '1'),
(3, 'naomi@gmail.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '1'),
(3, 'norma@gmail.com', '*10360BAA8AC38BFC5B10749557C9312', '2'),
(4, 'camila@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(4, 'empprueba@gmail.com', '*A4B6157319038724E3560894F7F932C', '1'),
(5, 'yeshua@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(6, 'ariana@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(7, 'consuelo@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(8, 'martha@gmail.com', '*A4B6157319038724E3560894F7F932C', '2'),
(9, 'yael@gmail.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', '2'),
(10, 'enrique@gmail.com', '*A4B6157319038724E3560894F7F932C', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_paciente`,`id_cita`),
  ADD KEY `citaFK2` (`tipo_cita`),
  ADD KEY `citaFK3` (`empleado_agendo`),
  ADD KEY `citaFK4` (`empleado_atendio`);

--
-- Indices de la tabla `cita_medicamento`
--
ALTER TABLE `cita_medicamento`
  ADD PRIMARY KEY (`id_paciente`,`id_cita`,`id_medicamento`),
  ADD KEY `cita_medicamentoFK3` (`id_medicamento`);

--
-- Indices de la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`id_paciente`,`id_cita`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id_paciente`,`id_cita`,`id_tipomedida`),
  ADD KEY `expedienteFK2` (`id_tipomedida`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `tipo_cita`
--
ALTER TABLE `tipo_cita`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_cita`
--
ALTER TABLE `tipo_cita`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `citaFK1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citaFK2` FOREIGN KEY (`tipo_cita`) REFERENCES `tipo_cita` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citaFK3` FOREIGN KEY (`empleado_agendo`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citaFK4` FOREIGN KEY (`empleado_atendio`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita_medicamento`
--
ALTER TABLE `cita_medicamento`
  ADD CONSTRAINT `cita_medicamentoFK1` FOREIGN KEY (`id_paciente`,`id_cita`) REFERENCES `cita` (`id_paciente`, `id_cita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_medicamentoFK3` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id_medicamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD CONSTRAINT `dietaFK1` FOREIGN KEY (`id_paciente`,`id_cita`) REFERENCES `cita` (`id_paciente`, `id_cita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `expedienteFK1` FOREIGN KEY (`id_paciente`,`id_cita`) REFERENCES `cita` (`id_paciente`, `id_cita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expedienteFK2` FOREIGN KEY (`id_tipomedida`) REFERENCES `tipo_medida` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
