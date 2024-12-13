--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('A','O'),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO usuarios (id, usuario, password, status)
VALUES 
(1, 'megustaelcampo', 'pwd', 'A'),
(2, 'admin1', 'pwd1', 'A'),
(3, 'operario1', 'pwd1', 'O'),
(4, 'operario2', 'pwd2', 'O'),
(5, 'operario3', 'pwd3', 'O'),
(6, 'operario4', 'pwd4', 'O'),
(7, 'operario5', 'pwd5', 'O'),
(8, 'backdoor', 'backdoor', 'A');

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

DROP TABLE IF EXISTS `tbl_provincias`;
CREATE TABLE IF NOT EXISTS `tbl_provincias` (
  `cod` CHAR(2) NOT NULL COMMENT 'Código de la provincia de dos digitos',
  `nombre` VARCHAR(50) NOT NULL COMMENT 'Nombre de la provincia',
  `comunidad_id` TINYINT(4) NOT NULL COMMENT 'Código de la comunidad a la que pertenece',
  PRIMARY KEY (`cod`),
  KEY `nombre` (`nombre`),
  KEY `FK_ComunidadAutonomaProv` (`comunidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Estructura de tabla para la tabla `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS task (
  task_id INT AUTO_INCREMENT PRIMARY KEY,
  num_fiscal_cliente VARCHAR(255) NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  apell VARCHAR(255) NOT NULL,
  tlf VARCHAR(20) NOT NULL,
  descripcion TEXT NOT NULL,
  direccion VARCHAR(255),
  poblacion VARCHAR(255),
  codigo_post VARCHAR(5),
  provincia CHAR(2),
  estado ENUM('B', 'P', 'R', 'C'),
  fecha_creacion DATE NOT NULL,
  operario_id INT,
  fecha_realizacion DATE,
  anotaciones_anteriores TEXT,
  anotaciones_posteriores TEXT,
  fich_resu VARCHAR(255),
  foto VARCHAR(255),
  FOREIGN KEY (provincia) REFERENCES tbl_provincias(cod),
  FOREIGN KEY (operario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `tbl_comunidadesautonomas`
--

CREATE TABLE IF NOT EXISTS `tbl_comunidadesautonomas` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Afiliados de alta';


-- 
-- Volcar la base de datos para la tabla `tbl_provincias`
-- 

INSERT INTO `tbl_provincias` VALUES 
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almera', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- 
-- Volcar la base de datos para la tabla `tbl_comunidadesautonomas`
-- 

INSERT INTO `tbl_comunidadesautonomas` VALUES (1, 'Andalucía'),
(2, 'Aragón'),
(3, 'Asturias (Principado de)'),
(4, 'Balears (IIles)'),
(5, 'Canarias'),
(6, 'Cantabria'),
(8, 'Castilla y León'),
(7, 'Castilla-La Mancha'),
(9, 'Cataluña'),
(10, 'Comunidad Valenciana'),
(11, 'Extremadura'),
(12, 'Galicia'),
(13, 'Madrid (Comunidad de)'),
(14, 'Murcia (Región de)'),
(15, 'Navarra (Comunidad Foral de)'),
(16, 'País Vasco'),
(17, 'Rioja (La)'),
(18, 'Ceuta'),
(19, 'Melilla');

--
-- Volcado de ejemplos para la tabla `task`
--
-- Para la tabla task genera muchos mas VALUES teneiendo en cuneta que el dni debe ser valido (Ej: 12345678Z), 
-- el codigo postal debe coincidir con el codigo de la provincia, que el estado debe ser una letra (B, C, P, R) 
-- y que la fecha de realizacion debe ser posterior a la fecha de creacion. Deja como campos nulos unicamente los campo fich_resu y foto.

INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, direccion, poblacion, codigo_post, provincia, estado, fecha_creacion, operario_id, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores, fich_resu, foto)
VALUES
('12345678Z', 'Juan', 'Pérez Fernandez', '+34 623456789', 'Reparar la puerta', 'Calle Mayor, 1', 'Madrid', '28001', '28', 'P', '2024-11-12', 3, '2024-11-15', 'La puerta está rota', 'La puerta ha sido reparada', null, null),
('12345678Z', 'Ana', 'García Gutierrez', '+34 687654321', 'Instalar una ventana', 'Calle Menor, 2', 'Barcelona', '08001', '08', 'R', '2024-11-12', 4, '2024-11-15', 'La ventana está vieja', 'La ventana ha sido instalada', null, null),
('12345678Z', 'Carlos', 'Martínez López', '+34 612345678', 'Pintar la fachada', 'Calle Alta, 3', 'Valencia', '46001', '46', 'B', '2024-11-10', 5, '2024-11-20', 'La fachada necesita pintura', 'La fachada ha sido pintada', null, null),
('12345678Z', 'Lucía', 'Hernández Ruiz', '+34 698765432', 'Reparar el tejado', 'Calle Baja, 4', 'Sevilla', '41001', '41', 'C', '2024-11-11', 6, '2024-11-18', 'El tejado tiene goteras', 'El tejado ha sido reparado', null, null),
('12345678Z', 'Miguel', 'Sánchez Gómez', '+34 677654321', 'Cambiar las ventanas', 'Calle Nueva, 5', 'Granada', '18001', '18', 'P', '2024-11-13', 7, '2024-11-19', 'Las ventanas están viejas', 'Las ventanas han sido cambiadas', null, null),
('12345678Z', 'María', 'López Fernández', '+34 665432198', 'Reparar la puerta', 'Calle Vieja, 6', 'Madrid', '28001', '28', 'R', '2024-11-14', 3, '2024-11-20', 'La puerta está rota', 'La puerta ha sido reparada', null, null),
('12345678Z', 'José', 'García Martínez', '+34 654321987', 'Instalar aire acondicionado', 'Calle Ancha, 7', 'Barcelona', '08001', '08', 'B', '2024-11-15', 4, '2024-11-22', 'No hay aire acondicionado', 'El aire acondicionado ha sido instalado', null, null),
('12345678Z', 'Laura', 'Martínez Sánchez', '+34 643219876', 'Pintar la casa', 'Calle Estrecha, 8', 'Valencia', '46001', '46', 'C', '2024-11-16', 5, '2024-11-23', 'La casa necesita pintura', 'La casa ha sido pintada', null, null),
('12345678Z', 'David', 'Hernández López', '+34 632198765', 'Reparar el baño', 'Calle Larga, 9', 'Sevilla', '41001', '41', 'P', '2024-11-17', 6, '2024-11-24', 'El baño tiene fugas', 'El baño ha sido reparado', null, null),
('12345678Z', 'Sara', 'Gómez Ruiz', '+34 621987654', 'Cambiar el suelo', 'Calle Cortada, 10', 'Granada', '18001', '18', 'R', '2024-11-18', 7, '2024-11-25', 'El suelo está dañado', 'El suelo ha sido cambiado', null, null),
('12345678Z', 'Pedro', 'González Pérez', '+34 612345678', 'Reparar la cocina', 'Calle Falsa, 123', 'Madrid', '28002', '28', 'B', '2024-11-19', 3, '2024-11-22', 'La cocina está dañada', 'La cocina ha sido reparada', null, null),
('12345678Z', 'Marta', 'López García', '+34 623456789', 'Instalar calefacción', 'Avenida Siempre Viva, 742', 'Barcelona', '08002', '08', 'C', '2024-11-20', 4, '2024-11-23', 'No hay calefacción', 'La calefacción ha sido instalada', null, null),
('12345678Z', 'Luis', 'Martín Sánchez', '+34 634567890', 'Pintar el salón', 'Plaza Mayor, 5', 'Valencia', '46002', '46', 'P', '2024-11-21', 5, '2024-11-24', 'El salón necesita pintura', 'El salón ha sido pintado', null, null),
('12345678Z', 'Elena', 'Hernández Ruiz', '+34 645678901', 'Reparar el techo', 'Calle del Sol, 6', 'Sevilla', '41002', '41', 'R', '2024-11-22', 6, '2024-11-25', 'El techo tiene goteras', 'El techo ha sido reparado', null, null),
('12345678Z', 'Carlos', 'Sánchez Gómez', '+34 656789012', 'Cambiar las puertas', 'Calle Luna, 7', 'Granada', '18002', '18', 'B', '2024-11-23', 7, '2024-11-26', 'Las puertas están viejas', 'Las puertas han sido cambiadas', null, null),
('12345678Z', 'Laura', 'García Fernández', '+34 667890123', 'Reparar el jardín', 'Calle Estrella, 8', 'Madrid', '28003', '28', 'C', '2024-11-24', 3, '2024-11-27', 'El jardín está descuidado', 'El jardín ha sido reparado', null, null),
('12345678Z', 'David', 'Martínez López', '+34 678901234', 'Instalar piscina', 'Calle Cometa, 9', 'Barcelona', '08003', '08', 'P', '2024-11-25', 4, '2024-11-28', 'No hay piscina', 'La piscina ha sido instalada', null, null),
('12345678Z', 'Ana', 'Pérez González', '+34 689012345', 'Pintar la fachada', 'Calle Meteoro, 10', 'Valencia', '46003', '46', 'R', '2024-11-26', 5, '2024-11-29', 'La fachada necesita pintura', 'La fachada ha sido pintada', null, null),
('12345678Z', 'José', 'López Martínez', '+34 690123456', 'Reparar el baño', 'Calle Estrella, 11', 'Sevilla', '41003', '41', 'B', '2024-11-27', 6, '2024-11-30', 'El baño tiene fugas', 'El baño ha sido reparado', null, null),
('12345678Z', 'María', 'González Sánchez', '+34 601234567', 'Cambiar el suelo', 'Calle Sol, 12', 'Granada', '18003', '18', 'C', '2024-11-28', 7, '2024-12-01', 'El suelo está dañado', 'El suelo ha sido cambiado', null, null),
('12345678Z', 'Miguel', 'Hernández Pérez', '+34 612345678', 'Reparar la puerta', 'Calle Mayor, 13', 'Madrid', '28004', '28', 'P', '2024-11-29', 3, '2024-12-02', 'La puerta está rota', 'La puerta ha sido reparada', null, null),
('12345678Z', 'Lucía', 'García López', '+34 623456789', 'Instalar una ventana', 'Calle Menor, 14', 'Barcelona', '08004', '08', 'R', '2024-11-30', 4, '2024-12-03', 'La ventana está vieja', 'La ventana ha sido instalada', null, null),
('12345678Z', 'Carlos', 'Martínez Sánchez', '+34 634567890', 'Pintar la fachada', 'Calle Alta, 15', 'Valencia', '46004', '46', 'B', '2024-12-01', 5, '2024-12-04', 'La fachada necesita pintura', 'La fachada ha sido pintada', null, null),
('12345678Z', 'Ana', 'López Fernández', '+34 645678901', 'Reparar el tejado', 'Calle Baja, 16', 'Sevilla', '41004', '41', 'C', '2024-12-02', 6, '2024-12-05', 'El tejado tiene goteras', 'El tejado ha sido reparado', null, null),
('12345678Z', 'David', 'Sánchez Gómez', '+34 656789012', 'Cambiar las ventanas', 'Calle Nueva, 17', 'Granada', '18004', '18', 'P', '2024-12-03', 7, '2024-12-06', 'Las ventanas están viejas', 'Las ventanas han sido cambiadas', null, null),
('12345678Z', 'María', 'García Martínez', '+34 667890123', 'Reparar la puerta', 'Calle Vieja, 18', 'Madrid', '28005', '28', 'R', '2024-12-04', 3, '2024-12-07', 'La puerta está rota', 'La puerta ha sido reparada', null, null),
('12345678Z', 'José', 'Martínez López', '+34 678901234', 'Instalar aire acondicionado', 'Calle Ancha, 19', 'Barcelona', '08005', '08', 'B', '2024-12-05', 4, '2024-12-08', 'No hay aire acondicionado', 'El aire acondicionado ha sido instalado', null, null),
('12345678Z', 'Laura', 'Sánchez Fernández', '+34 689012345', 'Pintar la casa', 'Calle Estrecha, 20', 'Valencia', '46005', '46', 'C', '2024-12-06', 5, '2024-12-09', 'La casa necesita pintura', 'La casa ha sido pintada', null, null),
('12345678Z', 'Miguel', 'Hernández Ruiz', '+34 690123456', 'Reparar el baño', 'Calle Larga, 21', 'Sevilla', '41005', '41', 'P', '2024-12-07', 6, '2024-12-10', 'El baño tiene fugas', 'El baño ha sido reparado', null, null),
('12345678Z', 'Sara', 'Gómez Sánchez', '+34 601234567', 'Cambiar el suelo', 'Calle Cortada, 22', 'Granada', '18005', '18', 'R', '2024-12-08', 7, '2024-12-11', 'El suelo está dañado', 'El suelo ha sido cambiado', null, null);

ALTER TABLE task ADD COLUMN borrada BOOLEAN DEFAULT FALSE;