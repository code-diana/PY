-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2022 a las 20:25:01
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `USUARI` varchar(20) NOT NULL,
  `PASSWD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`USUARI`, `PASSWD`) VALUES
('admin', '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes`
--

CREATE TABLE `alumnes` (
  `EMAIL` varchar(20) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `COGNOMS` varchar(20) NOT NULL,
  `EDAT` int(11) NOT NULL,
  `FOTO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnes`
--

INSERT INTO `alumnes` (`EMAIL`, `DNI`, `PASSWORD`, `NOM`, `COGNOMS`, `EDAT`, `FOTO`) VALUES
('a@a', '49457569W', '0cc175b9c0f1b6a831c399e269772661', 'Diana', 'Martos', 22, 'descarga.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `CODI` int(11) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `DESCRIPCIO` varchar(50) NOT NULL,
  `HORES` int(11) NOT NULL,
  `INICI` date NOT NULL,
  `FI` date NOT NULL,
  `DNIPROFESSOR` varchar(20) NOT NULL,
  `ACTIU` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`CODI`, `NOM`, `DESCRIPCIO`, `HORES`, `INICI`, `FI`, `DNIPROFESSOR`, `ACTIU`) VALUES
(333, 'Desarrollo web', 'Sense descripció', 160, '2022-11-20', '2022-12-03', '1234W', 1),
(444, 'Sistemas Informático', 'Sense descripció', 78, '2022-11-30', '2023-02-21', '1234W', 1),
(456, 'Programación', 'I & II', 100, '2022-10-22', '2022-08-17', '1234W', 1),
(588, 'Java', 'III', 320, '2022-10-20', '2023-04-22', '123A', 1),
(5436, 'PHP', 'IV', 30, '2022-11-17', '2022-09-02', '123A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `CODI` int(11) NOT NULL,
  `DNI_ALUMNE` varchar(20) NOT NULL,
  `NOTA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`CODI`, `DNI_ALUMNE`, `NOTA`) VALUES
(333, '49457569W', NULL),
(444, '324', NULL),
(444, '49457569W', NULL),
(456, '1111A', 7),
(456, '324', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professors`
--

CREATE TABLE `professors` (
  `DNI` varchar(20) NOT NULL,
  `CONTRASENYA` varchar(50) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `COGNOMS` varchar(20) NOT NULL,
  `TITOL` varchar(20) NOT NULL,
  `FOTO` varchar(50) NOT NULL,
  `ACTIU` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professors`
--

INSERT INTO `professors` (`DNI`, `CONTRASENYA`, `NOM`, `COGNOMS`, `TITOL`, `FOTO`, `ACTIU`) VALUES
('1234W', '0cc175b9c0f1b6a831c399e269772661', 'José', 'Sanchez', 'Técnico', 'descarga.jpg', 1),
('123A', '0cc175b9c0f1b6a831c399e269772661', 'Carlos', 'Redondo', 'Ingeniero', 'icono-perfil-avatar_188544-4755.webp', 1),
('49457S', 'e1671797c52e15f763380b45e841ec32', 'Sara', 'Ponts', 'Técnica Especialista', 'Captura.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`) USING BTREE,
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `EMAIL_2` (`EMAIL`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`CODI`),
  ADD KEY `cursos_ibfk_1` (`DNIPROFESSOR`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`CODI`,`DNI_ALUMNE`);

--
-- Indices de la tabla `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNIPROFESSOR`) REFERENCES `professors` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`CODI`) REFERENCES `cursos` (`CODI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
