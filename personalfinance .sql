-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2023 a las 06:47:17
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
  `Monto` decimal(10,2) DEFAULT NULL,
  `idPresupuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ahorros`
--

INSERT INTO `ahorros` (`idAhorro`, `Fecha`, `Descripcion`, `Monto`, `idPresupuesto`) VALUES
(1, '2023-10-30', 'Ahorro mensual', 500.00, 1),
(2, '2023-10-10', 'Ahorro para la compra de comestibles', 200.00, 1),
(3, '2023-10-15', 'Ahorro para el viaje en autobús', 100.00, 2),
(4, '2023-10-05', 'Ahorro para una cena en restaurante', 150.00, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital`
--

CREATE TABLE `capital` (
  `idCapital` int(11) NOT NULL,
  `MontoInicial` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `formapago_idFormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `capital`
--

INSERT INTO `capital` (`idCapital`, `MontoInicial`, `idUsuario`, `formapago_idFormaPago`) VALUES
(1, 10000, 1, 1),
(2, 5000, 1, 1),
(3, 8000, 2, 2),
(4, 10000, 3, 3);

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
(2, 'Tarjeta de crédito'),
(3, 'Transferencia bancaria');

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
  `idFormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idGasto`, `Fecha`, `Descripcion`, `Monto`, `idPresupuesto`, `idFormaPago`) VALUES
(1, '2023-10-30', 'Comida', 100, 1, 1),
(2, '2023-10-12', 'Compra de comestibles', 150, 1, 1),
(3, '2023-10-18', 'Boleto de autobús', 30, 2, 2),
(4, '2023-10-08', 'Cena en restaurante', 60, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `idPresupuesto` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `ValorAsignado` int(11) DEFAULT NULL,
  `capital_idCapital` int(11) NOT NULL,
  `idTipoPresupuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`idPresupuesto`, `idUsuario`, `ValorAsignado`, `capital_idCapital`, `idTipoPresupuesto`) VALUES
(1, 1, 3000, 1, 1),
(2, 1, 1000, 1, 1),
(3, 2, 2000, 2, 2),
(4, 3, 1500, 3, 3);

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
(1, 'Alimentación'),
(2, 'Transporte'),
(3, 'Entretenimiento');

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
(1, 'Juan', 'Pérez', 'juan@example.com', '1234567890'),
(2, 'María', 'López', 'maria@example.com', '9876543210'),
(3, 'Carlos', 'González', 'carlos@example.com', '5551234567'),
(4, 'Laura', 'Martínez', 'laura@example.com', '3337778888');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ahorros`
--
ALTER TABLE `ahorros`
  ADD PRIMARY KEY (`idAhorro`),
  ADD KEY `fk_ahorros_presupuestos1_idx` (`idPresupuesto`);

--
-- Indices de la tabla `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`idCapital`),
  ADD KEY `fk_capital_usuarios_idx` (`idUsuario`),
  ADD KEY `fk_capital_formapago1_idx` (`formapago_idFormaPago`);

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
  ADD KEY `fk_gastos_formapago1_idx` (`idFormaPago`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`idPresupuesto`),
  ADD KEY `fk_presupuestos_capital1_idx` (`capital_idCapital`),
  ADD KEY `fk_presupuestos_tipopresupuesto1_idx` (`idTipoPresupuesto`);

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
  MODIFY `idAhorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `capital`
--
ALTER TABLE `capital`
  MODIFY `idCapital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `idFormaPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipopresupuesto`
--
ALTER TABLE `tipopresupuesto`
  MODIFY `idTipoPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ahorros`
--
ALTER TABLE `ahorros`
  ADD CONSTRAINT `fk_ahorros_presupuestos1` FOREIGN KEY (`idPresupuesto`) REFERENCES `presupuestos` (`idPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `capital`
--
ALTER TABLE `capital`
  ADD CONSTRAINT `fk_capital_formapago1` FOREIGN KEY (`formapago_idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_capital_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fk_gastos_formapago1` FOREIGN KEY (`idFormaPago`) REFERENCES `formapago` (`idFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_presupuestos1` FOREIGN KEY (`idPresupuesto`) REFERENCES `presupuestos` (`idPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `fk_presupuestos_capital1` FOREIGN KEY (`capital_idCapital`) REFERENCES `capital` (`idCapital`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_presupuestos_tipopresupuesto1` FOREIGN KEY (`idTipoPresupuesto`) REFERENCES `tipopresupuesto` (`idTipoPresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
