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

INSERT INTO `evento_tipo` (`id`, `id_evento`, `id_tipo`) VALUES
(1,	55,	3),
(2,	56,	4),
(3,	57,	5),
(4,	58,	6),
(5,	59,	8);

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `descripcion` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `horario` time NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_direccion` int NOT NULL,
  `precio_min` int NOT NULL,
  `precio_max` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_direccion` (`id_direccion`),
  CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `eventos` (`id`, `nombre`, `descripcion`, `fecha`, `horario`, `img`, `id_direccion`, `precio_min`, `precio_max`) VALUES
(55,	'Ciclos de Conferencias Bioética',	'Conferencias para reflexionar sobre los desafíos éticos de los avances científicos en salud, biotecnología y derechos humanos, a cargo de expertos en la materia.',	'2025-10-04 00:00:00',	'17:00:00',	'https://www.nebrija.com/medios/actualidadnebrija/wp-content/uploads/sites/2/2018/11/Congreso_bioetica.png',	9,	0,	0),
(56,	'Voces que Trascienden',	'Encuentros con autores locales y nacionales para discutir sobre las citas más famosas de todos los tiempos.',	'2025-10-04 00:00:00',	'18:00:00',	'https://www.educaciontrespuntocero.com/wp-content/uploads/2023/11/encuentros-literarios.jpg',	5,	0,	0),
(57,	'Papel',	'Una historia en torno al acoso escolar inspirada en hechos reales.',	'2025-04-25 00:00:00',	'20:00:00',	'https://www.corraldealcala.com/wp-content/uploads/2023/08/papel-ficha-jpg.webp',	2,	0,	15),
(58,	'Festival Internacional de Cine de Xixón',	'Edición 63 del Festival donde descubrirás las mejores películas de autor.',	'2025-11-25 00:00:00',	'00:00:00',	'https://oficinamediaespana.eu/media/k2/items/cache/fcd467d7b3349b271327a32de878da3c_M.jpg',	9,	0,	25),
(59,	'Mercado de Artesanía',	'Mercado artesano y ecológico de Gijón donde disfrutarás de una experiencia única gastronómica y de talleres artesanos.',	'2025-05-15 00:00:00',	'12:00:00',	'https://s1.ppllstatics.com/elcomercio/www/multimedia/201808/13/media/cortadas/mercado-artesano-gijon-k5QB-U60621129558iiC-624x385@El%20Comercio.jpg',	10,	0,	0),
(60,	'Naturaleza del Lenguaje',	'La práctica de Linsambarth gira en torno a la parte anecdótica de una historia o un rel. En su trabajo, el arte es un lenguaje propio el cual posee códigos y simbologías inherentes a su propia naturaleza, interesándose por la relación o diálogo que existe entre lo enigmático y lo atemporal.',	'2025-04-15 00:00:00',	'17:00:00',	'https://images.squarespace-cdn.com/content/54417b8de4b0a94c7678ee04/1694507908409-KXR83F5HFEQR2YSZQ0FT/Pablo+Linsambarth_La+mano+de+Dios_Dia+de+Visitas_baja.jpg',	9,	0,	0),
(61,	'Post-Covid',	'A través de imágenes, exploramos cómo el mundo se transformó, cómo nos adaptamos a la nueva normalidad y cómo, a pesar de todo, seguimos adelante, renovados y resilientes',	'2025-04-14 00:00:00',	'12:00:00',	'https://www.consalud.es/uploads/s1/13/81/79/7/una-exposicion-fotografica-refleja-la-pandemia-de-la-covid-19.jpeg',	9,	0,	0),
(62,	'Tesoros Naturales',	'Disfruta de un recorrido único por el Jardín Botánico de Gijón. Durante este paseo, exploraremos su diversa flora y nos conectaremos con la tranquilidad que solo el entorno natural puede ofrecer. ¡Acompáñanos en esta experiencia que despierta los sentidos!',	'2025-04-29 00:00:00',	'12:00:00',	'https://unviajecreativo.com/wp-content/uploads/2020/08/Jard%C3%ADn-Bot%C3%A1nico-de-Gij%C3%B3n-visita-ni%C3%B1os-2.jpg',	8,	0,	0);

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
  `telefono` varchar(255) NOT NULL,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `organizadores` (`id`, `nombre`, `telefono`, `direccion`) VALUES
(2,	'Teatro de la Laboral',	'985 18 29 29',	'Calle Luis Moya Blanco, 261, 33203 Gijón'),
(3,	'Teatro Jovellanos',	'985 18 29 25',	'Calle de los Piles, 6, 33201 Gijón'),
(4,	'Museo Evaristo Valle',	'985 18 53 20',	'Calle de la Paz, 17, 33206 Gijón'),
(5,	'Centro de Cultura Antiguo Instituto',	'985 18 56 60',	'Calle de Jovellanos, 21, 33201 Gijón'),
(6,	'Cajastur Espacio Cultural',	'985 18 36 00',	'Calle de Asturias, 9, 33203 Gijón'),
(7,	'Casa de la Cultura de Gijón',	'985 18 44 00',	'Calle de la Reina, 5, 33206 Gijón'),
(8,	'Cine Yelmo',	'985 18 35 85',	'Calle de Luis Moya Blanco, 5, 33203 Gijón');

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

-- 2025-03-31 07:55:39