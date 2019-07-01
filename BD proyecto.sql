-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2019 a las 02:43:29
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
-- Estructura de tabla para la tabla `comentario_foro`
--

CREATE TABLE `comentario_foro` (
  `IDCOMENTARIO` int(11) NOT NULL,
  `IDFORO` int(11) DEFAULT NULL,
  `IDUSUARIO` int(11) DEFAULT NULL,
  `NOMBREAUTORCOMENTARIO` varchar(45) DEFAULT NULL,
  `CONTENIDO` varchar(256) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `ARCHIVORUTA` varchar(256) DEFAULT NULL,
  `TIPOARCHIVO` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `IDFORO` int(11) NOT NULL,
  `NOMBREFORO` char(100) NOT NULL,
  `DESCRIPCIONFORO` text NOT NULL,
  `IDAUTORFORO` int(11) DEFAULT NULL,
  `NOMBREAUTORFORO` varchar(60) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `ARCHIVORUTA` varchar(256) DEFAULT NULL,
  `TIPOARCHIVO` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `ID` int(11) NOT NULL,
  `NOMBRES` char(100) NOT NULL,
  `APELLIDOS` char(100) NOT NULL,
  `CORREO` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`ID`, `NOMBRES`, `APELLIDOS`, `CORREO`) VALUES
(1, 'Angel Daniel', 'Yanez Aguiar', 'angel.yanez@epn.edu.ec'),
(2, 'Alexandra Vanessa', 'Macas Cevallos', 'alexandra.macas@epn.edu.ec'),
(3, 'Carol Lizeth', 'Ona Hinostroza', 'carol.ona@epn.edu.ec'),
(4, 'Ricardo Andres', 'Ortiz Villacres', 'ricardo.ortiz02@epn.edu.ec');

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
(1, '202400313', 'administrador', 'administrador', 'admin', 'admin', 'admin', NULL, 'activo');

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
-- Indices de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  ADD PRIMARY KEY (`IDCOMENTARIO`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`IDFORO`),
  ADD KEY `fk_foro_usuario_idx` (`IDAUTORFORO`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `IDCALIFICACION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `IDCARRERA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `IDCOMENTARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  MODIFY `IDCOMENTARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `IDFORO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `IDMATERIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `IDREPOSITORIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `fk_foro_usuario` FOREIGN KEY (`IDAUTORFORO`) REFERENCES `usuario` (`IDUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
