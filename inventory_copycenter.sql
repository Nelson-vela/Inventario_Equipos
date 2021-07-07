-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2021 a las 17:11:48
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventory_copycenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `area` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `area`, `fecha`) VALUES
(1, 'Ventas', '2020-06-24 16:11:44'),
(2, 'Informática', '2020-06-24 16:11:44'),
(3, 'Gerencia General', '2020-06-24 16:12:30'),
(4, 'Gerencia Administrativa', '2020-06-24 16:12:30'),
(5, 'Contabilidad', '2020-06-24 16:12:56'),
(6, 'Almacen 2', '2020-06-24 16:12:56'),
(7, 'Almacen 1', '2020-06-24 16:13:07'),
(8, 'Secretaría', '2020-06-25 09:13:01'),
(10, 'Administración', '2020-12-23 17:05:27'),
(11, 'Tienda', '2021-03-18 10:42:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_clienteEntrega` int(11) NOT NULL,
  `serie` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `horaEntrega` time NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `id_equipo`, `id_cliente`, `id_clienteEntrega`, `serie`, `codigo`, `fechaEntrega`, `horaEntrega`, `fecha`) VALUES
(7, 19, 7, 7, 2020, 1, '2020-07-25', '00:00:00', '2020-12-23 23:50:40'),
(8, 18, 7, 7, 2020, 2, '2020-07-01', '17:06:00', '2020-12-23 23:50:54'),
(10, 21, 5, 7, 2020, 3, '2020-06-04', '15:06:00', '2020-12-23 23:50:56'),
(11, 22, 7, 5, 2020, 4, '2020-08-07', '09:00:00', '2020-12-23 23:50:59'),
(13, 23, 7, 5, 2020, 5, '2020-08-07', '09:00:00', '2020-12-23 23:51:02'),
(14, 24, 7, 5, 2020, 6, '2020-09-07', '09:05:00', '2020-12-23 23:51:07'),
(15, 25, 7, 4, 2020, 7, '2020-10-31', '16:00:00', '2020-12-23 23:51:09'),
(16, 28, 7, 4, 2020, 8, '2020-11-10', '15:25:00', '2020-12-23 23:51:16'),
(17, 28, 5, 7, 2020, 9, '2020-11-13', '10:26:00', '2020-12-23 23:51:19'),
(18, 29, 13, 4, 2020, 10, '2020-11-19', '12:50:00', '2020-12-23 23:51:23'),
(19, 30, 14, 4, 2020, 11, '2020-11-19', '12:50:00', '2020-12-23 23:51:25'),
(21, 32, 11, 5, 2020, 12, '2020-11-19', '18:00:00', '2020-12-23 23:51:27'),
(22, 31, 6, 5, 2020, 13, '2020-11-19', '18:00:00', '2020-12-23 23:51:31'),
(23, 33, 5, 4, 2020, 14, '2020-11-19', '18:10:00', '2020-12-23 23:51:33'),
(24, 34, 5, 4, 2020, 15, '2020-11-19', '18:10:00', '2020-12-23 23:51:37'),
(25, 22, 13, 5, 2020, 16, '2020-12-04', '12:55:00', '2020-12-23 23:51:40'),
(26, 47, 18, 7, 2020, 17, '2020-12-23', '15:55:00', '2020-12-23 23:51:44'),
(29, 42, 11, 7, 2020, 18, '2020-12-24', '18:14:00', '2020-12-23 23:51:48'),
(30, 38, 16, 7, 2020, 19, '2020-12-23', '18:22:00', '2020-12-23 23:51:51'),
(32, 40, 17, 7, 2020, 20, '2020-12-23', '18:26:00', '2020-12-23 23:51:53'),
(33, 41, 12, 7, 2020, 21, '2020-12-23', '18:28:00', '2020-12-23 23:51:56'),
(34, 39, 10, 7, 2020, 22, '2020-12-23', '18:31:00', '2020-12-23 23:51:59'),
(35, 50, 12, 5, 2021, 23, '2021-01-11', '17:00:00', '2021-01-11 21:43:25'),
(36, 51, 18, 5, 2021, 24, '2021-02-02', '12:15:00', '2021-02-02 17:02:02'),
(37, 22, 11, 5, 2021, 25, '2021-02-19', '10:10:00', '2021-02-19 15:06:59'),
(38, 52, 19, 5, 2021, 26, '2021-03-18', '11:00:00', '2021-03-18 15:34:16'),
(39, 53, 20, 5, 2021, 27, '2021-03-18', '11:00:00', '2021-03-18 15:48:05'),
(40, 30, 20, 5, 2021, 28, '2021-03-26', '11:10:00', '2021-03-26 16:02:49'),
(41, 27, 14, 5, 2021, 29, '2021-05-05', '10:00:00', '2021-05-05 14:42:42'),
(42, 55, 21, 5, 2021, 30, '2021-07-03', '12:30:00', '2021-07-03 17:16:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(12, 'Monitores', '2020-06-21 02:32:44'),
(13, 'Mouses', '2020-06-21 02:33:25'),
(14, 'Teclados', '2020-06-21 02:33:21'),
(15, 'Cpu', '2020-06-21 02:36:43'),
(16, 'Pistola escaner', '2020-06-24 20:40:28'),
(17, 'Ups', '2020-06-24 20:41:02'),
(18, 'Impresoras', '2020-06-24 20:52:55'),
(19, 'Teléfonos', '2020-06-25 14:24:30'),
(20, 'Laptos', '2020-07-23 19:43:10'),
(21, 'Conexiones', '2020-09-07 20:34:53'),
(22, 'Radio', '2020-11-14 15:24:50'),
(23, 'Luces', '2020-11-19 17:24:39'),
(24, 'Varios Equipos', '2020-11-19 17:24:56'),
(25, 'Guías Remisión', '2021-05-19 15:21:48'),
(26, 'Termómetros', '2021-07-03 16:59:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `documentoID` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `id_area`, `nombre`, `documentoID`, `email`, `telefono`, `direccion`, `fecha`) VALUES
(1, 2, 'David Laiche Bardales', '45532422', 'dlaiche@copycenter.com.pe', '(51) 924-029483', 'Jose Galvez 676 - Iquitos', '2020-07-26 21:36:45'),
(2, 1, 'Rocio Tello Jaba', '05314964', 'rtello@copycenter.com.pe', '(51) 965-618916', 'Calle Las Gardenas 300 Las Palmeras - San Juan', '2020-11-20 15:34:14'),
(3, 3, 'Marina Soares Yoplack', '05253056', 'msorares@copycenter.com.pe', '(51) 965-675155', 'Jr. Arica 428 - Iquitos', '2020-07-26 21:25:52'),
(4, 4, 'Teresa Bueno Soares', '40134268', 'tbueno@copycenter.com.pe', '(51) 982-084427', 'Las Orquídeas 310 - San Juan', '2020-07-26 22:05:24'),
(5, 10, 'Kattia Angeles Ticona', '41730347', 'kangeles@copycenter.com.pe', '(51) 934-873737', 'Fitzcarrald 504 - Iquitos', '2021-05-05 14:46:00'),
(6, 8, 'Marisela Sanchez Prada', '44269039', 'msanchez@copycenter.com.pe', '(51) 935-841958', 'Ricardo Palma 1402 - Iquitos', '2020-07-26 21:39:41'),
(7, 2, 'Nelson Vela Lopez', '70600515', 'nvela@copycenter.com.pe', '(51) 999-226410', 'Calle Estado de Israel 228 - Iquitos', '2020-09-07 21:10:21'),
(8, 5, 'Fabiola Salazar Mattos', '05411129', 'fsalazar@copycenter.com.pe', '(51) 965-842005', 'Urb. Rio Mar Mz 1 Lt 31A - Belen', '2020-07-26 22:00:57'),
(9, 5, 'Rubén Ramos Iparraguirre', '05331236', 'rramos@copycenter.com.pe', '(51) 965-989630', 'Av Freyre 565 - Iquitos', '2020-11-20 15:30:11'),
(10, 1, 'Vivian Reategui Rengifo', '72306147', 'vreategui@copycenter.com.pe', '(51) 924-974341', 'Samanez Ocampo 343 - Iquitos', '2020-07-26 21:51:32'),
(11, 1, 'Beatriz Sinarahua Preciado', '05846150', 'bsinarahua@copycenter.com.pe', '(51) 990-261073', 'Martires de la democracia A28 - Belén', '2020-11-20 15:28:13'),
(12, 1, 'Jessica Tapullima Mozombite', '41924037', 'jtapullima@copycenter.com.pe', '(51) 965-888909', 'Echenique 163 - Iquitos', '2020-11-20 15:28:49'),
(13, 7, 'Omar Castillo Honorio', '61318934', 'ocastillo@copycenter.com.pe', '(51) 998-059973', 'Urb. Virgen de Loreto, mz Lote 2 - Iquitos', '2020-07-26 21:47:09'),
(14, 11, 'Carlos Sarango Ramirez', '42750946', 'csarango@copycenter.com.pe', '(51) 938-176124', 'Sargento Lores 2358 - Iquitos', '2021-03-18 15:42:15'),
(16, 1, 'Kurt Kevin Talexio Nolorbe', '74646624', 'ktalexio@copycenter.com.pe', '(51) 970-596551', 'José Gálvez 449 - Iquitos', '2020-12-22 14:44:19'),
(17, 1, 'Beatriz Perez Nuñez', '05326277', 'bperez@copycenter.com.pe', '(51) 988-826516', 'Calle Los Claveles 112 AH Las Colinas - San Juan', '2020-11-19 23:28:41'),
(18, 1, 'Maruja Tello Jaba', '05217568', 'mtello@copycenter.com.pe', '(51) 950-574778', 'Yavari 847 -Iquitos', '2020-11-20 15:38:29'),
(19, 2, 'Yvonne Yanac Castro', '42753911', 'yyanac@copycenter.com.pe', '(51) 979-424434', 'Jr. Arica 426 - Iquitos', '2021-03-18 15:35:04'),
(20, 6, 'Erick Rodriguez Peña', '70003895', 'esaavedra@copycenter.com.pe', '(51) 912-771628', 'Ricardo Palma 1402 - Iquitos', '2021-03-18 16:00:16'),
(21, 1, 'Julinho Arimuya Tamani', '73106049', 'Julinhoarimuya29@gmail.com', '(051) 993-970984', 'Psj. Pedro Vasquez, Punchana ', '2021-07-03 17:03:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_tipodocumento_detalle` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_tipodocumento_detalle`, `productos`, `total`, `fecha_compra`, `responsable`, `fecha`) VALUES
(1, 1, '[{\"titulo\":\"Procesador Intel Core I5 9400 2.90GHZ \",\"cantidad\":\"1\",\"precio\":\"900\",\"total\":\"900\"},{\"titulo\":\"Placa Asus Prime B360M-A DDR4\",\"cantidad\":\"1\",\"precio\":\"390\",\"total\":\"390\"},{\"titulo\":\"Memoria Ram 8 GB HP\",\"cantidad\":\"1\",\"precio\":\"160\",\"total\":\"160\"},{\"titulo\":\"Lectora DVD-RW LG GH24NS95\",\"cantidad\":\"1\",\"precio\":\"65\",\"total\":\"65\"},{\"titulo\":\"Case Advance ATX Slim 1061\",\"cantidad\":\"1\",\"precio\":\"175\",\"total\":\"175\"}]', 1690, '2020-10-31 00:00:00', 'Teresa Bueno', '2020-10-31 22:01:29'),
(2, 2, '[{\"titulo\":\"Pilas recargables AA de 2700 MAH x 4 PB\",\"cantidad\":\"1\",\"precio\":\"79.90\",\"total\":\"79.9\"},{\"titulo\":\"Lectora de Tarjeta  Teraware\",\"cantidad\":\"1\",\"precio\":\"21.90\",\"total\":\"21.9\"}]', 101.8, '2020-11-13 00:00:00', 'Teresa Bueno', '2020-11-13 23:48:47'),
(3, 3, '[{\"titulo\":\"Radio FRS Talkabout T200PE - 32KM\",\"cantidad\":\"1\",\"precio\":\"329.90\",\"total\":\"329.9\"}]', 329.9, '2020-11-13 00:00:00', 'Teresa Bueno', '2020-11-13 23:51:23'),
(4, 4, '[{\"titulo\":\"Impresora HP NeverStop MTF 1200w \",\"cantidad\":\"1\",\"precio\":\"1100\",\"total\":\"1100\"},{\"titulo\":\"Toner HP 103A Negro 5000 hojas\",\"cantidad\":\"1\",\"precio\":\"50\",\"total\":\"50\"}]', 1150, '2020-11-09 00:00:00', 'Teresa Bueno', '2020-11-13 23:54:42'),
(5, 5, '[{\"titulo\":\"Procesador Intel Pentium DC G5420 1151v2 3.80GHZ\",\"cantidad\":\"1\",\"precio\":\"293.45\",\"total\":\"293.45\"},{\"titulo\":\"Placa MSI H310M Pro-M2 DDR4\",\"cantidad\":\"1\",\"precio\":\"269\",\"total\":\"269\"},{\"titulo\":\"Memoria Ram HP 8GB DDR4\",\"cantidad\":\"1\",\"precio\":\"156.51\",\"total\":\"156.51\"},{\"titulo\":\"Disco Duro Seagate 1TB\",\"cantidad\":\"1\",\"precio\":\"205.41\",\"total\":\"205.41\"},{\"titulo\":\"Case Teros ATX TE 1072/1070/1056/1055\",\"cantidad\":\"1\",\"precio\":\"127.16\",\"total\":\"127.16\"},{\"titulo\":\"Tarjeta PCI WIfi TPLink TL-WN881DN\",\"cantidad\":\"1\",\"precio\":\"68.47\",\"total\":\"68.47\"},{\"titulo\":\"Disco Duro Seagate 1TB\",\"cantidad\":\"1\",\"precio\":\"205\",\"total\":\"205\"}]', 1325, '2020-11-10 00:00:00', 'Teresa Bueno', '2020-11-14 22:52:42'),
(6, 6, '[{\"titulo\":\"Linterna led recargable 76SMD\\tceleste\",\"cantidad\":\"2\",\"precio\":\"14.95\",\"total\":\"29.9\"}]', 29.9, '2020-11-19 00:00:00', 'Teresa Bueno', '2020-11-19 17:16:55'),
(7, 7, '[{\"titulo\":\"Luz led de emergencia metal lonen\",\"cantidad\":\"2\",\"precio\":\"34.95\",\"total\":\"69.9\"}]', 69.9, '2020-11-19 00:00:00', 'Teresa Bueno', '2020-11-19 17:20:00'),
(8, 8, '[{\"titulo\":\"Pilas Alc AAA x 24 radioshack\",\"cantidad\":\"1\",\"precio\":\"39.90\",\"total\":\"39.9\"},{\"titulo\":\"Pilas Alc AA x 24 radioshack\",\"cantidad\":\"1\",\"precio\":\"39.90\",\"total\":\"39.9\"}]', 79.8, '2020-11-19 00:00:00', 'Teresa Bueno', '2020-11-19 17:23:59'),
(9, 9, '[{\"titulo\":\"Linterna led recargable 76SMD celeste\\t\",\"cantidad\":\"2\",\"precio\":\"14.95\",\"total\":\"29.9\"},{\"titulo\":\"Linterna led recargable 76SMD celeste\\t\",\"cantidad\":\"2\",\"precio\":\"14.95\",\"total\":\"29.9\"}]', 59.8, '2020-11-19 00:00:00', 'Teresa Bueno', '2020-11-19 22:31:42'),
(10, 10, '[{\"titulo\":\"Linterna 3W Led\\t\",\"cantidad\":\"2\",\"precio\":\"11.45\",\"total\":\"22.9\"}]', 22.9, '2020-11-19 00:00:00', 'Teresa Bueno', '2020-11-19 22:47:43'),
(13, 13, '[{\"titulo\":\"Disco duro interno Seagate 1Tb\",\"cantidad\":\"1\",\"precio\":\"250\",\"total\":\"250\"},{\"titulo\":\"Switch TPLink 24 puertos\",\"cantidad\":\"1\",\"precio\":\"450\",\"total\":\"450\"},{\"titulo\":\"Toner compatible 103A\",\"cantidad\":\"2\",\"precio\":\"45\",\"total\":\"90\"}]', 790, '2021-06-10 00:00:00', 'Nelson Vela', '2021-06-10 23:00:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_cargo`
--

CREATE TABLE `documento_cargo` (
  `id` int(11) NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento_cargo`
--

INSERT INTO `documento_cargo` (`id`, `documento`, `fecha`) VALUES
(1, 'Entrega', '2020-08-08 19:14:34'),
(2, 'Translado', '2020-08-08 19:14:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `alias` text COLLATE utf8_spanish_ci NOT NULL,
  `serie` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` text COLLATE utf8_spanish_ci NOT NULL,
  `modelo` text COLLATE utf8_spanish_ci NOT NULL,
  `codbarra` text COLLATE utf8_spanish_ci NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_mantenimiento` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `id_categoria`, `id_area`, `id_cliente`, `alias`, `serie`, `marca`, `modelo`, `codbarra`, `detalles`, `estado`, `imagen`, `ultimo_mantenimiento`, `fecha_ingreso`, `fecha`) VALUES
(1, 15, 1, 11, 'Equipo 3', 'S/N', 'Cyberlink', 'Genérico', '', '[{\"caracteristicas\":\"Procesador\",\"detalles\":\"Pentium Dual Core 2.50 GHz\"},{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"512 Mb\"},{\"caracteristicas\":\"Sistema Operativo\",\"detalles\":\"Windows 7 \"},{\"caracteristicas\":\"Versión\",\"detalles\":\"32 Bits\"},{\"caracteristicas\":\"Disco duro\",\"detalles\":\"500 Gb\"}]', 1, 'vistas/img/equipo/482.jpg', '2020-06-25', '2020-07-09', '2020-12-24 23:58:33'),
(15, 18, 3, 3, 'Impresora Gerencia', 'sn', 'Cannon', 'MG3500', '', '[{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Tipo\",\"detalles\":\"Multifuncional\"},{\"caracteristicas\":\"Conectividad\",\"detalles\":\"Wifi, cable usb\"},{\"caracteristicas\":\"Tinta\",\"detalles\":\"Cartucho\"},{\"caracteristicas\":\"Modelo tinta\",\"detalles\":\"No se\"}]', 1, 'vistas/img/equipo/995.jpg', '2020-06-23', '2019-08-01', '2020-12-23 14:51:39'),
(17, 19, 7, 13, 'Telefono Almacen', 'S/N', 'GrandStream', 'GXP1625', '', '[{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"}]', 1, 'vistas/img/equipo/444.jpg', '0000-00-00', '0000-00-00', '2020-06-28 21:11:57'),
(18, 12, 2, 7, 'Monitor Informática 1', 'S/N', 'AOC', 'E2070S', '', '[{\"caracteristicas\":\"Tamaño\",\"detalles\":\"20 pulgadas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"Hdmi, Vga\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"}]', 1, 'vistas/img/equipo/899.jpg', '2020-06-29', '2020-05-06', '2020-12-25 00:00:13'),
(19, 12, 2, 7, 'Monitor Informática 2', 'S/N', 'AOC', 'E2070S', '', '[{\"caracteristicas\":\"Tamaño\",\"detalles\":\"20 pulgadas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"Hdmi, Vga\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"}]', 1, 'vistas/img/equipo/139.jpg', '2020-06-29', '2020-09-24', '2020-11-20 15:43:39'),
(20, 15, 2, 7, 'Servidor Facturación', 'SN', 'Genérica', 'Genérica', '', '[{\"caracteristicas\":\"Procesador\",\"detalles\":\"Intel Core I7 920\"},{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"4GB DDR3\"},{\"caracteristicas\":\"Disco Duro 1\",\"detalles\":\"1TB\"},{\"caracteristicas\":\"Disco Duro 2\",\"detalles\":\"698 GB\"},{\"caracteristicas\":\"Disco Duro 3\",\"detalles\":\"500 GB\"}]', 1, 'vistas/img/equipo/823.jpg', '2020-06-18', '2018-07-02', '2020-12-24 15:51:05'),
(21, 20, 2, 7, 'Lapto Gerencia Admi.', 'CND6083G9R', 'HP ', '240 G3 Notebook', '', '[{\"caracteristicas\":\"Procesador\",\"detalles\":\"Intel Celeron\"},{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"2 GB\"},{\"caracteristicas\":\"Disco Duro\",\"detalles\":\"500 GB\"},{\"caracteristicas\":\"Sistema Operativo\",\"detalles\":\"Windows 10 \"},{\"caracteristicas\":\"Version\",\"detalles\":\"64 bits\"}]', 1, 'vistas/img/equipo/398.jpg', '0000-00-00', '2020-06-29', '2020-11-20 15:56:45'),
(22, 20, 2, 11, 'Lapto pequeña 1', 'SHJT1808010598', 'Advance', 'Notebook Nv9801', 'shjt1808010598', '[{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"2GB\"},{\"caracteristicas\":\"Pantalla\",\"detalles\":\"10.1 Pulgadas\"},{\"caracteristicas\":\"Procesador\",\"detalles\":\"Quad Core z8350\"},{\"caracteristicas\":\"Batería\",\"detalles\":\"4000 mAh\"},{\"caracteristicas\":\"Disco Duro\",\"detalles\":\"32GB\"}]', 1, 'vistas/img/equipo/466.jpg', '0000-00-00', '2020-08-07', '2021-02-19 15:03:03'),
(23, 20, 2, 7, 'Lapto pequeña 2', 'SHJT1811010793', 'Advance', 'Notebook Nv9801', '', '[{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"2GB\"},{\"caracteristicas\":\"Pantalla\",\"detalles\":\"10.1 Pulgadas\"},{\"caracteristicas\":\"Procesador\",\"detalles\":\"Quad Core z8350\"},{\"caracteristicas\":\"Batería\",\"detalles\":\"4000 mAh\"},{\"caracteristicas\":\"Disco Duro\",\"detalles\":\"32GB\"}]', 1, 'vistas/img/equipo/467.jpg', '0000-00-00', '2020-08-07', '2020-08-08 15:29:37'),
(24, 21, 2, 7, 'Switch sistema', 'S/N', 'Nexxt', 'Naxos1600', '', '[{\"caracteristicas\":\"Puertos\",\"detalles\":\"16\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Capacidad\",\"detalles\":\"10/100mb\"}]', 1, 'vistas/img/equipo/367.jpg', '0000-00-00', '2020-09-07', '2020-09-07 21:00:38'),
(25, 15, 2, 7, 'Servidor Marktech', 'S/N', 'Advance', 'ADV1061N', '', '[{\"caracteristicas\":\"Procesador\",\"detalles\":\"Intel Core I5 9400 2.90GHZ\"},{\"caracteristicas\":\"Placa Madre\",\"detalles\":\"Asus Prime B360M-A DDR4 LGA 1151V2\"},{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"8GB DDR4\"},{\"caracteristicas\":\"Lectora\",\"detalles\":\"DVD-RW LG GH24N95\"},{\"caracteristicas\":\"Case\",\"detalles\":\"Advance ATX 1061N\"}]', 1, 'vistas/img/equipo/256.jpg', '0000-00-00', '2020-10-31', '2020-10-31 22:55:34'),
(26, 18, 2, 7, 'Impresora HP NeverStop', 'BRBSMDBB16 GRT:180', 'HP', 'NeverStop MFP1200w', '', '[{\"caracteristicas\":\"Color\",\"detalles\":\"Blanco\"},{\"caracteristicas\":\"Tipo\",\"detalles\":\"Multifuncional\"},{\"caracteristicas\":\"Toner\",\"detalles\":\"103A \"}]', 1, 'vistas/img/equipo/779.jpg', '0000-00-00', '2020-11-13', '2020-11-14 00:01:54'),
(27, 22, 2, 7, 'Radio Informática', 'S/N', 'Motorola', 'Talkabout T200PE', '', '[{\"caracteristicas\":\"Alcance\",\"detalles\":\"32KM\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Canales\",\"detalles\":\"14\"},{\"caracteristicas\":\"Baterías \",\"detalles\":\"3 AA recargables\"},{\"caracteristicas\":\"Cargador\",\"detalles\":\"Dual Micro-USB\"},{\"caracteristicas\":\"Tonos\",\"detalles\":\"20 tonos de llamadas\"}]', 1, 'vistas/img/equipo/176.jpg', '0000-00-00', '2020-11-13', '2020-11-14 15:33:44'),
(28, 15, 4, 5, 'PC Administración', 'S/N', 'Genérica', 'Teros', '', '[{\"caracteristicas\":\"Disco Duro \",\"detalles\":\"1TB\"},{\"caracteristicas\":\"Procesador\",\"detalles\":\"Intel Pentium DC G5420 1151V2 3.80GHZ\"},{\"caracteristicas\":\"Placa Madre\",\"detalles\":\"MSI H310M PRO-M2\"},{\"caracteristicas\":\"Memoria Ram\",\"detalles\":\"8GB DDR4\"},{\"caracteristicas\":\"Tarjeta Wifi\",\"detalles\":\"TPLink PCI-E TL.WN881ND\"},{\"caracteristicas\":\"Case\",\"detalles\":\"Teros ATX TE 1072/1070/1056\"}]', 1, 'vistas/img/equipo/670.jpg', '0000-00-00', '2020-11-10', '2020-11-14 23:22:48'),
(29, 23, 7, 13, 'Luz Emerg Omar', 'SP03-27/BL', 'Lonen', 'SP03-27', '', '[{\"caracteristicas\":\"Bateria Interna\",\"detalles\":\"2*4V 700mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 100-240V 50/60Hz\"},{\"caracteristicas\":\"Tiempo de Carga\",\"detalles\":\"2-5 hrs\"},{\"caracteristicas\":\"Mantenimiento bateria\",\"detalles\":\"Cargar la batería completamete una vez cada 3 meses\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Celeste\"}]', 1, 'vistas/img/equipo/819.jpg', '0000-00-00', '2020-11-19', '2020-11-19 17:35:02'),
(30, 23, 6, 14, 'Luz Emerg  Alm 2', 'SP03-27/BL', 'Lonen', 'SP03-27', '', '[{\"caracteristicas\":\"Bateria Interna\",\"detalles\":\"2*4V 700mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 100-240V 50/60Hz\"},{\"caracteristicas\":\"Tiempo de Carga\",\"detalles\":\"2-5 hrs\"},{\"caracteristicas\":\"Mantenimiento bateria\",\"detalles\":\"Cargar la batería completamete una vez cada 3 meses\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Celeste\"}]', 1, 'vistas/img/equipo/625.jpg', '0000-00-00', '2020-11-19', '2021-03-26 16:02:15'),
(31, 23, 8, 6, 'Luz Emerg Marisela', 'SP03-27/BL', 'Lonen', 'SP03-27', '', '[{\"caracteristicas\":\"Bateria Interna\",\"detalles\":\"2*4V 700mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 100-240V 50/60Hz\"},{\"caracteristicas\":\"Tiempo de Carga\",\"detalles\":\"2-5 hrs\"},{\"caracteristicas\":\"Mantenimiento bateria\",\"detalles\":\"Cargar la batería completamete una vez cada 3 meses\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Celeste\"}]', 1, 'vistas/img/equipo/506.jpg', '0000-00-00', '2020-11-19', '2020-11-19 22:36:56'),
(32, 23, 1, 11, 'Luz Emerg Beatriz S.', 'SP03-27/BL', 'Lonen', 'SP03-27', '', '[{\"caracteristicas\":\"Bateria Interna\",\"detalles\":\"2*4V 700mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 100-240V 50/60Hz\"},{\"caracteristicas\":\"Tiempo de Carga\",\"detalles\":\"2-5 hrs\"},{\"caracteristicas\":\"Mantenimiento bateria\",\"detalles\":\"Cargar la batería completamete una vez cada 3 meses\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Celeste\"}]', 1, 'vistas/img/equipo/331.jpg', '0000-00-00', '2020-11-19', '2020-11-19 22:40:49'),
(33, 23, 7, 5, 'Lámpara  Emerg Escalera Alm1', 'SP03-25/WT', 'Lonen', 'SP03-25', '', '[{\"caracteristicas\":\"Bombillas\",\"detalles\":\"2 bombillas led\"},{\"caracteristicas\":\"Señalización\",\"detalles\":\"2 señales de salida\"},{\"caracteristicas\":\"Material\",\"detalles\":\"Hierro (resistente fuego)\"},{\"caracteristicas\":\"Bateria \",\"detalles\":\"4V 2500mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 220V 50Hz\"},{\"caracteristicas\":\"Tiempo Recarga\",\"detalles\":\"Hasta 12Hrs\"},{\"caracteristicas\":\"Tiempo Operación\",\"detalles\":\"Luz 1: 6hrs, Luz 2: 3hrs\"}]', 1, 'vistas/img/equipo/566.jpg', '0000-00-00', '2020-11-19', '2020-11-19 23:03:54'),
(34, 23, 1, 5, 'Lámpara Emerg Despacho', 'SP03-25/WT', 'Lonen', 'SP03-25', '', '[{\"caracteristicas\":\"Bombillas\",\"detalles\":\"2 bombillas led\"},{\"caracteristicas\":\"Señalización\",\"detalles\":\"2 señales de salida\"},{\"caracteristicas\":\"Material\",\"detalles\":\"Hierro (resistente fuego)\"},{\"caracteristicas\":\"Bateria \",\"detalles\":\"4V 2500mAh\"},{\"caracteristicas\":\"Voltaje\",\"detalles\":\"AC 220V 50Hz\"},{\"caracteristicas\":\"Tiempo Recarga\",\"detalles\":\"Hasta 12Hrs\"},{\"caracteristicas\":\"Tiempo Operación\",\"detalles\":\"Luz 1: 6hrs, Luz 2: 3hrs\"}]', 1, 'vistas/img/equipo/734.jpg', '0000-00-00', '2020-11-19', '2020-11-19 23:08:56'),
(35, 19, 2, 7, 'Teléfono Informática', 'S/N', 'GrandStream', 'GXP1625', '', '[{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"}]', 1, 'vistas/img/equipo/239.jpg', '0000-00-00', '2020-07-06', '2020-11-20 16:25:29'),
(36, 18, 2, 7, 'Impresora HP Ecotanl 315', 'S/N', 'HP', 'ecotank 315', '', '[{\"caracteristicas\":\"Capacidad de Entrada\",\"detalles\":\"Hasta 60 hojas\"},{\"caracteristicas\":\"Capacidad de Salidad\",\"detalles\":\"Hasta 25 hojas\"},{\"caracteristicas\":\"Impresiones\",\"detalles\":\"Colores\"},{\"caracteristicas\":\"Tecnología de impresión\",\"detalles\":\"Inyección térmica de tinta HP\"}]', 1, 'vistas/img/equipo/653.jpg', '0000-00-00', '2020-11-20', '2020-11-20 21:27:55'),
(37, 17, 2, 7, 'Ups Servidor Concar', 'NT-512U', 'Forza', 'NT-512U', '200313500420', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/222.jpg', '0000-00-00', '2020-12-18', '2020-12-23 17:30:11'),
(38, 17, 1, 16, 'Ups Ventas 1', 'NT-512U', 'Forza', 'NT-512U', '200313500419', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/984.jpg', '0000-00-00', '2020-12-18', '2020-12-23 15:53:26'),
(39, 17, 1, 10, 'Ups Ventas 2', 'NT-512U', 'Forza', 'NT-512U', '200413500262', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 4, 'vistas/img/equipo/160.jpg', '0000-00-00', '2020-12-18', '2021-01-23 16:45:03'),
(40, 17, 1, 17, 'Ups Ventas 3', 'NT-512U', 'Forza', 'NT-512U', '200413500261', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/383.jpg', '0000-00-00', '2020-12-18', '2020-12-23 16:35:51'),
(41, 17, 1, 12, 'Ups Ventas 4', 'NT-512U', 'Forza', 'NT-512U', '200413500264', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/537.jpg', '0000-00-00', '2020-12-18', '2020-12-23 16:41:59'),
(42, 17, 1, 11, 'Ups Caja 1', 'NT-512U', 'Forza', 'NT-512U', '200313500418', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/280.jpg', '0000-00-00', '2020-12-18', '2020-12-23 17:31:00'),
(43, 17, 4, 4, 'Ups Gerencia Administrativa', 'NT-512U', 'Forza', 'NT-512U', '200313502034', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/430.jpg', '0000-00-00', '2020-12-18', '2021-01-04 23:05:50'),
(44, 17, 4, 5, 'Ups Administración', 'NT-512U', 'Forza', 'NT-512U', '200313500417', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/270.jpg', '0000-00-00', '2020-12-18', '2020-12-23 15:42:38'),
(47, 17, 1, 17, 'Ups Ventas 2', 'NT-512U', 'Forza', 'NT-512U', '200413500263', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/616.jpg', '0000-00-00', '2020-12-18', '2021-01-23 16:45:40'),
(48, 17, 1, 17, 'Ups Ventas 5', 'NT-512U', 'Forza', 'NT-512U', '200313502033', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/767.jpg', '0000-00-00', '2020-12-18', '2020-12-26 17:52:54'),
(49, 17, 3, 3, 'Gerencia General', 'NT-512U', 'Forza', 'NT-512U', '200313502035', '[{\"caracteristicas\":\"Capacidad\",\"detalles\":\"500VA/250W\"},{\"caracteristicas\":\"Tiempo\",\"detalles\":\"18 min\"},{\"caracteristicas\":\"Carga\",\"detalles\":\"6 horas\"},{\"caracteristicas\":\"Entradas\",\"detalles\":\"6\"},{\"caracteristicas\":\"Rango Voltaje\",\"detalles\":\"162-268VA\"}]', 1, 'vistas/img/equipo/411.jpg', '0000-00-00', '2020-12-18', '2021-01-05 20:06:28'),
(50, 22, 1, 12, 'Radio Caja', 'S/n', 'Motorola', 'Talkabout T200PE', '', '[{\"caracteristicas\":\"Alcance\",\"detalles\":\"32KM\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Canales\",\"detalles\":\"14\"},{\"caracteristicas\":\"Baterías \",\"detalles\":\"3 AA recargables\"},{\"caracteristicas\":\"Cargador\",\"detalles\":\"Dual Micro-USB\"},{\"caracteristicas\":\"Tonos\",\"detalles\":\"20 tonos de llamadas\"}]', 1, 'vistas/img/equipo/103.jpg', '0000-00-00', '2021-01-11', '2021-01-11 21:42:33'),
(51, 22, 1, 18, 'Radio Protocolo', 'S/N', 'Motorola', 'Talkabout T200PE', '', '[{\"caracteristicas\":\"Alcance\",\"detalles\":\"32KM\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Canales\",\"detalles\":\"14\"},{\"caracteristicas\":\"Baterías \",\"detalles\":\"3 AA recargables\"},{\"caracteristicas\":\"Cargador\",\"detalles\":\"Dual Micro-USB\"},{\"caracteristicas\":\"Tonos\",\"detalles\":\"20 tonos de llamadas\"}]', 1, 'vistas/img/equipo/261.jpg', '0000-00-00', '2021-02-02', '2021-02-02 17:00:51'),
(52, 22, 2, 19, 'Radio Gerencia Admin', 'S/N', 'Motorola', 'Talkabout T200PE', '', '[{\"caracteristicas\":\"Alcance\",\"detalles\":\"32KM\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Canales\",\"detalles\":\"14\"},{\"caracteristicas\":\"Baterías \",\"detalles\":\"3 AA recargables\"},{\"caracteristicas\":\"Cargador\",\"detalles\":\"Dual Micro-USB\"},{\"caracteristicas\":\"Tonos\",\"detalles\":\"20 tonos de llamadas\"}]', 1, 'vistas/img/equipo/489.jpg', '0000-00-00', '2021-03-18', '2021-03-18 15:33:26'),
(53, 22, 6, 20, 'Radio Almacen 2', 'S/N', 'Motorola', 'Talkabout T200PE', '', '[{\"caracteristicas\":\"Alcance\",\"detalles\":\"32KM\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Negro\"},{\"caracteristicas\":\"Canales\",\"detalles\":\"14\"},{\"caracteristicas\":\"Baterías \",\"detalles\":\"3 AA recargables\"},{\"caracteristicas\":\"Cargador\",\"detalles\":\"Dual Micro-USB\"},{\"caracteristicas\":\"Tonos\",\"detalles\":\"20 tonos de llamadas\"}]', 1, 'vistas/img/equipo/374.jpg', '0000-00-00', '2021-03-18', '2021-03-18 15:47:17'),
(54, 25, 2, 7, 'Guías Remisión Bloque', 'S/N', 'S/N', 'S/N', '', '[{\"caracteristicas\":\"TAMAÑO\",\"detalles\":\"OFICIO\"},{\"caracteristicas\":\"CANTIDAD HOJAS\",\"detalles\":\"3\"}]', 1, '', '0000-00-00', '2021-05-19', '2021-05-19 15:34:24'),
(55, 26, 11, 21, 'Termómetro Protocolo', 'S/N', 'S/N', 'TK-E303', '', '[{\"caracteristicas\":\"Pantalla\",\"detalles\":\"LCD\"},{\"caracteristicas\":\"Tipo Medición\",\"detalles\":\"Infrarrojo sin contacto\"},{\"caracteristicas\":\"Batería\",\"detalles\":\"2x AAA\"},{\"caracteristicas\":\"Color\",\"detalles\":\"Blanco\"}]', 1, 'vistas/img/equipo/621.jpg', '0000-00-00', '2021-07-03', '2021-07-03 17:16:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `requerimientos` text COLLATE utf8_spanish_ci NOT NULL,
  `conclusion` text COLLATE utf8_spanish_ci NOT NULL,
  `total_presupuesto` float NOT NULL,
  `fecha_mantenimiento` date NOT NULL,
  `estado_mantenimiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id`, `id_equipo`, `responsable`, `observaciones`, `requerimientos`, `conclusion`, `total_presupuesto`, `fecha_mantenimiento`, `estado_mantenimiento`, `estado`, `fecha`) VALUES
(20, 15, 'David Laiche', '[{\"observaciones\":\"Atasco de papel\"},{\"observaciones\":\"Derrama tinta al imprimir\"}]', '[{\"requerimiento\":\"Tinta nueva \",\"precio\":\"250\"},{\"requerimiento\":\"Mantenimiento correctivo con un especialista\",\"precio\":\"150\"}]', 'aún esta en matenimiento', 400, '2020-06-23', 0, 1, '2020-12-23 14:51:39'),
(21, 20, 'Nelson Vela', '[{\"observaciones\":\"Errores de placa, se apaga inoportunamente\"},{\"observaciones\":\"posibles cambios de disco duro\"}]', '[{\"requerimiento\":\"Mano de obra del especialista\",\"precio\":\"200\"},{\"requerimiento\":\"Placa nueva\",\"precio\":\"450\"}]', 'Se realizó los cambios necesarios para la correción del problema, los cambios realizados fueron:\r\n-Cambio de la placa madre, la antigua placa tenía un cruce de componentes electrónicos que causaba el apagado inoportuno.\r\n-Limpieza total de los componentes.\r\n-Cambio de disco duro por una nueva de 1TB.', 650, '2020-06-18', 0, 1, '2020-12-24 15:51:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `ruc` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `proveedor`, `ruc`, `direccion`, `email`, `telefono`, `fecha_ingreso`, `fecha`) VALUES
(4, 'COPY CENTER S.R.L', '20103984794', 'Arica 426-Iquitos', 'ventas@copycenter.com.pe', '(065) 231530', '2020-06-22 21:17:26', '2020-06-23 02:46:12'),
(5, 'Visoft', '10408655027', 'Tacna 579 - Iquitos', 'julio_vidal_pezo@hotmail.com', '(065) 225464', '2020-10-31 14:22:31', '2020-10-31 19:22:31'),
(6, 'CoolBox', '20378890161', 'Jr. Prospero 259 - Iquitos', 'xxx@coolbox.com', '(065) 225199', '2020-11-13 18:44:41', '2020-11-19 17:48:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `tipo`, `fecha`) VALUES
(1, 'Factura', '2020-06-21 17:33:03'),
(2, 'Boleta', '2020-06-21 17:32:35'),
(3, 'Guia Remision', '2020-12-25 19:52:58'),
(4, 'Nota Entrada', '2020-06-21 17:19:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento_detalle`
--

CREATE TABLE `tipo_documento_detalle` (
  `id` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `serie` text COLLATE utf8_spanish_ci NOT NULL,
  `ntipo` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `fecha_almacenamiento` datetime NOT NULL,
  `total` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento_detalle`
--

INSERT INTO `tipo_documento_detalle` (`id`, `id_tipo_documento`, `id_proveedor`, `id_usuario`, `serie`, `ntipo`, `fecha_emision`, `fecha_almacenamiento`, `total`, `fecha`) VALUES
(1, 1, 5, 29, 'FF02', '7583', '2020-10-31 00:00:00', '2020-10-31 00:00:00', 1690, '2020-10-31 22:01:29'),
(2, 1, 6, 29, 'F815', '24214', '2020-11-13 00:00:00', '2020-11-13 00:00:00', 101.8, '2020-11-13 23:48:47'),
(3, 1, 6, 29, 'F815', '24218', '2020-11-13 00:00:00', '2020-11-13 00:00:00', 329.9, '2020-11-13 23:51:23'),
(4, 1, 5, 29, 'FF02', '7701', '2020-11-09 00:00:00', '2020-11-09 00:00:00', 1150, '2020-11-13 23:54:42'),
(5, 1, 5, 29, 'FF02', '7715', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 1325, '2020-11-14 22:52:42'),
(6, 1, 6, 29, 'F815', '24279', '2020-11-19 00:00:00', '2020-11-19 00:00:00', 29.9, '2020-11-19 17:16:55'),
(7, 1, 6, 29, 'F815', '24278', '2020-11-19 00:00:00', '2020-11-19 00:00:00', 69.9, '2020-11-19 17:20:00'),
(8, 1, 6, 29, 'F815', '24277', '2020-11-19 00:00:00', '2020-11-19 00:00:00', 79.8, '2020-11-19 17:23:59'),
(9, 1, 6, 29, 'F815', '24286', '2020-11-19 00:00:00', '2020-11-19 00:00:00', 59.8, '2020-11-19 22:29:36'),
(10, 1, 6, 29, 'F815', '24288', '2020-11-19 00:00:00', '2020-11-19 00:00:00', 22.9, '2020-12-25 04:41:54'),
(13, 1, 5, 29, 'FF02', '10065', '2021-06-10 00:00:00', '2021-06-10 00:00:00', 790, '2021-06-10 23:00:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(29, 'Nelson Vela Lopez', 'nvela', '$2a$07$asxx54ahjppf45sd87a5auYR8TCZEJVTtwETSnS9uFZx2BIl9WnJq', 'Administrador', 'vistas/img/usuarios/Nelson Vela Lopez/393.jpg', 1, '2021-07-03 18:29:45', '2021-07-03 23:29:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documento_cargo`
--
ALTER TABLE `documento_cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento_detalle`
--
ALTER TABLE `tipo_documento_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `documento_cargo`
--
ALTER TABLE `documento_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_documento_detalle`
--
ALTER TABLE `tipo_documento_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
