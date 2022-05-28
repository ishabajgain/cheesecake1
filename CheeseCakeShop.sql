-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 10:10 PM
-- Server version: 5.5.40
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cheesecakeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `u_id`, `quantity`) VALUES
(1, 112, 27, 20),
(2, 113, 26, 5),
(3, 112, 29, 2),
(5, 118, 29, 10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `p_id`) VALUES
(0, 'new category', NULL),
(1, 'Cheese Cakes', NULL),
(2, 'Cakes', NULL),
(3, 'Other Products', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  `pr_id` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `u_id`, `created_at`, `order_status`, `pr_id`, `total_quantity`, `total_price`) VALUES
(2011, 20, '2020-11-10 19:10:10', 'Delivered', 0, 0, NULL),
(2012, 21, '2021-01-10 14:10:10', 'In Transit', 0, 0, NULL),
(2013, 22, '2021-01-11 13:10:10', 'Cancelled', 0, 0, NULL),
(2014, 26, '2021-01-11 01:10:10', 'Ready to Ship', 112, 0, NULL),
(2015, 26, '2021-02-10 20:10:10', 'Delivered', 112, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
`o_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(10,0) DEFAULT NULL,
  `items` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2015 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`o_id`, `quantity`, `total_amount`, `items`) VALUES
(2011, 2, '72', 111),
(2011, 1, '35', 113),
(2012, 10, '360', 114),
(2012, 4, '188', 117),
(2013, 5, '15', 16),
(2013, 6, '30', 120),
(2014, 1, '70', 116);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
`id` int(11) NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `cardholder_name` varchar(45) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `card_expiry` datetime DEFAULT NULL,
  `card_cvv` int(11) DEFAULT NULL,
  `payment_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_number`, `cardholder_name`, `card_number`, `card_expiry`, `card_cvv`, `payment_status`) VALUES
(1, 2011, 'Simon Downes', 11108888, '2022-11-10 00:00:00', 122, 'paid'),
(2, 2014, 'Clara Brown ', 11119999, '2022-11-12 00:00:00', 211, 'on hold'),
(3, 2013, 'Oliver Brown', 12988222, '2022-11-13 00:00:00', 322, 'unsuccessful'),
(4, 2015, 'John Smith', 23457676, '2022-11-15 00:00:00', 455, 'processing'),
(5, 2012, 'Clara Brown', 76768989, '2022-11-25 00:00:00', 233, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`p_id` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `description` longtext,
  `category_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `product_name`, `price`, `description`, `category_id`, `image_path`, `subcategory_id`) VALUES
(112, 'Strawberry Sundae', '45', 'Baked cheesecake glazed with fresh strawberries', 1, '1112.jpeg', 11),
(113, 'Cookies and Cream', '35', 'Mix of continental cheesecake and cookie crumbs on a choc graham biscuit base', 1, '1113.jpeg', 12),
(114, 'Creamy Caramel', '33', 'Continental cheesecake with caramel filling and a caramel glaze', 1, '1114.jpeg', 12),
(115, 'Rainbow Cake', '55', 'Six layers of rainbow coloured vanilla sponge simply layered with fresh cream and covered with rainbow sequins.', 2, '1115.png', 17),
(117, 'Black Forest', '47', 'Eggless chocolate sponge layered with vegetarian vanilla cream and hand-crushed sour cherries. Finished with cream rosettes and maraschino cherries', 2, '1117.jpeg', 14),
(118, 'Double Choc Strawberry', '47', 'Eggless chocolate sponge layered with vegetarian chocolate cream and natural strawberry filling. Finished with cream rosettes and fresh strawberries.', 2, '1118.jpeg', 14),
(119, 'Cake Server', '3', '', 3, '1119.jpeg', 15),
(120, 'Number 0', '5', '', 3, '1120.png', 16),
(121, 'Number 1', '5', '', 3, '1121.gif', 16);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
`id` int(11) NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `o_id`, `address`) VALUES
(101, 2011, 'u 10, 28 Sydney St'),
(102, 2012, 'u 14, Penshurst Lane'),
(103, 2013, 'u 10, Railway Street, rockdale'),
(104, 2014, '10-12 Empress street, Hurstville'),
(105, 2015, 'u 15, 20-22 Princess Highway');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `title`, `category`) VALUES
(11, 'Baked Cheesecakes', 1),
(12, 'Continental Cheesecakes', 1),
(13, 'Celebration Cakes', 2),
(14, 'Eggless Cakes', 2),
(15, 'Server', 3),
(16, 'Chocolate Numbers', 3),
(17, 'Party Cakes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`u_id` int(11) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `dateJoined` datetime NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `full_name`, `address`, `password`, `email`, `dateJoined`, `is_admin`) VALUES
(20, 'John Smith', 'u 10, 28 Sydney St', 'john20', 'john@gmail.com', '2020-12-10 19:10:10', NULL),
(21, 'Clara Brown', 'u 14, Penshurst Lane', 'clara21', 'clara@gmail.com', '2021-01-12 10:01:56', NULL),
(22, 'Oliver Brown', 'u 15, 20-22 Princes Highway', 'oliver22', 'oliver@gmail.com', '2022-03-05 17:03:10', NULL),
(23, 'Simon Downes', 'u 12, 189 Hampden Road', 'Simon8212', 'Simon@gmail.com', '2022-03-06 12:03:10', NULL),
(24, 'Sandy Morris', 'u 10, Queens Road', 'Sandy7767', 'Sandy@gmail.com', '2018-05-15 00:00:00', NULL),
(25, 'manish', 'manish', '$2y$10$za3IZQw8r7nxOmT0ORh4Oedqqg2giw2.9B/CJ8nGc.MXnA8SJ3Wmy', 'manish@manish.com', '0000-00-00 00:00:00', 0),
(26, 'hello', 'hello', '$2y$10$p683De415cjHiahnPeKCRu7//LEFhLqMcY/n9CKV35/PMiFBD8E3i', 'hello@hello.om', '0000-00-00 00:00:00', 1),
(27, 'hello', 'hello', '$2y$10$NOrrOUOTS6xJ8b/r6e5LZ.2wXCjWtzaapVxvvvkB12CKzCtLHeJJ.', 'hello@hello1.com', '0000-00-00 00:00:00', 0),
(28, 'new hello', 'hello', '$2y$10$uB6ypGg8cbspBJJTtnCq/eGHSs61AylUfFGbm9afiLZWu2MGZFD9i', 'newhello@hello.com', '0000-00-00 00:00:00', 1),
(29, 'helloagain', 'he', '$2y$10$spqjFw/Gp5QBQ6N.5EAw5OICEOXlPpez1IiRNPplRqUVtRY4J1b7a', 'h@h.com', '2022-05-28 19:12:11', 1),
(30, 'he', 'he', '$2y$10$riQmIz9DzcKopQqzTrr7heSyhKi2Wewoto20D6ouZKs6I9mQpl3/2', 'hello@helloagain.com', '2022-05-28 19:12:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE IF NOT EXISTS `wishlist_items` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`id`, `product_id`, `user_id`) VALUES
(1, 112, 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id`), ADD KEY `users_FK` (`u_id`), ADD KEY `products_FK` (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD KEY `p_id_idx` (`p_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id_idx` (`u_id`), ADD KEY `u_id_idx` (`u_id`), ADD KEY `fk_pr_id` (`pr_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
 ADD PRIMARY KEY (`o_id`,`items`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
 ADD PRIMARY KEY (`id`), ADD KEY `order_id_idx` (`order_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`p_id`), ADD KEY `category_id_idx` (`category_id`), ADD KEY `subcategory_id_idx` (`subcategory_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
 ADD PRIMARY KEY (`id`), ADD KEY `o_id_idx` (`o_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
 ADD PRIMARY KEY (`id`), ADD KEY `category_idx` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id_idx` (`user_id`), ADD KEY `product_id_idx` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2015;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `products_FK` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `users_FK` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `fk_pr_id` FOREIGN KEY (`pr_id`) REFERENCES `products` (`p_id`),
ADD CONSTRAINT `u_id` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
ADD CONSTRAINT `order_number` FOREIGN KEY (`order_number`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
ADD CONSTRAINT `o_id` FOREIGN KEY (`o_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
ADD CONSTRAINT `category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`p_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
