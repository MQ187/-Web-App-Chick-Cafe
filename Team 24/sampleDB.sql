-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 01:22 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
`idbank` int(11) NOT NULL,
  `idPayment` int(11) DEFAULT NULL,
  `bankAccount` varchar(17) NOT NULL,
  `bankSortCode` varchar(6) NOT NULL,
  `bankAccountName` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`idbank`, `idPayment`, `bankAccount`, `bankSortCode`, `bankAccountName`) VALUES
(1, 5, '76543212', '234567', 'David Dodson'),
(2, 8, '73543749', '234587', 'Chris Smart'),
(3, 15, '73687236', '247628', 'skjdhfshfkhs');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
`idcard` int(11) NOT NULL,
  `idPayment` int(11) DEFAULT NULL,
  `card4` varchar(4) NOT NULL,
  `cardExp` varchar(8) NOT NULL,
  `cardName` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`idcard`, `idPayment`, `card4`, `cardExp`, `cardName`) VALUES
(1, 1, '3234', '15-10-09', 'John Doe'),
(2, 2, '8989', '16-03-12', 'John Doe'),
(3, 3, '1432', '17-8-27', 'Chris Smart'),
(4, 6, '5899', '17-12-19', 'John Doe'),
(5, 7, '4741', '17-03-29', 'Sarah Broklehurst'),
(6, 9, '4323', '17-12-12', 'John Doe'),
(7, 10, '4784', '17-12-12', 'Marc'),
(8, 11, '4759', '15-12-12', 'gaetsadkj'),
(9, 12, '5462', '17-12-12', 'KJDJSHDKJSHDFJHSK'),
(10, 13, '8263', '17-12-12', 'KRYIUWEYRIUWY'),
(11, 14, '8764', '17-12-12', 'jeruwrwyeruw'),
(12, 16, '8746', '17-12-12', 'gjagdjhgdjag');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`idCustomer` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(45) NOT NULL,
  `isLoggedIn` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `phone`, `password`, `isLoggedIn`) VALUES
(1, 'Chris', 'Smart', 'chris@mail.com', '07656748765', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(2, 'David', 'Dodson', 'david@mail.com', '07837654587', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(3, 'Sarah', 'Broklehurst', 'sarahb@mail.com', '07587679867', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(4, 'John', 'Doe', 'john@mail.com', '07876349754', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(5, 'Mark', 'Hammil', 'mark@mail.com', '0786542467', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customerdiscount`
--

CREATE TABLE IF NOT EXISTS `customerdiscount` (
`idcustomerDiscount` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customerdiscount`
--

INSERT INTO `customerdiscount` (`idcustomerDiscount`, `idcustomer`, `idDiscounts`) VALUES
(1, 1, 5),
(2, 3, 6),
(3, 2, 7),
(4, 4, 4),
(7, 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
`idDiscounts` int(11) NOT NULL,
  `vipMembership` int(11) NOT NULL,
  `discountType` tinyint(1) NOT NULL DEFAULT '0',
  `discountValue` decimal(6,2) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date DEFAULT '0000-00-00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`idDiscounts`, `vipMembership`, `discountType`, `discountValue`, `startTime`, `endTime`) VALUES
(4, 0, 0, '0.00', '2015-04-09', '0000-00-00'),
(5, 3, 0, '1.00', '2015-04-09', '0000-00-00'),
(6, 2, 0, '2.00', '2015-04-09', '0000-00-00'),
(7, 1, 1, '0.00', '2015-04-09', '2017-01-01'),
(8, 0, 0, '1.00', '2015-04-10', '0000-00-00'),
(9, 1, 0, '1.00', '2015-04-10', '0000-00-00'),
(10, 2, 0, '2.00', '2015-04-10', '0000-00-00'),
(11, 3, 1, '0.00', '2015-04-10', '2015-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`idemployee` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idemployee`, `name`, `password`, `email`, `active`) VALUES
(250, 'Dennis Menace', 'cd621fa36524acce270970d487852698bd5a7876', 'menace@chickcafe.com', 1),
(260, 'Penelope Pitstop', 'a2d159618ad981ecae2de15c559dbe44f65ad57b', 'pitstop@chickcafe.com', 1),
(261, 'Johnny', '511ef9b97d6a7638f2efc9389f42c0bb908c68e7', 'bravo2@chickcafe.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `flexdiscount`
--

CREATE TABLE IF NOT EXISTS `flexdiscount` (
`idflexDiscount` int(11) NOT NULL,
  `idDiscount` int(11) DEFAULT NULL,
  `uppr` decimal(6,2) NOT NULL,
  `lowr` decimal(6,2) NOT NULL,
  `value` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flexdiscount`
--

INSERT INTO `flexdiscount` (`idflexDiscount`, `idDiscount`, `uppr`, `lowr`, `value`) VALUES
(1, 7, '1000.00', '0.00', '0.00'),
(2, 7, '2000.00', '1000.00', '1.00'),
(3, 7, '9999.99', '2000.00', '2.00'),
(4, 11, '100.00', '0.00', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
`idIngredients` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`idIngredients`, `name`, `availability`, `price`) VALUES
(1, 'Tomatoes', 200, '0.23'),
(2, 'Letuce', 500, '0.03'),
(3, 'Cheddar', 100, '1.20'),
(4, 'Bread', 100, '0.10'),
(5, 'Onions', 60, '0.99'),
(6, 'Peppers', 40, '0.72'),
(7, 'Cucumber', 60, '0.60'),
(8, 'Shallots', 20, '0.80'),
(9, 'Garlic', 90, '0.12'),
(10, 'Chicken Breast', 100, '1.12'),
(11, 'Beans', 500, '1.01'),
(12, 'Salt', 20, '2.07'),
(13, 'Orangina', 500, '0.80'),
(14, 'Coca-cola', 1000, '0.80'),
(15, 'Sprite', 500, '0.80'),
(16, 'Fanta', 500, '0.80'),
(17, 'Guarana', 500, '0.80'),
(18, 'Lemonade', 500, '0.80'),
(19, 'RedBull', 500, '1.10'),
(20, 'Tea', 3000, '0.90'),
(21, 'Coffee', 500, '0.90'),
(22, 'Hot Wine', 2000, '0.90'),
(23, 'Minced Beef', 500, '3.72'),
(24, 'Steak', 60, '20.99'),
(25, 'Porc Chops', 100, '2.90'),
(26, 'Sausages - Porc', 120, '1.90'),
(27, 'Sausages - Halal', 40, '1.99'),
(28, 'Eggs', 100, '0.19'),
(29, 'Milk', 40, '0.99'),
(30, 'Butter', 15, '1.20'),
(31, 'Chocolate', 200, '1.20'),
(32, 'Puff Pastry', 50, '1.50'),
(33, 'Jam', 20, '2.50'),
(34, 'Nutella', 20, '3.60'),
(35, 'Yoghurt', 30, '0.90'),
(36, 'Apple Juice', 50, '1.90'),
(37, 'Gin', 40, '20.00'),
(38, 'Whisky', 60, '32.00'),
(39, 'Rhum', 30, '15.00'),
(40, 'Vodka', 70, '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
`iditem` int(11) NOT NULL,
  `idMenu` int(11) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `preperationTime` time NOT NULL,
  `dailySpecial` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`iditem`, `idMenu`, `type`, `name`, `description`, `price`, `preperationTime`, `dailySpecial`) VALUES
(1, 1, 'Meal', 'Continental Breakfast', 'Pastries along side sausages and a tomato salad.', '11.50', '00:20:00', 0),
(2, 2, 'Meal', 'Fillets of Dover Sole, cherry tomatoes, Squid', 'Fillets of Dover Sole, cherry tomatoes, Squid and crab', '18.00', '00:40:00', 0),
(3, 3, 'Meal', 'Soup', 'Different', '700.00', '00:07:00', 1),
(4, 2, 'Meal', 'Spring courgette and aubergine with chick pea', 'Spring courgette and aubergine with chick pea', '12.50', '00:30:00', 0),
(5, 3, 'Meal', 'Grilled 28 day hung beef Sirloin', 'Grilled 28 day hung beef Sirloin', '23.00', '00:45:00', 0),
(6, 1, 'Meal', 'Poached eggs', 'Poached eggs', '8.00', '00:15:00', 0),
(7, 2, 'Meal', 'Pot roasted duck', 'Pot roasted duck', '16.00', '01:00:00', 0),
(8, 3, 'Meal', 'Scottish salmon', 'Scottish salmon', '21.50', '00:25:00', 0),
(9, 1, 'Meal', 'Butter croissants', 'Butter croissants', '2.00', '00:10:00', 1),
(10, 3, 'Meal', 'Crisp lobster croquettes', 'Crisp lobster croquettes', '16.50', '00:47:00', 0),
(11, 1, 'Meal', 'Lemonade', 'Lemonade', '1.00', '00:03:00', 0),
(12, 8, 'Hot Drink', 'Coffee - Long', 'Long Coffee', '1.50', '00:02:00', 0),
(13, 8, 'Hot Drink', 'Coffee - Expresso', 'Expresso', '1.50', '00:02:00', 0),
(14, 5, 'Cold Drink', 'Guarana', 'Guarana', '2.50', '00:01:00', 0),
(15, 7, 'Cold Drink', 'Coca-Cola', 'Coca-Cola', '0.75', '00:01:00', 0),
(16, 6, 'Cold Drink', 'Fanta', 'Fanta 330ml Can', '0.75', '00:01:00', 0),
(17, 9, 'Hot Drink', 'Coffee - Expresso', 'Expresso', '1.50', '00:03:00', 0),
(18, 9, 'Hot Drink', 'Tea', 'Tea', '1.00', '00:01:00', 0),
(19, 6, 'Cold Drink', 'Orangina', 'Orangina Bottle 0.5l', '1.50', '00:01:00', 0),
(20, 10, 'Hot Drink', 'Coffee - Expresso', 'Expresso', '1.50', '00:03:00', 0),
(21, 4, 'Hot Drink', 'Coffee - Long', 'Long Coffee', '1.50', '00:03:00', 0),
(22, 4, 'Hot Drink', 'Hot house wine', 'Hot house wine', '2.00', '00:03:00', 0),
(23, 1, 'Meal', 'Turkish Breakfast', 'Full tasty breakfast', '13.00', '00:20:00', 0),
(24, 1, 'Meal', 'Full indian breakfast ', 'Curry and rice', '12.00', '00:10:00', 0),
(25, 1, 'Meal', 'Tuna Sandwich', 'Tuna fish in bread', '3.00', '00:00:00', 0),
(26, 1, 'Meal', 'Egg Sandwich', 'Egg and butter in bread', '3.00', '00:05:00', 0),
(27, 1, 'Meal', 'Egg and Bacon', 'Sandwich', '3.00', '00:05:00', 0),
(28, 1, 'Meal', 'Egg and Bacon', 'Sandwich', '3.00', '00:05:00', 0),
(29, 1, 'Meal', 'Croissants with butter', 'Croissants with butter', '1.80', '00:04:00', 1),
(30, 3, 'Meal', 'Daily stuff', 'DailyStuff', '1.99', '00:01:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemingredients`
--

CREATE TABLE IF NOT EXISTS `itemingredients` (
`iditemIngredients` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idIngredients` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemingredients`
--

INSERT INTO `itemingredients` (`iditemIngredients`, `idItem`, `idIngredients`, `quantity`) VALUES
(1, 2, 1, 1),
(2, 2, 8, 1),
(3, 2, 9, 1),
(4, 3, 1, 1),
(5, 3, 8, 1),
(6, 3, 12, 1),
(7, 4, 8, 1),
(8, 4, 12, 1),
(9, 5, 12, 1),
(10, 5, 24, 1),
(11, 5, 30, 1),
(12, 6, 28, 1),
(13, 7, 39, 1),
(14, 8, 12, 1),
(15, 9, 32, 1),
(16, 10, 9, 1),
(17, 10, 30, 1),
(18, 11, 18, 1),
(19, 12, 21, 1),
(20, 13, 21, 1),
(21, 14, 17, 1),
(22, 15, 14, 1),
(23, 16, 16, 1),
(24, 17, 21, 1),
(25, 18, 20, 1),
(26, 19, 13, 1),
(27, 20, 21, 1),
(28, 21, 21, 1),
(29, 22, 22, 1),
(30, 23, 1, 1),
(31, 23, 2, 1),
(32, 23, 3, 1),
(33, 23, 4, 1),
(34, 24, 1, 1),
(35, 24, 2, 1),
(36, 24, 3, 1),
(37, 25, 1, 1),
(38, 25, 2, 1),
(39, 25, 4, 1),
(40, 26, 1, 1),
(41, 26, 2, 1),
(42, 26, 3, 1),
(43, 26, 4, 1),
(44, 26, 5, 1),
(45, 27, 2, 1),
(46, 27, 3, 1),
(47, 27, 4, 1),
(48, 28, 2, 1),
(49, 28, 3, 1),
(50, 28, 4, 1),
(51, 29, 22, 1),
(52, 30, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
`idmanager` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`idmanager`, `owner`, `name`, `password`, `email`, `active`) VALUES
(300, 0, 'Minnie Minx', '367d442a53ff68ec055f32ea429d2f58c617a679', 'minx@chickcafe.com', 1),
(350, 1, 'Mr Neko', 'f472ecfb58120c20ce6aa75d3527eedd5240c4b0', 'neko@chickcafe.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`idmenu` int(11) NOT NULL,
  `menuType` varchar(45) NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `menuType`, `openTime`, `closeTime`) VALUES
(1, 'Breakfast', '07:00:00', '11:00:00'),
(2, 'Lunch', '12:00:00', '17:00:00'),
(3, 'Dinner', '18:00:00', '22:00:00'),
(4, 'Drinks', '00:00:00', '00:00:00'),
(5, 'Breakfast Cold Drinks', '07:00:00', '11:00:00'),
(6, 'Lunch Cold Drinks', '12:00:00', '17:00:00'),
(7, 'Dinner Cold Drinks', '18:00:00', '22:00:00'),
(8, 'Breakfast Hot Drinks', '07:00:00', '11:00:00'),
(9, 'Lunch Hot Drinks', '12:00:00', '17:00:00'),
(10, 'Dinner Hot Drinks', '18:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`idorder` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `orderType` varchar(10) NOT NULL,
  `orderTimeS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderPriority` tinyint(1) NOT NULL DEFAULT '0',
  `orderStatus` varchar(45) NOT NULL DEFAULT 'Pending',
  `etc` time NOT NULL,
  `timeCompleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idorder`, `idCustomer`, `idEmployee`, `orderType`, `orderTimeS`, `orderPriority`, `orderStatus`, `etc`, `timeCompleted`) VALUES
(1, 4, 250, '', '2015-02-10 08:04:58', 0, 'Refunded', '00:01:00', '2015-02-10 08:11:58'),
(4, 4, 260, '', '2015-01-09 09:26:59', 0, 'Completed', '00:02:00', '2015-01-09 09:30:12'),
(5, 4, 260, '', '2015-01-09 13:12:11', 0, 'Completed', '00:04:00', '2015-01-09 13:17:45'),
(6, 1, 260, '', '2015-02-02 13:07:33', 0, 'Refunded', '00:10:00', '2015-02-02 13:24:48'),
(7, 2, 260, '', '2015-02-02 19:10:37', 0, 'Completed', '00:09:00', '2015-02-02 19:18:42'),
(8, 4, 250, '', '2015-02-02 09:25:19', 1, 'Completed', '00:06:00', '2015-02-02 09:35:27'),
(9, 3, 250, '', '2015-02-02 14:27:34', 0, 'Completed', '01:00:00', '2015-02-02 15:34:34'),
(10, 1, 250, '', '2015-02-02 19:30:18', 0, 'Completed', '00:07:00', '2015-02-02 19:42:37'),
(11, 4, 250, '', '2015-04-10 11:33:32', 0, 'Collected', '01:11:00', '0000-00-00 00:00:00'),
(12, 1, 260, '', '2015-04-10 11:36:48', 0, 'Completed', '00:04:00', '0000-00-00 00:00:00'),
(13, 3, 250, '', '2015-04-10 11:39:18', 0, 'Completed', '00:07:00', '0000-00-00 00:00:00'),
(14, 1, NULL, '', '2015-04-10 11:41:41', 0, 'Pending', '00:04:00', NULL),
(15, 1, 250, '', '2015-04-10 11:42:07', 1, 'Refunded', '00:03:00', '0000-00-00 00:00:00'),
(16, 1, NULL, '', '2015-04-10 11:45:04', 1, 'Pending', '01:00:00', NULL),
(17, 4, NULL, '', '2015-04-10 11:53:44', 0, 'Pending', '00:04:00', NULL),
(18, 5, NULL, '', '2015-04-10 12:04:13', 0, 'Pending', '00:03:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
`idorderItem` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`idorderItem`, `idOrder`, `idItem`, `quantity`) VALUES
(1, 1, 9, 1),
(3, 4, 1, 1),
(4, 5, 2, 1),
(5, 6, 3, 1),
(6, 6, 4, 1),
(7, 7, 5, 1),
(8, 8, 6, 1),
(9, 9, 7, 1),
(10, 10, 8, 1),
(11, 11, 2, 2),
(12, 11, 21, 1),
(13, 11, 7, 1),
(14, 12, 2, 1),
(15, 13, 3, 1),
(16, 14, 2, 1),
(17, 15, 4, 1),
(18, 16, 7, 1),
(19, 17, 2, 1),
(20, 18, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`idPayment` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idOrder` int(11) DEFAULT NULL,
  `idDiscounts` int(11) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `sucessful` tinyint(1) NOT NULL,
  `ammount` decimal(6,2) NOT NULL,
  `ammountDiscounted` decimal(6,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `idCustomer`, `idOrder`, `idDiscounts`, `paymentType`, `sucessful`, `ammount`, `ammountDiscounted`, `date`) VALUES
(1, 4, 4, 4, 0, 1, '11.50', '0.00', '2015-04-10 08:26:59'),
(2, 4, 5, 4, 0, 1, '18.00', '0.00', '2015-04-10 08:59:11'),
(3, 1, 6, 5, 0, 1, '19.31', '0.20', '2015-04-10 09:07:33'),
(4, 2, 7, 7, 0, 1, '23.00', '0.00', '2015-04-10 09:10:37'),
(5, 2, NULL, 7, 0, 1, '23.00', '0.00', '2015-04-10 09:16:03'),
(6, 4, 8, 4, 0, 1, '8.40', '0.00', '2015-04-10 09:25:18'),
(7, 3, 9, 6, 0, 1, '15.68', '0.32', '2015-04-10 09:27:34'),
(8, 1, 10, 5, 0, 1, '21.29', '0.22', '2015-04-10 09:30:18'),
(9, 4, 11, 4, 0, 1, '53.50', '0.00', '2015-04-10 11:33:32'),
(10, 1, 12, 5, 0, 1, '17.82', '0.18', '2015-04-10 11:36:48'),
(11, 3, 13, 6, 0, 1, '686.00', '14.00', '2015-04-10 11:39:17'),
(12, 1, 14, 5, 0, 1, '17.82', '0.18', '2015-04-10 11:41:40'),
(13, 1, 15, 5, 0, 1, '12.99', '0.13', '2015-04-10 11:42:06'),
(14, 1, 16, 5, 0, 1, '16.63', '0.16', '2015-04-10 11:45:03'),
(15, 4, 17, 4, 0, 1, '18.00', '0.00', '2015-04-10 11:53:43'),
(16, 5, 18, 11, 0, 1, '12.50', '0.00', '2015-04-10 12:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE IF NOT EXISTS `refund` (
`idRefund` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idManager` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `accountNumber` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `ammount` decimal(6,2) NOT NULL,
  `details` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
`idreports` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`idreports`, `idmanager`, `date`, `type`) VALUES
(1, 350, '2015-01-10 11:03:58', 'All'),
(2, 350, '2015-02-10 08:57:11', 'All'),
(3, 350, '2015-03-10 07:57:12', 'All'),
(4, 350, '2015-04-10 01:14:21', 'All'),
(5, 350, '2015-04-10 01:14:57', 'Refund'),
(6, 350, '2015-04-10 12:48:46', 'Order'),
(7, 350, '2015-04-10 12:49:12', 'Order'),
(8, 350, '2015-04-10 12:50:03', 'Customer Spending'),
(9, 350, '2015-04-10 12:50:33', 'Customer Spending'),
(10, 350, '2015-04-10 12:50:40', 'Customer Spending'),
(11, 350, '2015-04-10 12:50:59', 'Customer Spending'),
(12, 350, '2015-04-10 12:51:11', 'Customer Spending'),
(13, 350, '2015-04-10 12:51:57', 'Staff Performance'),
(14, 350, '2015-04-10 12:56:58', 'Refund'),
(15, 350, '2015-04-10 12:57:49', 'Active Customer'),
(16, 350, '2015-04-10 12:58:22', 'Active Customer'),
(17, 350, '2015-04-10 13:03:22', 'Active Customer'),
(18, 350, '2015-04-10 13:03:42', 'Active Customer'),
(19, 350, '2015-04-10 13:04:17', 'Active Customer'),
(20, 350, '2015-04-10 13:04:19', 'Active Customer'),
(21, 350, '2015-04-10 13:04:23', 'Active Customer'),
(22, 350, '2015-04-10 13:04:49', 'Active Customer'),
(23, 350, '2015-04-10 13:10:26', 'Customer Spending'),
(24, 350, '2015-04-10 13:15:06', 'Customer Spending'),
(25, 350, '2015-04-10 13:17:48', 'All');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
 ADD PRIMARY KEY (`idbank`), ADD KEY `idPayment_idx` (`idPayment`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
 ADD PRIMARY KEY (`idcard`), ADD KEY `idPayment_idx` (`idPayment`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`idCustomer`);

--
-- Indexes for table `customerdiscount`
--
ALTER TABLE `customerdiscount`
 ADD PRIMARY KEY (`idcustomerDiscount`), ADD KEY `idCustomer_idx` (`idcustomer`), ADD KEY `idDiscount_idx` (`idDiscounts`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
 ADD PRIMARY KEY (`idDiscounts`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`idemployee`);

--
-- Indexes for table `flexdiscount`
--
ALTER TABLE `flexdiscount`
 ADD PRIMARY KEY (`idflexDiscount`), ADD KEY `FDDiscount_idx` (`idDiscount`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
 ADD PRIMARY KEY (`idIngredients`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`iditem`), ADD KEY `idMenu_idx` (`idMenu`);

--
-- Indexes for table `itemingredients`
--
ALTER TABLE `itemingredients`
 ADD PRIMARY KEY (`iditemIngredients`), ADD KEY `idItem_idx` (`idItem`), ADD KEY `idIngredients_idx` (`idIngredients`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
 ADD PRIMARY KEY (`idmanager`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`idorder`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idEmployee_idx` (`idEmployee`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
 ADD PRIMARY KEY (`idorderItem`), ADD KEY `idOrder_idx` (`idOrder`), ADD KEY `idItem_idx` (`idItem`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`idPayment`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idOrder_idx` (`idOrder`), ADD KEY `idDiscounts_idx` (`idDiscounts`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
 ADD PRIMARY KEY (`idRefund`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idManager_idx` (`idManager`), ADD KEY `idOrder_idx` (`idOrder`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
 ADD PRIMARY KEY (`idreports`), ADD KEY `idmanager_idx` (`idmanager`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
MODIFY `idbank` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
MODIFY `idcard` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customerdiscount`
--
ALTER TABLE `customerdiscount`
MODIFY `idcustomerDiscount` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
MODIFY `idDiscounts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT for table `flexdiscount`
--
ALTER TABLE `flexdiscount`
MODIFY `idflexDiscount` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
MODIFY `idIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `itemingredients`
--
ALTER TABLE `itemingredients`
MODIFY `iditemIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
MODIFY `idmanager` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=351;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
MODIFY `idorderItem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
MODIFY `idRefund` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `idreports` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
ADD CONSTRAINT `bankPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `card`
--
ALTER TABLE `card`
ADD CONSTRAINT `cardPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customerdiscount`
--
ALTER TABLE `customerdiscount`
ADD CONSTRAINT `CDCustomer` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `CDDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `flexdiscount`
--
ALTER TABLE `flexdiscount`
ADD CONSTRAINT `FDDiscount` FOREIGN KEY (`idDiscount`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `itemMenu` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itemingredients`
--
ALTER TABLE `itemingredients`
ADD CONSTRAINT `IIIngredients` FOREIGN KEY (`idIngredients`) REFERENCES `ingredients` (`idIngredients`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `IIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `orderCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `orderEmployee` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idemployee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
ADD CONSTRAINT `OIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `OIOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
ADD CONSTRAINT `paymentCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `paymentDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `paymentOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `refund`
--
ALTER TABLE `refund`
ADD CONSTRAINT `refundCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `refundManager` FOREIGN KEY (`idManager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `refundOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
ADD CONSTRAINT `reportsManager` FOREIGN KEY (`idmanager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
