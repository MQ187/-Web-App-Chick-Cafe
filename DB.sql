-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: ccdb
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `idbank` int(11) NOT NULL AUTO_INCREMENT,
  `idPayment` int(11) DEFAULT NULL,
  `bankAccount` varchar(17) NOT NULL,
  `bankSortCode` varchar(6) NOT NULL,
  `bankAccountName` varchar(45) NOT NULL,
  PRIMARY KEY (`idbank`),
  KEY `idPayment_idx` (`idPayment`),
  CONSTRAINT `bankPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `idcard` int(11) NOT NULL AUTO_INCREMENT,
  `idPayment` int(11) DEFAULT NULL,
  `card4` varchar(4) NOT NULL,
  `cardExp` varchar(6) NOT NULL,
  `cardName` varchar(45) NOT NULL,
  PRIMARY KEY (`idcard`),
  KEY `idPayment_idx` (`idPayment`),
  CONSTRAINT `cardPayment` FOREIGN KEY (`idPayment`) REFERENCES `payment` (`idPayment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (1,NULL,'1234','--','Jack O\'neill'),(2,NULL,'1234','-23-11','Jack O\'neill'),(5,NULL,'1234','-23-11','Jack O\'neill'),(6,NULL,'1234','-23-11','Jack O\'neill'),(7,NULL,'1234','-23-11','Jack O\'neill'),(8,NULL,'1234','-23-11','Jack O\'neill'),(9,NULL,'1234','-23-12','Jack O\'neill'),(10,NULL,'1234','-23-12','Jack O\'neill'),(11,NULL,'1234','-12-12','Jack O\'neill'),(12,NULL,'1234','-12-12','Jack O\'neill'),(14,NULL,'1234','-12-12','Jack O\'neill'),(18,NULL,'1234','-12-12','Jack O\'neill'),(19,NULL,'1234','-12-12','Jack O\'neill'),(20,NULL,'1234','-12-12','Jack O\'neill'),(21,NULL,'1234','-12-12','Jack O\'neill'),(22,44,'1234','-12-12','Jack O\'neill'),(23,45,'1234','-12-12','Jack O\'neill'),(24,46,'1234','-12-12','Jack O\'neill'),(25,48,'1234','-12-12','Jack O\'neill'),(26,49,'1234','-12-12','Jack O\'neill'),(27,50,'123','-12-12','1234'),(28,51,'1234','-12-12','Jack O\'neill'),(29,52,'1234','-12-12','gaetan');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(45) NOT NULL,
  `isLoggedIn` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCustomer`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (4,'Daniel','Muller','daniel','7757766','1f4129b2b73b8ce2b048846c93da6402608f12e6',0),(5,'naresh','chamkani','nausnu@hotmail.com','4455667788','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1',0),(8,'test','tester','test@gmail.com','08977654322','cc03e747a6afbbcbf8be7668acfebee5',0),(10,'Gaetan','Mougel','gaetan@familymougel.eu','07837324564','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1',0),(11,'f','f','f@a','f','ec78ddda0cbcc3ba8f0e79ffc29e242cfccae579',0),(12,'t','t','t','t','b32f33e9fa28c36b11922d902038dc6c93200d8c',0),(22,'jim','bob','j@gmail.com','123','adcd7048512e64b48da55b027577886ee5a36350',0);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerdiscount`
--

DROP TABLE IF EXISTS `customerdiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customerdiscount` (
  `idcustomerDiscount` int(11) NOT NULL AUTO_INCREMENT,
  `idcustomer` int(11) NOT NULL,
  `idDiscounts` int(11) NOT NULL,
  PRIMARY KEY (`idcustomerDiscount`),
  KEY `idCustomer_idx` (`idcustomer`),
  KEY `idDiscount_idx` (`idDiscounts`),
  CONSTRAINT `CDCustomer` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CDDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerdiscount`
--

LOCK TABLES `customerdiscount` WRITE;
/*!40000 ALTER TABLE `customerdiscount` DISABLE KEYS */;
INSERT INTO `customerdiscount` VALUES (3,5,4);
/*!40000 ALTER TABLE `customerdiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `idDiscounts` int(11) NOT NULL AUTO_INCREMENT,
  `vipMembership` int(11) NOT NULL,
  `discountType` tinyint(1) NOT NULL DEFAULT '0',
  `discountValue` decimal(6,2) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date DEFAULT NULL,
  PRIMARY KEY (`idDiscounts`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,3,0,0.00,'2015-04-01',NULL),(2,2,0,4.00,'2015-04-07','0000-00-00'),(3,1,0,2.00,'2015-04-07','0000-00-00'),(4,3,0,2.00,'2015-04-07','0000-00-00');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `idemployee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`idemployee`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'jack','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','sparrow',0),(2,'Jackson','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','Jack@sparrow.com',1);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flexdiscount`
--

DROP TABLE IF EXISTS `flexdiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flexdiscount` (
  `idflexDiscount` int(11) NOT NULL AUTO_INCREMENT,
  `idDiscount` int(11) DEFAULT NULL,
  `uppr` decimal(6,2) NOT NULL,
  `lowr` decimal(6,2) NOT NULL,
  `value` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idflexDiscount`),
  KEY `FDDiscount_idx` (`idDiscount`),
  CONSTRAINT `FDDiscount` FOREIGN KEY (`idDiscount`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flexdiscount`
--

LOCK TABLES `flexdiscount` WRITE;
/*!40000 ALTER TABLE `flexdiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `flexdiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `idIngredients` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idIngredients`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Tomatoes',786,0.33),(2,'letuce',786,0.33),(3,'Cheddar',20,0.40);
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `iditem` int(11) NOT NULL AUTO_INCREMENT,
  `idMenu` int(11) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `preperationTime` time NOT NULL,
  `dailySpecial` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iditem`),
  KEY `idMenu_idx` (`idMenu`),
  CONSTRAINT `itemMenu` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (2,1,'Meal','Eggs Benedict','English muffins with English Ham',10.00,'00:05:00',0),(9,2,'Meal','Lunch Food','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST',5.00,'00:05:00',0),(10,1,'Meal','Breakfast Test','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST',99.00,'00:05:00',0),(11,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(12,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(13,2,'Meal','LUNCHCH Test','Descrip foewfr drink test',12.00,'00:05:00',0),(14,2,'Meal','1 more Test','Descrip foewfr drink test',12.00,'00:05:00',0),(15,1,'Meal','Breakfast','Descrip',99.00,'00:05:00',0),(16,1,'Meal','Full English Breakfast','The full package',28.00,'00:10:00',0),(17,1,'Meal','Full','The',28.00,'00:10:00',0),(20,2,'Meal','1 more Test','Descrip foewfr drink test',12.00,'00:05:00',0),(21,2,'Meal','1 more Test','Descrip foewfr drink test',12.00,'00:05:00',0),(22,2,'Meal','Lunch Food','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST',5.00,'00:05:00',0),(23,2,'Meal','Lunch Food','Descrip for lunch test',5.00,'00:05:00',0),(24,2,'Meal','Lunch Food','Descrip for lunch test',5.00,'00:05:00',0),(25,2,'Meal','Lunch Food','Descrip for lunch test',5.00,'00:05:00',0),(26,2,'Meal','LUNCHCH Test','Descrip foewfr drink test',12.00,'00:05:00',0),(27,2,'Meal','1 more Test','Descrip foewfr drink test',12.00,'00:05:00',0),(28,2,'Meal','1 more Test','Descrip foewfr drink test',12.00,'00:05:00',0),(29,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(30,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(31,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(32,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(33,3,'Meal','Dinner Test','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST',12.00,'00:05:00',0),(34,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(35,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(36,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(37,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(38,3,'Meal','Dinner Test','Descrip for dinner test',12.00,'00:05:00',0),(39,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(40,4,'Drink','Drink Test','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST',12.00,'00:05:00',0),(41,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(43,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(44,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(45,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(46,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(47,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(48,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(49,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(50,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(51,4,'Drink','Drink Test','Descrip for drink test',12.00,'00:05:00',0),(52,1,'Meal','test','tedst',234.00,'00:10:00',1),(53,1,'Meal','rtr','treter',0.00,'00:00:00',1),(54,1,'Meal','rtr','treter',0.00,'00:00:00',1),(55,1,'Meal','gtg','gtg',21.00,'00:00:00',1),(56,1,'Meal','gtg','gtg',21.00,'00:00:00',1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemingredients`
--

DROP TABLE IF EXISTS `itemingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemingredients` (
  `iditemIngredients` int(11) NOT NULL AUTO_INCREMENT,
  `idItem` int(11) NOT NULL,
  `idIngredients` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iditemIngredients`),
  KEY `idItem_idx` (`idItem`),
  KEY `idIngredients_idx` (`idIngredients`),
  CONSTRAINT `IIIngredients` FOREIGN KEY (`idIngredients`) REFERENCES `ingredients` (`idIngredients`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `IIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemingredients`
--

LOCK TABLES `itemingredients` WRITE;
/*!40000 ALTER TABLE `itemingredients` DISABLE KEYS */;
INSERT INTO `itemingredients` VALUES (3,2,3,1);
/*!40000 ALTER TABLE `itemingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `idmanager` int(11) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmanager`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (1,0,'jackie','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','jackie@chan.com',1),(2,1,'Bruce','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','bruce@banner.hu',1),(3,0,'man','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','man@m.com',0),(4,1,'Homer Simpsons','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','homer@simpsons.com',1);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `menuType` varchar(45) NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Breakfast','07:00:00','11:00:00'),(2,'Lunch','12:00:00','17:00:00'),(3,'Dinner','18:00:00','22:00:00'),(4,'Drinks','00:00:00','00:00:00'),(5,'Breakfast Cold Drinks','07:00:00','11:00:00'),(6,'Lunch Cold Drinks','12:00:00','17:00:00'),(7,'Dinner Cold Drinks','18:00:00','22:00:00'),(8,'Breakfast Hot Drinks','07:00:00','11:00:00'),(9,'Lunch Hot Drinks','12:00:00','17:00:00'),(10,'Dinner Hot Drinks','18:00:00','22:00:00');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `idorder` int(11) NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `orderType` varchar(10) NOT NULL,
  `orderTimeS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderPriority` tinyint(1) NOT NULL DEFAULT '0',
  `orderStatus` varchar(45) NOT NULL DEFAULT 'Pending',
  `etc` time NOT NULL,
  `timeCompleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idorder`),
  KEY `idCustomer_idx` (`idCustomer`),
  KEY `idEmployee_idx` (`idEmployee`),
  CONSTRAINT `orderCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderEmployee` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idemployee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (22,10,2,'Breakfast','2015-04-04 18:50:31',0,'Preparing','00:00:00','0000-00-00 00:00:00'),(23,10,NULL,'','2015-04-06 15:03:39',0,'Pending','00:00:00',NULL),(24,10,NULL,'','2015-04-06 15:04:48',0,'Pending','00:00:00',NULL),(25,10,NULL,'','2015-04-06 15:07:02',0,'Pending','00:00:00',NULL),(26,10,NULL,'','2015-04-06 15:08:11',0,'Pending','00:00:00',NULL),(27,10,NULL,'','2015-04-06 15:09:55',0,'Pending','00:00:00',NULL),(28,10,NULL,'','2015-04-06 15:11:12',0,'Pending','00:00:00',NULL),(29,10,NULL,'','2015-04-06 15:12:40',0,'Pending','00:00:00',NULL),(30,10,NULL,'','2015-04-06 15:13:01',0,'Pending','00:00:00',NULL),(31,10,NULL,'','2015-04-06 15:13:14',0,'Pending','00:00:00',NULL),(32,10,NULL,'','2015-04-06 15:14:41',0,'Pending','00:10:00',NULL),(33,5,NULL,'','2015-04-07 17:31:14',0,'Pending','00:10:00',NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitem` (
  `idorderItem` int(11) NOT NULL AUTO_INCREMENT,
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idorderItem`),
  KEY `idOrder_idx` (`idOrder`),
  KEY `idItem_idx` (`idItem`),
  CONSTRAINT `OIItem` FOREIGN KEY (`idItem`) REFERENCES `item` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OIOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitem`
--

LOCK TABLES `orderitem` WRITE;
/*!40000 ALTER TABLE `orderitem` DISABLE KEYS */;
INSERT INTO `orderitem` VALUES (5,22,10,1),(6,33,29,1),(7,33,31,1);
/*!40000 ALTER TABLE `orderitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `idPayment` int(11) NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `idOrder` int(11) DEFAULT NULL,
  `idDiscounts` int(11) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `sucessful` tinyint(1) NOT NULL,
  `ammount` decimal(6,2) NOT NULL,
  `ammountDiscounted` decimal(6,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPayment`),
  KEY `idCustomer_idx` (`idCustomer`),
  KEY `idOrder_idx` (`idOrder`),
  KEY `idDiscounts_idx` (`idDiscounts`),
  CONSTRAINT `paymentCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `paymentDiscount` FOREIGN KEY (`idDiscounts`) REFERENCES `discounts` (`idDiscounts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `paymentOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (15,10,NULL,1,1,1,23.00,0.00,'2015-04-06 14:01:05'),(16,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:02:31'),(17,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:05:15'),(18,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:06:51'),(19,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:07:07'),(20,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:07:17'),(21,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:08:03'),(22,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:09:13'),(23,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:10:13'),(24,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:10:28'),(25,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:11:51'),(26,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:12:44'),(27,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:14:40'),(28,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:15:51'),(29,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:22:03'),(30,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:30:40'),(31,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:31:09'),(32,10,NULL,1,0,1,32.00,0.00,'2015-04-06 14:32:17'),(33,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:33:25'),(34,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:33:52'),(35,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:38:09'),(36,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:39:02'),(37,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:39:49'),(38,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:49:34'),(39,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:56:14'),(40,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:56:29'),(41,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:56:39'),(42,10,NULL,1,0,1,36.00,0.00,'2015-04-06 14:57:58'),(43,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:00:08'),(44,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:00:27'),(45,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:01:25'),(46,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:02:01'),(47,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:02:20'),(48,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:02:29'),(49,10,NULL,1,0,1,36.00,0.00,'2015-04-06 15:03:00'),(50,10,NULL,1,0,1,48.00,0.00,'2015-04-06 15:04:48'),(51,10,NULL,1,0,1,24.00,0.00,'2015-04-06 15:14:41'),(52,5,NULL,1,0,1,24.00,0.00,'2015-04-07 17:31:14');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund`
--

DROP TABLE IF EXISTS `refund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund` (
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
  KEY `idOrder_idx` (`idOrder`),
  CONSTRAINT `refundCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `refundManager` FOREIGN KEY (`idManager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `refundOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund`
--

LOCK TABLES `refund` WRITE;
/*!40000 ALTER TABLE `refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `idreports` int(11) NOT NULL AUTO_INCREMENT,
  `idmanager` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idreports`),
  KEY `idmanager_idx` (`idmanager`),
  CONSTRAINT `reportsManager` FOREIGN KEY (`idmanager`) REFERENCES `manager` (`idmanager`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-07 18:47:47
