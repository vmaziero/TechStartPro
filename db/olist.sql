CREATE TABLE `category` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `product` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `description` varchar(255),
  `value` float
);

CREATE TABLE `productCategory` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `idProduct` int,
  `idCategory` int
);

ALTER TABLE `productCategory` ADD FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

ALTER TABLE `productCategory` ADD FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`);
