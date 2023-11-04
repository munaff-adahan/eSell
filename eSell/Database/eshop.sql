-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: eshop
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` text,
  `lname` text,
  `email` text,
  `verification_code` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Thisitha','Atapattu','thisitha2008@gmail.com','6358009133368');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'Apple'),(2,'Samsung'),(3,'Vivo'),(4,'Sony'),(5,'HTC'),(6,'Huawei'),(7,'Xiaomi'),(8,'LG'),(9,'Nokia'),(10,'Motorola'),(11,'MSI'),(12,'Acer');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (79,32,'thisitha2008@gmail.com',1),(80,28,'thisitha2008@gmail.com',1),(81,24,'thisitha2008@gmail.com',1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Cell Phones & Accesories'),(2,'Computors & Tablets'),(3,'Cameras'),(4,'Camera Drones'),(5,'Video Game Consoles'),(14,'	Computors & Tablets'),(15,'Feature Phones'),(16,'Televisions'),(17,'Tablets');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `content` text,
  `date` datetime DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  KEY `fk_chat_status1_idx` (`status`),
  CONSTRAINT `fk_chat_status1` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (24,'thetechproemail@gmail.com','thisitha2008@gmail.com','hi','2021-11-22 10:58:12',1),(25,'thetechproemail@gmail.com','thisitha2008@gmail.com','hello','2021-11-22 10:59:44',1);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `postal_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Malabe','0500'),(2,'Kelaniya','11300'),(3,'Dompe','11680');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Gold'),(2,'Graphite'),(3,'Silver'),(4,'Pacific Blue'),(5,'Jet Black'),(6,'Rose Gold'),(7,'Minty Green'),(8,'Purple'),(9,'Starlight');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condition`
--

DROP TABLE IF EXISTS `condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condition`
--

LOCK TABLES `condition` WRITE;
/*!40000 ALTER TABLE `condition` DISABLE KEYS */;
INSERT INTO `condition` VALUES (1,'Brand New'),(2,'Used');
/*!40000 ALTER TABLE `condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Colombo'),(2,'Gampaha'),(3,'Ampara'),(4,'Anuradhapura'),(5,'Badulla'),(6,'Batticaloa'),(7,'Colombo'),(8,'Galle'),(9,'Gampaha'),(10,'Hambantota'),(11,'Jaffna'),(12,'Kalutara'),(13,'Kandy'),(14,'Kegalle'),(15,'Kilinochchi'),(16,'Kurunegala'),(17,'Mannar'),(18,'Matale'),(19,'Matara'),(20,'Monaragala'),(21,'Mullaitivu'),(22,'Nuwara Eliya'),(23,'Polonnaruwa'),(24,'Puttalam'),(25,'Ratnapura'),(26,'Trincomalee'),(27,'Vavuniya');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `feedback_txt` text,
  `product_id` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (3,'Great product',36,'thisitha2008@gmail.com'),(4,'Nice',36,'thisitha2008@gmail.com'),(5,'Good Quality',36,'thisitha2008@gmail.com'),(8,'wsxw',28,'thetechproemail@gmail.com');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Male'),(2,'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `code` text NOT NULL,
  `product_id` int NOT NULL,
  KEY `fk_image_product1_idx` (`product_id`),
  CONSTRAINT `fk_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES ('product_images//617760a40bdd5.jpg',24),('product_images//617761beace40.jpg',28),('product_images//61776ff066614.jpg',29),('product_images//6177d7e36cfb5.jpg',32),('product_images//61791ade9ebac.jpg',36),('product_images//61791adea13e0.jpg',36),('product_images//61791adea4590.jpg',36),('product_images//6192718ed0431.jpg',46),('product_images//619287cec65a3.jpg',49),('product_images//619287cec8883.jpg',49),('product_images//619287cec9d8b.jpg',49),('product_images//6192ba2dd15f5.jpg',50),('product_images//6192ba2dd30a1.jpg',50),('product_images//6192ba2dd4113.jpg',50),('product_images//6193d6dfcdaec.jpg',52),('product_images//6194ad912b9db.jpg',53),('product_images//6194accf473a5.jpg',53),('product_images//6194accf49035.jpg',53);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `order_id` text,
  `unit_price` double DEFAULT NULL,
  `delivery_fee` double NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_status1_idx` (`status_id`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'thisitha2008@gmail.com',36,'2021-10-27 18:56:10',2,'617953432c4a4',31,0,2),(2,'thisitha2008@gmail.com',36,'2021-10-27 19:58:06',1,'617961d85f6bf',31,0,1),(3,'thisitha2008@gmail.com',36,'2021-10-28 09:34:48',1,'617a210891772',31,0,1),(4,'thisitha2008@gmail.com',36,'2021-11-01 20:37:27',2,'61800275e36a1',31,0,2),(5,'thisitha2008@gmail.com',36,'2021-11-06 09:45:41',2,'6186013a3ed77',31,0,2),(6,'thisitha2008@gmail.com',27,'2021-11-06 20:11:57',1,'6186941a54215',35,0,2),(7,'thisitha2008@gmail.com',29,'2021-11-06 20:11:57',1,'6186941a54215',40,0,2),(8,'thisitha2008@gmail.com',27,'2021-11-06 20:24:42',1,'61869711824ab',35,0,2),(9,'thisitha2008@gmail.com',29,'2021-11-06 20:24:42',1,'61869711824ab',40,0,2),(11,'thisitha2008@gmail.com',24,'2021-11-07 14:45:22',1,'6187990ee6c15',100,0,2),(12,'thisitha2008@gmail.com',36,'2021-11-07 14:45:22',1,'6187990ee6c15',31,0,2),(13,'thisitha2008@gmail.com',29,'2021-11-07 14:45:22',1,'6187990ee6c15',40,0,2),(14,'thisitha2008@gmail.com',36,'2021-11-07 14:47:59',1,'61879999305a8',31,0,2),(15,'thisitha2008@gmail.com',36,'2021-11-07 14:49:07',2,'618799f03cc4d',31,0,2),(38,'thisitha2008@gmail.com',36,'2021-11-08 11:08:44',1,'6188b7c64e16e',20,31,2),(39,'thisitha2008@gmail.com',29,'2021-11-08 11:16:14',1,'6188b99091952',40,1000,2),(41,'thisitha2008@gmail.com',36,'2021-11-08 11:16:14',1,'6188b99091952',31,20,2),(43,'thisitha2008@gmail.com',29,'2021-11-08 19:41:47',1,'61892ff0a610f',40,1000,2),(44,'thisitha2008@gmail.com',27,'2021-11-08 19:41:47',1,'61892ff0a610f',35,1000,2),(46,'thisitha2008@gmail.com',28,'2021-11-14 20:59:57',1,'61912b47972b9',40000,200,1),(48,'thisitha2008@gmail.com',53,'2021-11-17 12:53:54',1,'6194adea8253b',40,100,1),(49,'thisitha2008@gmail.com',53,'2021-11-17 13:01:35',2,'6194afbde8b8f',40,100,1),(50,'thisitha2008@gmail.com',32,'2021-11-17 13:01:35',1,'6194afbde8b8f',100000,1000,1),(51,'thisitha2008@gmail.com',29,'2021-11-17 14:24:23',1,'6194c31c2e7d3',40,1000,1),(52,'thisitha2008@gmail.com',53,'2021-11-17 14:24:23',1,'6194c31c2e7d3',40,100,1),(53,'thisitha2008@gmail.com',52,'2021-11-17 16:51:23',1,'6194e5949fff7',80000,2000,1),(54,'thetechproemail@gmail.com',28,'2021-11-22 17:10:02',1,'619b80d1a1a81',40000,200,1);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_id` int NOT NULL,
  `district_id` int NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_location_province1_idx` (`province_id`),
  KEY `fk_location_district1_idx` (`district_id`),
  KEY `fk_location_city1_idx` (`city_id`),
  CONSTRAINT `fk_location_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_location_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_location_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,1,1,1),(2,1,1,2),(3,1,2,3);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (1,'iPhone 12'),(2,'iPhone 11'),(3,'iPhone x'),(4,'iPhone 8'),(5,'iPhone 7'),(6,'iphone 14'),(7,'iPhone 15'),(8,'iPhone 16'),(9,'GP65 Leopard'),(10,'GS76 Stealth'),(11,'iPad Pro');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_brand`
--

DROP TABLE IF EXISTS `model_has_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_id` int NOT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_model1_idx` (`model_id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_brand`
--

LOCK TABLES `model_has_brand` WRITE;
/*!40000 ALTER TABLE `model_has_brand` DISABLE KEYS */;
INSERT INTO `model_has_brand` VALUES (1,1,1),(2,2,1),(3,3,6),(4,7,3),(5,10,11),(6,9,11),(7,11,1);
/*!40000 ALTER TABLE `model_has_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `color_id` int NOT NULL,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `condition_id` int NOT NULL,
  `status_id` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `status_delete` int NOT NULL,
  `approve_status` int NOT NULL,
  `product_code` text,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_color1_idx` (`color_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  KEY `fk_product_status2_idx` (`status_delete`),
  KEY `fk_product_status3_idx` (`approve_status`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_status2` FOREIGN KEY (`status_delete`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_status3` FOREIGN KEY (`approve_status`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (24,1,2,'Iphone 10',1,100,5,'Cupertino, California — Apple today announced iPhone X, the future of the smartphone, in a gorgeous all-glass design with a beautiful 5.8-inch Super Retina display, A11 Bionic chip, wireless charging and an improved rear camera with dual optical image stabilization. ... “iPhone X is the future of the smartphone.',1,1,'thisitha2008@gmail.com','2021-10-26 07:27:56',1000,2000,1,1,'6191ec4b15e28'),(27,1,2,'test',1,35,1,'The iPhone is a smartphone made by Apple that combines a computer, iPod, digital camera and cellular phone into one device with a touchscreen interface. The iPhone runs the iOS operating system, and in 2021 when the iPhone 13 was introduced, it offered up to 1 TB of storage and a 12-megapixel camera.',1,1,'thisitha2008@gmail.com','2021-10-26 07:29:47',1000,2000,2,1,'6191ec6673bcc'),(28,1,2,'Iphone 10',1,40000,8,'The iPhone is a smartphone made by Apple that combines a computer, iPod, digital camera and cellular phone into one device with a touchscreen interface. The iPhone runs the iOS operating system, and in 2021 when the iPhone 13 was introduced, it offered up to 1 TB of storage and a 12-megapixel camera.',1,1,'thisitha2008@gmail.com','2021-10-26 07:32:38',200,300,1,1,'6191ec6dd93a1'),(29,1,1,'Iphone 5',4,40,0,'The iPhone is a smartphone made by Apple that combines a computer, iPod, digital camera and cellular phone into one device with a touchscreen interface. The iPhone runs the iOS operating system, and in 2021 when the iPhone 13 was introduced, it offered up to 1 TB of storage and a 12-megapixel camera.',1,1,'thisitha2008@gmail.com','2021-10-26 08:33:12',1000,2000,1,1,'6191ec75b4c61'),(32,1,1,'Iphone',1,100000,9,'The iPhone is a smartphone made by Apple that combines a computer, iPod, digital camera and cellular phone into one device with a touchscreen interface. The iPhone runs the iOS operating system, and in 2021 when the iPhone 13 was introduced, it offered up to 1 TB of storage and a 12-megapixel camera.',1,1,'thisitha2008@gmail.com','2021-10-26 15:56:43',1000,2000,1,1,'6191ec7fc4172'),(36,1,1,'Iphone 13',3,31,0,'Great product',1,1,'thisitha2008@gmail.com','2021-10-27 14:54:46',20,40,2,1,'6191ec8bef1dd'),(46,2,6,'MSI GP65 LEOPARD',9,300000,5,'SKJI',1,1,'thisitha2008@gmail.com','2021-11-15 20:11:18',1000,2000,2,1,'6192718ecd364'),(48,1,5,'GS76 STEALTH',8,300000,100,'As a world leading gaming brand, MSI is the most trusted name in gaming and eSports. Ranked highest on gamers wish lists, the Gaming Series features top-notch laptops, graphics cards, monitors, motherboards, desktops and gaming gear. The Content Creation Series is specifically tailored for digital content creators.',1,1,'thisitha2008@gmail.com','2021-11-15 20:35:24',1000,2000,2,1,'619277345b3ca'),(49,2,5,'MSI GS76 STEALTH',9,220000,100,'As a world leading gaming brand, MSI is the most trusted name in gaming and eSports. Ranked highest on gamers wish lists, the Gaming Series features top-notch laptops, graphics cards, monitors, motherboards, desktops and gaming gear. The Content Creation Series is specifically tailored for digital content creators.',1,1,'thisitha2008@gmail.com','2021-11-15 21:46:14',1000,2000,2,1,'619287cec2676'),(50,2,6,'MSI GP65 LEOPARD',8,300000,50,'As a world leading gaming brand, MSI is the most trusted name in gaming and eSports. ... Ranked highest on gamers\' wish lists, the Gaming Series features top-notch laptops, graphics cards, monitors, motherboards, desktops and gaming gear. The Content Creation Series is specifically tailored for digital content creators.',1,1,'thisitha2008@gmail.com','2021-11-16 01:21:09',1000,2000,2,1,'6192ba2dce032'),(51,2,7,'Apple iPad Pro',1,100000,50,'The iPad Pro is Apple\'s high-end tablet computer. The latest iPad Pro models feature a powerful M1 chip, a Thunderbolt port, an improved front-facing camera, a Liquid Retina XDR mini-LED display option on the larger model, and up to 16GB of RAM and 2TB of storage.',1,1,'thisitha2008@gmail.com','2021-11-16 11:21:04',1000,2000,2,1,'619346c873332'),(52,17,7,'APPLE IPAD PRO',1,80000,99,'The iPad Pro is Apple\'s high-end tablet computer. The latest iPad Pro models feature a powerful M1 chip, a Thunderbolt port, an improved front-facing camera, a Liquid Retina XDR mini-LED display option on the larger model, and up to 16GB of RAM and 2TB of storage.',1,1,'thisitha2008@gmail.com','2021-11-16 21:35:51',1000,2000,1,1,'6193d6dfc4c98'),(53,1,1,'iPhone 12',1,40,1,'guhhhiu1',1,1,'thisitha2008@gmail.com','2021-11-17 12:48:39',100,200,1,1,'6194accf404e2');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_img`
--

DROP TABLE IF EXISTS `profile_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_path` text,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_img`
--

LOCK TABLES `profile_img` WRITE;
/*!40000 ALTER TABLE `profile_img` DISABLE KEYS */;
INSERT INTO `profile_img` VALUES (4,'user_images//61869e03b9c0d.jpg','thisitha2008@gmail.com'),(5,'user_images//6437a43125af8.png','thetechproemail@gmail.com');
/*!40000 ALTER TABLE `profile_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Western Province');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Active'),(2,'Inactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `verification_code` text,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  KEY `fk_user_status1_idx` (`status_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('thetechproemail@gmail.com','Thisitha','Atapattu','Thisitha123','0718987987','2021-11-06 22:21:58','6186b4eb3415f',1,1),('thisitha2008@gmail.com','Thisitha','Atapattu','Thisitha123','0718012818','2021-09-04 10:40:42','640d8d8ccd36f',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_address`
--

DROP TABLE IF EXISTS `user_has_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `line1` text,
  `line2` text,
  `location_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_address_user1_idx` (`user_email`),
  KEY `fk_user_has_address_location1_idx` (`location_id`),
  CONSTRAINT `fk_user_has_address_location1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `fk_user_has_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_address`
--

LOCK TABLES `user_has_address` WRITE;
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` VALUES (7,'thisitha2008@gmail.com','501','A2',1),(8,'thetechproemail@gmail.com','501','A2',1);
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'eshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-04 12:58:07
