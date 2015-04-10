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

INSERT INTO `ingredients` (`idIngredients`, `name`, `availability`, `price`) VALUES
(1, 'Tomatoes', 200, '0.23'),
(2, 'Letuce', 500, '0.03'),
(3, 'Cheddar', 80, '1.20'),
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
(39, 'Rhum', 8, '15.00'),
(40, 'Vodka', 70, '20.00');

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `phone`, `password`, `isLoggedIn`) VALUES
(1, 'Chris', 'Smart', 'chris@mail.com', '07656748765', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 1),
(2, 'David', 'Dodson', 'daved@mail.com', '07837654587', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(3, 'Sarah', 'Broklehurst', 'sarahb@mail.com', '07587679867', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(4, 'John', 'Doe', 'john@mail.com', '07876349754', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0);

INSERT INTO `discounts` (`idDiscounts`, `vipMembership`, `discountType`, `discountValue`, `startTime`, `endTime`) VALUES
(4, 0, 0, '1.00', '2015-04-09', '0000-00-00'),
(5, 3, 0, '1.00', '2015-04-09', '0000-00-00'),
(6, 2, 0, '2.00', '2015-04-09', '0000-00-00'),
(7, 1, 1, '0.00', '2015-04-09', '2017-01-01');

INSERT INTO `customerdiscount` (`idcustomerDiscount`, `idcustomer`, `idDiscounts`) VALUES
(1, 1, 5),
(2, 3, 6),
(3, 2, 7),
(4, 4, 4);

INSERT INTO `employee` (`idemployee`, `name`, `password`, `email`, `active`) VALUES
(250, 'Dennis Menace', 'cd621fa36524acce270970d487852698bd5a7876', 'menace@chickcafe.com', 1),
(260, 'Penelope Pitstop', 'a2d159618ad981ecae2de15c559dbe44f65ad57b', 'pitstop@chickcafe.com', 1);

INSERT INTO `flexdiscount` (`idflexDiscount`, `idDiscount`, `uppr`, `lowr`, `value`) VALUES
(1, 7, '1000.00', '0.00', '0.00'),
(2, 7, '2000.00', '1000.00', '1.00'),
(3, 7, '9999.99', '2000.00', '2.00');

INSERT INTO `manager` (`idmanager`, `owner`, `name`, `password`, `email`, `active`) VALUES
(300, 0, 'Minnie Minx', '367d442a53ff68ec055f32ea429d2f58c617a679', 'minx@chickcafe.com', 1),
(350, 1, 'Neko', 'f472ecfb58120c20ce6aa75d3527eedd5240c4b0', 'neko@chickcafe.com', 1);

INSERT INTO `item` (`iditem`, `idMenu`, `type`, `name`, `description`, `price`, `preperationTime`, `dailySpecial`) VALUES
(1, 1, 'Meal', 'Continental Breakfast', 'Pastries along side sausages and a tomato salad.', '11.50', '00:20:00', 0),
(2, 1, 'Meal', 'Fillets of Dover Sole, cherry tomatoes, Squid', 'Fillets of Dover Sole, cherry tomatoes, Squid and crab', '18.00', '00:40:00', 0),
(3, 1, 'Meal', 'Soup of the day', 'Different each day, contact us directly for further information.', '7.00', '00:07:00', 1),
(4, 1, 'Meal', 'Spring courgette and aubergine with chick pea', 'Spring courgette and aubergine with chick pea', '12.50', '00:30:00', 0),
(5, 3, 'Meal', 'Grilled 28 day hung beef Sirloin', 'Grilled 28 day hung beef Sirloin', '23.00', '00:45:00', 0),
(6, 1, 'Meal', 'Poached eggs', 'Poached eggs', '8.00', '00:15:00', 0),
(7, 1, 'Meal', 'Pot roasted duck', 'Pot roasted duck', '16.00', '01:00:00', 0),
(8, 1, 'Meal', 'Scottish salmon', 'Scottish salmon', '21.50', '00:25:00', 0),
(9, 1, 'Meal', 'Butter croissants', 'Butter croissants', '2.00', '00:10:00', 1),
(10, 3, 'Meal', 'Crisp lobster croquettes', 'Crisp lobster croquettes', '16.50', '00:47:00', 0);

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
(17, 10, 30, 1);

INSERT INTO `order` (`idorder`, `idCustomer`, `idEmployee`, `orderType`, `orderTimeS`, `orderPriority`, `orderStatus`, `etc`, `timeCompleted`) VALUES
(1, 4, 250, '', '2015-02-10 08:04:58', 0, 'Refunded', '00:01:00', '2015-02-10 08:11:58'),
(3, 4, 260, '', '2015-01-09 07:07:11', 0, 'Completed', '00:02:00', '2015-01-09 07:18:11');

INSERT INTO `orderitem` (`idorderItem`, `idOrder`, `idItem`, `quantity`) VALUES
(1, 1, 9, 1),
(2, 3, 1, 1);

INSERT INTO `refund` (`idRefund`, `idCustomer`, `idManager`, `idOrder`, `accountNumber`, `date`, `ammount`, `details`) VALUES
(1, 4, 350, 1, '35465447643', '2015-04-10 01:12:32', '2.00', 'Undercooked.');

INSERT INTO `reports` (`idreports`, `idmanager`, `date`, `type`) VALUES
(1, 350, '2015-01-10 11:03:58', 'All'),
(2, 350, '2015-02-10 08:57:11', 'All'),
(3, 350, '2015-03-10 07:57:12', 'All');