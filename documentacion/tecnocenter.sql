-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-03-2011 a las 19:02:55
-- Versión del servidor: 5.1.33
-- Versión de PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tecnocenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'admin_menu', 1, 14),
(2, NULL, NULL, NULL, 'menu', 15, 16),
(3, 1, NULL, NULL, 'actualiza', 2, 3),
(4, 1, NULL, NULL, 'inventarios', 4, 5),
(5, 1, NULL, NULL, 'ventas', 6, 7),
(6, 1, NULL, NULL, 'reportes', 8, 9),
(7, 1, NULL, NULL, 'auditoria', 10, 11),
(8, 1, NULL, NULL, 'encuestas', 12, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, 'Super_Administrador', 1, 2),
(2, NULL, 'Role', 2, 'Administrador', 3, 4),
(3, NULL, 'Role', 3, 'Vendedor', 5, 6),
(4, NULL, 'Role', 4, 'Web', 7, 8),
(5, NULL, 'Role', 5, 'Clientes', 9, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '1', '1', '1', '1'),
(3, 3, 1, '1', '1', '1', '1'),
(4, 4, 2, '1', '1', '1', '1'),
(5, 5, 2, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audits`
--

CREATE TABLE IF NOT EXISTS `audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `foreing_key` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auidtdeunusuario` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcar la base de datos para la tabla `audits`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `nombre`, `order`) VALUES
(1, 'Portatiles', 1),
(2, 'Pc de escritorio', 2),
(3, 'Routers', 3),
(4, 'Impresoras', 4),
(5, 'Accesorios', 5),
(6, 'Cables', 6),
(7, 'Software', 7),
(8, 'Perifericos', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_page`
--

CREATE TABLE IF NOT EXISTS `contact_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `e_mail` varchar(60) NOT NULL,
  `asunto` varchar(30) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `contact_page`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventariodelproducto` (`product_id`),
  KEY `inventariodelproveedor` (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `provider_id`, `stock`) VALUES
(1, 3, 1, 4),
(2, 9, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_movements`
--

CREATE TABLE IF NOT EXISTS `inventory_movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `detalle` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deltipodedocumento` (`tipo_documento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `inventory_movements`
--

INSERT INTO `inventory_movements` (`id`, `inventory_id`, `tipo_documento_id`, `detalle`, `created`, `updated`) VALUES
(1, 1, 1, 'le compro 5 impresoras a Reynell', '2011-03-10 18:54:27', '2011-03-10 18:54:27'),
(2, 1, 1, '5 eran pocas entonces compor otras 5, tengo 10', '2011-03-10 18:55:16', '2011-03-10 18:55:16'),
(3, 2, 2, 'le compro 5 compaqs a felipe', '2011-03-10 18:56:21', '2011-03-10 18:56:21'),
(4, 3, 2, '', '2011-03-10 19:12:24', '2011-03-10 19:12:24'),
(5, 4, 2, '', '2011-03-10 19:13:32', '2011-03-10 19:13:32'),
(6, 5, 2, '', '2011-03-10 19:14:10', '2011-03-10 19:14:10'),
(7, 5, 2, '', '2011-03-10 19:15:18', '2011-03-10 19:15:18'),
(8, 6, 2, '', '2011-03-10 19:15:59', '2011-03-10 19:15:59'),
(9, 6, 2, '', '2011-03-10 19:17:05', '2011-03-10 19:17:05'),
(10, 6, 2, '', '2011-03-10 19:17:52', '2011-03-10 19:17:52'),
(11, 6, 2, '', '2011-03-10 19:19:00', '2011-03-10 19:19:00'),
(12, 1, 2, 'vendo 3 del de reynell', '2011-03-10 19:20:38', '2011-03-10 19:20:38'),
(13, 1, 2, 'vendo 1 del de reynell', '2011-03-10 19:21:44', '2011-03-10 19:21:44'),
(14, 1, 3, '', '2011-03-10 19:24:43', '2011-03-10 19:24:43'),
(15, 2, 3, 'le deculevo un computador a felipe', '2011-03-10 19:25:07', '2011-03-10 19:25:07'),
(16, 1, 5, 'dos impresoras de las de reynel', '2011-03-10 19:32:02', '2011-03-10 19:32:02'),
(17, 1, 5, '1 impresoras de las de reynel', '2011-03-10 19:33:12', '2011-03-10 19:33:12'),
(18, 1, 5, '1 impresoras de las de reynel', '2011-03-10 19:33:56', '2011-03-10 19:33:56'),
(19, 2, 6, 'salen dos computadores de felipe ', '2011-03-10 19:35:53', '2011-03-10 19:35:53'),
(20, 1, 7, 'entrada que mando reynel', '2011-03-10 19:37:39', '2011-03-10 19:37:39'),
(21, 1, 4, 'el cliente devolvio esta impresora', '2011-03-10 19:49:27', '2011-03-10 19:49:27'),
(22, 1, 4, 'el cliente devolvio esta impresora', '2011-03-10 19:51:28', '2011-03-10 19:51:28'),
(23, 2, 4, '', '2011-03-10 19:51:47', '2011-03-10 19:51:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `nombre`, `created`, `updated`) VALUES
(1, 'DELL', '2011-02-25 13:13:34', '2011-02-25 13:13:34'),
(2, 'HP', '2011-02-25 13:18:32', '2011-02-25 13:18:32'),
(3, 'CISCO', '2011-02-25 13:18:38', '2011-02-25 13:18:38'),
(4, 'LINK SYS', '2011-02-25 13:18:49', '2011-02-25 13:18:49'),
(5, 'APPLE', '2011-02-25 13:18:54', '2011-02-25 13:18:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_sales`
--

CREATE TABLE IF NOT EXISTS `online_sales` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(10) NOT NULL,
  `user_id` int(15) NOT NULL,
  `product_id` int(10) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `codigo_venta` varchar(50) NOT NULL,
  `cantidad` int(4) NOT NULL,
  `porcentaje_iva` float DEFAULT NULL,
  `valor_unit` int(10) NOT NULL,
  `subtotal` double NOT NULL,
  `valor_iva` double NOT NULL,
  `valor_total` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `online_sales_product` (`product_id`),
  KEY `online_sales_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `online_sales`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passoword_changes`
--

CREATE TABLE IF NOT EXISTS `passoword_changes` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `passoword_changes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_album_id` int(11) DEFAULT NULL,
  `path` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `thumb` varchar(45) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imagendelagaleria` (`photo_album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `photos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo_albums`
--

CREATE TABLE IF NOT EXISTS `photo_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeriadelproducto` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `photo_albums`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text,
  `codigo` int(11) NOT NULL,
  `cod_barras` int(11) DEFAULT NULL,
  `promocionar` tinyint(1) DEFAULT NULL,
  `destacar` tinyint(1) DEFAULT NULL,
  `ficha_producto` varchar(45) DEFAULT NULL,
  `inventario` int(11) DEFAULT NULL,
  `stock_minimo` int(4) DEFAULT NULL,
  `stock_maximo` int(4) DEFAULT NULL,
  `costo` int(10) NOT NULL,
  `costo_promedio` float DEFAULT NULL,
  `tarifa_iva` int(5) DEFAULT NULL,
  `valor_iva` int(10) DEFAULT NULL,
  `porc_utilidad` int(5) DEFAULT NULL,
  `valor_venta` int(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `rotacion` varchar(5) NOT NULL,
  `tiempo_reposicion` int(3) NOT NULL,
  `imagen_listado` varchar(50) DEFAULT NULL,
  `imagen_principal` varchar(50) DEFAULT NULL,
  `imagen_destacar` varchar(50) DEFAULT NULL,
  `imagen_ficha_tecnica` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`,`codigo`),
  KEY `productsbelogstocategorie` (`category_id`),
  KEY `pertenece a un fabricante` (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category_id`, `manufacturer_id`, `nombre`, `descripcion`, `codigo`, `cod_barras`, `promocionar`, `destacar`, `ficha_producto`, `inventario`, `stock_minimo`, `stock_maximo`, `costo`, `costo_promedio`, `tarifa_iva`, `valor_iva`, `porc_utilidad`, `valor_venta`, `estado`, `rotacion`, `tiempo_reposicion`, `imagen_listado`, `imagen_principal`, `imagen_destacar`, `imagen_ficha_tecnica`, `created`, `updated`) VALUES
(1, 1, 1, 'Inspiron-1545', 'PortÃ¡til dell para todo tipo de uso ', 54816, NULL, 1, 1, '', NULL, 2, 5, 1500000, NULL, NULL, NULL, NULL, 1800000, 'Activo', 'Alta', 12, 'fotos/9f1c531f20f3e8a04e406b727be26c78.jpg', 'fotos/9f1c531f20f3e8a04e406b727be26c78.jpg', 'fotos/9f1c531f20f3e8a04e406b727be26c78.jpg', '', '2011-02-28 14:52:06', '2011-03-01 15:05:56'),
(2, 2, 1, 'Vostro 200', 'Computador de escritorio dell para uso bÃ¡sico de la casa', 8745, NULL, 1, 1, '', NULL, 2, 7, 800000, NULL, NULL, NULL, NULL, 1200000, 'Activo', 'Alta', 13, 'fotos/d2565e7f5ff832db94604d0c901be3d4.jpg', 'fotos/d2565e7f5ff832db94604d0c901be3d4.jpg', 'fotos/d2565e7f5ff832db94604d0c901be3d4.jpg', '', '2011-02-28 14:53:26', '2011-03-01 15:06:00'),
(3, 4, 1, 'Impresora Dell 1130', 'Impresora lÃ¡ser de alto desempeÃ±o', 2140, NULL, 0, 1, '', NULL, 1, 4, 250000, NULL, NULL, NULL, NULL, 350000, 'Activo', 'Alta', 10, 'fotos/77932ba6d5a9c399377ef5fbeb35716c.jpg', 'fotos/77932ba6d5a9c399377ef5fbeb35716c.jpg', 'fotos/77932ba6d5a9c399377ef5fbeb35716c.jpg', '', '2011-02-28 14:55:28', '2011-02-28 17:42:21'),
(4, 1, 2, 'HP Envy 17', 'Computador portatil de alto desempeÃ±o para diseÃ±o y videojuegos', 7451, NULL, 1, 0, '', NULL, NULL, NULL, 2500000, NULL, NULL, NULL, NULL, 3500000, 'Activo', 'Alta', 52, 'fotos/d4c17e83809191312b773b3e5308806f.jpg', 'fotos/d4c17e83809191312b773b3e5308806f.jpg', 'fotos/d4c17e83809191312b773b3e5308806f.jpg', '', '2011-02-28 14:57:27', '2011-03-01 15:06:11'),
(5, 2, 2, 'HP 3130', ' Intel Core i5-650 3.2GHz, 4GB DDR3, 320GB HDD, DVDRW, Windows 7 Professional 64-bit', 21436, NULL, 1, 0, '', NULL, NULL, NULL, 1200000, NULL, NULL, NULL, NULL, 1500000, 'Activo', 'Alta', 142, 'fotos/76ef0c0933513f82a0d061a37bd83a85.jpg', 'fotos/76ef0c0933513f82a0d061a37bd83a85.jpg', 'fotos/76ef0c0933513f82a0d061a37bd83a85.jpg', '', '2011-02-28 15:03:01', '2011-03-01 15:06:13'),
(6, 2, 2, 'HP Workstation Z600', 'Intel Xeon E5506 2.13GHz, 6GB DDR3, 250GB HDD, DVDRW, NVIDIA Quadro NVS450, Windows 7 Professional 32-bit', 5461, NULL, 0, 0, '', NULL, 1, 3, 2600000, NULL, NULL, NULL, NULL, 3600000, 'Activo', 'Alta', 12, 'fotos/b9086f3509967e330cd1ec95294f09d7.jpg', 'fotos/b9086f3509967e330cd1ec95294f09d7.jpg', 'fotos/b9086f3509967e330cd1ec95294f09d7.jpg', '', '2011-02-28 15:09:01', '2011-03-01 15:06:05'),
(7, 2, 2, 'HP 505B', 'AMD Athlon II X2 3.0GHz, 3GB DDR3, 250GB HDD, DVDRW, Windows 7 Professional 64-bit', 1230, NULL, 0, 1, '', NULL, NULL, NULL, 1700000, NULL, NULL, NULL, NULL, 2400000, 'Activo', 'Alta', 14, 'fotos/548ba51a2edb6424741d021e8cc440f2.jpg', 'fotos/548ba51a2edb6424741d021e8cc440f2.jpg', 'fotos/548ba51a2edb6424741d021e8cc440f2.jpg', 'fotos/548ba51a2edb6424741d021e8cc440f2.jpg', '2011-02-28 15:12:39', '2011-02-28 17:05:36'),
(8, 2, 2, 'HP Slim 3209', 'El computador perfecto', 1234, NULL, 0, 0, '', NULL, 2, 4, 1600000, NULL, NULL, NULL, NULL, 2100000, 'Activo', 'Alta', 26, 'fotos/ee1b17f5f5789aedc1d0c864c0f41feb.jpg', 'fotos/ee1b17f5f5789aedc1d0c864c0f41feb.jpg', 'fotos/ee1b17f5f5789aedc1d0c864c0f41feb.jpg', '', '2011-03-08 12:08:27', '2011-03-08 12:08:27'),
(9, 2, 2, 'Compaq Q2002', 'Computador para el hogar', 5421, NULL, 0, 0, '', NULL, NULL, NULL, 1100000, NULL, NULL, NULL, NULL, 1500000, 'Activo', 'Alta', 32, 'fotos/985d4823009edd21ef2bd330bfb8302d.jpg', 'fotos/985d4823009edd21ef2bd330bfb8302d.jpg', 'fotos/985d4823009edd21ef2bd330bfb8302d.jpg', '', '2011-03-08 12:09:27', '2011-03-08 12:09:27'),
(10, 2, 1, 'Alienware 5623', 'Computador de alto rendimiento', 2346, NULL, 0, 0, '', NULL, NULL, NULL, 1500000, NULL, NULL, NULL, NULL, 2300000, 'Activo', 'Alta', 564, 'fotos/028ca199d478ff948a7141e562ffedfc.jpg', 'fotos/028ca199d478ff948a7141e562ffedfc.jpg', 'fotos/028ca199d478ff948a7141e562ffedfc.jpg', '', '2011-03-08 12:10:30', '2011-03-08 12:10:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `tipo_prov` varchar(8) NOT NULL,
  `tipo_iden_pro` varchar(5) NOT NULL,
  `nit_proveedor` int(15) NOT NULL,
  `digito_ver` varchar(1) DEFAULT NULL,
  `clasificacion` varchar(30) NOT NULL,
  `p_nom_prov` varchar(25) NOT NULL,
  `s_nom_prov` varchar(25) DEFAULT NULL,
  `p_ape_prov` varchar(25) NOT NULL,
  `s_ape_prov` varchar(25) DEFAULT NULL,
  `representante_legal` varchar(50) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `ciudad` varchar(40) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono_1` int(15) NOT NULL,
  `telefono_2` int(15) DEFAULT NULL,
  `celular` int(30) DEFAULT NULL,
  `e_mail` varchar(60) DEFAULT NULL,
  `estado_proveedor` varchar(1) NOT NULL,
  `tipo_regimen` varchar(20) NOT NULL,
  `notas_proveedor` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `tipo_prov`, `tipo_iden_pro`, `nit_proveedor`, `digito_ver`, `clasificacion`, `p_nom_prov`, `s_nom_prov`, `p_ape_prov`, `s_ape_prov`, `representante_legal`, `pais`, `departamento`, `ciudad`, `direccion`, `telefono_1`, `telefono_2`, `celular`, `e_mail`, `estado_proveedor`, `tipo_regimen`, `notas_proveedor`, `created`, `updated`) VALUES
(1, '', '', 111111, '', '', 'Reynell', '', 'Gonzales', '', '', '', '', '', '', 55555555, NULL, NULL, '', '', '', '', '2011-03-10 16:29:30', '2011-03-10 16:36:19'),
(2, '', '', 222222, '', '', 'Felipe', '', 'Gonzales', '', '', '', '', '', '', 5555555, NULL, NULL, '', '', '', '', '2011-03-10 16:36:56', '2011-03-10 16:36:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Super_Administrador'),
(2, 'Administrador'),
(3, 'Vendedor'),
(4, 'Web'),
(5, 'Clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `description` text,
  `content` longtext,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `services`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text,
  `estado` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `surveys`
--

INSERT INTO `surveys` (`id`, `titulo`, `estado`, `created`, `updated`) VALUES
(1, 'Cual es tu marca de portÃ¡tiles favorita??', 1, '2011-03-14 11:34:32', '2011-03-14 13:09:13'),
(2, 'Cuel es el mejor dispositivo movil', 0, '2011-03-14 11:35:16', '2011-03-14 13:01:23'),
(3, '\r\nEncuesta de prueba', 0, '2011-03-14 11:38:27', '2011-03-14 11:38:27'),
(4, 'otra de prubea', 0, '2011-03-14 11:42:07', '2011-03-14 13:02:17'),
(5, 'Cuel es el mejor dispositivo movil', 0, '2011-03-14 12:52:03', '2011-03-14 12:52:03'),
(6, 'Cuel es el mejor dispositivo movil', 0, '2011-03-14 12:53:43', '2011-03-14 12:53:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `survey_options`
--

CREATE TABLE IF NOT EXISTS `survey_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `votos` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_survey_options_surveys1` (`survey_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `survey_options`
--

INSERT INTO `survey_options` (`id`, `survey_id`, `name`, `votos`) VALUES
(1, 1, 'Dell', 2),
(2, 1, 'Apple', 1),
(3, 1, 'Toshiba', 1),
(4, 1, 'Sony', 0),
(5, 1, 'Hp', 0),
(6, 2, 'Un BlackBerry', 0),
(7, 2, 'Iphone', 0),
(8, 2, 'Ipad', 0),
(9, 2, 'Sansumg Galaxy Tab s', 0),
(10, 3, 'Un BlackBerry', 0),
(11, 3, 'Iphone', 0),
(12, 3, 'Ipad', 0),
(13, 3, 'Sansumg Galaxy Tab', 0),
(14, 1, 'PANDAles', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tipo_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipo_movimiento` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `nombre`, `descripcion`, `tipo_movimiento`) VALUES
(1, 'FC', 'Factura de Compra  [Aumenta las cantidades en el inventario]', 'E'),
(2, 'VO', 'Ventas On-Line [Disminuye las cantidades en el inventario]', 'S'),
(3, 'DP', ' Devolucion Proveedor  [Disminuye las cantidades en el inventario]', 'S'),
(4, 'DC', 'Devolucion Cliente   [Aumenta las cantidades en el inventario]', 'E'),
(5, 'FV', 'Factura de venta   [Disminuye las cantidades en el inventario]', 'S'),
(6, 'SV', 'Salidas Varias   [Disminuye las cantidades en el inventario]', 'S'),
(7, 'EV', 'Entradas Varias   [Aumenta las cantidades en el inventario]', 'E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `tipo_identificacion` varchar(3) DEFAULT NULL,
  `numero_identificacion` int(11) DEFAULT NULL,
  `primer_nombre` varchar(25) DEFAULT NULL,
  `segundo_nombre` varchar(25) DEFAULT NULL,
  `primer_apellido` varchar(25) DEFAULT NULL,
  `segundo_apellido` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `telefono_adicional` int(15) DEFAULT NULL,
  `celular` int(15) DEFAULT NULL,
  `celular_adicional` int(15) DEFAULT NULL,
  `foto` varchar(25) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_belongs_to_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `users`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `audits`
--
ALTER TABLE `audits`
  ADD CONSTRAINT `auidtdeunusuario` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventariodelproducto` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventariodelproveedor` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `deltipodedocumento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `imagendelagaleria` FOREIGN KEY (`photo_album_id`) REFERENCES `photo_albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `photo_albums`
--
ALTER TABLE `photo_albums`
  ADD CONSTRAINT `galeriadelproducto` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `pertenece a un fabricante` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productsbelogstocategorie` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `survey_options`
--
ALTER TABLE `survey_options`
  ADD CONSTRAINT `fk_survey_options_surveys1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_belongs_to_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
