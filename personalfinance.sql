-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2023 a las 03:39:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `personalfinance`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ahorro`
--

CREATE TABLE `ahorro` (
  `idAhorro` int(11) NOT NULL,
  `fecha_ahorro` date DEFAULT NULL,
  `descripcion_ahorro` varchar(45) DEFAULT NULL,
  `montoInicial_ahorro` int(11) DEFAULT NULL,
  `montoActual_ahorro` int(11) DEFAULT NULL,
  `montoMeta_ahorro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ahorro`
--

INSERT INTO `ahorro` (`idAhorro`, `fecha_ahorro`, `descripcion_ahorro`, `montoInicial_ahorro`, `montoActual_ahorro`, `montoMeta_ahorro`) VALUES
(9, '2023-11-30', 'Moto', 300000, 300000, 4000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital`
--

CREATE TABLE `capital` (
  `idCapital` int(11) NOT NULL,
  `Montoactual` int(11) NOT NULL,
  `descipcion` varchar(45) NOT NULL,
  `formapago_idFormaPago` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `capital`
--

INSERT INTO `capital` (`idCapital`, `Montoactual`, `descipcion`, `formapago_idFormaPago`, `fecha`, `usuarios_idUsuario`) VALUES
(6, 1000000, 'Salario', 8, '2023-11-30', 3),
(7, 700000, 'SENNOVA', 9, '2023-11-30', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital_has_ahorro`
--

CREATE TABLE `capital_has_ahorro` (
  `capital_idCapital` int(11) NOT NULL,
  `ahorro_idAhorro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital_has_presupuestos`
--

CREATE TABLE `capital_has_presupuestos` (
  `idCapital_has_presupuestoscol` int(11) NOT NULL,
  `capital_idCapital` int(11) NOT NULL,
  `presupuestos_idPresupuesto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valorDeducido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `idFormaPago` int(11) NOT NULL,
  `NombreFormaPago` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`idFormaPago`, `NombreFormaPago`) VALUES
(8, 'Nequi'),
(9, 'Efectivo'),
(10, 'Daviplata');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idGasto` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcionGasto` text DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `idPresupuesto` int(11) NOT NULL,
  `formapago_idFormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `idingreso` int(11) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `monto_ingreso` int(11) DEFAULT NULL,
  `formapago_idFormaPago` int(11) NOT NULL,
  `capital_idCapital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`idingreso`, `fecha_ingreso`, `hora_ingreso`, `monto_ingreso`, `formapago_idFormaPago`, `capital_idCapital`) VALUES
(6, '2023-11-30', '21:20:42', 200000, 8, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `idPresupuesto` int(11) NOT NULL,
  `descripcionPresupuesto` varchar(100) NOT NULL,
  `ValorAsignado` decimal(20,0) NOT NULL,
  `montoActual` decimal(20,0) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regahorros`
--

CREATE TABLE `regahorros` (
  `idRegAhorros` int(11) NOT NULL,
  `fecha_regAhorro` date DEFAULT NULL,
  `hora_regAhorro` time DEFAULT NULL,
  `monto_regAhorro` int(11) DEFAULT NULL,
  `ahorro_idAhorro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `regahorros`
--

INSERT INTO `regahorros` (`idRegAhorros`, `fecha_regAhorro`, `hora_regAhorro`, `monto_regAhorro`, `ahorro_idAhorro`) VALUES
(1, '2023-11-30', '21:24:10', 100000, 9),
(2, '2023-11-30', '21:35:44', 200000, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombres` varchar(155) NOT NULL,
  `apellidos` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `contrasena` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombres`, `apellidos`, `email`, `telefono`, `contrasena`) VALUES
(3, 'David', 'Sanabria', 'david@gmail.com', '3105343292', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ahorro`
--
ALTER TABLE `ahorro`
  ADD PRIMARY KEY (`idAhorro`);

--
-- Indices de la tabla `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`idCapital`),
  ADD KEY `fk_capital_formapago1_idx` (`formapago_idFormaPago`),
  ADD KEY `fk_capital_usuarios1_idx` (`usuarios_idUsuario`);

--
-- Indices de la tabla `capital_has_ahorro`
--
ALTER TABLE `capital_has_ahorro`
  ADD PRIMARY KEY (`capital_idCapital`,`ahorro_idAhorro`),
  ADD KEY `fk_capital_has_ahorro_ahorro1_idx` (`ahorro_idAhorro`),
  ADD KEY `fk_capital_has_ahorro_capital1_idx` (`capital_idCapital`);

--
-- Indices de la tabla `capital_has_presupuestos`
--
ALTER TABLE `capital_has_presupuestos`
  ADD PRIMARY KEY (`idCapital_has_presupuestoscol`,`capital_idCapital`,`presupuestos_idPresupuesto`),
  ADD KEY `fk_capital_has_presupuestos_presupuestos1_idx` (`presupuestos_idPresupuesto`),
  ADD KEY `fk_capital_has_presupuestos_capital1_idx` (`capital_idCapital`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`idFormaPago`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idGasto`),
  ADD KEY `fk_gastos_presupuestos1_idx` (`idPresupuesto`),
  ADD KEY `fk_gastos_formapago1_idx` (`formapago_idFormaPago`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingresos_formapago1_idx` (`formapago_idFormaPago`),
  ADD KEY `fk_ingresos_capital1_idx` (`capital_idCapital`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`idPresupuesto`);

--
-- Indices de la tabla `regahorros`
--
ALTER TABLE `regahorros`
  ADD PRIMARY KEY (`idRegAhorros`),
  ADD KEY `fk_regAhorros_ahorro1_idx` (`ahorro_idAhorro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ahorro`
--
ALTER TABLE `ahorro`
  MODIFY `idAhorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `capital`
--
ALTER TABLE `capital`
  MODIFY `idCapital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `capital_has_presupuestos`
--
ALTER TABLE `capital_has_presupuestos`
  MODIFY `idCapital_has_presupuestoscol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `idFormaPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `regahorros`
--
ALTER TABLE `regahorros`
  MODIFY `idRegAhorros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capital`
--
ALTER TABLE `capital`
  ADD CONSTRAINT `fk_capital_formapago1` FOREIGN KEY (`formapago_idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_capital_usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `capital_has_ahorro`
--
ALTER TABLE `capital_has_ahorro`
  ADD CONSTRAINT `fk_capital_has_ahorro_ahorro1` FOREIGN KEY (`ahorro_idAhorro`) REFERENCES `ahorro` (`idAhorro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_capital_has_ahorro_capital1` FOREIGN KEY (`capital_idCapital`) REFERENCES `capital` (`idCapital`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `capital_has_presupuestos`
--
ALTER TABLE `capital_has_presupuestos`
  ADD CONSTRAINT `fk_capital_has_presupuestos_capital1` FOREIGN KEY (`capital_idCapital`) REFERENCES `capital` (`idCapital`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_capital_has_presupuestos_presupuestos1` FOREIGN KEY (`presupuestos_idPresupuesto`) REFERENCES `presupuestos` (`idPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fk_gastos_formapago1` FOREIGN KEY (`formapago_idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_presupuestos1` FOREIGN KEY (`idPresupuesto`) REFERENCES `presupuestos` (`idPresupuesto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingresos_capital1` FOREIGN KEY (`capital_idCapital`) REFERENCES `capital` (`idCapital`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ingresos_formapago1` FOREIGN KEY (`formapago_idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `regahorros`
--
ALTER TABLE `regahorros`
  ADD CONSTRAINT `fk_regAhorros_ahorro1` FOREIGN KEY (`ahorro_idAhorro`) REFERENCES `ahorro` (`idAhorro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
