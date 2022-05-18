-- MySQL dump 10.13  Distrib 8.0.29, for macos12 (x86_64)
--
-- Host: localhost    Database: capstone
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `p_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_id_idx` (`p_id`),
  CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'cheesecakes',NULL),(2,'cakes',NULL),(3,'other products',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `o_id` int NOT NULL AUTO_INCREMENT,
  `quantity` int DEFAULT NULL,
  `total_amount` decimal(10,0) DEFAULT NULL,
  `items` int NOT NULL,
  PRIMARY KEY (`o_id`,`items`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (2011,2,72,111),(2011,1,35,113),(2012,10,360,114),(2012,4,188,117),(2013,5,15,16),(2013,6,30,120),(2014,1,70,116);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL,
  `u_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`u_id`),
  KEY `u_id_idx` (`u_id`),
  CONSTRAINT `u_id` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2011,20,'2020-11-10 19:10:10','Delivered'),(2012,21,'2021-01-10 14:10:10','In Transit'),(2013,22,'2021-01-11 13:10:10','Cancelled'),(2014,21,'2021-01-11 01:10:10','Ready to ship'),(2015,23,'2021-02-10 20:10:10','Delivered');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_number` int DEFAULT NULL,
  `cardholder_name` varchar(45) DEFAULT NULL,
  `card_number` int DEFAULT NULL,
  `card_expiry` datetime DEFAULT NULL,
  `card_cvv` int DEFAULT NULL,
  `payment_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id_idx` (`order_number`),
  CONSTRAINT `order_number` FOREIGN KEY (`order_number`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,2011,'Simon Downes',11108888,'2022-11-10 00:00:00',122,'paid'),(2,2014,'Clara Brown ',11119999,'2022-11-12 00:00:00',211,'on hold'),(3,2013,'Oliver Brown',12988222,'2022-11-13 00:00:00',322,'unsuccessful'),(4,2015,'John Smith',23457676,'2022-11-15 00:00:00',455,'processing'),(5,2012,'Clara Brown',76768989,'2022-11-25 00:00:00',233,'paid');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `description` longtext,
  `category_id` int DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `subcategory_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id_idx` (`category_id`),
  KEY `subcategory_id_idx` (`subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (111,'American Baked Cheesecake',36,'A vanilla cheesecake on a graham biscuit base.',1,'1111',11),(112,'Strawberry Sundae',38,'Baked cheesecake glazed with fresh strawberries',1,'1112',11),(113,'Cookies and Cream',35,'Mix of continental cheesecake and cookie crumbs on a choc graham biscuit base',1,'1113',12),(114,'Creamy Caramel',33,'Continental cheesecake with caramel filling and a caramel glaze',1,'1114',12),(115,'Rainbow Cake',55,'Six layers of rainbow coloured vanilla sponge simply layered with fresh cream and covered with rainbow sequins.',2,'1115',17),(116,'A Little Bit Fancy',70,'Vanilla sponge layered with fresh caramel cream and gooey caramel. Coated in mousse and finished with a milk choc drip, rosettes, gold pearls and choc chips.',2,'1116',13),(117,'Black Forest',47,'Eggless chocolate sponge layered with vegetarian vanilla cream and hand-crushed sour cherries. Finished with cream rosettes and maraschino cherries',2,'1117',14),(118,'Double Choc Strawberry',47,'Eggless chocolate sponge layered with vegetarian chocolate cream and natural strawberry filling. Finished with cream rosettes and fresh strawberries.',2,'1118',14),(119,'Cake Server',3,'',3,'1119',15),(120,'Number 0',5,'',3,'1120',16),(121,'Number 1',5,'',3,'1121',16);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `o_id` int DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `o_id_idx` (`o_id`),
  CONSTRAINT `o_id` FOREIGN KEY (`o_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
INSERT INTO `shipping` VALUES (101,2011,'u 10, 28 Sydney St'),(102,2012,'u 14, Penshurst Lane'),(103,2013,'u 10, Railway Street, rockdale'),(104,2014,'10-12 Empress street, Hurstville'),(105,2015,'u 15, 20-22 Princess Highway');
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_idx` (`category`),
  CONSTRAINT `category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (11,'Baked Cheesecakes',1),(12,'Continental Cheesecakes',1),(13,'Celebration Cakes',2),(14,'Eggless Cakes',2),(15,'Server',3),(16,'Chocolate Numbers',3),(17,'Party Cakes',2);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(45) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `dateJoined` datetime NOT NULL,
  `is_admin` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (20,'John Smith','u 10, 28 Sydney St','john20','john@gmail.com','2020-12-10 19:10:10',NULL),(21,'Clara Brown','u 14, Penshurst Lane','clara21','clara@gmail.com','2021-01-12 10:01:56',NULL),(22,'Oliver Brown','u 15, 20-22 Princes Highway','oliver22','oliver@gmail.com','2022-03-05 17:03:10',NULL),(23,'Simon Downes','u 12, 189 Hampden Road','Simon8212','Simon@gmail.com','2022-03-06 12:03:10',NULL),(24,'Sandy Morris','u 10, Queens Road','Sandy7767','Sandy@gmail.com','2018-05-15 00:00:00',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist_items`
--

DROP TABLE IF EXISTS `wishlist_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist_items` (
  `id` int NOT NULL,
  `product_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist_items`
--

LOCK TABLES `wishlist_items` WRITE;
/*!40000 ALTER TABLE `wishlist_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-15 21:31:33
