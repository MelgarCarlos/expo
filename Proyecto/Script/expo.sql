-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2016 a las 18:03:44
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expo`
--
CREATE DATABASE IF NOT EXISTS `expo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `expo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `pedido` int(11) DEFAULT NULL,
  `producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `detalles` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`pedido`, `producto`, `cantidad`, `detalles`) VALUES
(1, 2, 1, 'Pago en efectivo'),
(2, 5, 1, 'Deseo este banner, me podrian ayudar con el diseÃ±o'),
(2, 1, 10, 'Documento se los enviare al correo'),
(2, 3, 1, '3 paginas de guarro, tambien un pliego'),
(3, 2, 8, 'Un par de paquetes de colores para mi hija, favor tenermelos listos en la tarde tipo 4 que pase por su puesto'),
(5, 1, 2, 'quiero imprimir mi diseÃ±o de word'),
(6, 3, 2, 'dos paginas de guarro'),
(8, 5, 2, 'quiero dos banner para maÃ±ana'),
(9, 4, 2, 'Hola muy buenas deseo la creacion de dos logos'),
(4, 3, 5, 'Dos paginas de guarro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iconos`
--

CREATE TABLE `iconos` (
  `nombre` varchar(40) DEFAULT NULL,
  `codigo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `iconos`
--

INSERT INTO `iconos` (`nombre`, `codigo`) VALUES
('broadcast', 'mif-broadcast'),
('versions', 'mif-versions'),
('lamp', 'mif-lamp'),
('file-movie', 'mif-file-movie'),
('location-city', 'mif-location-city'),
('money', 'mif-money'),
('looks', 'mif-looks'),
('pencil', 'mif-pencil'),
('images', 'mif-images'),
('film', 'mif-film'),
('file-empty', 'mif-file-empty'),
('file-music', 'mif-file-music'),
('stack', 'mif-stack'),
('folder', 'mif-folder'),
('tags', 'mif-tags'),
('credit-card', 'mif-credit-card'),
('wrench', 'mif-wrench'),
('cogs', 'mif-cogs'),
('gamepad', 'mif-gamepad'),
('gamepad', 'mif-gamepad'),
('dollars', 'mif-dollars'),
('file-image', 'mif-file-image'),
('file-code', 'mif-file-code'),
('contacts-mail', 'mif-contacts-mail'),
('camera', 'mif-camera'),
('database', 'mif-database'),
('clipboard', 'mif-clipboard'),
('embed2', 'mif-embed2'),
('layers', 'mif-layers');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estado` smallint(1) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `fecha`, `total`, `estado`, `usuario`) VALUES
(1, '2016-09-23 01:42:24', 25, 3, 'esther'),
(2, '2016-09-23 01:43:52', 26.50000011920929, 3, 'esther'),
(3, '2016-09-23 01:44:34', 200, 3, 'esther'),
(4, '2016-09-26 13:02:48', 5, 3, 'esther'),
(5, '2016-09-23 01:45:47', 1.100000023841858, 3, 'ale'),
(6, '2016-09-23 01:46:18', 2, 3, 'ale'),
(7, '2016-09-23 01:46:18', 0, 1, 'ale'),
(8, '2016-09-23 01:48:38', 40, 3, 'jesus'),
(9, '2016-09-23 01:49:15', 100, 3, 'jesus'),
(10, '2016-09-23 01:49:15', 0, 1, 'jesus'),
(11, '2016-09-26 13:02:48', 0, 1, 'esther');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`) VALUES
(1, 'Color favorito'),
(2, 'Fecha importante'),
(3, 'Mejor amigo de infancia'),
(4, 'Pais o region'),
(5, 'Hobbie favorito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio_n` float DEFAULT NULL,
  `precio_v` float DEFAULT NULL,
  `dir` varchar(400) DEFAULT NULL,
  `estado` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_n`, `precio_v`, `dir`, `estado`) VALUES
(1, 'Impresiones a color', 'Impresiones en tamaÃ±o carta a color', 3, 4, '../img/productos/img_pro_1.png', 1),
(2, 'Paquete de colores', 'Paquete de colores', 15, 25, '../img/productos/img_pro_2.png', 1),
(3, 'Papel guarro', 'Papel guarro para todas tus necesidades', 0.25, 1, '../img/productos/img_pro_3.png', 1),
(4, 'Diseno de logos', 'DiseÃ±a tus logos solo incluye un logo en formato png', 25, 50, '../img/productos/img_pro_4.png', 1),
(5, 'Creacion de banner', 'crea un buen banner para tu empresa 12x10', 12, 20, '../img/productos/img_pro_5.png', 1),
(6, 'producto', 'un producto que estara a la venta', 3, 3, '../img/productos/img_pro_6.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `dir` varchar(400) DEFAULT NULL,
  `vigencia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `titulo`, `descripcion`, `dir`, `vigencia`) VALUES
(1, 'Promocion', 'Se agrega cada cierto tiempo esta buena promocion que no la tienes que desaprovechar ven e imprime tus banner a precios especiales, acercate y buscanos.', '../img/promo/img_promo_1.png', '2016-09-29'),
(2, 'Promocion', 'Nueva promocion', '../img/promo/img_promo_2.png', '2016-10-07'),
(3, 'Promocion de impresiones', 'ven y descubre los precios nuevos', '../img/promo/img_promo_3.png', '2016-10-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `icono` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `titulo`, `descripcion`, `icono`) VALUES
(1, 'Servicio de web hosting', 'Brindamos un servicio de alojamiento web donde puedes guardar y subir a la nube todos tus diseÃ±os de tus paginas web para compartirlos con el publico existente', 'mif-database'),
(2, 'Diseno de tarjetas', 'Se dispone del servicio de creacion de todo tipo de tarjetas de presentacion para que las personas que lo necesitan te conozcan y tus clientes te busquen y recomienden con mayor facilidad', 'mif-contacts-mail');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(40) NOT NULL,
  `contrasena` varchar(300) DEFAULT NULL,
  `tipo` smallint(1) DEFAULT NULL,
  `estado` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contrasena`, `tipo`, `estado`) VALUES
('admin', '8hkrGUDsHeG344bxPd0ynDGwsUpNQ7Mh7eoCVyi4je8=', 1, 1),
('ale', '8hkrGUDsHeG344bxPd0ynDGwsUpNQ7Mh7eoCVyi4je8=', 3, 1),
('esther', '8hkrGUDsHeG344bxPd0ynDGwsUpNQ7Mh7eoCVyi4je8=', 3, 1),
('jesus', '8hkrGUDsHeG344bxPd0ynDGwsUpNQ7Mh7eoCVyi4je8=', 3, 1),
('milagro', '8hkrGUDsHeG344bxPd0ynDGwsUpNQ7Mh7eoCVyi4je8=', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_info`
--

CREATE TABLE `usuario_info` (
  `usuario` varchar(40) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `pregunta` int(11) DEFAULT NULL,
  `respuesta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_info`
--

INSERT INTO `usuario_info` (`usuario`, `nombre`, `apellido`, `correo`, `pregunta`, `respuesta`) VALUES
('esther', 'Esther', 'Marroquin', 'esther@correo.com', 1, 'Morado'),
('ale', 'Ale', 'Orellana', 'ale@gmail.com', 1, 'Morado'),
('milagro', 'Milagro', 'Mejia', 'milagro@gmail.com', 3, 'Julio'),
('jesus', 'Jesus', 'Avelardo', 'jesus@gmail.com', 4, 'El Salvador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD KEY `pedido` (`pedido`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `usuario_info`
--
ALTER TABLE `usuario_info`
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `pregunta` (`pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `usuario_info`
--
ALTER TABLE `usuario_info`
  ADD CONSTRAINT `usuario_info_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `usuario_info_ibfk_2` FOREIGN KEY (`pregunta`) REFERENCES `preguntas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
