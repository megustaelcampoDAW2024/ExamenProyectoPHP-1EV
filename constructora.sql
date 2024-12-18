-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: constructora
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `num_fiscal_cliente` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apell` varchar(255) NOT NULL,
  `tlf` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `poblacion` varchar(255) DEFAULT NULL,
  `codigo_post` varchar(5) DEFAULT NULL,
  `provincia` char(2) DEFAULT NULL,
  `estado` enum('B','P','R','C') DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `operario_id` int(11) DEFAULT NULL,
  `fecha_realizacion` date DEFAULT NULL,
  `anotaciones_anteriores` text DEFAULT NULL,
  `anotaciones_posteriores` text DEFAULT NULL,
  `fich_resu` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `provincia` (`provincia`),
  KEY `operario_id` (`operario_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`provincia`) REFERENCES `tbl_provincias` (`cod`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`operario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'12345678Z','Juan','P├®rez Fernandez','+34 623456789','Reparar la puerta','juan.perez@example.com','Calle Mayor, 1','Madrid','28001','28','P','2024-11-12',3,'2024-11-15','La puerta est├í rota','La puerta ha sido reparada',NULL,NULL),(2,'12345678Z','Ana','Garc├¡a Gutierrez','+34 687654321','Instalar una ventana','ana.garcia@example.com','Calle Menor, 2','Barcelona','08001','08','R','2024-11-12',4,'2024-11-15','La ventana est├í vieja','La ventana ha sido instalada',NULL,NULL),(3,'12345678Z','Carlos','Mart├¡nez L├│pez','+34 612345678','Pintar la fachada','carlos.martinez@example.com','Calle Alta, 3','Valencia','46001','46','B','2024-11-10',5,'2024-11-20','La fachada necesita pintura','La fachada ha sido pintada',NULL,NULL),(4,'12345678Z','Luc├¡a','Hern├índez Ruiz','+34 698765432','Reparar el tejado','lucia.hernandez@example.com','Calle Baja, 4','Sevilla','41001','41','C','2024-11-11',6,'2024-11-18','El tejado tiene goteras','El tejado ha sido reparado',NULL,NULL),(5,'12345678Z','Miguel','S├ínchez G├│mez','+34 677654321','Cambiar las ventanas','miguel.sanchez@example.com','Calle Nueva, 5','Granada','18001','18','P','2024-11-13',7,'2024-11-19','Las ventanas est├ín viejas','Las ventanas han sido cambiadas',NULL,NULL),(6,'12345678Z','Mar├¡a','L├│pez Fern├índez','+34 665432198','Reparar la puerta','maria.lopez@example.com','Calle Vieja, 6','Madrid','28001','28','R','2024-11-14',3,'2024-11-20','La puerta est├í rota','La puerta ha sido reparada',NULL,NULL),(7,'12345678Z','Jos├®','Garc├¡a Mart├¡nez','+34 654321987','Instalar aire acondicionado','jose.garcia@example.com','Calle Ancha, 7','Barcelona','08001','08','B','2024-11-15',4,'2024-11-22','No hay aire acondicionado','El aire acondicionado ha sido instalado',NULL,NULL),(8,'12345678Z','Laura','Mart├¡nez S├ínchez','+34 643219876','Pintar la casa','laura.martinez@example.com','Calle Estrecha, 8','Valencia','46001','46','C','2024-11-16',5,'2024-11-23','La casa necesita pintura','La casa ha sido pintada',NULL,NULL),(9,'12345678Z','David','Hern├índez L├│pez','+34 632198765','Reparar el ba├▒o','david.hernandez@example.com','Calle Larga, 9','Sevilla','41001','41','P','2024-11-17',6,'2024-11-24','El ba├▒o tiene fugas','El ba├▒o ha sido reparado',NULL,NULL),(10,'12345678Z','Sara','G├│mez Ruiz','+34 621987654','Cambiar el suelo','sara.gomez@example.com','Calle Cortada, 10','Granada','18001','18','R','2024-11-18',7,'2024-11-25','El suelo est├í da├▒ado','El suelo ha sido cambiado',NULL,NULL),(11,'12345678Z','Pedro','Gonz├ílez P├®rez','+34 612345678','Reparar la cocina','pedro.gonzalez@example.com','Calle Falsa, 123','Madrid','28002','28','B','2024-11-19',3,'2024-11-22','La cocina est├í da├▒ada','La cocina ha sido reparada',NULL,NULL),(12,'12345678Z','Marta','L├│pez Garc├¡a','+34 623456789','Instalar calefacci├│n','marta.lopez@example.com','Avenida Siempre Viva, 742','Barcelona','08002','08','C','2024-11-20',4,'2024-11-23','No hay calefacci├│n','La calefacci├│n ha sido instalada',NULL,NULL),(13,'12345678Z','Luis','Mart├¡n S├ínchez','+34 634567890','Pintar el sal├│n','luis.martin@example.com','Plaza Mayor, 5','Valencia','46002','46','P','2024-11-21',5,'2024-11-24','El sal├│n necesita pintura','El sal├│n ha sido pintado',NULL,NULL),(14,'12345678Z','Elena','Hern├índez Ruiz','+34 645678901','Reparar el techo','elena.hernandez@example.com','Calle del Sol, 6','Sevilla','41002','41','R','2024-11-22',6,'2024-11-25','El techo tiene goteras','El techo ha sido reparado',NULL,NULL),(15,'12345678Z','Carlos','S├ínchez G├│mez','+34 656789012','Cambiar las puertas','carlos.sanchez@example.com','Calle Luna, 7','Granada','18002','18','B','2024-11-23',7,'2024-11-26','Las puertas est├ín viejas','Las puertas han sido cambiadas',NULL,NULL),(16,'12345678Z','Laura','Garc├¡a Fern├índez','+34 667890123','Reparar el jard├¡n','laura.garcia@example.com','Calle Estrella, 8','Madrid','28003','28','C','2024-11-24',3,'2024-11-27','El jard├¡n est├í descuidado','El jard├¡n ha sido reparado',NULL,NULL),(17,'12345678Z','David','Mart├¡nez L├│pez','+34 678901234','Instalar piscina','david.martinez@example.com','Calle Cometa, 9','Barcelona','08003','08','P','2024-11-25',4,'2024-11-28','No hay piscina','La piscina ha sido instalada',NULL,NULL),(18,'12345678Z','Ana','P├®rez Gonz├ílez','+34 689012345','Pintar la fachada','ana.perez@example.com','Calle Meteoro, 10','Valencia','46003','46','R','2024-11-26',5,'2024-11-29','La fachada necesita pintura','La fachada ha sido pintada',NULL,NULL),(19,'12345678Z','Jos├®','L├│pez Mart├¡nez','+34 690123456','Reparar el ba├▒o','jose.lopez@example.com','Calle Estrella, 11','Sevilla','41003','41','B','2024-11-27',6,'2024-11-30','El ba├▒o tiene fugas','El ba├▒o ha sido reparado',NULL,NULL),(20,'12345678Z','Mar├¡a','Gonz├ílez S├ínchez','+34 601234567','Cambiar el suelo','maria.gonzalez@example.com','Calle Sol, 12','Granada','18003','18','C','2024-11-28',7,'2024-12-01','El suelo est├í da├▒ado','El suelo ha sido cambiado',NULL,NULL),(21,'12345678Z','Miguel','Hern├índez P├®rez','+34 612345678','Reparar la puerta','miguel.hernandez@example.com','Calle Mayor, 13','Madrid','28004','28','P','2024-11-29',3,'2024-12-02','La puerta est├í rota','La puerta ha sido reparada',NULL,NULL),(22,'12345678Z','Luc├¡a','Garc├¡a L├│pez','+34 623456789','Instalar una ventana','lucia.garcia@example.com','Calle Menor, 14','Barcelona','08004','08','R','2024-11-30',4,'2024-12-03','La ventana est├í vieja','La ventana ha sido instalada',NULL,NULL),(23,'12345678Z','Carlos','Mart├¡nez S├ínchez','+34 634567890','Pintar la fachada','carlos.martinez@example.com','Calle Alta, 15','Valencia','46004','46','B','2024-12-01',5,'2024-12-04','La fachada necesita pintura','La fachada ha sido pintada',NULL,NULL),(24,'12345678Z','Ana','L├│pez Fern├índez','+34 645678901','Reparar el tejado','ana.lopez@example.com','Calle Baja, 16','Sevilla','41004','41','C','2024-12-02',6,'2024-12-05','El tejado tiene goteras','El tejado ha sido reparado',NULL,NULL),(25,'12345678Z','David','S├ínchez G├│mez','+34 656789012','Cambiar las ventanas','david.sanchez@example.com','Calle Nueva, 17','Granada','18004','18','P','2024-12-03',7,'2024-12-06','Las ventanas est├ín viejas','Las ventanas han sido cambiadas',NULL,NULL),(26,'12345678Z','Mar├¡a','Garc├¡a Mart├¡nez','+34 667890123','Reparar la puerta','maria.garcia@example.com','Calle Vieja, 18','Madrid','28005','28','R','2024-12-04',3,'2024-12-07','La puerta est├í rota','La puerta ha sido reparada',NULL,NULL),(27,'12345678Z','Jos├®','Mart├¡nez L├│pez','+34 678901234','Instalar aire acondicionado','jose.martinez@example.com','Calle Ancha, 19','Barcelona','08005','08','B','2024-12-05',4,'2024-12-08','No hay aire acondicionado','El aire acondicionado ha sido instalado',NULL,NULL),(28,'12345678Z','Laura','S├ínchez Fern├índez','+34 689012345','Pintar la casa','laura.sanchez@example.com','Calle Estrecha, 20','Valencia','46005','46','C','2024-12-06',5,'2024-12-09','La casa necesita pintura','La casa ha sido pintada',NULL,NULL),(29,'12345678Z','Miguel','Hern├índez Ruiz','+34 690123456','Reparar el ba├▒o','miguel.hernandez@example.com','Calle Larga, 21','Sevilla','41005','41','P','2024-12-07',6,'2024-12-10','El ba├▒o tiene fugas','El ba├▒o ha sido reparado',NULL,NULL),(30,'12345678Z','Sara','G├│mez S├ínchez','+34 601234567','Cambiar el suelo','sara.gomez@example.com','Calle Cortada, 22','Granada','18005','18','R','2024-12-08',7,'2024-12-11','El suelo est├í da├▒ado','El suelo ha sido cambiado','1733817277_Ejercicio con Media Queries.pdf',NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comunidadesautonomas`
--

DROP TABLE IF EXISTS `tbl_comunidadesautonomas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comunidadesautonomas` (
  `id` tinyint(4) NOT NULL DEFAULT 0,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Afiliados de alta';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comunidadesautonomas`
--

LOCK TABLES `tbl_comunidadesautonomas` WRITE;
/*!40000 ALTER TABLE `tbl_comunidadesautonomas` DISABLE KEYS */;
INSERT INTO `tbl_comunidadesautonomas` VALUES (1,'Andaluc├¡a'),(2,'Arag├│n'),(3,'Asturias (Principado de)'),(4,'Balears (IIles)'),(5,'Canarias'),(6,'Cantabria'),(8,'Castilla y Le├│n'),(7,'Castilla-La Mancha'),(9,'Catalu├▒a'),(18,'Ceuta'),(10,'Comunidad Valenciana'),(11,'Extremadura'),(12,'Galicia'),(13,'Madrid (Comunidad de)'),(19,'Melilla'),(14,'Murcia (Regi├│n de)'),(15,'Navarra (Comunidad Foral de)'),(16,'Pa├¡s Vasco'),(17,'Rioja (La)');
/*!40000 ALTER TABLE `tbl_comunidadesautonomas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_provincias`
--

DROP TABLE IF EXISTS `tbl_provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_provincias` (
  `cod` char(2) NOT NULL COMMENT 'C├│digo de la provincia de dos digitos',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) NOT NULL COMMENT 'C├│digo de la comunidad a la que pertenece',
  PRIMARY KEY (`cod`),
  KEY `nombre` (`nombre`),
  KEY `FK_ComunidadAutonomaProv` (`comunidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Provincias de espa├▒a; 99 para seleccionar a Nacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_provincias`
--

LOCK TABLES `tbl_provincias` WRITE;
/*!40000 ALTER TABLE `tbl_provincias` DISABLE KEYS */;
INSERT INTO `tbl_provincias` VALUES ('01','Alava',16),('02','Albacete',7),('03','Alicante',10),('04','Almera',1),('05','Avila',8),('06','Badajoz',11),('07','Balears (Illes)',4),('08','Barcelona',9),('09','Burgos',8),('10','C├íceres',11),('11','C├ídiz',1),('12','Castell├│n',10),('13','Ciudad Real',7),('14','C├│rdoba',1),('15','Coru├▒a (A)',12),('16','Cuenca',7),('17','Girona',9),('18','Granada',1),('19','Guadalajara',7),('20','Guipzcoa',16),('21','Huelva',1),('22','Huesca',2),('23','Ja├®n',1),('24','Le├│n',8),('25','Lleida',9),('26','Rioja (La)',17),('27','Lugo',12),('28','Madrid',13),('29','M├ílaga',1),('30','Murcia',14),('31','Navarra',15),('32','Ourense',12),('33','Asturias',3),('34','Palencia',8),('35','Palmas (Las)',5),('36','Pontevedra',12),('37','Salamanca',8),('38','Santa Cruz de Tenerife',5),('39','Cantabria',6),('40','Segovia',8),('41','Sevilla',1),('42','Soria',8),('43','Tarragona',9),('44','Teruel',2),('45','Toledo',7),('46','Valencia',10),('47','Valladolid',8),('48','Vizcaya',16),('49','Zamora',8),('50','Zaragoza',2),('51','Ceuta',18),('52','Melilla',19);
/*!40000 ALTER TABLE `tbl_provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('A','O') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'megustaelcampo','pwd','A'),(2,'admin1','pwd1','A'),(3,'operario1','pwd1','O'),(4,'operario2','pwd2','O'),(5,'operario3','pwd3','O'),(6,'operario4','pwd4','O'),(7,'operario5','pwd5','O');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-10 12:44:53
