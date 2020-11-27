-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2020 a las 22:07:44
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsivolicores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administrador`
--

CREATE TABLE `tbl_administrador` (
  `PK_ID_Administrador` int(11) NOT NULL,
  `Ad_Nombre` varchar(45) NOT NULL,
  `Ad_Apellido` varchar(45) NOT NULL,
  `Ad_Email` varchar(100) NOT NULL,
  `Ad_Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_administrador`
--

INSERT INTO `tbl_administrador` (`PK_ID_Administrador`, `Ad_Nombre`, `Ad_Apellido`, `Ad_Email`, `Ad_Password`) VALUES
(0, 'testing', 'testingon', 'testing@outlook.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(1, 'root', 'rooter', 'root@outlook.com', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `PK_ID_Banner` int(11) NOT NULL,
  `B_Imagen` text NOT NULL,
  `B_Nombre` varchar(45) NOT NULL,
  `B_Fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_banner`
--

INSERT INTO `tbl_banner` (`PK_ID_Banner`, `B_Imagen`, `B_Nombre`, `B_Fecha_actualizacion`) VALUES
(1, 'Cócteles-con-vino.jpg', 'Parallax', '2020-11-13 17:28:51'),
(2, 'Juniper_slide_1.jpg', 'Slide_uno', '2020-11-13 17:33:20'),
(3, 'Oktoberfest_Slide_1.jpg', 'Slide_dos', '2020-11-13 17:33:20'),
(4, 'budweiser_slide_1.jpg', 'Slide_tres', '2020-11-13 17:35:07'),
(5, 'Wallpaper_Cócteles.jpg', 'Receta_coctel', '2020-11-13 17:39:56'),
(6, 'Wallpaper_cart.jpg', 'Carrito', '2020-11-13 17:39:56'),
(7, 'Wallpaper_Contacto.jpg', 'Finalizar_pedido', '2020-11-13 17:39:56'),
(8, 'Wallpaper_Vinos.jpg', 'Login', '2020-11-13 17:39:56'),
(9, 'Wallpaper_Vino1.jpg', 'Registro', '2020-11-13 17:39:56'),
(17, 'Wallpaper_Ron.jpg', 'Licores', '2020-11-17 17:12:19'),
(18, 'Wallpaper_Cerveza.jpg', 'Cervezas', '2020-11-17 17:13:06'),
(19, 'Wallpaper_Gaseosas.jpg', 'Bebidas', '2020-11-17 17:14:17'),
(20, 'Wallpaper_Vinos.jpg', 'Vinos', '2020-11-17 17:16:37'),
(21, 'Wallpaper_Cócteles.jpg', 'Cócteles', '2020-11-17 17:17:17'),
(22, 'Wallpaper_Vodka.jpg', 'Alone', '2020-11-17 17:28:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrito_pedidos`
--

CREATE TABLE `tbl_carrito_pedidos` (
  `PK_ID_Carrito` int(11) NOT NULL,
  `Pt_Cantidad` int(11) NOT NULL,
  `Car_Total` float NOT NULL,
  `Car_SubTotal` float NOT NULL,
  `FK_ID_Cliente` int(11) NOT NULL,
  `FK_ID_Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_carrito_pedidos`
--

INSERT INTO `tbl_carrito_pedidos` (`PK_ID_Carrito`, `Pt_Cantidad`, `Car_Total`, `Car_SubTotal`, `FK_ID_Cliente`, `FK_ID_Producto`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 10, 10, 1000, 6, 1),
(3, 22, 22, 2222, 6, 2),
(4, 10, 10, 1000, 6, 1),
(5, 22, 22, 2222, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `PK_ID_Categoria` int(11) NOT NULL,
  `Cat_Nombre` varchar(45) NOT NULL,
  `Cat_Imagen` text NOT NULL,
  `Cat_Banner_Imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`PK_ID_Categoria`, `Cat_Nombre`, `Cat_Imagen`, `Cat_Banner_Imagen`) VALUES
(82, 'Licores', 'Licores-1.jpg', 'Wallpaper_Cerveza.jpg'),
(83, 'Cervezas', 'Cervezas-1.jpg', 'Wallpaper_Cerveza.jpg'),
(84, 'Bebidas', 'Bebidas-1.jpg', 'Wallpaper_Gaseosas.jpg'),
(85, 'Vinos', 'Vino-1.jpg', 'Wallpaper_Vinos.jpg'),
(86, 'Cócteles', '', 'Wallpaper_Cócteles.jpg'),
(87, 'Alone', '', 'Wallpaper_Vodka.jpg');

--
-- Disparadores `tbl_categoria`
--
DELIMITER $$
CREATE TRIGGER `Tbl_catxsub_Tbl_categoria_BEFORE_DELETE` BEFORE DELETE ON `tbl_categoria` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_catxsub
     WHERE (FK_ID_Categoria = old.PK_ID_Categoria);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tbl_categoria_tbl_banner` AFTER INSERT ON `tbl_categoria` FOR EACH ROW INSERT INTO tbl_banner
(B_Imagen, B_Nombre)
VALUES
(new.Cat_Banner_Imagen, new.Cat_Nombre)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tbl_categoria_tbl_banner_UPDATE` AFTER UPDATE ON `tbl_categoria` FOR EACH ROW UPDATE
    tbl_banner
SET
    B_Imagen =(NEW.Cat_Banner_Imagen),
    B_Nombre =(NEW.Cat_Nombre)
WHERE
    (B_Nombre = old.Cat_Nombre)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_catxsub`
--

CREATE TABLE `tbl_catxsub` (
  `FK_ID_Categoria` int(11) DEFAULT NULL,
  `FK_ID_SubCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_catxsub`
--

INSERT INTO `tbl_catxsub` (`FK_ID_Categoria`, `FK_ID_SubCategoria`) VALUES
(82, 78),
(82, 79),
(82, 80),
(83, 81),
(83, 82),
(84, 83),
(84, 84),
(85, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `PK_ID_Cliente` int(11) NOT NULL,
  `Cl_Nombre` varchar(45) NOT NULL,
  `Cl_Apellido` varchar(45) NOT NULL,
  `Cl_Dirección` varchar(45) NOT NULL,
  `Cl_Telefono` varchar(16) NOT NULL,
  `Cl_Fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `Cl_Pedidos_realizado` varchar(5) NOT NULL,
  `Cl_email` varchar(64) NOT NULL,
  `Cl_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`PK_ID_Cliente`, `Cl_Nombre`, `Cl_Apellido`, `Cl_Dirección`, `Cl_Telefono`, `Cl_Fecha_registro`, `Cl_Pedidos_realizado`, `Cl_email`, `Cl_password`) VALUES
(1, 'Juan Esteban', 'Sanchez Aragon', 'Calle 11 15-91', '3222312397', '2020-06-19 17:34:27', '0', 'juan@mail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'Alejandro', 'Repizo', 'Calle 11#12-91', '3222312397', '2020-09-22 17:22:39', '5', 'alejo.oafr2001@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(11, 'testingo', 'testi', 'Calle 11 #15-91', '3222312397', '2020-11-18 18:37:08', '0', 'alejo.oafgr2001@afginsdasd', '81dc9bdb52d04dc20036dbd8313ed055'),
(12, 'Wiston', 'Andrade', 'Calle 11 #15-91', '32223', '2020-11-19 18:19:01', '0', 'will@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(14, 'Ataque', 'atac', 'Calle 11#12-91', '2323', '2020-11-20 16:45:57', '0', 'atac@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_envio`
--

CREATE TABLE `tbl_envio` (
  `PK_ID_Envio` int(11) DEFAULT NULL,
  `Cl_Nombre` text NOT NULL,
  `Pt_Nombre` text NOT NULL,
  `Ped_Fecha` text DEFAULT NULL,
  `Pt_Cantidad` varchar(40) NOT NULL,
  `Ped_Direccion` text DEFAULT NULL,
  `Cl_Telefono` varchar(45) NOT NULL,
  `Total` text NOT NULL,
  `Ped_Observaciones` text DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `PK_ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_envio`
--

INSERT INTO `tbl_envio` (`PK_ID_Envio`, `Cl_Nombre`, `Pt_Nombre`, `Ped_Fecha`, `Pt_Cantidad`, `Ped_Direccion`, `Cl_Telefono`, `Total`, `Ped_Observaciones`, `Estado`, `PK_ID_Cliente`) VALUES
(6, '0', '', '2020-10-10 18:39:36', '', 'Calle 11', '', '', 'Rock and I will be able to ', 'Por completar', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `PK_ID_Inventario` int(11) NOT NULL,
  `FK_ID_ProductoInventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`PK_ID_Inventario`, `FK_ID_ProductoInventario`) VALUES
(1, 1),
(2, 2),
(34, 48),
(35, 49),
(36, 50),
(37, 51),
(38, 52),
(39, 53);

--
-- Disparadores `tbl_inventario`
--
DELIMITER $$
CREATE TRIGGER `Tbl_Invetario_AFTER_DELETE` AFTER DELETE ON `tbl_inventario` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_producto
     WHERE (PK_ID_Producto = old.FK_ID_ProductoInventario);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_marca`
--

CREATE TABLE `tbl_marca` (
  `PK_ID_Marca` int(11) NOT NULL,
  `Ma_Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_marca`
--

INSERT INTO `tbl_marca` (`PK_ID_Marca`, `Ma_Nombre`) VALUES
(1, 'Club'),
(20, '2'),
(21, '3'),
(22, '4'),
(23, '5'),
(27, '6'),
(60, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `PK_ID_Pedido` int(11) NOT NULL,
  `Cl_Nombre` text NOT NULL,
  `Pt_Nombre` text NOT NULL,
  `Ped_Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Pt_Cantidad` varchar(40) NOT NULL,
  `Ped_Direccion` varchar(45) NOT NULL,
  `Cl_Telefono` varchar(45) NOT NULL,
  `Total` text NOT NULL,
  `Ped_Observaciones` text DEFAULT NULL,
  `Estado` varchar(45) NOT NULL,
  `PK_ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`PK_ID_Pedido`, `Cl_Nombre`, `Pt_Nombre`, `Ped_Fecha`, `Pt_Cantidad`, `Ped_Direccion`, `Cl_Telefono`, `Total`, `Ped_Observaciones`, `Estado`, `PK_ID_Cliente`) VALUES
(1, '', '', '2020-09-14 00:00:00', '', 'Calle 11', '', '', NULL, 'Pendiente', 0),
(4, '', '', '2020-10-10 18:29:23', '', 'Calle 11', '', '', 'NOTHING ', 'Pendiente', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `PK_ID_Producto` int(11) NOT NULL,
  `Pt_codigo` varchar(5) NOT NULL,
  `Pt_Nombre` varchar(45) NOT NULL,
  `Pt_Precio` int(100) NOT NULL,
  `Pt_Imagen` text DEFAULT NULL,
  `Pt_Presentacion` varchar(5) NOT NULL,
  `Pt_Grados_alchol` varchar(10) NOT NULL,
  `Pt_Pais` varchar(45) NOT NULL,
  `Pt_Color` varchar(45) NOT NULL,
  `Pt_Stock` int(11) NOT NULL,
  `FK_ID_Categoria` int(11) NOT NULL,
  `FK_ID_Marca` int(11) NOT NULL,
  `FK_ID_SubCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`PK_ID_Producto`, `Pt_codigo`, `Pt_Nombre`, `Pt_Precio`, `Pt_Imagen`, `Pt_Presentacion`, `Pt_Grados_alchol`, `Pt_Pais`, `Pt_Color`, `Pt_Stock`, `FK_ID_Categoria`, `FK_ID_Marca`, `FK_ID_SubCategoria`) VALUES
(1, '0001', 'Firts Producto', 0, 'Cerveza_Heineken_Six_pack_720x960.jpg', '0', '0', 'Colombia', 'Dorado', 100, 1, 1, 0),
(2, '002', 'Cerveza Club Colombia Dorada Six pack Botella', 14, 'Cerveza_Club_Colombia_Six_pack_720x960.jpg', '330ml', '0', 'Colombia', 'rojo', 10, 1, 1, 0),
(48, '0001', 'Cerveza Botella Budweiser', 2900, 'Cerverza_budweiser_720x960.jpg', '330ml', '10', 'Colombia', 'Dorado', 10, 83, 1, 81),
(49, '0002', 'Crema de Whisky Baileys', 47400, 'Baileys_720x960.jpg', '750ml', '10', 'Colombia', 'Dorado', 3, 82, 20, 80),
(50, '0003', 'Manantial con Gas', 1200, 'Agua_Manantial_gas_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 20, 84, 1, 83),
(51, '0004', 'Vino Casillero Del Diablo', 50000, 'Casillero_Del_Diablo_Cabernet_Sauvignon_720x960.jpg', '750ml', '10', 'Chile', 'Oscuro', 10, 85, 1, 85),
(52, '0005', 'Cerveza Corona Six pack Botella', 21900, 'Cerveza_Corona_Six_pack_720x960.jpg', '355ml', '10', 'México', 'Dorado', 4, 87, 1, NULL),
(53, '006', 'Beck&#39;s', 3300, 'Cerveza_Beck_720x960.jpg', '275ml', '10', 'Colombia', 'Verde', 3, 83, 1, 81);

--
-- Disparadores `tbl_producto`
--
DELIMITER $$
CREATE TRIGGER `Tbl_Producto_AFTER_INSERT` AFTER INSERT ON `tbl_producto` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario
(FK_ID_ProductoInventario)
VALUES(new.PK_ID_Producto);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_receta_coctel`
--

CREATE TABLE `tbl_receta_coctel` (
  `PK_ID_Receta` int(11) NOT NULL,
  `RC_Nombre` varchar(45) NOT NULL,
  `RC_Receta` text NOT NULL,
  `RC_Fecha` date NOT NULL DEFAULT current_timestamp(),
  `RC_Autor` varchar(45) NOT NULL,
  `RC_Descripcion` text NOT NULL,
  `RC_Image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_receta_coctel`
--

INSERT INTO `tbl_receta_coctel` (`PK_ID_Receta`, `RC_Nombre`, `RC_Receta`, `RC_Fecha`, `RC_Autor`, `RC_Descripcion`, `RC_Image`) VALUES
(1, 'Coctel prueba', '1. Coloque el hielo, el vodka, y luego el resto de los ingredientes en el vaso mezclador.\n2. Remueva con una cucharilla mezcladora durante 8 o 10 segundos.\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en el vaso de trago largo.\n4. Coloque la rama de apio dentro del vaso y sirva inmediatamente.', '2020-09-16', 'Alejandro Repizo', 'El Bloody Mary auténtico lleva “Worcestershire Sauce”, una salsa típica de Inglaterra con un\n sabor avinagrado que está de muerte. Se puede comprar en España en las secciones de comida\n Británica de grandes supermercados pero también podéis hacer el cóctel\n sin ella y tampoco cambiará demasiado el resultado', '1.jpg'),
(2, 'Coctel 2', 'El Bloody Mary auténtico lleva “Worcestershire Sauce”, una salsa típica de Inglaterra con un\n sabor avinagrado que está de muerte. Se puede comprar en España en las secciones de comida\n Británica de grandes supermercados pero también podéis hacer el cóctel\n sin ella y tampoco cambiará demasiado el resultado\n\n1. Coloque el hielo, el vodka, y luego el resto de los ingredientes en el vaso mezclador.\n2. Remueva con una cucharilla mezcladora durante 8 o 10 segundos.\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en el vaso de trago largo.\n4. Coloque la rama de apio dentro del vaso y sirva inmediatamente.', '2020-09-16', 'Admin', 'El Bloody Mary auténtico lleva “Worcestershire Sauce”, una salsa típica de Inglaterra con un\n sabor avinagrado que está de muerte. Se puede comprar en España en las secciones de comida\n Británica de grandes supermercados pero también podéis hacer el cóctel\n sin ella y tampoco cambiará demasiado el resultado', '2.jpg'),
(3, 'Cóctel 3', '', '2020-09-14', '', '', '3.jpg'),
(4, 'Cóctel 4', '', '2020-09-14', '', '', '4.jpg'),
(5, 'Cóctel 5', 'Preparacion', '2020-09-16', 'Administrador', 'Description', '5.jpg'),
(7, 'Cóctel 6', '', '2020-09-14', '', '', '6.jpg'),
(8, 'Cóctel 7', 'this is a little bit', '2020-10-06', 'Administrador', 'actually', '7.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reporte_pedido`
--

CREATE TABLE `tbl_reporte_pedido` (
  `PK_ID_reporte` int(11) DEFAULT NULL,
  `Cl_Nombre` text NOT NULL,
  `Pt_Nombre` text NOT NULL,
  `Ped_Fecha` text DEFAULT NULL,
  `Pt_Cantidad` varchar(40) NOT NULL,
  `Ped_Direccion` text DEFAULT NULL,
  `Cl_Telefono` varchar(45) NOT NULL,
  `Total` text NOT NULL,
  `Ped_Observaciones` text DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `PK_ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_reporte_pedido`
--

INSERT INTO `tbl_reporte_pedido` (`PK_ID_reporte`, `Cl_Nombre`, `Pt_Nombre`, `Ped_Fecha`, `Pt_Cantidad`, `Ped_Direccion`, `Cl_Telefono`, `Total`, `Ped_Observaciones`, `Estado`, `PK_ID_Cliente`) VALUES
(13, '', '', '2020-10-10 19:07:43', '', 'Calle 12', '', '', 'testing is going to be able to come in for this reason why we have to go to your office ', 'Cancelado', 0),
(11, '', '', '2020-10-10 19:03:42', '', 'do you ', '', '', 'Do you have any questions or ', 'Cancelado', 0),
(10, '', '', '2020-10-10 18:59:45', '', 'Calle 12', '', '', 'ANDY is going to have the opportunity ', 'Cancelado', 0),
(8, '', '', '2020-10-10 18:39:36', '', 'Calle 11', '', '', 'Rock and I will be able to ', 'Cancelado', 0),
(37, 'testingo', 'Crema de Whisky Baileys', '2020-11-25 17:39:37', '1', 'Calle 11 #15-91', '3222312397', '47,400', '', 'Cancelado', 11),
(0, '', '', '', '', '', '', '', '', 'Cancelado', 0),
(0, '', '', '', '', '', '', '', '', 'Cancelado', 0),
(0, '', '', '', '', '', '', '', '', 'Cancelado', 0),
(44, 'testingo', 'Manantial con Gas', '2020-11-25 17:58:40', '1', 'Calle 11 #15-91', '3222312397', '1,200', '', 'Cancelado', 11),
(43, 'testingo', 'Crema de Whisky Baileys', '2020-11-25 17:58:40', '1', 'Calle 11 #15-91', '3222312397', '47,400', '', 'Cancelado', 11),
(45, 'testingo', 'Cerveza Corona Six pack Botella', '2020-11-25 18:18:04', '1', 'Calle 11 #15-91', '3222312397', '21,900', '', 'Cancelado', 11),
(46, 'testingo', 'Vino Casillero Del Diablo', '2020-11-26 15:55:26', '1', 'Calle 11 #15-91', '3222312397', '50,000', '', 'Cancelado', 11),
(46, 'testingo', 'Vino Casillero Del Diablo', '2020-11-26 15:55:26', '1', 'Calle 11 #15-91', '3222312397', '50,000', '', 'Cancelado', 11),
(46, 'testingo', 'Vino Casillero Del Diablo', '2020-11-26 15:55:26', '1', 'Calle 11 #15-91', '3222312397', '50,000', '', 'Cancelado', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reporte_ventas`
--

CREATE TABLE `tbl_reporte_ventas` (
  `PK_ID_reporte` int(11) DEFAULT NULL,
  `Cl_Nombre` text NOT NULL,
  `Pt_Nombre` text NOT NULL,
  `Ped_Fecha` text DEFAULT NULL,
  `Pt_Cantidad` varchar(40) NOT NULL,
  `Ped_Direccion` text DEFAULT NULL,
  `Cl_Telefono` varchar(45) NOT NULL,
  `Total` text NOT NULL,
  `Ped_Observaciones` text DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `PK_ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_reporte_ventas`
--

INSERT INTO `tbl_reporte_ventas` (`PK_ID_reporte`, `Cl_Nombre`, `Pt_Nombre`, `Ped_Fecha`, `Pt_Cantidad`, `Ped_Direccion`, `Cl_Telefono`, `Total`, `Ped_Observaciones`, `Estado`, `PK_ID_Cliente`) VALUES
(12, '', '', '2020-10-10 19:07:43', '', 'Calle 11', '', '', 'testing to see if you can ', 'Completado', 0),
(9, '', '', '2020-10-10 18:59:45', '', 'cALE', '', '', 'KNOT and a little ', 'Completado', 0),
(5, '', '', '2020-10-10 18:29:23', '', 'Calle 12', '', '', 'not sure if I can be there for you ', 'Completado', 0),
(7, '', '', '2020-10-10 18:39:36', '', 'Calle 11', '', '', 'Rock and I will be able to ', 'Completado', 0),
(0, '', '', '', '', '', '', '', '', 'Completado', 0),
(0, '', '', '', '', '', '', '', '', 'Completado', 0),
(0, '', '', '', '', '', '', '', '', 'Completado', 0),
(40, 'testingo', 'Vino Casillero Del Diablo', '2020-11-25 17:49:19', '1', 'Calle 11 #15-91', '3222312397', '50,000', '', 'Completado', 11),
(41, 'testingo', 'Cerveza Corona Six pack Botella', '2020-11-25 17:58:40', '1', 'Calle 11 #15-91', '3222312397', '21,900', '', 'Completado', 11),
(42, 'testingo', 'Vino Casillero Del Diablo', '2020-11-25 17:58:40', '2', 'Calle 11 #15-91', '3222312397', '100,000', '', 'Completado', 11),
(43, 'testingo', 'Crema de Whisky Baileys', '2020-11-25 17:58:40', '1', 'Calle 11 #15-91', '3222312397', '47,400', '', 'Completado', 11),
(45, 'testingo', 'Cerveza Corona Six pack Botella', '2020-11-25 18:18:04', '1', 'Calle 11 #15-91', '3222312397', '21,900', '', 'Completado', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_subcategoria`
--

CREATE TABLE `tbl_subcategoria` (
  `PK_ID_SubCategoria` int(11) NOT NULL,
  `SCat_Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_subcategoria`
--

INSERT INTO `tbl_subcategoria` (`PK_ID_SubCategoria`, `SCat_Nombre`) VALUES
(1, 'Aguardiente'),
(64, 'Whisky'),
(65, 'Importada'),
(66, 'Nacionales'),
(73, 'Jovenes'),
(74, 'Espumosos'),
(75, 'Gaseosas'),
(76, 'Jugos y te'),
(77, 'Vodka'),
(78, 'Aguardiente'),
(79, 'Ron'),
(80, 'Whisky'),
(81, 'Importadas'),
(82, 'Nacionales'),
(83, 'Agua'),
(84, 'Gaseosas'),
(85, 'Espumosos');

--
-- Disparadores `tbl_subcategoria`
--
DELIMITER $$
CREATE TRIGGER `Tbl_catxsub_BEFORE_DELETE` BEFORE DELETE ON `tbl_subcategoria` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_catxsub
     WHERE (FK_ID_SubCategoria = old.PK_ID_SubCategoria);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD PRIMARY KEY (`PK_ID_Administrador`);

--
-- Indices de la tabla `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`PK_ID_Banner`);

--
-- Indices de la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  ADD PRIMARY KEY (`PK_ID_Carrito`),
  ADD KEY `FK_ID_Cliente` (`FK_ID_Cliente`),
  ADD KEY `FK_ID_Producto` (`FK_ID_Producto`);

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`PK_ID_Categoria`);

--
-- Indices de la tabla `tbl_catxsub`
--
ALTER TABLE `tbl_catxsub`
  ADD KEY `FK_ID_Categoria` (`FK_ID_Categoria`),
  ADD KEY `FK_ID_SubCategoria` (`FK_ID_SubCategoria`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`PK_ID_Cliente`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`PK_ID_Inventario`),
  ADD KEY `FK_ID_ProductoInventario` (`FK_ID_ProductoInventario`);

--
-- Indices de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  ADD PRIMARY KEY (`PK_ID_Marca`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`PK_ID_Pedido`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`PK_ID_Producto`),
  ADD KEY `PK_ID_SubCategoria` (`FK_ID_SubCategoria`),
  ADD KEY `FK_ID_Categoria` (`FK_ID_Categoria`),
  ADD KEY `FK_ID_Marca` (`FK_ID_Marca`);

--
-- Indices de la tabla `tbl_receta_coctel`
--
ALTER TABLE `tbl_receta_coctel`
  ADD PRIMARY KEY (`PK_ID_Receta`);

--
-- Indices de la tabla `tbl_subcategoria`
--
ALTER TABLE `tbl_subcategoria`
  ADD PRIMARY KEY (`PK_ID_SubCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `PK_ID_Banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  MODIFY `PK_ID_Carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `PK_ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `PK_ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `PK_ID_Inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `PK_ID_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `PK_ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `PK_ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `tbl_receta_coctel`
--
ALTER TABLE `tbl_receta_coctel`
  MODIFY `PK_ID_Receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbl_subcategoria`
--
ALTER TABLE `tbl_subcategoria`
  MODIFY `PK_ID_SubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  ADD CONSTRAINT `FK_ID_Cliente` FOREIGN KEY (`FK_ID_Cliente`) REFERENCES `tbl_cliente` (`PK_ID_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ID_Producto` FOREIGN KEY (`FK_ID_Producto`) REFERENCES `tbl_producto` (`PK_ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_catxsub`
--
ALTER TABLE `tbl_catxsub`
  ADD CONSTRAINT `tbl_catxsub_ibfk_1` FOREIGN KEY (`FK_ID_Categoria`) REFERENCES `tbl_categoria` (`PK_ID_Categoria`),
  ADD CONSTRAINT `tbl_catxsub_ibfk_2` FOREIGN KEY (`FK_ID_SubCategoria`) REFERENCES `tbl_subcategoria` (`PK_ID_SubCategoria`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `FK_ID_ProductoInventario` FOREIGN KEY (`FK_ID_ProductoInventario`) REFERENCES `tbl_producto` (`PK_ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
