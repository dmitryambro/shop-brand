-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 09 Lis 2017, 10:06
-- Wersja serwera: 5.7.19
-- Wersja PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_order1_idx` (`order_id`),
  KEY `fk_cart_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Vomen'),
(5, 'Kids'),
(8, 'Men'),
(10, 'TEST');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `alt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price_sum` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` mediumtext,
  `price` double DEFAULT NULL,
  `add_tmst` int(11) DEFAULT NULL,
  `last_edit_tmst` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_sub_category1_idx` (`sub_category_id`),
  KEY `fk_product_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `add_tmst`, `last_edit_tmst`, `weight`, `size`, `category_id`, `sub_category_id`, `user_id`, `count`, `image_url`) VALUES
(4, 'test', 'test', 123, 1509230717, 1509230717, 1123, 'd', 3, 21, 5, 1, '/uploads/1105c69e1a4cb677f6ae203a3d43f673.jpg'),
(5, 'test', 'test', 123, 1509230726, 1509230726, 1123, 'd', 3, 21, 5, 1, '/uploads/1105c69e1a4cb677f6ae203a3d43f673.jpg'),
(6, 'test', 'test', 123, 1509230735, 1509230735, 1123, 'd', 3, 21, 5, 1, '/uploads/1105c69e1a4cb677f6ae203a3d43f673.jpg'),
(7, 'test', 'test', 123, 1509230735, 1509230735, 1123, 'd', 3, 21, 5, 1, '/uploads/1105c69e1a4cb677f6ae203a3d43f673.jpg'),
(9, 'test', 'test', 123, 1509230736, 1509230736, 1123, 'd', 3, 21, 5, 1, '/uploads/1105c69e1a4cb677f6ae203a3d43f673.jpg'),
(10, 'test 2', 'test', 12, 1509230876, 1509236022, 12, 'd', 8, 26, 9, 1, '/uploads/bea167155ca68908b35eaa8342d78077.jpg'),
(11, 'x', 'x', 12, 1509236067, 1509236067, 1123, '123', 3, 29, 9, 1, '/uploads/14ea8fb2687d659d572f3345239689fd.jpg'),
(12, 'x1', 'x1', 1231, 1509966190, 1509966190, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(13, 'x1', 'x1', 1231, 1509966199, 1509966199, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(14, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(15, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(16, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(17, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(18, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(19, 'x1', 'x1', 1231, 1509966200, 1509966200, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(20, 'x1', 'x1', 1231, 1509966201, 1509966201, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(21, 'x1', 'x1', 1231, 1509966201, 1509966201, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(22, 'x1', 'x1', 1231, 1509966201, 1509966201, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(23, 'x1', 'x1', 1231, 1509966201, 1509966201, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(24, 'x1', 'x1', 1231, 1509966202, 1509966202, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(25, 'x1', 'x1', 1231, 1509966202, 1509966202, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(26, 'x1', 'x1', 1231, 1509966202, 1509966202, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(27, 'x1', 'x1', 1231, 1509966202, 1509966202, 13123, 'XC', 3, 21, 9, 3, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(29, 'Kids product 1', 'Kids product description 1', 123, 1509994365, 1509994365, 12, '23', 5, 8, 9, 0, '/uploads/9e2212e8dd1666370e03fc49a759304c.jpg'),
(30, 'x', 'x', 123, 1509994555, 1509994555, 1312, 'dsad', 5, 8, 9, 134, '/uploads/45aa1066481011b2eb780147d8720ba0.jpg'),
(31, 'x', 'x', 1312, 1509995114, 1509995114, 123, '3123', 3, 21, 9, 11, '/uploads/14ea8fb2687d659d572f3345239689fd.jpg'),
(32, 'test', 'dasd', 213, 1509995169, 1510011541, 213, '3123', 5, 8, 9, 1, '/uploads/14ea8fb2687d659d572f3345239689fd.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_category_category1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`) VALUES
(8, 'Shirts', 5),
(21, 'Shirts', 3),
(26, 'Spodnie', 8),
(27, 'Koszula', 8),
(29, 'test', 3),
(31, 'X_TEST x', 10),
(32, 'sub test', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_user_permission_idx` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `permission_id`) VALUES
(5, 'test', '098f6bcd4621d373cade4e832627b4f6', 'mail@mail.com', 'User', 'Userowicz', 1),
(7, 'test2', '098f6bcd4621d373cade4e832627b4f6', 'test@xx.oo', 'User2', 'Userovich2', 1),
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'test@test.com', 'Admin', 'Adminowicz', 3),
(10, 'max', 'd1696816bc1a7afe92f1c8787ac222c3', 'max@yandex.ru', 'Max', 'Maximovich', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_sub_category1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
