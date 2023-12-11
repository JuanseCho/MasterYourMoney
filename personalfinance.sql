-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 16:50:12
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
  `montoMeta_ahorro` int(11) DEFAULT NULL,
  `usuario_Ahorro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ahorro`
--

INSERT INTO `ahorro` (`idAhorro`, `fecha_ahorro`, `descripcion_ahorro`, `montoInicial_ahorro`, `montoActual_ahorro`, `montoMeta_ahorro`, `usuario_Ahorro`) VALUES
(10, '2023-12-06', 'para el viaje', 300000, 309000, 1000000, 0),
(11, '2023-12-11', 'Moto', 200000, 200000, 4000000, 10),
(12, '2023-12-11', 'Computador', 200000, 200000, 3000000, 10),
(13, '2023-12-11', 'Monitor', 100000, 120000, 1000000, 11),
(14, '2023-12-11', 'Viajar', 200000, 200000, 250000, 13);

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
(11, 432655, 'Sennova', 18, '2023-12-06', 5),
(13, 550000, 'Salario', 18, '2023-12-11', 10),
(14, 350000, 'SENNOVA', 18, '2023-12-11', 10),
(15, 4950000, 'Lo de mi bolsillo', 19, '2023-12-11', 11),
(16, 280000, 'algo', 19, '2023-12-11', 11),
(17, 530000, 'Monitorias', 20, '2023-12-11', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capital_has_ahorro`
--

CREATE TABLE `capital_has_ahorro` (
  `idRegAhorro` int(11) NOT NULL,
  `capital_idCapital` int(11) NOT NULL,
  `ahorro_idAhorro` int(11) NOT NULL,
  `fecha_regAhorro` date DEFAULT NULL,
  `hora_regAhorro` time DEFAULT NULL,
  `monto_regAhorro` int(11) DEFAULT NULL,
  `usuario_regAhorro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `capital_has_ahorro`
--

INSERT INTO `capital_has_ahorro` (`idRegAhorro`, `capital_idCapital`, `ahorro_idAhorro`, `fecha_regAhorro`, `hora_regAhorro`, `monto_regAhorro`, `usuario_regAhorro`) VALUES
(1, 11, 10, '2023-12-06', '11:46:54', 9000, 5),
(4, 16, 13, '2023-12-11', '10:22:09', 20000, 11);

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

--
-- Volcado de datos para la tabla `capital_has_presupuestos`
--

INSERT INTO `capital_has_presupuestos` (`idCapital_has_presupuestoscol`, `capital_idCapital`, `presupuestos_idPresupuesto`, `fecha`, `valorDeducido`) VALUES
(8, 11, 3, '2023-12-06', 7000),
(9, 13, 4, '2023-12-11', 500000),
(10, 13, 5, '2023-12-11', 200000),
(11, 14, 4, '2023-12-11', 150000),
(12, 15, 6, '2023-12-11', 50000),
(13, 16, 6, '2023-12-11', 200000),
(14, 17, 7, '2023-12-11', 150000);

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
(18, 'efectivo'),
(19, 'nequi'),
(20, 'Tarjeta debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idGasto` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `descripcionGasto` text NOT NULL,
  `monto` int(11) NOT NULL,
  `usuario_gasto` int(11) NOT NULL,
  `presupuesto` varchar(45) DEFAULT NULL,
  `idPresupuesto` int(11) DEFAULT NULL,
  `formapago_idFormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idGasto`, `hora`, `fecha`, `descripcionGasto`, `monto`, `usuario_gasto`, `presupuesto`, `idPresupuesto`, `formapago_idFormaPago`) VALUES
(13, '12:19:27', '2023-12-06', 'galletas', 3000, 5, 'Alimentacion', 3, 18),
(15, '09:09:33', '2023-12-11', 'Almuerzo', 15000, 10, NULL, 4, 18),
(18, '10:19:40', '2023-12-11', 'Gasolina', 50000, 11, NULL, 6, 19),
(19, '10:25:04', '2023-12-11', 'plata', 42000, 13, NULL, 7, 20);

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
  `capital_idCapital` int(11) NOT NULL,
  `usuario_ingreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`idingreso`, `fecha_ingreso`, `hora_ingreso`, `monto_ingreso`, `formapago_idFormaPago`, `capital_idCapital`, `usuario_ingreso`) VALUES
(10, '2023-12-06', '10:45:22', 89, 18, 11, 0),
(12, '2023-12-06', '12:12:02', 70000, 18, 11, 5),
(13, '2023-12-07', '10:46:05', 34000, 18, 11, 5),
(14, '2023-12-11', '08:11:49', 250000, 18, 13, 10),
(16, '2023-12-11', '10:25:04', 100000, 20, 17, 13);

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

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`idPresupuesto`, `descripcionPresupuesto`, `ValorAsignado`, `montoActual`, `usuario`) VALUES
(3, 'Alimentacion', '7000', '4000', 5),
(4, 'Alimentación', '650000', '635000', 10),
(5, 'Transporte', '200000', '200000', 10),
(6, 'Moto', '250000', '200000', 11),
(7, 'Ram para PC', '150000', '108000', 13);

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
  `contrasena` varchar(200) NOT NULL,
  `imgPerfil_URL` varchar(200) NOT NULL DEFAULT 'src/Vista/img/DefaultAvatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombres`, `apellidos`, `email`, `telefono`, `contrasena`, `imgPerfil_URL`) VALUES
(5, 'Sebastian', 'Choconta', 'juansechoconta@gmail.com', '3209797846', '49359c1b093e8ae27544ade32d029c0ae248414cb24387dd684daaa0e8e3648d8e09b9ece05b08d42bff539e50b79d8b3697f2f8bbce20b555e0c14ca41bdd8f', 'src/Vista/img/usuarios/raze icon valorant.jpeg'),
(6, 'camila', 'Vargas ', 'camilaV@gmail.com', '3114035552', 'c6113d386edd46b2ff44e4eab60aa73a8caf87ba83e9aac45e32c00ca6aa8e169056726c0ce93a7da786ce82bd23fb29fc8c8768ff66921a0f8930ac07e64606', 'src/Vista/img/usuarios/Fluffy Neon.jpeg'),
(9, 'juan', 'Choconta', 'js.chocont@yahoo.com', '3177035552', '08c02b725e5850a4f6470dece21efac8b196fe2c071176d75fb1e0656586697a203a4d0d0a1d7f2da0e0bb068abc93c479d84e71078e9e5310a50d09c8639192', 'src/Vista/img/usuarios/jghjkjpg.jpg'),
(10, 'David', 'Sanabria', 'david@gmail.com', '3105343292', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'src/Vista/img/DefaultAvatar.png'),
(11, 'Duvan', 'Becerra', 'yesidrodriguez305@gmail.com', '3114689644', '5a4a885216241be06f30e31265a3df45d6c0d99f4e7a83bf44779fae27e4a1dc178490a4179905795fc40d3540b2730c0b770cea60dc32b2341b6a4a1ea71451', 'src/Vista/img/DefaultAvatar.png'),
(12, 'Diego', 'Cristancho', 'da111@gmail.com', '12345', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'src/Vista/img/DefaultAvatar.png'),
(13, 'Ronald Humberto', 'Benavides Jaimes', 'humberto.benavides2003@gmail.com', '3143822319', '108e6081edd1f6deb600550eaec629f5d4ea7dd668d36ed90019e80611897543ba2c674b2cc292c291c1afa75fa1d0fd00b324e9105a8225960454affa35b947', 'src/Vista/img/DefaultAvatar.png'),
(14, 'Andres', 'Perez', 'andres@gmail.com', '3112569858', '690437692d902cfd23005bda16631d83644899e78dc0a489da6dca3cb9f9c0cdcd9dd533bc59102dc90155223df777672328c9149354de239f48c58f0a1d44a6', 'src/Vista/img/DefaultAvatar.png');

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
  ADD PRIMARY KEY (`idRegAhorro`,`capital_idCapital`,`ahorro_idAhorro`),
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
  MODIFY `idAhorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `capital`
--
ALTER TABLE `capital`
  MODIFY `idCapital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `capital_has_ahorro`
--
ALTER TABLE `capital_has_ahorro`
  MODIFY `idRegAhorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `capital_has_presupuestos`
--
ALTER TABLE `capital_has_presupuestos`
  MODIFY `idCapital_has_presupuestoscol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `idFormaPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
