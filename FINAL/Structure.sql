SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `ccdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ccdb`;

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
`idbank` int(11) NOT NULL,
  `idPayment` int(11) DEFAULT NULL,
  `bankAccount` varchar(17) NOT NULL,
  `bankSortCode` varchar(6) NOT NULL,
  `bankAccountName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
`idcard` int(11) NOT NULL,
  `idPayment` int(11) DEFAULT NULL,
  `card4` varchar(4) NOT NULL,
  `cardExp` varchar(6) NOT NULL,
  `cardName` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
`idCustomer` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(45) NOT NULL,
  `isLoggedIn` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `customerdiscount`;
CREATE TABLE IF NOT EXISTS `customerdiscount` (
`idcustomerDiscount` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
`idDiscounts` int(11) NOT NULL,
  `vipMembership` int(11) NOT NULL,
  `discountType` tinyint(1) NOT NULL DEFAULT '0',
  `discountValue` decimal(6,2) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
`idemployee` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `flexdiscount`;
CREATE TABLE IF NOT EXISTS `flexdiscount` (
`idflexDiscount` int(11) NOT NULL,
  `idDiscount` int(11) DEFAULT NULL,
  `uppr` decimal(6,2) NOT NULL,
  `lowr` decimal(6,2) NOT NULL,
  `value` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
`idIngredients` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `item`;
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

DROP TABLE IF EXISTS `itemingredients`;
CREATE TABLE IF NOT EXISTS `itemingredients` (
`iditemIngredients` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idIngredients` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
`idmanager` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
`idmenu` int(11) NOT NULL,
  `menuType` varchar(45) NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `order`;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
`idorderItem` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `payment`;
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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `refund`;
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

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
`idreports` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


ALTER TABLE `bank`
 ADD PRIMARY KEY (`idbank`), ADD KEY `idPayment_idx` (`idPayment`);

ALTER TABLE `card`
 ADD PRIMARY KEY (`idcard`), ADD KEY `idPayment_idx` (`idPayment`);

ALTER TABLE `customer`
 ADD PRIMARY KEY (`idCustomer`);

ALTER TABLE `customerdiscount`
 ADD PRIMARY KEY (`idcustomerDiscount`), ADD KEY `idCustomer_idx` (`idcustomer`), ADD KEY `idDiscount_idx` (`idDiscounts`);

ALTER TABLE `discounts`
 ADD PRIMARY KEY (`idDiscounts`);

ALTER TABLE `employee`
 ADD PRIMARY KEY (`idemployee`);

ALTER TABLE `flexdiscount`
 ADD PRIMARY KEY (`idflexDiscount`), ADD KEY `FDDiscount_idx` (`idDiscount`);

ALTER TABLE `ingredients`
 ADD PRIMARY KEY (`idIngredients`);

ALTER TABLE `item`
 ADD PRIMARY KEY (`iditem`), ADD KEY `idMenu_idx` (`idMenu`);

ALTER TABLE `itemingredients`
 ADD PRIMARY KEY (`iditemIngredients`), ADD KEY `idItem_idx` (`idItem`), ADD KEY `idIngredients_idx` (`idIngredients`);

ALTER TABLE `manager`
 ADD PRIMARY KEY (`idmanager`);

ALTER TABLE `menu`
 ADD PRIMARY KEY (`idmenu`);

ALTER TABLE `order`
 ADD PRIMARY KEY (`idorder`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idEmployee_idx` (`idEmployee`);

ALTER TABLE `orderitem`
 ADD PRIMARY KEY (`idorderItem`), ADD KEY `idOrder_idx` (`idOrder`), ADD KEY `idItem_idx` (`idItem`);

ALTER TABLE `payment`
 ADD PRIMARY KEY (`idPayment`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idOrder_idx` (`idOrder`), ADD KEY `idDiscounts_idx` (`idDiscounts`);

ALTER TABLE `refund`
 ADD PRIMARY KEY (`idRefund`), ADD KEY `idCustomer_idx` (`idCustomer`), ADD KEY `idManager_idx` (`idManager`), ADD KEY `idOrder_idx` (`idOrder`);

ALTER TABLE `reports`
 ADD PRIMARY KEY (`idreports`), ADD KEY `idmanager_idx` (`idmanager`);


ALTER TABLE `bank`
MODIFY `idbank` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `card`
MODIFY `idcard` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
ALTER TABLE `customer`
MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
ALTER TABLE `customerdiscount`
MODIFY `idcustomerDiscount` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `discounts`
MODIFY `idDiscounts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
ALTER TABLE `employee`
MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `flexdiscount`
MODIFY `idflexDiscount` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `ingredients`
MODIFY `idIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `item`
MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
ALTER TABLE `itemingredients`
MODIFY `iditemIngredients` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `manager`
MODIFY `idmanager` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `menu`
MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
ALTER TABLE `order`
MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
ALTER TABLE `orderitem`
MODIFY `idorderItem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
ALTER TABLE `payment`
MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
ALTER TABLE `refund`
MODIFY `idRefund` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reports`
MODIFY `idreports` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `bank`
ADD CONSTRAINT `bankPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `card`
ADD CONSTRAINT `cardPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `customerdiscount`
ADD CONSTRAINT `CDCustomer` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `CDDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `flexdiscount`
ADD CONSTRAINT `FDDiscount` FOREIGN KEY (`idDiscount`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `item`
ADD CONSTRAINT `itemMenu` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `itemingredients`
ADD CONSTRAINT `IIIngredients` FOREIGN KEY (`idIngredients`) REFERENCES `ingredients` (`idIngredients`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `IIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `order`
ADD CONSTRAINT `orderCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `orderEmployee` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idemployee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `orderitem`
ADD CONSTRAINT `OIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `OIOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `payment`
ADD CONSTRAINT `paymentCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `paymentDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `paymentOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `refund`
ADD CONSTRAINT `refundCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `refundManager` FOREIGN KEY (`idManager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `refundOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reports`
ADD CONSTRAINT `reportsManager` FOREIGN KEY (`idmanager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
