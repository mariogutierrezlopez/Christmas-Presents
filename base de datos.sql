-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para usuarios
CREATE DATABASE IF NOT EXISTS `usuarios` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `usuarios`;

-- Volcando estructura para tabla usuarios.data_users
CREATE TABLE IF NOT EXISTS `data_users` (
  `nombre` varchar(32) NOT NULL,
  `apellidos` varchar(32) NOT NULL,
  `usuario` varchar(16) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `regalo1` char(128) DEFAULT NULL,
  `regalo2` char(128) DEFAULT NULL,
  `regalo3` char(128) DEFAULT NULL,
  `carta` char(255) DEFAULT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla usuarios.data_users: ~6 rows (aproximadamente)
REPLACE INTO `data_users` (`nombre`, `apellidos`, `usuario`, `edad`, `direccion`, `password`, `tipo`, `regalo1`, `regalo2`, `regalo3`, `carta`) VALUES
	('Baltasar', '', 'baltasar', 2000, 'Arabia', '$2y$10$HPMXm2zu8oCPrzqrTx6vyeMEM/Mhlb3EST.odxNIs2Clj7jWwuIOu', 2, NULL, NULL, NULL, NULL),
	('Carla', 'Sánchez', 'carla', 8, 'Av. San Martín de Valdeiglesias, 22, 28922 Alcorcón, Madrid', '$2y$10$lGlonWbkA7t4lQSTr26Kzuz2K.eoBAx1oSL.7/WLt8kV3nCvUoeHm', 1, 'silla nueva', 'play 5', 'Entradas cine', ''),
	('Gaspar', '', 'gaspar', 2000, 'India', '$2y$10$7W3U.a7QEsnCoMg7iFAeOOR/kg40/Mur4fMRFvdzJLzXzyOHqeU6O', 2, NULL, NULL, NULL, NULL),
	('Mario', 'Gutiérrez', 'mario', 10, 'C. Tajo, s/n, 28670 Villaviciosa de Odón, Madrid', '$2y$10$76.giu4RMPxZzoAPK2a5g.kPQqLxI1FpKkIRLMolj9AIzTvI4gGAC', 1, 'Play Station 5', 'Consola', 'Mochila', 'Queridos Reyes Magos, anhelo felicidad, sueños cumplidos y un año lleno de amor. Que la magia ilumine cada corazón. Gracias por su bondad. ?'),
	('Melchor', '', 'melchor', 2000, 'Persia', '$2y$10$.wNcwMGVFC7wOcTBIPssDe6fJHrFXziSJM6IFucQgVUS4hocxZ2Ka', 2, NULL, NULL, NULL, NULL),
	('Pepe', 'González', 'pepe', 8, 'C. Maximino Miyar, 3, 33300 Villaviciosa, Asturias', '$2y$10$hRcByRIezNT6nIfKE7HsSucdZ29GafPVBMPPqiolhyVPfC4GkYxZS', 1, 'Libro', 'Cargador', 'Airpods', 'Queridos Reyes Magos, deseo libros, alegría y prosperidad. Que la esperanza guíe cada paso. Gracias por sus regalos y magia eterna.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
