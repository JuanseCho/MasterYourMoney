-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2023 a las 17:13:27
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
-- Base de datos: `personalfinance`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ahorros`
--

CREATE TABLE `ahorros` (
  `idAhorro` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ahorros`
--

INSERT INTO `ahorros` (`idAhorro`, `Fecha`, `Descripcion`, `Monto`) VALUES
(1, '2023-11-07', 'Ahorro para vacaciones', 1000.00),
(2, '2023-11-10', 'Ahorro para emergencias', 500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ahorros_has_capital`
--

CREATE TABLE `ahorros_has_capital` (
  `ahorros_idAhorro` int(11) NOT NULL,
  `capital_idCapital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital`
--

CREATE TABLE `capital` (
  `idCapital` int(11) NOT NULL,
  `Montoactual` int(11) DEFAULT NULL,
  `descipcion` varchar(45) DEFAULT NULL,
  `formapago_idFormaPago` int(11) NOT NULL,
  `usuarios_idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `capital`
--

INSERT INTO `capital` (`idCapital`, `Montoactual`, `descipcion`, `formapago_idFormaPago`, `usuarios_idUsuario`, `fecha`) VALUES
(1, 1000, 'Fondo de inversión', 1, 1, '2023-11-07'),
(2, 500, 'Cuenta bancaria', 2, 2, '2023-11-07'),
(3, 7000000, 'sueldo ', 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital_has_presupuestos`
--

CREATE TABLE `capital_has_presupuestos` (
  `capital_idCapital` int(11) NOT NULL,
  `presupuestos_idPresupuesto` int(11) NOT NULL
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
(1, 'Efectivo'),
(2, 'Tarjeta de crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idGasto` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Monto` int(11) DEFAULT NULL,
  `idPresupuesto` int(11) NOT NULL,
  `formapago_idFormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idGasto`, `Fecha`, `Descripcion`, `Monto`, `idPresupuesto`, `formapago_idFormaPago`) VALUES
(1, '2023-11-15', 'Comida rápida', 20, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `idPresupuesto` int(11) NOT NULL,
  `ValorAsignado` int(11) DEFAULT NULL,
  `tipopresupuesto_idTipoPresupuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`idPresupuesto`, `ValorAsignado`, `tipopresupuesto_idTipoPresupuesto`) VALUES
(1, 500, 1),
(2, 300, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopresupuesto`
--

CREATE TABLE `tipopresupuesto` (
  `idTipoPresupuesto` int(11) NOT NULL,
  `NombreTipoPresupuesto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipopresupuesto`
--

INSERT INTO `tipopresupuesto` (`idTipoPresupuesto`, `NombreTipoPresupuesto`) VALUES
(1, 'Alimentos'),
(2, 'Transporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellido` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Apellido`, `Email`, `Telefono`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123-456-7890'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '987-654-3210');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ahorros`
--
ALTER TABLE `ahorros`
  ADD PRIMARY KEY (`idAhorro`);

--
-- Indices de la tabla `ahorros_has_capital`
--
ALTER TABLE `ahorros_has_capital`
  ADD PRIMARY KEY (`ahorros_idAhorro`,`capital_idCapital`),
  ADD KEY `fk_ahorros_has_capital_capital1_idx` (`capital_idCapital`),
  ADD KEY `fk_ahorros_has_capital_ahorros1_idx` (`ahorros_idAhorro`);

--
-- Indices de la tabla `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`idCapital`),
  ADD KEY `fk_capital_formapago1_idx` (`formapago_idFormaPago`),
  ADD KEY `fk_capital_usuarios1_idx` (`usuarios_idUsuario`);

--
-- Indices de la tabla `capital_has_presupuestos`
--
ALTER TABLE `capital_has_presupuestos`
  ADD PRIMARY KEY (`capital_idCapital`,`presupuestos_idPresupuesto`),
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
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`idPresupuesto`),
  ADD KEY `fk_presupuestos_tipopresupuesto1_idx` (`tipopresupuesto_idTipoPresupuesto`);

--
-- Indices de la tabla `tipopresupuesto`
--
ALTER TABLE `tipopresupuesto`
  ADD PRIMARY KEY (`idTipoPresupuesto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ahorros`
--
ALTER TABLE `ahorros`
  MODIFY `idAhorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `capital`
--
ALTER TABLE `capital`
  MODIFY `idCapital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `idFormaPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipopresupuesto`
--
ALTER TABLE `tipopresupuesto`
  MODIFY `idTipoPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ahorros_has_capital`
--
ALTER TABLE `ahorros_has_capital`
  ADD CONSTRAINT `fk_ahorros_has_capital_ahorros1` FOREIGN KEY (`ahorros_idAhorro`) REFERENCES `ahorros` (`idAhorro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ahorros_has_capital_capital1` FOREIGN KEY (`capital_idCapital`) REFERENCES `capital` (`idCapital`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `capital`
--
ALTER TABLE `capital`
  ADD CONSTRAINT `fk_capital_formapago1` FOREIGN KEY (`formapago_idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_capital_usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_gastos_presupuestos1` FOREIGN KEY (`idPresupuesto`) REFERENCES `presupuestos` (`idPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `fk_presupuestos_tipopresupuesto1` FOREIGN KEY (`tipopresupuesto_idTipoPresupuesto`) REFERENCES `tipopresupuesto` (`idTipoPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
