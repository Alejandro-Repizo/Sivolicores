-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2020 a las 01:00:57
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
(1, 'Wallpaper_Ron.jpg', 'Licores', '2020-11-26 16:33:24'),
(2, 'Wallpaper_Cerveza.jpg', 'Cervezas', '2020-11-26 16:33:45'),
(3, 'Wallpaper_Gaseosas.jpg', 'Bebidas', '2020-11-26 16:35:09'),
(4, 'Wallpaper_Vino.jpg', 'Vinos', '2020-11-26 16:35:54'),
(5, 'cocteles-de-fruta.jpg', 'Cócteles', '2020-11-26 16:36:14'),
(6, '2016-09-08.jpg', 'Parallax', '2020-11-26 18:03:54'),
(7, 'banner3.jpg', 'Slide_uno', '2020-11-26 18:03:54'),
(8, 'Oktoberfest_Slide_1.jpg', 'Slide_dos', '2020-11-26 18:03:54'),
(9, 'Juniper_slide_1.jpg', 'Slide_tres', '2020-11-26 18:03:54'),
(10, 'Wallpaper_Vodka.jpg', 'Carrito', '2020-11-26 18:03:54'),
(11, 'Wallpaper_Vinos.jpg', 'Finalizar_pedido', '2020-11-26 18:03:54'),
(12, 'Wallpaper_Vinos.jpg', 'Login', '2020-11-26 18:03:54'),
(13, 'Wallpaper_Vino1.jpg', 'Registro', '2020-11-26 18:03:54'),
(14, '', 'Test', '2020-11-26 19:00:00');

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
(1, 'Licores', 'Licores-1.jpg', 'Wallpaper_Ron.jpg'),
(2, 'Cervezas', '', 'Wallpaper_Cerveza.jpg'),
(3, 'Bebidas', 'Bebidas-1.jpg', 'Wallpaper_Gaseosas.jpg'),
(4, 'Vinos', '', 'Wallpaper_Vino.jpg'),
(5, 'Cócteles', '', 'Wallpaper_Cócteles.jpg'),
(6, 'Test', '', '');

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
(1, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `PK_ID_Cliente` int(11) NOT NULL,
  `Cl_Nombre` varchar(45) NOT NULL,
  `Cl_Apellido` varchar(45) NOT NULL,
  `Cl_Direccion` varchar(200) NOT NULL,
  `Cl_Telefono` varchar(16) NOT NULL,
  `Cl_Fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `Cl_Pedidos_realizado` varchar(5) NOT NULL,
  `Cl_email` varchar(64) NOT NULL,
  `Cl_password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(40, 40);

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
(1, 'Aguardiente Antioqueño'),
(2, 'Aguardiente Cristal'),
(3, 'Doble Anis'),
(4, 'Nectar'),
(5, 'Aguila'),
(6, 'Budweiser'),
(7, 'Club Colombia'),
(8, 'Corona'),
(9, 'Beck&#39;s'),
(10, 'Heineken'),
(11, 'Pilsen'),
(12, 'Poker'),
(13, 'Sol'),
(14, 'Redd´s'),
(15, 'Casillero del Diablo'),
(16, 'Syrah Malbec'),
(17, 'Gato Negro'),
(18, 'Frontera'),
(19, 'Michel Torino'),
(20, 'Entrecote'),
(21, 'Cielo'),
(22, 'Manantial'),
(23, 'H2Oh!'),
(24, 'Saviloe');

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
  `Ped_Direccion` varchar(200) NOT NULL,
  `Cl_Telefono` varchar(45) NOT NULL,
  `Total` text NOT NULL,
  `Ped_Observaciones` text DEFAULT NULL,
  `Estado` varchar(45) NOT NULL,
  `PK_ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '0001', 'Aguardiente Antioqueño', 35500, 'Aguardiente_Antioqueño_Media_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 20, 1, 1, 1),
(2, '0002', 'Aguardiente Antioqueño', 52000, 'Aguardiente_Antioqueño_Rojo_720x960.jpg', '1000m', '29', 'Colombia', 'Transparante', 30, 1, 1, 1),
(3, '0003', 'Aguardiente Antioqueño Azul sin Azúcar', 95100, 'Aguardiente_Antioqueño_Sin_Azucar_720x960.jpg', '2000m', '29', 'Colombia', 'Transparante', 30, 1, 1, 1),
(4, '0004', 'Aguardiente Cristal Sin Azúcar', 23500, 'Aguardiente_Cristal_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 9, 1, 2, 1),
(5, '0005', 'Aguardiente Doble Anis', 22500, 'Aguardiente_Doble_Anis_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 90, 1, 3, 1),
(6, '0006', 'Aguardiente Nectar Club', 60000, 'Aguardiente_Nectar_720x960.jpg', '2000m', '29', 'Colombia', 'Transparante', 10, 1, 4, 1),
(7, '0007', 'Aguardiente Nectar Club', 15000, 'Aguardiente_Nectar_Media_720x960.jpg', '375ml', '29', 'Colombia', 'Transparante', 20, 1, 4, 1),
(8, '0008', 'Aguardiente Nectar Club Azul', 28700, 'Nectar_Azul_Botella_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 30, 1, 4, 1),
(9, '0009', 'Aguardiente Nectar Club', 35000, 'Nectar_Club_Verde_720x960.jpg', '1000m', '29', 'Colombia', 'Transparante', 23, 1, 4, 1),
(10, '0010', 'Aguardiente Nectar Club Rojo', 28700, 'Nectar_Rojo_Botella_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 23, 1, 4, 1),
(11, '0011', 'Aguardiente Nectar Club', 28700, 'Nectar_Verde_Botella_720x960.jpg', '750ml', '29', 'Colombia', 'Transparante', 100, 1, 4, 1),
(12, '0012', 'Cerveza Botella Budweiser', 2250, 'Cerverza_budweiser_720x960.jpg', '330ml', '5,0', 'Estados Unidos', 'Dorado', 70, 2, 6, NULL),
(13, '0013', 'Cerveza Aguila light Six pack Lata', 12900, 'Cerveza_Aguila_Light_Six_pack_720x960.jpg', '330ml', '5,0', 'Colombia', 'Dorado', 25, 2, 5, NULL),
(14, '0014', 'Cerveza Aguila Six pack lata', 12900, 'Cerveza_Aguila_Six_pack_720x960.jpg', '330ml', '5,0', 'Colombia', 'Dorado', 30, 2, 5, NULL),
(15, '0015', 'Cerveza Aguila sin Alcohol Six pack lata', 12050, 'Cerveza_Aguila_Botella_Six_pack_720x960.jpg', '330ml', '5,0', 'Colombia', 'Dorado', 20, 2, 5, NULL),
(16, '0016', 'Beck&#39;s', 3300, 'Cerveza_Beck_720x960.jpg', '275ml', '5,0', 'Alemania', 'Dorado', 30, 2, 9, NULL),
(17, '0017', 'Cerveza Club Colombia Dorada Six pack Botella', 14100, 'Cerveza_Club_Colombia_Six_pack_720x960.jpg', '330ml', '5,0', 'Colombia', 'Dorado', 60, 2, 7, NULL),
(18, '0018', 'Cerveza Corona Six pack Botella', 21900, 'Cerveza_Corona_Six_pack_720x960.jpg', '355ml', '5,0', 'México', 'Dorado', 59, 2, 8, NULL),
(19, '0019', 'Cerveza Heineken Six pack lata', 20700, 'Cerveza_Heineken_Six_pack_720x960.jpg', '330ml', '5,0', 'Países Bajos', 'Amarillo claro', 40, 2, 10, NULL),
(20, '0020', 'Cerveza Pilsen six pack lata', 12500, 'Cerveza_Pilsen_Six_pack_720x960.jpg', '330ml', '5,0', 'República Cecha', 'Amarillo claro', 40, 2, 11, NULL),
(21, '0021', 'Cerveza Poker Six pack lata', 12500, 'Cerveza_Poker_Six_pack_720x960.jpg', '330ml', '5,0', 'Colombia', 'Dorado', 40, 2, 12, NULL),
(22, '0022', 'Cerveza Sol Six pack Botella', 22500, 'Cerveza_Sol_Six_pack_720x960.jpg', '355ml', '5,0', 'México', 'Amarillo claro', 30, 2, 13, NULL),
(23, '0023', 'Vino Espumoso Baron de Rothberg', 17200, 'Baron_Rothberg_720x960.jpg', '750ml', '10', 'Estados Unidos', 'Transparante', 30, 4, 16, NULL),
(24, '0024', 'Vino Caracter Blanco Dulce', 25900, 'Caracter_Blanco_Dulce_720x960.jpg', '750ml', '19', 'Francia', 'Blanco', 30, 4, 16, NULL),
(25, '0025', 'Vino Caracter-Syrah Malbec', 25900, 'Caracter_Tinto_Dulce_720x960.jpg', '750ml', '10', 'Francia', 'Vino Tinto', 40, 4, 16, NULL),
(26, '0026', 'Vino Casillero del Diablo', 50000, 'Casillero_Del_Diablo_Cabernet_Sauvignon_720x960.jpg', '750ml', '10', 'Chile', 'Vino Tinto', 90, 4, 15, NULL),
(27, '0027', 'Vino Casillero del Diablo Malbec', 50000, 'Casillero_Del_Diablo_Malbec_720x960.jpg', '750ml', '10', 'Chile', 'Vino Tinto', 20, 4, 15, NULL),
(28, '0028', 'Vino Casillero del Diablo Sauvignon Blanc', 46900, 'Casillero_Del_Diablo_Sauvignon_720x960.jpg', '750ml', '10', 'Chile', 'Blanco', 30, 4, 15, NULL),
(29, '0029', 'Vino Frontera Cabernet Sauvinon', 33900, 'Frontera_Cabernet_720x960.jpg', '750ml', '10', 'Chile', 'Vino Tinto', 12, 4, 18, NULL),
(30, '0030', 'Vino Gato Negro Cabernet Sauvignon Rosé', 33900, 'Gato_Negro_Rose_720x960.jpg', '750ml', '10', 'Chile', 'Rosa', 30, 4, 17, NULL),
(31, '0031', 'Vino las Moras Malbec', 38900, 'Las_Moras_720x960.jpg', '750ml', '10', 'Chile', 'Vino Tinto', 30, 4, 18, NULL),
(32, '0032', 'Vino Michel Torino Malbec', 38900, 'Michel_Torino_720x960.jpg', '750ml', '10', 'Chile', 'Vino Tinto', 100, 4, 19, NULL),
(33, '0033', 'Vino Tinto Entrecote Merlot Cabernet', 42700, 'Vino_entrecote_720x960.jpg', '750ml', '10', 'Francia', 'Vino Tinto', 7, 4, 20, NULL),
(34, '0034', 'Cielo', 2200, 'Agua_Cielo_720x960.jpg', '620ml', '0', 'Colombia', 'Transparante', 200, 3, 21, 2),
(35, '0035', 'Manantial con Gas', 1900, 'Agua_Manantial_gas_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 30, 3, 22, 2),
(36, '0036', 'Manantial', 2800, 'Agua_Mantantial_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 30, 3, 22, 2),
(37, '0037', 'H20h! Frutos Tropicales', 3500, 'H2OH__Frutos_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 90, 3, 23, 2),
(38, '0038', 'H20h! Limón', 3500, 'H2OH_limon_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 30, 3, 23, 2),
(39, '0039', 'H20h! Maracuyá', 3500, 'H2OH_Maracuya_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 60, 3, 23, 2),
(40, '0040', 'Saviloe', 3000, 'Saviloe_720x960.jpg', '600ml', '0', 'Colombia', 'Transparante', 40, 3, 24, 2);

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
(1, 'Cóctel Bacardi', '1. Coloque el hielo, el ron, y el resto de los ingredientes en el fondo de la coctelera.\r\n2. Tape la coctelera y agítela energicamente entre 8 o 10 segundos, o hasta notar escarchada la parte exterior de la misma.\r\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en la copa de cóctel.\r\n4. Cortar un trozo de cáscara de limón. Exprima la piel sobre el vaso con los dedos para extraerle la esencia y luego colocarla dentro. Servir de inmediato.', '2020-11-26', 'Juan Felipe Sanchez', 'El cóctel de Bacardi era originalmente el mismo que el Daiquiri, que contenía ron, jugo de lima y azúcar; La versión Granadina del Cóctel Bacardi se originó en los EE. UU., Mientras que la receta original no roja de la compañía Bacardi se originó en Cuba.', 'Cóctel_Bacardi_820x540.jpg'),
(2, 'Cóctel Bloody Mary', '1. Coloque el hielo, el vodka, y luego el resto de los ingredientes en el vaso mezclador.\r\n2. Remueva con una cucharilla mezcladora durante 8 o 10 segundos.\r\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en el vaso de trago largo.\r\n4. Coloque la rama de apio dentro del vaso y sirva inmediatamente.', '2020-11-26', 'Alexis Duarte', 'El Bloody Mary auténtico lleva “Worcestershire Sauce”, una salsa típica de Inglaterra con un sabor avinagrado que está de muerte. Se puede comprar en España en las secciones de comida Británica de grandes supermercados pero también podéis hacer el cóctel sin ella y tampoco cambiará demasiado el resultado.', 'Cóctel_bloody_mary_820x540.jpg'),
(3, 'Cóctel Long Island Iced Tea', '1. Coloque 5 o 6 cubitos y todos los ingredientes salvo la gaseosa de cola y la rodaja de limón, en el fondo de la coctelera.\r\n2. Tape la coctelera y agítela energicamente entre 8 o 10 segundos, o hasta notar escarchada la parte exterior de la misma.\r\n3. Colocar 3 o 4 cubitos en el vaso largo y luego agregue la gaseosa de cola.\r\n4. Colar lentamente la mezcla con un colador de gusanillo u oruga, para crear una gradación con la gaseosa.\r\n5. Para finalizar eche la media rodaja de limón en el vaso. Sirva de inmediato y deje que sea el invitado quien mezcle la bebida.', '2020-11-26', 'Andru Bohorquez', 'La creación de esta bebida se atribuye a Balboa Café de San Francisco. Hizo su aparición a mediados de la década de 1980 y tuvo éxito, sobre todo, entre la población maculina.', 'Cóctel_long_island_ice_tea_820x540.jpg'),
(4, 'Cóctel Sex on the Beach', '1. Coloque el hielo en la parte inferior de la coctelera y agreguelé el vodka.\r\n2. Agregue el resto de los ingredientes en la coctelera y agítela energicamente durante 8 o 10 segundos.\r\n3. Coloque hielo nuevo en un vaso trago largo y cuele el contenido de la coctelera en él.\r\n4. Servir inmediatamente.', '2020-11-26', 'Alexis Duarte', 'El Cóctel Sex on the Beach, es uno de los más famosos en el mundo y su auge se ve reflejado en la época de 1980; en todas las fiestas de playa de la época.', 'Cóctel_sex_beach_820x540.jpg'),
(5, 'Cóctel Whiskey Sour', '1. Coloque el hielo, el whiskey, y el resto de los ingredientes (salvo la cereza) en la coctelera.\r\n2. Tape la coctelera y agítela energicamente entre 8 o 10 segundos, o hasta notar escarchada la parte exterior de la misma.\r\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en el vaso corto.\r\n4. Coloque la cereza dentro del cóctel y sirva inmediatamente.', '2020-11-26', 'Michael Sarmiento', 'El Whisky Sour es un famoso cóctel sour que contiene Bourbon whisky, jugo de limón, azúcar y, opcionalmente, clara de huevo. Se agita y se sirve directamente o sobre hielo. Tradicionalmente se adorna con una rodaja de naranja y una cereza maraschino.', 'Cóctel_Whiskey_Sour_820x540.jpg'),
(6, 'Cóctel Cuba Libre', '1. Corte el cuarto de lima en dos y coloquelos en el vaso largo. Macháquelos con ayuda de un mortero.\r\n2. Coloque el hielo, el ron y la gaseosa en el vaso.\r\n3. Remueva con una cucharilla mezcladora durante 8 o 10 segundos. Servir inmediatamente.', '2020-11-26', 'Danitza Mendez', 'Este cóctel apareció en Cuba durante la época de la ley seca estadounidense. Actualmente algunos lo llaman “mentiroso” para indicar que Cuba sigue sin ser un país libre.', 'Cóctel_Cuba_libre_820x640.jpg'),
(7, 'Cóctel Black Russian', '1. Coloque el hielo, el vodka, y el licor en el vaso corto.\r\n2. Remueva con una cucharilla mezcladora durante 8 o 10 segundos.\r\n3. Servir inmediatamente.', '2020-11-26', 'Alejandro Repizo', 'Lo primero que debes hacer es añadir el hielo en un vas corto. Luego agrégale dos shots de vodka, uno de licor de café y uno de café expreso o instantáneo, para después revolver todo y así obtendrás un “Black Russian”.', 'Cóctel_Black_Russian820x540.jpg'),
(8, 'Cóctel Manhattan', '1. Coloque el hielo el whisky, el vermut y la angostura en el vaso mezclador.\r\n2. Remueva con una cucharilla mezcladora durante 8 o 10 segundos.\r\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en la copa de cóctel.\r\n4. Coloque la cereza dentro de la copa y siva inmediatamente.', '2020-11-26', 'Andru Bohorquez', 'El cóctel Manhattan está considerado uno de los mejores combinados jamás creado, su sabor con matices amargos y dulces es difícil de explicar.', 'Cóctel_Manhattan_820x540.jpg'),
(9, 'Cóctel Cosmopolitan', '1. Coloque el hielo, el vodka, y luego el resto de los ingredientes en la coctelera.\r\n2. Tape la coctelera en la parte superior y agite enérgicamente durante 8 a 10 segundos, o hasta notar escarchada la parte exterior de la misma.\r\n3. Colar la mezcla con un colador de gusanillo u oruga, directo en la copa de cóctel.\r\n4. Cortar un trozo de cáscara de limón. Exprima la piel sobre el vaso con los dedos para extraerle la esencia y luego colocarla dentro. Servir de inmediato.', '2020-11-26', 'Michael Sarmiento', 'Un Cosmopolitan o Cosmo es un cóctel de vodka con cierto matiz a fruta ácida. Se prepara con vodka, triple seco (como Cointreau o Grand Marnier), zumo de arándanos y zumo de lima recién exprimido. Suele servirse en copa de cóctel, adornado con corteza de lima.', 'Cóctel_Cosmopolitan_820x540pg.jpg'),
(10, 'Cóctel Daiquiri', '1. Coloque el hielo y el ron en la coctelera.\r\n2. Agregue el zumo de lima y el jarabe de caña de azúcar.\r\n3. Tape la coctelera y agítela energicamente entre 8 o 10 segundos, o hasta notar escarchada la parte exterior de la misma.\r\n4. Colar el contenido en una copa de cóctel. Sirva de inmediato.', '2020-11-26', 'Danitza Mendez', 'El Daiquiri es un cóctel cubano con una gran historia y de preparación muy sencilla. El sabor exquisito de esta bebida surge a partir de la combinación de ron blanco, con zumo de limón o lima y mucho hielo frappé.', 'Cóctel_daiquiri_820x540.jpg');

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
(2, 'Agua');

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
  MODIFY `PK_ID_Banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `PK_ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `PK_ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `PK_ID_Inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `PK_ID_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `PK_ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `PK_ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tbl_receta_coctel`
--
ALTER TABLE `tbl_receta_coctel`
  MODIFY `PK_ID_Receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_subcategoria`
--
ALTER TABLE `tbl_subcategoria`
  MODIFY `PK_ID_SubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

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
