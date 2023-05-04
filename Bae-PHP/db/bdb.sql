/* ET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; */
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE articulos;
use articulos;

CREATE TABLE `articulos` (
  `cod_articulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `texto` VARCHAR(1000) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `articulos` (`cod_articulo`, `nombre`, `texto`, `fecha_creacion`, `categoria`) VALUES
(1, 'Articulo1', 'Texto1', '2020-11-11', 'Forex'),
(2, 'Articulo2', 'Texto2', '2020-11-11', 'Criptomonedas'),
(3, 'Articulo3', 'Texto3', '2020-11-11', 'Acciones'),
(4, 'Articulo4', 'Texto4', '2020-11-11', 'Futuros'),
(5, 'Articulo5', 'Texto5', '2020-11-11', 'Bonos');

CREATE TABLE `comentarios` (
  `cod_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(1000) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `likes` int(11) NOT NULL,
  `cod_articulo` int(11) NOT NULL,
  PRIMARY KEY (`cod_comentario`),
  FOREIGN KEY (`cod_articulo`) REFERENCES `articulos` (`cod_articulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comentarios` (`cod_comentario`, `texto`, `fecha_creacion`, `likes`, `cod_articulo`) VALUES
(1, 'Comentario1', '2020-11-11', 1, 1),
(2, 'Comentario2', '2020-11-11', 2, 2),
(3, 'Comentario3', '2020-11-11', 3, 3),
(4, 'Comentario4', '2020-11-11', 4, 4),
(5, 'Comentario5', '2020-11-11', 5, 5);

COMMIT;
