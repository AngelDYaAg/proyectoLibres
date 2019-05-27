-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2019 a las 01:32:46
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `IDCALIFICACION` int(11) NOT NULL,
  `NOTACALIFICACION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `IDCARRERA` int(11) NOT NULL,
  `NOMBRECARRERA` char(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`IDCARRERA`, `NOMBRECARRERA`) VALUES
(1, 'ingeniería en sistemas informáticos y de computación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `IDCOMENTARIO` int(11) NOT NULL,
  `IDUSUARIO` int(11) DEFAULT NULL,
  `IDFORO` int(11) DEFAULT NULL,
  `DESCRIPCIONCOMENTARIO` char(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `IDFORO` int(11) NOT NULL,
  `NOMBREFORO` char(100) NOT NULL,
  `DESCRIPCIONFORO` char(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `IDMATERIA` int(11) NOT NULL,
  `IDCARRERA` int(11) DEFAULT NULL,
  `NOMBREMATERIA` char(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`IDMATERIA`, `IDCARRERA`, `NOMBREMATERIA`) VALUES
(1, 1, 'aplicaciones en ambientes libres'),
(2, 1, 'programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE `recurso` (
  `IDREPOSITORIO` int(11) NOT NULL,
  `IDUSUARIO` int(11) DEFAULT NULL,
  `IDCALIFICACION` int(11) DEFAULT NULL,
  `IDMATERIA` int(11) DEFAULT NULL,
  `NOMBRERECURSO` char(100) NOT NULL,
  `DESCRIPCIONRECURSO` char(250) NOT NULL,
  `TIPORECURSO` char(100) NOT NULL,
  `AUTORRECURSO` char(100) NOT NULL,
  `INSTAUTORRECURSO` char(100) DEFAULT NULL,
  `FECHACREACIONRECURSO` date NOT NULL,
  `PALABRASCLAVERECURSO` char(100) DEFAULT NULL,
  `ESTADORECURSO` char(50) DEFAULT NULL,
  `RUTARECURSO` char(250) DEFAULT NULL,
  `LINKRECURSO` char(250) DEFAULT NULL,
  `TIPOARCHIVO` char(50) DEFAULT NULL,
  `SIZERECURSO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`IDREPOSITORIO`, `IDUSUARIO`, `IDCALIFICACION`, `IDMATERIA`, `NOMBRERECURSO`, `DESCRIPCIONRECURSO`, `TIPORECURSO`, `AUTORRECURSO`, `INSTAUTORRECURSO`, `FECHACREACIONRECURSO`, `PALABRASCLAVERECURSO`, `ESTADORECURSO`, `RUTARECURSO`, `LINKRECURSO`, `TIPOARCHIVO`, `SIZERECURSO`) VALUES
(1, 2, NULL, 1, 'logo EPN', 'logotipo EPN', 'archivo', 'Anonimo', 'EPN', '2019-05-27', 'logo', 'publico', 'archivos/AngelDanielYanezAguiar/EPN_logo_big.png', 'NULL', 'image/png', 58685);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDUSUARIO` int(11) NOT NULL,
  `CEDULAUSUARIO` decimal(10,0) NOT NULL,
  `NOMBRESUSUARIO` char(100) NOT NULL,
  `APELLIDOSUSUARIO` char(100) NOT NULL,
  `TIPOUSUARIO` char(50) NOT NULL,
  `USER` char(100) DEFAULT NULL,
  `PASSWORD` char(100) DEFAULT NULL,
  `RUTAUSUARIO` char(250) DEFAULT NULL,
  `ESTADOUSUARIO` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUSUARIO`, `CEDULAUSUARIO`, `NOMBRESUSUARIO`, `APELLIDOSUSUARIO`, `TIPOUSUARIO`, `USER`, `PASSWORD`, `RUTAUSUARIO`, `ESTADOUSUARIO`) VALUES
(1, '202400313', 'administrador', 'administrador', 'admin', 'admin', 'admin', NULL, 'activo'),
(2, '202400313', 'Angel Daniel', 'Yanez Aguiar', 'estudiante', 'AngelDanielYanezAguiar', '1996', 'archivos/AngelDanielYanezAguiar', 'activo'),
(3, '1721905006', 'Alexandra Vanessa', 'Macas Cevallos', 'profesor', 'AlexandraVanessaMacasCevallos', '1721905006', 'archivos/AlexandraVanessaMacasCevallos', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`IDCALIFICACION`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`IDCARRERA`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`IDCOMENTARIO`),
  ADD KEY `FK_RELATIONSHIP_5` (`IDFORO`),
  ADD KEY `FK_RELATIONSHIP_6` (`IDUSUARIO`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`IDFORO`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`IDMATERIA`),
  ADD KEY `FK_RELATIONSHIP_4` (`IDCARRERA`);

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`IDREPOSITORIO`),
  ADD KEY `FK_RELATIONSHIP_1` (`IDUSUARIO`),
  ADD KEY `FK_RELATIONSHIP_2` (`IDCALIFICACION`),
  ADD KEY `FK_RELATIONSHIP_3` (`IDMATERIA`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUSUARIO`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`IDFORO`) REFERENCES `foro` (`IDFORO`),
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`IDUSUARIO`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`IDCARRERA`) REFERENCES `carrera` (`IDCARRERA`);

--
-- Filtros para la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`IDUSUARIO`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`IDCALIFICACION`) REFERENCES `calificacion` (`IDCALIFICACION`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`IDMATERIA`) REFERENCES `materia` (`IDMATERIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
