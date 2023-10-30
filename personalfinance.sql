-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 01:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personalfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `ahorros`
--

CREATE TABLE `ahorros` (
  `idahorro` int(11) NOT NULL,
  `valor_ahorro` int(11) DEFAULT NULL,
  `transacciones_idtransaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dias`
--

CREATE TABLE `dias` (
  `iddia` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `semanas_idsemana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuentes`
--

CREATE TABLE `fuentes` (
  `idfuente` int(11) NOT NULL,
  `nombre_fuente` varchar(45) DEFAULT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  `tipo_fuentes_idtipo_fuente` int(11) NOT NULL,
  `monto_inicial_fuente` int(11) DEFAULT NULL,
  `monto_actual_fuente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE `gastos` (
  `idgasto` int(11) NOT NULL,
  `valor_gasto` int(11) DEFAULT NULL,
  `descripcion_gasto` varchar(45) DEFAULT NULL,
  `transacciones_idtransaccion` int(11) NOT NULL,
  `tipo_gastos_idtipo_gasto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingresos`
--

CREATE TABLE `ingresos` (
  `idingreso` int(11) NOT NULL,
  `valor_ingreso` int(11) DEFAULT NULL,
  `descripcion_ingreso` varchar(45) DEFAULT NULL,
  `transacciones_idtransaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meses`
--

CREATE TABLE `meses` (
  `idmes` int(11) NOT NULL,
  `fecha_inicio_mes` date DEFAULT NULL,
  `fecha_fin_mes` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metas_ahorro`
--

CREATE TABLE `metas_ahorro` (
  `idmeta_ahorro` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `monto_inicial` int(11) DEFAULT NULL,
  `monto_actual` int(11) DEFAULT NULL,
  `monto_objetivo` int(11) DEFAULT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presupuestos`
--

CREATE TABLE `presupuestos` (
  `idpresupuesto` int(11) NOT NULL,
  `limite_presupuestal` int(11) NOT NULL,
  `tipo_gastos_idtipo_gasto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semanas`
--

CREATE TABLE `semanas` (
  `idsemana` int(11) NOT NULL,
  `fecha_inicio_semana` date DEFAULT NULL,
  `fecha_fin_semana` date DEFAULT NULL,
  `meses_idmes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_fuentes`
--

CREATE TABLE `tipo_fuentes` (
  `idtipo_fuente` int(11) NOT NULL,
  `nombre_tipo_fuente` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_gastos`
--

CREATE TABLE `tipo_gastos` (
  `idtipo_gasto` int(11) NOT NULL,
  `nombre_tipo_gasto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tipo_gastos`
--

INSERT INTO `tipo_gastos` (`idtipo_gasto`, `nombre_tipo_gasto`) VALUES
(1, 'valor_nombre_tipo_gasto'),
(2, 'kjn'),
(3, 'kjn'),
(4, 'temp'),
(5, 'oiljl'),
(6, 'oiljl'),
(7, 'lol'),
(8, 'juan'),
(9, 'kjn'),
(10, 'undefined'),
(11, 'undefined'),
(12, 'undefined'),
(13, 'undefined'),
(14, 'undefined'),
(15, 'undefined'),
(16, 'undefined'),
(17, 'undefined'),
(18, '1'),
(19, '3');

-- --------------------------------------------------------

--
-- Table structure for table `transacciones`
--

CREATE TABLE `transacciones` (
  `idtransaccion` int(11) NOT NULL,
  `fuentes_idfuente` int(11) NOT NULL,
  `dias_iddia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahorros`
--
ALTER TABLE `ahorros`
  ADD PRIMARY KEY (`idahorro`),
  ADD KEY `fk_ahorros_transacciones1_idx` (`transacciones_idtransaccion`);

--
-- Indexes for table `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`iddia`),
  ADD KEY `fk_dias_semanas1_idx` (`semanas_idsemana`);

--
-- Indexes for table `fuentes`
--
ALTER TABLE `fuentes`
  ADD PRIMARY KEY (`idfuente`),
  ADD KEY `fk_fuentes_usuarios_idx` (`usuarios_idusuario`),
  ADD KEY `fk_fuentes_tipo_fuentes1_idx` (`tipo_fuentes_idtipo_fuente`);

--
-- Indexes for table `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idgasto`),
  ADD KEY `fk_gastos_transacciones1_idx` (`transacciones_idtransaccion`),
  ADD KEY `fk_gastos_tipo_gastos1_idx` (`tipo_gastos_idtipo_gasto`);

--
-- Indexes for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingresos_transacciones1_idx` (`transacciones_idtransaccion`);

--
-- Indexes for table `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`idmes`);

--
-- Indexes for table `metas_ahorro`
--
ALTER TABLE `metas_ahorro`
  ADD PRIMARY KEY (`idmeta_ahorro`),
  ADD KEY `fk_metas_ahorro_usuarios1_idx` (`usuarios_idusuario`);

--
-- Indexes for table `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`idpresupuesto`),
  ADD KEY `fk_presupuestos_tipo_gastos1_idx` (`tipo_gastos_idtipo_gasto`);

--
-- Indexes for table `semanas`
--
ALTER TABLE `semanas`
  ADD PRIMARY KEY (`idsemana`),
  ADD KEY `fk_semanas_meses1_idx` (`meses_idmes`);

--
-- Indexes for table `tipo_fuentes`
--
ALTER TABLE `tipo_fuentes`
  ADD PRIMARY KEY (`idtipo_fuente`);

--
-- Indexes for table `tipo_gastos`
--
ALTER TABLE `tipo_gastos`
  ADD PRIMARY KEY (`idtipo_gasto`);

--
-- Indexes for table `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`idtransaccion`),
  ADD KEY `fk_transacciones_fuentes1_idx` (`fuentes_idfuente`),
  ADD KEY `fk_transacciones_dias1_idx` (`dias_iddia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahorros`
--
ALTER TABLE `ahorros`
  MODIFY `idahorro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dias`
--
ALTER TABLE `dias`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuentes`
--
ALTER TABLE `fuentes`
  MODIFY `idfuente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idgasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meses`
--
ALTER TABLE `meses`
  MODIFY `idmes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metas_ahorro`
--
ALTER TABLE `metas_ahorro`
  MODIFY `idmeta_ahorro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `idpresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semanas`
--
ALTER TABLE `semanas`
  MODIFY `idsemana` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_fuentes`
--
ALTER TABLE `tipo_fuentes`
  MODIFY `idtipo_fuente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_gastos`
--
ALTER TABLE `tipo_gastos`
  MODIFY `idtipo_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `idtransaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ahorros`
--
ALTER TABLE `ahorros`
  ADD CONSTRAINT `fk_ahorros_transacciones1` FOREIGN KEY (`transacciones_idtransaccion`) REFERENCES `transacciones` (`idtransaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dias`
--
ALTER TABLE `dias`
  ADD CONSTRAINT `fk_dias_semanas1` FOREIGN KEY (`semanas_idsemana`) REFERENCES `semanas` (`idsemana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fuentes`
--
ALTER TABLE `fuentes`
  ADD CONSTRAINT `fk_fuentes_tipo_fuentes1` FOREIGN KEY (`tipo_fuentes_idtipo_fuente`) REFERENCES `tipo_fuentes` (`idtipo_fuente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fuentes_usuarios` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fk_gastos_tipo_gastos1` FOREIGN KEY (`tipo_gastos_idtipo_gasto`) REFERENCES `tipo_gastos` (`idtipo_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_transacciones1` FOREIGN KEY (`transacciones_idtransaccion`) REFERENCES `transacciones` (`idtransaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingresos_transacciones1` FOREIGN KEY (`transacciones_idtransaccion`) REFERENCES `transacciones` (`idtransaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `metas_ahorro`
--
ALTER TABLE `metas_ahorro`
  ADD CONSTRAINT `fk_metas_ahorro_usuarios1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `fk_presupuestos_tipo_gastos1` FOREIGN KEY (`tipo_gastos_idtipo_gasto`) REFERENCES `tipo_gastos` (`idtipo_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `semanas`
--
ALTER TABLE `semanas`
  ADD CONSTRAINT `fk_semanas_meses1` FOREIGN KEY (`meses_idmes`) REFERENCES `meses` (`idmes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `fk_transacciones_dias1` FOREIGN KEY (`dias_iddia`) REFERENCES `dias` (`iddia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacciones_fuentes1` FOREIGN KEY (`fuentes_idfuente`) REFERENCES `fuentes` (`idfuente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
