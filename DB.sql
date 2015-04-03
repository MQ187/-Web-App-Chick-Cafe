-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 03:28 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

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
  `idbank` int(11) NOT NULL AUTO_INCREMENT,
  `idPayment` int(11) DEFAULT NULL,
  `bankAccount` varchar(17) NOT NULL,
  `bankSortCode` varchar(6) NOT NULL,
  `bankAccountName` varchar(45) NOT NULL,
  PRIMARY KEY (`idbank`),
  KEY `idPayment_idx` (`idPayment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `idcard` int(11) NOT NULL AUTO_INCREMENT,
  `idPayment` int(11) DEFAULT NULL,
  `card4` varchar(4) NOT NULL,
  `cardExp` varchar(6) NOT NULL,
  `cardName` varchar(45) NOT NULL,
  PRIMARY KEY (`idcard`),
  KEY `idPayment_idx` (`idPayment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(45) NOT NULL,
  `isLoggedIn` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCustomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `phone`, `password`) VALUES
(3, 'ajadj', 'jajdaj', 'jajdajaj', 'jg', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1'),
(4, 'Daniel', 'Muller', 'daniel', '7757766', '1f4129b2b73b8ce2b048846c93da6402608f12e6'),
(5, 'naresh', 'chamkani', 'nausnu@hotmail.com', '4455667788', '0f869632dedf073cb0587e8dfa43ec94c872abfc'),
(8, 'test', 'tester', 'test@gmail.com', '08977654322', 'cc03e747a6afbbcbf8be7668acfebee5'),
(9, 'jim', 'bob', 'j@gmail.com', '123', 'adcd7048512e64b48da55b027577886ee5a36350'),
(10, 'Gaetan', 'Mougel', 'gaetan@familymougel.eu', '07837324564', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1'),
(11, 'f', 'f', 'f@a', 'f', 'ec78ddda0cbcc3ba8f0e79ffc29e242cfccae579');

-- --------------------------------------------------------

--
-- Table structure for table `customerdiscount`
--

CREATE TABLE IF NOT EXISTS `customerdiscount` (
  `idcustomerDiscount` int(11) NOT NULL AUTO_INCREMENT,
  `idcustomer` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL,
  PRIMARY KEY (`idcustomerDiscount`),
  KEY `idCustomer_idx` (`idcustomer`),
  KEY `idDiscount_idx` (`idDiscounts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `idDiscounts` int(11) NOT NULL AUTO_INCREMENT,
  `vipMembership` int(11) NOT NULL,
  `discountType` tinyint(1) NOT NULL DEFAULT '0',
  `discountValue` decimal(6,2) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date DEFAULT NULL,
  PRIMARY KEY (`idDiscounts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `idemployee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`idemployee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idemployee`, `name`, `password`, `email`, `active`) VALUES
(1, 'jack', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'sparrow', 1),
(2, 'Jackson', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'Jack@sparrow.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flexdiscount`
--

CREATE TABLE IF NOT EXISTS `flexdiscount` (
  `idflexDiscount` int(11) NOT NULL,
  `idDiscount` int(11) DEFAULT NULL,
  `upper` decimal(6,2) NOT NULL,
  `lower` decimal(6,2) NOT NULL,
  `value` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idflexDiscount`),
  KEY `FDDiscount_idx` (`idDiscount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `idIngredients` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idIngredients`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`idIngredients`, `name`, `availability`, `price`) VALUES
(1, 'Tomatoes', 150, '0.33'),
(2, 'letuce', 100, '0.33'),
(3, 'Cheddar', 20, '0.40');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `iditem` int(11) NOT NULL AUTO_INCREMENT,
  `idMenu` int(11) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `preperationTime` time NOT NULL,
  `dailySpecial` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iditem`),
  KEY `idMenu_idx` (`idMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`iditem`, `idMenu`, `type`, `name`, `description`, `price`, `preperationTime`, `dailySpecial`) VALUES
(1, 1, 'Meal', 'Full English Breakfast', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '28.00', '00:10:00', 1),
(2, 1, 'Meal', 'Eggs Benedict', 'English muffins with English Ham', '10.00', '00:05:00', 0),
(9, 2, 'Meal', 'Lunch Food', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '5.00', '00:05:00', 0),
(10, 1, 'Meal', 'Breakfast Test', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '99.00', '00:05:00', 0),
(11, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(12, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(13, 2, 'Meal', 'LUNCHCH Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(14, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(15, 1, 'Meal', 'Breakfast Test', 'Descrip for break test', '99.00', '00:05:00', 0),
(16, 1, 'Meal', 'Full English Breakfast', 'The full package', '28.00', '00:10:00', 0),
(17, 1, 'Meal', 'Full English Breakfast', 'The full package', '28.00', '00:10:00', 0),
(18, 1, 'Meal', 'Full English Breakfast', 'The full package', '28.00', '00:10:00', 0),
(19, 1, 'Meal', 'Full English Breakfast', 'The full package', '28.00', '00:10:00', 0),
(20, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(21, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(22, 2, 'Meal', 'Lunch Food', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '5.00', '00:05:00', 0),
(23, 2, 'Meal', 'Lunch Food', 'Descrip for lunch test', '5.00', '00:05:00', 0),
(24, 2, 'Meal', 'Lunch Food', 'Descrip for lunch test', '5.00', '00:05:00', 0),
(25, 2, 'Meal', 'Lunch Food', 'Descrip for lunch test', '5.00', '00:05:00', 0),
(26, 2, 'Meal', 'LUNCHCH Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(27, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(28, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(29, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(30, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(31, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(32, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(33, 3, 'Meal', 'Dinner Test', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '12.00', '00:05:00', 0),
(34, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(35, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(36, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(37, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(38, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(39, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(40, 4, 'Drink', 'Drink Test', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '12.00', '00:05:00', 0),
(41, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(42, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(43, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(44, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(45, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(46, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(47, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(48, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(49, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(50, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(51, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemingredients`
--

CREATE TABLE IF NOT EXISTS `itemingredients` (
  `iditemIngredients` int(11) NOT NULL AUTO_INCREMENT,
  `idItem` int(11) NOT NULL,
  `idIngredients` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iditemIngredients`),
  KEY `idItem_idx` (`idItem`),
  KEY `idIngredients_idx` (`idIngredients`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `itemingredients`
--

INSERT INTO `itemingredients` (`iditemIngredients`, `idItem`, `idIngredients`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1),
(3, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `idmanager` int(11) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmanager`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`idmanager`, `owner`, `name`, `password`, `email`, `active`) VALUES
(1, 0, 'jackie', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'jackie@chan.com', 1),
(2, 1, 'Bruce', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'bruce@banner.hu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `menuType` varchar(45) NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `menuType`, `openTime`, `closeTime`) VALUES
(1, 'Breakfast', '07:00:00', '11:00:00'),
(2, 'Lunch', '12:00:00', '17:00:00'),
(3, 'Dinner', '18:00:00', '22:00:00'),
(4, 'Drinks', '00:00:00', '00:00:00'),
(5, 'Breakfast Drinks', '07:00:00', '11:00:00'),
(6, 'Lunch Drinks', '12:00:00', '17:00:00'),
(7, 'Dinner Drinks', '18:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `idorder` int(11) NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `orderTime` time NOT NULL,
  `orderPriority` tinyint(1) NOT NULL DEFAULT '0',
  `orderStatus` varchar(45) NOT NULL DEFAULT 'Pending',
  `etc` time NOT NULL,
  `timeCompleted` time NOT NULL,
  PRIMARY KEY (`idorder`),
  KEY `idCustomer_idx` (`idCustomer`),
  KEY `idEmployee_idx` (`idEmployee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idorder`, `idCustomer`, `idEmployee`, `orderDate`, `orderTime`, `orderPriority`, `orderStatus`, `etc`, `timeCompleted`) VALUES
(1, 10, 2, '2015-03-15', '00:15:00', 1, 'Completed', '00:00:00', '00:10:00'),
(2, 9, 2, '2015-03-17', '12:00:00', 0, 'Completed', '00:00:15', '00:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
  `idorderItem` int(11) NOT NULL AUTO_INCREMENT,
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idorderItem`),
  KEY `idOrder_idx` (`idOrder`),
  KEY `idItem_idx` (`idItem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`idorderItem`, `idOrder`, `idItem`, `quantity`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `idPayment` int(11) NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `sucessful` tinyint(1) NOT NULL,
  `ammount` decimal(6,2) NOT NULL,
  `ammountDiscounted` decimal(6,2) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idPayment`),
  KEY `idCustomer_idx` (`idCustomer`),
  KEY `idOrder_idx` (`idOrder`),
  KEY `idDiscounts_idx` (`idDiscounts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE IF NOT EXISTS `refund` (
  `idRefund` int(11) NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `idManager` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `accountNumber` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `ammount` decimal(6,2) NOT NULL,
  `details` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idRefund`),
  KEY `idCustomer_idx` (`idCustomer`),
  KEY `idManager_idx` (`idManager`),
  KEY `idOrder_idx` (`idOrder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `idreports` int(11) NOT NULL AUTO_INCREMENT,
  `idmanager` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idreports`),
  KEY `idmanager_idx` (`idmanager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
