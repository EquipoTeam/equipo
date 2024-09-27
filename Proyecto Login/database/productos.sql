CREATE TABLE `productos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `precio` DECIMAL(10, 2) NOT NULL,
  `imagen` VARCHAR(255),
  `descuento` INT(3) DEFAULT 0,
  `stock` INT(11) DEFAULT 0,
  `categoria` VARCHAR(100),
  `estrellas` DECIMAL(2, 1) DEFAULT 0.0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO 'productos' ('nombre', 'descripcion', 'precio', 'imagen', 'descuento', 'stock', 'categoria', 'estrellas') VALUES
('ROG Gladius II Core', 'Gaming mouse with RGB lighting', 735.24, 'MOUSE I.png', 15, 50, 'Mouse', 4.5),
('Teclado ROG Strix Flare II', 'Mechanical gaming keyboard', 2625.00, 'TECLADO III.png', 25, 30, 'Teclados', 4.5),
('PC Rog Strix Gt15', 'Gaming desktop', 19088.22, 'GABINETE I.png', 35, 15, 'PCs', 4.5),
('ROG Swift OLED PG27AQDM', '27-inch OLED monitor', 18000.00, 'MONITOR GL.png', 0, 20, 'Monitores', 4.5),
('ROG STRIX Z790-H GAMING WIFI', 'Motherboard for high-performance gaming', 12000.00, 'MOTHERBOARD GL.png', 0, 25, 'Motherboards', 4.5),
('ROG Strix Scope RX TKL Wireless Deluxe', 'Compact wireless gaming keyboard', 4500.00, 'TECLADO GL.png', 35, 40, 'Teclados', 4.5),
('ROG Strix GeForce RTX 4060 Ti', 'High-end graphics card', 7500.00, 'TARJETA GRAFICA GL.png', 0, 10, 'Graficas', 4.5),
('ROG-STRIX-750G', '750W power supply unit', 3000.00, 'FUENTE DE PODER GL.png', 0, 60, 'Fuentes', 4.5),
('XPG Lancer ROG DDR5', 'DDR5 memory for gaming', 2000.00, 'MEMORIA RAM GL.png', 0, 70, 'Memoria', 4.5);
