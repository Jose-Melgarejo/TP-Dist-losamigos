-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 26, 2018 at 01:23 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `losamigos`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `TraerCanchasPorFilial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `TraerCanchasPorFilial` (IN `idFilial` INT)  BEGIN
 SELECT fc.*,c.deporte, c.tipo 
 FROM filial f
 INNER JOIN filial_cancha fc
 ON f.id = fc.filial_id
 INNER JOIN cancha c
 ON c.id = fc.cancha_id
 WHERE f.id = idFilial
 ORDER BY c.deporte;
 END$$

DROP PROCEDURE IF EXISTS `TraerFiliales`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `TraerFiliales` ()  BEGIN
    SELECT * FROM filial;
    END$$

DROP PROCEDURE IF EXISTS `TraerTurnosPorFilialCancha`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `TraerTurnosPorFilialCancha` (IN `idFilialCancha` INT, IN `fecha` DATE)  BEGIN
 SELECT * 
 FROM turno
 WHERE filial_cancha_id = idFilialCancha
 AND DATE(hora_inicio) = fecha
 AND estado="activo"
 ORDER BY hora_inicio;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cancha`
--

DROP TABLE IF EXISTS `cancha`;
CREATE TABLE IF NOT EXISTS `cancha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deporte` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancha`
--

INSERT INTO `cancha` (`id`, `deporte`, `tipo`) VALUES
(1, 'Tenis', 'Polvo de Ladrillo'),
(2, 'Tenis', 'Césped'),
(3, 'Tenis', 'Cemento'),
(4, 'Fútbol', 'Césped sintético'),
(5, 'Fútbol', 'Cemento'),
(6, 'Fútbol', 'Arena'),
(7, 'Básquet', 'Madera'),
(8, 'Básquet', 'Cemento');

-- --------------------------------------------------------

--
-- Table structure for table `filial`
--

DROP TABLE IF EXISTS `filial`;
CREATE TABLE IF NOT EXISTS `filial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `dia_mantenimiento` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filial`
--

INSERT INTO `filial` (`id`, `direccion`, `nombre`, `dia_mantenimiento`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Av. 25 de Mayo', 'Plaza Fútbol', 4, '15:00:00', '20:00:00'),
(2, 'Independencia 2473', 'Los Pinos', 2, '10:00:00', '23:00:00'),
(3, 'Av. 9 de Julio y Av. Independencia', 'Casa Matriz', 1, '08:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `filial_cancha`
--

DROP TABLE IF EXISTS `filial_cancha`;
CREATE TABLE IF NOT EXISTS `filial_cancha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filial_id` int(11) NOT NULL,
  `cancha_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_filial_has_cancha_cancha1_idx` (`cancha_id`),
  KEY `fk_filial_has_cancha_filial1_idx` (`filial_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filial_cancha`
--

INSERT INTO `filial_cancha` (`id`, `filial_id`, `cancha_id`, `numero`) VALUES
(1, 3, 1, 1),
(2, 3, 2, 1),
(3, 3, 3, 1),
(4, 3, 4, 1),
(5, 3, 5, 1),
(6, 3, 6, 1),
(7, 3, 7, 1),
(8, 3, 8, 1),
(9, 2, 1, 1),
(10, 2, 1, 2),
(11, 2, 1, 3),
(12, 2, 4, 1),
(13, 2, 4, 2),
(14, 1, 4, 1),
(15, 1, 4, 2),
(16, 1, 5, 1),
(17, 1, 5, 2),
(18, 1, 6, 1),
(19, 1, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `socio`
--

DROP TABLE IF EXISTS `socio`;
CREATE TABLE IF NOT EXISTS `socio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `mail` varchar(90) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socio`
--

INSERT INTO `socio` (`id`, `nombre`, `apellido`, `direccion`, `telefono`, `mail`, `clave`, `fecha_registro`) VALUES
(1, 'Javier', 'Vescio', NULL, NULL, 'javiervescio@gmail.com', '123456', '2018-09-22 16:51:20'),
(2, 'Jose', 'Melgarejo', NULL, NULL, 'jose.melgarejo@gmail.com', '123456', '2018-09-25 16:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `socio_id` int(11) NOT NULL,
  `filial_cancha_id` int(11) NOT NULL,
  `hora_inicio` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_turno_socio_idx` (`socio_id`),
  KEY `fk_turno_filial_cancha1_idx` (`filial_cancha_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turno`
--

INSERT INTO `turno` (`id`, `socio_id`, `filial_cancha_id`, `hora_inicio`, `estado`) VALUES
(16, 1, 4, '2018-09-26 11:00:00', 'activo'),
(15, 2, 4, '2018-09-26 10:00:00', 'activo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
