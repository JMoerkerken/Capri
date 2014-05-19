-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 17 mrt 2014 om 22:59
-- Serverversie: 5.5.16
-- PHP-Versie: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capri`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(256) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `regRow` int(11) unsigned DEFAULT NULL,
  `regCol` int(11) unsigned DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Gegevens worden uitgevoerd voor tabel `product`
--

INSERT INTO `product` (`id`, `label`, `price`, `regRow`, `regCol`, `visible`) VALUES
(1, '1 bol', 1.25, 1, 1, 1),
(2, '2 bol', 2.35, 1, 2, 1),
(3, '3 bol', 3.35, 1, 3, 1),
(4, '4 bol', 4.25, 1, 4, 1),
(5, '+ 1 bol', 1, 1, 5, 1),
(6, 'Giga bol', 1.65, 2, 3, 1),
(7, 'Kinder ijsje', 0.9, 2, 2, 1),
(8, 'Kinder coup', 2.75, 2, 1, 1),
(9, 'Slagroom', 0.55, 2, 4, 1),
(10, 'Snoepjes', 0.5, 2, 5, 1),
(11, 'Capri horn', 3.5, 3, 1, 1),
(12, 'Milkshake', 2.65, 3, 2, 1),
(13, 'Kinder shake', 1.95, 3, 3, 1),
(14, '0,3 L', 3.75, 3, 4, 1),
(15, '0,5 L', 5.25, 3, 5, 1),
(16, '0,75 L', 7.5, 4, 1, 1),
(17, 'Espresso', 1.6, 4, 2, 1),
(18, 'Koffie', 1.8, 4, 3, 1),
(19, 'Latte', 2.4, 4, 4, 1),
(20, 'Thee', 1.5, 4, 5, 1),
(21, 'Fris', 1.5, 5, 1, 1),
(22, 'Cupcake', 1.75, 5, 2, 1),
(23, 'Cake pop', 0.75, 5, 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee` varchar(256) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `priceInVat` float DEFAULT NULL,
  `priceExVat` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `receipt_product`
--

CREATE TABLE IF NOT EXISTS `receipt_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(11) unsigned DEFAULT NULL,
  `receiptId` int(11) unsigned DEFAULT NULL,
  `label` varchar(256) DEFAULT NULL,
  `priceInVat` float DEFAULT NULL,
  `priceExVat` float DEFAULT NULL,
  `amount` int(11) unsigned DEFAULT NULL,
  `totalPriceInVat` float DEFAULT NULL,
  `totalPriceExVat` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
