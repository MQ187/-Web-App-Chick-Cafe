-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2015 at 03:26 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
`idcard` int(11) NOT NULL,
  `idPayment` int(11) DEFAULT NULL,
  `card4` varchar(4) NOT NULL,
  `cardExp` varchar(6) NOT NULL,
  `cardName` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`idcard`, `idPayment`, `card4`, `cardExp`, `cardName`) VALUES
(1, NULL, '1234', '--', 'Jack O''neill'),
(2, NULL, '1234', '-23-11', 'Jack O''neill'),
(5, NULL, '1234', '-23-11', 'Jack O''neill'),
(6, NULL, '1234', '-23-11', 'Jack O''neill'),
(7, NULL, '1234', '-23-11', 'Jack O''neill'),
(8, NULL, '1234', '-23-11', 'Jack O''neill'),
(9, NULL, '1234', '-23-12', 'Jack O''neill'),
(10, NULL, '1234', '-23-12', 'Jack O''neill'),
(11, NULL, '1234', '-12-12', 'Jack O''neill'),
(12, NULL, '1234', '-12-12', 'Jack O''neill'),
(14, NULL, '1234', '-12-12', 'Jack O''neill'),
(18, NULL, '1234', '-12-12', 'Jack O''neill'),
(19, NULL, '1234', '-12-12', 'Jack O''neill');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `phone`, `password`, `isLoggedIn`) VALUES
(4, 'Daniel', 'Muller', 'daniel', '7757766', '1f4129b2b73b8ce2b048846c93da6402608f12e6', 0),
(5, 'naresh', 'chamkani', 'nausnu@hotmail.com', '4455667788', '0f869632dedf073cb0587e8dfa43ec94c872abfc', 0),
(8, 'test', 'tester', 'test@gmail.com', '08977654322', 'cc03e747a6afbbcbf8be7668acfebee5', 0),
(10, 'Gaetan', 'Mougel', 'gaetan@familymougel.eu', '07837324564', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 1),
(11, 'f', 'f', 'f@a', 'f', 'ec78ddda0cbcc3ba8f0e79ffc29e242cfccae579', 0),
(12, 't', 't', 't', 't', 'b32f33e9fa28c36b11922d902038dc6c93200d8c', 0),
(22, 'jim', 'bob', 'j@gmail.com', '123', 'adcd7048512e64b48da55b027577886ee5a36350', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customerdiscount`
--

CREATE TABLE IF NOT EXISTS `customerdiscount` (
`idcustomerDiscount` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `endTime` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`idDiscounts`, `vipMembership`, `discountType`, `discountValue`, `startTime`, `endTime`) VALUES
(1, 3, 0, '0.00', '2015-04-01', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idemployee`, `name`, `password`, `email`, `active`) VALUES
(1, 'jack', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'sparrow', 0),
(2, 'Jackson', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'Jack@sparrow.com', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
`idIngredients` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`idIngredients`, `name`, `availability`, `price`) VALUES
(1, 'Tomatoes', 786, '0.33'),
(2, 'letuce', 786, '0.33'),
(3, 'Cheddar', 20, '0.40');

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`iditem`, `idMenu`, `type`, `name`, `description`, `price`, `preperationTime`, `dailySpecial`) VALUES
(2, 1, 'Meal', 'Eggs Benedict', 'English muffins with English Ham', '10.00', '00:05:00', 0),
(9, 2, 'Meal', 'Lunch Food', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '5.00', '00:05:00', 0),
(10, 1, 'Meal', 'Breakfast Test', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', '99.00', '00:05:00', 0),
(11, 3, 'Meal', 'Dinner Test', 'Descrip for dinner test', '12.00', '00:05:00', 0),
(12, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(13, 2, 'Meal', 'LUNCHCH Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(14, 2, 'Meal', '1 more Test', 'Descrip foewfr drink test', '12.00', '00:05:00', 0),
(15, 1, 'Meal', 'Breakfast', 'Descrip', '99.00', '00:05:00', 0),
(16, 1, 'Meal', 'Full English Breakfast', 'The full package', '28.00', '00:10:00', 0),
(17, 1, 'Meal', 'Full', 'The', '28.00', '00:10:00', 0),
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
(43, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(44, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(45, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(46, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(47, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(48, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(49, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(50, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(51, 4, 'Drink', 'Drink Test', 'Descrip for drink test', '12.00', '00:05:00', 0),
(52, 1, 'Meal', 'test', 'tedst', '234.00', '00:10:00', 1),
(53, 1, 'Meal', 'rtr', 'treter', '0.00', '00:00:00', 1),
(54, 1, 'Meal', 'rtr', 'treter', '0.00', '00:00:00', 1),
(55, 1, 'Meal', 'gtg', 'gtg', '21.00', '00:00:00', 1),
(56, 1, 'Meal', 'gtg', 'gtg', '21.00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemingredients`
--

CREATE TABLE IF NOT EXISTS `itemingredients` (
`iditemIngredients` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idIngredients` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemingredients`
--

INSERT INTO `itemingredients` (`iditemIngredients`, `idItem`, `idIngredients`, `quantity`) VALUES
(3, 2, 3, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`idmanager`, `owner`, `name`, `password`, `email`, `active`) VALUES
(1, 0, 'jackie', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'jackie@chan.com', 1),
(2, 1, 'Bruce', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'bruce@banner.hu', 1),
(3, 0, 'man', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'man@m.com', 0),
(4, 1, 'Homer Simpsons', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'homer@simpsons.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`idmenu` int(11) NOT NULL,
  `menuType` varchar(45) NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
`idorder` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `orderType` varchar(10) NOT NULL,
  `orderTimeS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderPriority` tinyint(1) NOT NULL DEFAULT '0',
  `orderStatus` varchar(45) NOT NULL DEFAULT 'Pending',
  `etc` time NOT NULL,
  `timeCompleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idorder`, `idCustomer`, `idEmployee`, `orderType`, `orderTimeS`, `orderPriority`, `orderStatus`, `etc`, `timeCompleted`) VALUES
(22, 10, 2, 'Breakfast', '2015-04-04 18:50:31', 0, 'Preparing', '00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
`idorderItem` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`idorderItem`, `idOrder`, `idItem`, `quantity`) VALUES
(5, 22, 10, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `idCustomer`, `idOrder`, `idDiscounts`, `paymentType`, `sucessful`, `ammount`, `ammountDiscounted`, `date`) VALUES
(15, 10, NULL, 1, 1, 1, '23.00', '0.00', '2015-04-06 14:01:05'),
(16, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:02:31'),
(17, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:05:15'),
(18, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:06:51'),
(19, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:07:07'),
(20, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:07:17'),
(21, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:08:03'),
(22, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:09:13'),
(23, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:10:13'),
(24, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:10:28'),
(25, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:11:51'),
(26, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:12:44'),
(27, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:14:40'),
(28, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:15:51'),
(29, 10, NULL, 1, 0, 1, '36.00', '0.00', '2015-04-06 14:22:03');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
MODIFY `idbank` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
MODIFY `idcard` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `customerdiscount`
--
ALTER TABLE `customerdiscount`
MODIFY `idcustomerDiscount` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
MODIFY `idDiscounts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `flexdiscount`
--
ALTER TABLE `flexdiscount`
MODIFY `idflexDiscount` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
MODIFY `idIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `itemingredients`
--
ALTER TABLE `itemingredients`
MODIFY `iditemIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
MODIFY `idmanager` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
MODIFY `idorderItem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
MODIFY `idRefund` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `idreports` int(11) NOT NULL AUTO_INCREMENT;
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
