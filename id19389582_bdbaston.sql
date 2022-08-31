-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-08-2022 a las 03:39:02
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id19389582_bdbaston`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechanac` date NOT NULL,
  `telcasa` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `foto` longblob NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `cvivienda` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `folio`, `nombre`, `apellido`, `fechanac`, `telcasa`, `celular`, `foto`, `direccion`, `cvivienda`) VALUES
(4, 333333, 'Juan Jose', 'López Montalvo', '2001-07-13', '9215667881', '9215667881', 0x6669726d61206a75616e2e6a706567, 'Allende num.113 coatzacoalcos', 'en callejon'),
(6, 925441, 'Miroslava', 'Santiago Luis', '2002-05-19', '9212480359', '9213032006', 0x666f746f20637572726963756c756d2e6a706567, 'Cuautemoc no.112 col. las palomas Ixhuatlan del Sureste,Veracruz', 'subiendo bloquera a 200mts, callejon casa morada con un pino'),
(7, 123456, 'Galilea', 'Santiago Luis', '2004-04-14', '9212480359', '9221757391', 0x45535445205745204c494e444f2e6a706567, 'Av. Universidad Tecnológica Lote Grande 1, 96360 Nanchital, Ver.', 'subiendo bloquera a 200mts, callejon casa morada con un pino'),
(8, 456487, 'Miros', 'Santiago Luis', '2002-05-19', '9213032006', '9213032006', 0x666f746f20637572726963756c756d2e6a706567, 'Av. Universidad Tecnológica Lote Grande 1, 96360 Nanchital, Ver.', 'en callejon'),
(9, 956334, 'Armando', 'Hernandez Perez', '2002-04-05', '9212858325', '9212858325', 0x706572736f6e614c6f67696e322e6a7067, 'desconocida', 'desconocida'),
(10, 0, 'vania citlaly ', 'hau cordero ', '2002-05-23', '9232313316', '9232063090', 0x536e6170636861742d3135353139383836362e6a7067, 'adolfo lopez mateo colonia tulipanes ', 'casa azul, de portones blancos  ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personacontacto`
--

CREATE TABLE `personacontacto` (
  `idcontacto` int(11) NOT NULL,
  `folio` int(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `lazofamiliar` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cvivienda` varchar(200) NOT NULL,
  `idpersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personacontacto`
--

INSERT INTO `personacontacto` (`idcontacto`, `folio`, `nombre`, `apellidos`, `celular`, `lazofamiliar`, `direccion`, `cvivienda`, `idpersona`) VALUES
(7, 957223, 'Pedro', 'Santiago Luis', '9212843437', 'padre', 'Cuautemoc no.112 col. las palomas Ixhuatlan del Sureste,Veracruz', 'subiendo bloquera a 200mts, callejon casa morada con un pino', 4),
(8, 936745, 'Angelica', 'Luis Cruz', '9211601313', 'madre', 'Cuautemoc no.112 col. las palomas Ixhuatlan del Sureste,Veracruz', 'subiendo bloquera a 200mts, callejon casa morada con un pino', 4),
(10, 222222, 'Miroslava', 'Santiago Luis', '9212480359', 'hermana', 'Av. Universidad Tecnológica Lote Grande 1, 96360 Nanchital, Ver.', 'casa verde en esquina', 4),
(11, 0, 'Rosalia', 'Cordero Garcia', '9232013316', 'Madre', 'adolfo lopez mateo colonia tulipanes', 'casa azul, de portones blancos', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipousuario` int(11) NOT NULL,
  `tipousuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipousuario`, `tipousuario`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombreusuario` varchar(20) NOT NULL,
  `contrasena` text NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombreusuario`, `contrasena`, `idpersona`, `idtipousuario`) VALUES
(3, 'miroslava20', 'a341e1df37c54e837147a1573bec4e7b4e857606', 6, 1),
(4, 'galilea', 'a80d397eec98dc82199af4af0eae08c069ae9a0d', 7, 2),
(5, 'miros', '7c4a8d09ca3762af61e59520943dc26494f8941b', 8, 1),
(6, 'armando', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 9, 1),
(7, 'vanihau', '7721cfa3ab9c253a1c1c6ca141c749fd9f3b4fb2', 10, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `personacontacto`
--
ALTER TABLE `personacontacto`
  ADD PRIMARY KEY (`idcontacto`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personacontacto`
--
ALTER TABLE `personacontacto`
  MODIFY `idcontacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
