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

INSERT INTO `manager` (`idmanager`, `owner`, `name`, `password`, `email`, `active`) VALUES
(1, 1, 'Homer Simpsons', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'homer@simpsons.com', 1),
(2, 1, 'Moe Szyslak', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'moe@simpsons.com', 0),
(3, 0, 'Carl Carlson', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'carl@simpsons.com', 1),
(4, 0, 'Lenny Leonard', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'lenny@simpsons.com', 0);

INSERT INTO `employee` (`idemployee`, `name`, `password`, `email`, `active`) VALUES
(1, 'Bart', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'bart@simpsons.com', 1),
(2, 'Lisa', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'lisa@simpsons.com', 0);

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `phone`, `password`, `isLoggedIn`) VALUES
(1, 'Jack', 'Sparrow', 'jack@sparrow.com', '07845469374', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(2, 'Tony', 'Stark', 'tony@stark.com', '02176398546', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(3, 'Johnny', 'Bravo', 'johnny@bravo.com', '07765984567', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(4, 'Bruce', 'Banner', 'bruce@hulk.com', '07887654564', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0),
(5, 'Clark', 'Kent', 'sm@kentfarm.com', '07654730274', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0);

INSERT INTO `customerdiscount` (`idcustomerDiscount`, `idcustomer`, `idDiscounts`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

INSERT INTO `discounts` (`idDiscounts`, `vipMembership`, `discountType`, `discountValue`, `startTime`, `endTime`) VALUES
(1, 0, 0, '0.00', '2015-03-28', '0000-00-00'),
(2, 1, 0, '2.00', '2015-03-29', '0000-00-00'),
(3, 2, 0, '3.00', '2015-03-29', '0000-00-00'),
(4, 3, 0, '4.00', '2015-03-29', '0000-00-00'),
(5, 1, 1, '0.00', '2015-04-05', '0000-00-00');

INSERT INTO `ccdb`.`flexdiscount` (`idflexDiscount`, `idDiscount`, `uppr`, `lowr`, `value`) VALUES 
(1, 5, '100.00', '0.00', '5.00'),
(2, 5, '200.00', '101.00', '7.00'),
(3, 5, '300.00', '201.00', '10.00');

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
(39, 'Rhum', 30, '15.00'),
(40, 'Vodka', 70, '20.00');




