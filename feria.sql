-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2018 at 10:41 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feria`
--
CREATE DATABASE IF NOT EXISTS `feria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `feria`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `idAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idAlbum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`idAlbum`, `Nombre`) VALUES
(2, 'Nuevo Album');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `idArea` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`idArea`, `Nombre`, `Precio`) VALUES
(2, 'Área sin Montar', '74.00'),
(3, 'Área exterior', '50.00'),
(4, 'Prueba de Area', '20.00'),
(5, 'dfdf', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `credencial`
--

CREATE TABLE IF NOT EXISTS `credencial` (
  `idCredencial` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Ci` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cargo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idSolicitudParticipacion` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  PRIMARY KEY (`idCredencial`),
  KEY `IDX_C8B1726D7DE217EF` (`idSolicitudParticipacion`),
  KEY `IDX_C8B1726DDA07061` (`idPais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`idEvento`, `Nombre`, `Descripcion`, `Foto`) VALUES
(4, 'Evento1', 'Descripcion', '7c61240fe28b0ab2178e993e4e3f4c23d1e6fa9f.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ext_log_entries`
--

CREATE TABLE IF NOT EXISTS `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(32) DEFAULT NULL,
  `object_class` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `DATA` longtext COMMENT '(DC2Type:array)',
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ext_translations`
--

CREATE TABLE IF NOT EXISTS `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) NOT NULL,
  `object_class` varchar(255) NOT NULL,
  `FIELD` varchar(32) NOT NULL,
  `foreign_key` varchar(64) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`FIELD`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `ext_translations`
--

INSERT INTO `ext_translations` (`id`, `locale`, `object_class`, `FIELD`, `foreign_key`, `content`) VALUES
(2, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Organismo', 'Nombre', '4', 'HTC'),
(5, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Organismo', 'Nombre', '8', 'English PCC'),
(7, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Area', 'Nombre', '2', 'Indoor area'),
(8, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Area', 'Nombre', '3', 'Outside Area'),
(9, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Area', 'Nombre', '4', 'Test Area'),
(10, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\TipoVisitante', 'Nombre', '1', 'Exhibitor'),
(11, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\TipoVisitante', 'Nombre', '2', 'Professional visitor'),
(12, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Album', 'Nombre', '2', 'New album'),
(13, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Foto', 'Descripcion', '2', 'Esta descripciones en ENG'),
(14, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Nombre', '1', 'RENTAL SPACE'),
(15, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Descripcion', '1', 'We have indoor and outdoor areas where you can develop a social, cultural or business meeting, with affordable prices and where you will find a pleasant atmosphere with very professional treatment and adequate. Our premises are all air conditioned and with good lighting and acoustics, furniture and / or technical equipment as required and may request further culinary accompaniment which carries an additional cost.'),
(16, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Nombre', '2', 'ASSEMBLY OF FAIRS AND EXHIBITIONS'),
(17, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Descripcion', '2', 'We have a team mounting that specializes in staging exhibitions in closed or open places either in galleries or enabled areas, running through drawings and models decoration artistic designs and working on tasks loading, unloading and transportation their means, to ensure the physical integrity of works.'),
(18, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Nombre', '3', 'DESIGN PROMOTION AND ADVERTISING'),
(19, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Descripcion', '3', 'We work on designing your corporate image, develop publishing projects Signage, Packaging, Advertising and Audiovisual and communication media operating in the plane, the sequence and three-dimensional.'),
(20, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Nombre', '4', 'RENTAL OF FURNITURE, EQUIPMENT AND CARRIAGES'),
(21, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Descripcion', '4', 'In our center we have furniture needed for the assembly of a stand, exhibition or fair, which you can rent for a very affordable price need only have a transport for transfer to the destination.'),
(22, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Nombre', '5', 'ACCOMMODATION ASSOCIATED WITH FOOD.'),
(23, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Servicio', 'Descripcion', '5', 'Motel Ganadero is a place for accommodation during a business trip to the capital where the good treatment in service and pleasant climate come together to enjoy a customer like you. 52 beds high comfort, air conditioning in rooms, television, refrigerator, very clean linen and food service associated with the right price.'),
(24, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\FotoServicio', 'Descripcion', '1', 'English'),
(34, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Descripcion', '1', 'English'),
(35, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Nombre', '1', 'ProdcutONE'),
(48, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Nombre', '11', 'Product 3'),
(49, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Descripcion', '11', 'English'),
(50, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Nombre', '4', 'English Prueba2'),
(51, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Producto', 'Descripcion', '4', 'English Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex'),
(52, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\FotoServicio', 'Descripcion', '6', 'Otra foto mas para este servicio ENG'),
(55, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Evento', 'Nombre', '4', 'Event 1 one'),
(56, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Evento', 'Descripcion', '4', 'Descripcion 1 one'),
(57, 'en', 'feriaagropecuaria\\BackendBundle\\Entity\\Area', 'Nombre', '5', 'dfd');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `idFichero` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Fecha` datetime NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tipo` int(11) NOT NULL,
  `idAlbum` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFichero`),
  KEY `IDX_EADC3BE52E5C2D5E` (`idAlbum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`idFichero`, `Descripcion`, `Fecha`, `path`, `Tipo`, `idAlbum`) VALUES
(2, 'Esta descripciones en ESP', '2016-04-22 00:00:00', '7e3dc8261983dc461b17ea166e8ba83e6d4661d8.png', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `foto_servicio`
--

CREATE TABLE IF NOT EXISTS `foto_servicio` (
  `idFotoServicio` int(11) NOT NULL AUTO_INCREMENT,
  `Fichero` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idServicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFotoServicio`),
  KEY `IDX_96FC6D109825D871` (`idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `foto_servicio`
--

INSERT INTO `foto_servicio` (`idFotoServicio`, `Fichero`, `Descripcion`, `idServicio`) VALUES
(1, '01f44e5e4d4adb042931cf0dd22744afb5570864.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', 1),
(2, '3315bc156a8b582fd66ab7ebcc2fd1eba8e32dc8.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', 2),
(3, '2040b8b860b6a7e4a7dc29aaefe384b576f5bcec.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', 3),
(4, '13e738f7e2b76815d16b87c65d657d895f710573.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', 4),
(5, 'a50f2abfb4f77df8cac2af098b6ce01a726eb824.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', 5),
(6, 'f92a930d1225440c6f507af4e6635c3d52195e75.png', 'Otra foto mas para este servicio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organismo`
--

CREATE TABLE IF NOT EXISTS `organismo` (
  `idOrganismo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idOrganismo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `organismo`
--

INSERT INTO `organismo` (`idOrganismo`, `Nombre`) VALUES
(4, 'CTC'),
(8, 'PCC');

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`idPais`, `Nombre`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua and Barbuda'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia and Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina Faso'),
(28, 'Burundi'),
(29, 'Cambodia'),
(30, 'Cameroon'),
(31, 'Canada'),
(32, 'Cape Verde'),
(33, 'Central African Republic'),
(34, 'Chad'),
(35, 'Chile'),
(36, 'China'),
(37, 'Colombia'),
(38, 'Comoros'),
(39, 'Congo (Brazzaville)'),
(40, 'Congo'),
(41, 'Costa Rica'),
(42, 'Cote d''Ivoire'),
(43, 'Croatia'),
(44, 'Cuba'),
(45, 'Cyprus'),
(46, 'Czech Republic'),
(47, 'Denmark'),
(48, 'Djibouti'),
(49, 'Dominica'),
(50, 'Dominican Republic'),
(51, 'East Timor (Timor Timur)'),
(52, 'Ecuador'),
(53, 'Egypt'),
(54, 'El Salvador'),
(55, 'Equatorial Guinea'),
(56, 'Eritrea'),
(57, 'Estonia'),
(58, 'Ethiopia'),
(59, 'Fiji'),
(60, 'Finland'),
(61, 'France'),
(62, 'Gabon'),
(63, 'Gambia, The'),
(64, 'Georgia'),
(65, 'Germany'),
(66, 'Ghana'),
(67, 'Greece'),
(68, 'Grenada'),
(69, 'Guatemala'),
(70, 'Guinea'),
(71, 'Guinea-Bissau'),
(72, 'Guyana'),
(73, 'Haiti'),
(74, 'Honduras'),
(75, 'Hungary'),
(76, 'Iceland'),
(77, 'India'),
(78, 'Indonesia'),
(79, 'Iran'),
(80, 'Iraq'),
(81, 'Ireland'),
(82, 'Israel'),
(83, 'Italy'),
(84, 'Jamaica'),
(85, 'Japan'),
(86, 'Jordan'),
(87, 'Kazakhstan'),
(88, 'Kenya'),
(89, 'Kiribati'),
(90, 'Korea, North'),
(91, 'Korea, South'),
(92, 'Kuwait'),
(93, 'Kyrgyzstan'),
(94, 'Laos'),
(95, 'Latvia'),
(96, 'Lebanon'),
(97, 'Lesotho'),
(98, 'Liberia'),
(99, 'Libya'),
(100, 'Liechtenstein'),
(101, 'Lithuania'),
(102, 'Luxembourg'),
(103, 'Macedonia'),
(104, 'Madagascar'),
(105, 'Malawi'),
(106, 'Malaysia'),
(107, 'Maldives'),
(108, 'Mali'),
(109, 'Malta'),
(110, 'Marshall Islands'),
(111, 'Mauritania'),
(112, 'Mauritius'),
(113, 'Mexico'),
(114, 'Micronesia'),
(115, 'Moldova'),
(116, 'Monaco'),
(117, 'Mongolia'),
(118, 'Morocco'),
(119, 'Mozambique'),
(120, 'Myanmar'),
(121, 'Namibia'),
(122, 'Nauru'),
(123, 'Nepa'),
(124, 'Netherlands'),
(125, 'New Zealand'),
(126, 'Nicaragua'),
(127, 'Niger'),
(128, 'Nigeria'),
(129, 'Norway'),
(130, 'Oman'),
(131, 'Pakistan'),
(132, 'Palau'),
(133, 'Panama'),
(134, 'Papua New Guinea'),
(135, 'Paraguay'),
(136, 'Peru'),
(137, 'Philippines'),
(138, 'Poland'),
(139, 'Portugal'),
(140, 'Qatar'),
(141, 'Romania'),
(142, 'Russia'),
(143, 'Rwanda'),
(144, 'Saint Kitts and Nevis'),
(145, 'Saint Lucia'),
(146, 'Saint Vincent'),
(147, 'Samoa'),
(148, 'San Marino'),
(149, 'Sao Tome and Principe'),
(150, 'Saudi Arabia'),
(151, 'Senegal'),
(152, 'Serbia and Montenegro'),
(153, 'Seychelles'),
(154, 'Sierra Leone'),
(155, 'Singapore'),
(156, 'Slovakia'),
(157, 'Slovenia'),
(158, 'Solomon Islands'),
(159, 'Somalia'),
(160, 'South Africa'),
(161, 'Spain'),
(162, 'Sri Lanka'),
(163, 'Sudan'),
(164, 'Suriname'),
(165, 'Swaziland'),
(166, 'Sweden'),
(167, 'Switzerland'),
(168, 'Syria'),
(169, 'Taiwan'),
(170, 'Tajikistan'),
(171, 'Tanzania'),
(172, 'Thailand'),
(173, 'Togo'),
(174, 'Tonga'),
(175, 'Trinidad and Tobago'),
(176, 'Tunisia'),
(177, 'Turkey'),
(178, 'Turkmenistan'),
(179, 'Tuvalu'),
(180, 'Uganda'),
(181, 'Ukraine'),
(182, 'United Arab Emirates'),
(183, 'United Kingdom'),
(184, 'United States'),
(185, 'Uruguay'),
(186, 'Uzbekistan'),
(187, 'Vanuatu'),
(188, 'Vatican City'),
(189, 'Venezuela'),
(190, 'Vietnam'),
(191, 'Yemen'),
(192, 'Zambia'),
(193, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Foto1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Foto2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Foto3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idProducto`, `Nombre`, `Foto1`, `Foto2`, `Foto3`, `Descripcion`, `Precio`) VALUES
(1, 'Producto1', '19182a29754a582aa0a14fe2c3920d4d6117bb8c.jpeg', '3a93cc5e53565a71b4e1a0644b9811b17fc09d79.jpeg', '00d800d5138217deb5f422073140a6e5bb03b2c0.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', '10.00'),
(4, 'Prueba2', 'c17ca21417bcdf8b2f336c45361afbf44e69d3a5.jpeg', '2339f99447a46789daa2ca6c8be96e624e270567.jpeg', 'e292f5f4d7ba8c6e3e0c83a900f6c586c6dd8f8d.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex', '5.00'),
(11, 'Producto3', '48a0a7d56325008c88fb092dd07aaea656b273cd.jpeg', 'e3604ef26b899408f25c64b1c5d7f9d9c77ee9cf.jpeg', '247f9ad5231e3a5994df6c0f81bcba7a2c285fbc.jpeg', 'Spanish', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `rechazo`
--

CREATE TABLE IF NOT EXISTS `rechazo` (
  `idRechazo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idSolicitudParticipacion` int(11) NOT NULL,
  PRIMARY KEY (`idRechazo`),
  UNIQUE KEY `UNIQ_DF6A1E467DE217EF` (`idSolicitudParticipacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`idServicio`, `Nombre`, `Descripcion`, `Precio`, `Foto`) VALUES
(1, 'ALQUILER DE ESPACIOS', 'Contamos con áreas interiores y exteriores donde usted puede desarrollar un encuentro social, cultural o de negocios, con precios asequibles y donde encontrara un ambiente agradable acompañado de un trato adecuado y muy profesional. Nuestros locales son todos climatizados y con buena iluminación y acústica, mobiliario y/o equipamiento técnico según lo requiera y puede solicitar además acompañamiento gastronómico el cual lleva un costo adicional.', '1714.08', NULL),
(2, 'MONTAJE DE FERIAS Y EXPOSICIONES', 'Contamos con un equipo de montaje que se especializa en el montaje de exposiciones en lugares cerrados o abiertos ya sea en galerías o áreas habilitadas, ejecutando a través de planos y maquetas la decoración de diseños artísticos y trabajando en las tareas de carga, descarga y transportación de sus medios, velando por la integridad física de las obras.', '1714.08', NULL),
(3, 'DISEÑO PROMOCIÓN Y PUBLICIDAD', 'Trabajamos en el diseño de su imagen Corporativa, desarrollamos proyectos editoriales de Señalización, Envases, Publicidad y Audiovisuales así como los soportes de comunicación que operan en el plano, la secuencia y la tridimensional.', '1714.08', NULL),
(4, 'ALQUILER DE MOBILIARIO, EQUIPOS Y CARRUAJES', 'En nuestro centro contamos con mobiliario necesario para el montaje de un stand, exposición o feria, el cual usted podrá alquilar por un precio muy accesible necesitando solo disponer de un transporte para su traslado al lugar de destino.', '1714.08', NULL),
(5, 'ALOJAMIENTO CON ALIMENTACIÓN ASOCIADA', 'El Motel ¨El ganadero¨ es un sitio para el alojamiento en ocasión de un viaje de trabajo a la capital donde el buen trato en el servicio y el clima agradable se unen para el disfrute de un cliente como usted. Con 52 camas de alto confort, climatización en las habitaciones, televisión, refrigerador, muy limpia lencería y servicio gastronómico asociado con un precio adecuado.', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicio_mobiliaria_producto`
--

CREATE TABLE IF NOT EXISTS `servicio_mobiliaria_producto` (
  `idServicioMobiliariaProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idServicioMobiliariaProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `servicio_mobiliaria_producto`
--

INSERT INTO `servicio_mobiliaria_producto` (`idServicioMobiliariaProducto`, `Nombre`, `Precio`, `Path`) VALUES
(1, 'cubo de 3 metros', '5.00', '25b9bee1cbcb07f7360eb9440c1dfcf6f549fb3d.png'),
(2, 'toma corriente', '15.00', 'a0256c74f83f055f6ddd50ff5440a91a903d1aa9.png');

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_participacion`
--

CREATE TABLE IF NOT EXISTS `solicitud_participacion` (
  `idSolicitudParticipacion` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NombreFirma` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CodigoPostal` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Metros` int(11) NOT NULL,
  `Rotulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Productos` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Firmas` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Observaciones` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `identificador` int(11) NOT NULL,
  `FechaCreado` date NOT NULL,
  `Aprobado` tinyint(1) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodigoContrato` int(11) NOT NULL,
  `Sala` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Stan` int(11) NOT NULL,
  `idTipoVisitante` int(11) DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `idOrganismo` int(11) DEFAULT NULL,
  `idArea` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSolicitudParticipacion`),
  KEY `IDX_AA6A804F53755907` (`idTipoVisitante`),
  KEY `IDX_AA6A804FDA07061` (`idPais`),
  KEY `IDX_AA6A804FC130877B` (`idOrganismo`),
  KEY `IDX_AA6A804FA46963F6` (`idArea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_producto`
--

CREATE TABLE IF NOT EXISTS `solicitud_producto` (
  `idSolicitudProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad` int(11) NOT NULL,
  `idSolicitudParticipacion` int(11) DEFAULT NULL,
  `idServicioMobiliaria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSolicitudProducto`),
  KEY `IDX_3D2023D07DE217EF` (`idSolicitudParticipacion`),
  KEY `IDX_3D2023D0ED602A68` (`idServicioMobiliaria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_visitante`
--

CREATE TABLE IF NOT EXISTS `tipo_visitante` (
  `idTipoVisitante` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idTipoVisitante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipo_visitante`
--

INSERT INTO `tipo_visitante` (`idTipoVisitante`, `Nombre`) VALUES
(1, 'Expositor'),
(2, 'Visitante Profesional');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Usuario`, `Password`) VALUES
(1, 'admin', 'GZhUWx7UVP7SXtaGDP2q4dksDeqcGenQRdFz1SGFv1ETpRSKEqFuOGuEOnEMfoMDW9FC0p0CZJwx4EkLcpfNvg=='),
(2, 'lopez', 'FIg280h4W2zL/8UmtJpcoJmzeNVIpcbx4jnQGn2sGGHJGNXDXPkATPz3S3+/18nJ54pMcqBmInRL0lm7fzer0w=='),
(3, 'lopez', 'FIg280h4W2zL/8UmtJpcoJmzeNVIpcbx4jnQGn2sGGHJGNXDXPkATPz3S3+/18nJ54pMcqBmInRL0lm7fzer0w==');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credencial`
--
ALTER TABLE `credencial`
  ADD CONSTRAINT `FK_C8B1726D7DE217EF` FOREIGN KEY (`idSolicitudParticipacion`) REFERENCES `solicitud_participacion` (`idSolicitudParticipacion`),
  ADD CONSTRAINT `FK_C8B1726DDA07061` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `FK_EADC3BE52E5C2D5E` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`);

--
-- Constraints for table `foto_servicio`
--
ALTER TABLE `foto_servicio`
  ADD CONSTRAINT `FK_96FC6D109825D871` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Constraints for table `rechazo`
--
ALTER TABLE `rechazo`
  ADD CONSTRAINT `FK_DF6A1E467DE217EF` FOREIGN KEY (`idSolicitudParticipacion`) REFERENCES `solicitud_participacion` (`idSolicitudParticipacion`);

--
-- Constraints for table `solicitud_participacion`
--
ALTER TABLE `solicitud_participacion`
  ADD CONSTRAINT `FK_AA6A804F53755907` FOREIGN KEY (`idTipoVisitante`) REFERENCES `tipo_visitante` (`idTipoVisitante`),
  ADD CONSTRAINT `FK_AA6A804FA46963F6` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `FK_AA6A804FC130877B` FOREIGN KEY (`idOrganismo`) REFERENCES `organismo` (`idOrganismo`),
  ADD CONSTRAINT `FK_AA6A804FDA07061` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`);

--
-- Constraints for table `solicitud_producto`
--
ALTER TABLE `solicitud_producto`
  ADD CONSTRAINT `FK_3D2023D07DE217EF` FOREIGN KEY (`idSolicitudParticipacion`) REFERENCES `solicitud_participacion` (`idSolicitudParticipacion`),
  ADD CONSTRAINT `FK_3D2023D0ED602A68` FOREIGN KEY (`idServicioMobiliaria`) REFERENCES `servicio_mobiliaria_producto` (`idServicioMobiliariaProducto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
