-- Adminer 4.8.3 MySQL 8.0.35 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE `ciudad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(255) NOT NULL,
  `gps` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `ciudad` (`id`, `ciudad`, `gps`) VALUES
(1,	'Gijón',	44),
(2,	'Oviedo',	44),
(3,	'Avilés',	44);

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE `direcciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cp` decimal(10,0) NOT NULL,
  `id_ciudad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ciudad` (`id_ciudad`),
  CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `direcciones` (`id`, `nombre`, `direccion`, `cp`, `id_ciudad`) VALUES
(2,	'Teatro de la Laboral',	'Luis Moya Blanco, 261',	33203,	1),
(3,	'Sala Acapulco',	'Calle Fernández Vallín s/n Gijón',	33205,	1),
(4,	'Teatro Albéniz',	'C/ San Bernardo 62',	33201,	1),
(5,	'Toma 3',	'Calle Marqués de Casa Valdés 27',	33202,	1),
(6,	'Mar de Niebla',	'Calle Magallanes 43',	33213,	1),
(7,	'Ateneo de la Calzada',	'Calle Ateneo Obrero de la Calzada ',	33213,	1),
(8,	'Jardín Botánico',	'Avda. Jardín Botánico, 2230',	33394,	1),
(9,	'Centro Cultura Antiguo Instituto',	'Calle Jovellanos 21',	33201,	1),
(10,	'Plaza Ayuntamiento Gijón',	'Plaza Mayor s/n',	33201,	1);

DROP TABLE IF EXISTS `evento_tipo`;
CREATE TABLE `evento_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `id_tipo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `evento_tipo_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evento_tipo_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_eventos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  `horario` time NOT NULL,
  `id_direccion` int NOT NULL,
  `precio_min` int NOT NULL,
  `precio_max` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_direccion` (`id_direccion`),
  CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `eventos` (`id`, `img`, `nombre`, `descripcion`, `fecha`, `horario`, `id_direccion`, `precio_min`, `precio_max`) VALUES
(55,	'https://www.nebrija.com/medios/actualidadnebrija/wp-content/uploads/sites/2/2018/11/Congreso_bioetica.png',	'Ciclos de Conferencias Bioética',	'Conferencias para reflexionar sobre los desafíos éticos de los avances científicos en salud, biotecnología y derechos humanos, a cargo de expertos en la materia.',	'2025-10-04 00:00:00',	'17:00:00',	9,	0,	0),
(56,	'https://i.pinimg.com/474x/96/2f/e1/962fe10413e09fda78a9270fb60ce036.jpg',	'Citas Literarias: Voces que Trascienden',	'Encuentros con autores locales y nacionales para discutir sobre las citas más famosas de todos los tiempos.',	'2025-10-04 00:00:00',	'18:00:00',	5,	0,	0),
(57,	'https://drupal.gijon.es/sites/default/files/2024-11/papel-1-25-540x405.jpg',	'Papel',	'Una historia en torno al acoso escolar inspirada en hechos reales.',	'2025-04-25 00:00:00',	'20:00:00',	2,	0,	15),
(58,	'img/festival_cine.jpg',	'Festival Internacional de Cine de Xixón',	'Edición 63 del Festival donde descubrirás las mejores películas de autor.',	'2025-11-25 00:00:00',	'00:00:00',	9,	0,	25),
(59,	'img/mercado_artesania.jpg',	'Mercado de Artesanía',	'Mercado artesano y ecológico de Gijón donde disfrutarás de una experiencia única gastronómica y de talleres artesanos.',	'2025-05-15 00:00:00',	'12:00:00',	10,	0,	0);

DROP TABLE IF EXISTS `eventos_organizadores`;
CREATE TABLE `eventos_organizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `id_organiza` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`),
  KEY `id_organiza` (`id_organiza`),
  CONSTRAINT `eventos_organizadores_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `eventos_organizadores_ibfk_2` FOREIGN KEY (`id_organiza`) REFERENCES `organizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `organizadores`;
CREATE TABLE `organizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `telefono` int NOT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `tipo_eventos`;
CREATE TABLE `tipo_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tipo_eventos` (`id`, `tipo`) VALUES
(1,	'Concierto'),
(2,	'Talleres y Actividades'),
(3,	'Ciclos de Conferencias'),
(4,	'Evento Literario'),
(5,	'Obra de Teatro'),
(6,	'Festival de Cine'),
(7,	'Festival de Música'),
(8,	'Mercado de Artesanía'),
(9,	'Rutas Culturales'),
(10,	'Festival Gastronómico'),
(11,	'Exposición de Fotografía y Arte Digital');

-- 2025-03-19 12:35:07