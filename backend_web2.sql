-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: backend_web2
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES ('admin@sgu.edu.vn','admin',1),('customer@sgu.edu.vn','customer',3),('staff','staff',2);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author_details`
--

DROP TABLE IF EXISTS `author_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author_details` (
  `product_id` int NOT NULL,
  `author_id` int NOT NULL,
  KEY `fk_product_id_author_details` (`product_id`),
  KEY `fk_author_id_author_details` (`author_id`),
  CONSTRAINT `fk_author_id_author_details` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `fk_product_id_author_details` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author_details`
--

LOCK TABLES `author_details` WRITE;
/*!40000 ALTER TABLE `author_details` DISABLE KEYS */;
INSERT INTO `author_details` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(5,6),(6,7),(7,8),(8,9),(10,11),(11,12),(12,13),(13,14),(14,15),(15,16),(16,17),(16,18),(17,19),(18,20),(19,21),(20,22),(21,23),(22,24),(27,25),(39,27),(40,28),(41,29),(42,30),(43,31),(44,32),(45,33),(46,34),(47,35),(48,29),(49,29);
/*!40000 ALTER TABLE `author_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'CHOU MU-TZU','CHOUMU-TZU@gmail.com'),(2,'LEE JIN SONG','LEEJINSONG@gmail.com'),(3,'PHAN KHẢI VĂN','PHANKHẢIVĂN@gmail.com'),(4,'STEVE HARVEY','STEVEHARVEY@gmail.com'),(5,'KRISTIN NEFF','KRISTINNEFF@gmail.com'),(6,'CHRISTOPHER GERMER','CHRISTOPHERGERMER@gmail.com'),(7,'CARL GUSTAV JUNG','CARLGUSTAVJUNG@gmail.com'),(8,'ILSE SAND','ILSESAND@gmail.com'),(9,'CHANDRA GHOSH IPPEN','CHANDRAGHOSHIPPEN@gmail.com'),(10,' SIGMUND FREUD','SIGMUNDFREUD@gmail.com'),(11,'ANNE ROONEY','ANNEROONEY@gmail.com'),(12,'DIÊU NGHIÊU','DIÊUNGHIÊU@gmail.com'),(13,'MATT HAIG','MATTHAIG@gmail.com'),(14,'CHRISTONPHE ANDRÉ','CHRISTONPHEANDRÉ@gmail.com'),(15,'DIANE MUSHO HAMILTON','DIANEMUSHOHAMILTON@gmail.com'),(16,'POMNYUN','POMNYUN@gmail.com'),(17,'UYÊN BÙI','UYÊNBÙI@gmail.com'),(18,'VALENTINE VŨ','VALENTINEVŨ@gmail.com'),(19,'TRẦN LANG','TRẦNLANG@gmail.com'),(20,'SYLVIA BROWNE','SYLVIABROWNE@gmail.com'),(21,'GUSTAVE DUMOUTIER','GUSTAVEDUMOUTIER@gmail.com'),(22,'TÂM BÙI','TÂMBÙI@gmail.com'),(23,'NGUYỄN QUANG LẬP','NGUYỄNQUANGLẬP@gmail.com'),(24,'GEORGES COULET','GEORGESCOULET@gmail.com'),(25,'PUAL GIRAN','PUALGIRAN@gmail.com'),(26,'HAYDEN CHERRY','HAYDENCHERRY@gmail.com'),(27,'Lạc Bạch Mai','LạcBạchMai@gmail.com'),(28,'Khương Chi Ngư','KhươngChiNgư@gmail.com'),(29,'Diệp Lạc Vô Tâm','DiệpLạcVôTâm@gmail.com'),(30,'Túy Hậu Ngư Ca','TúyHậuNgưCa@gmail.com'),(31,'Thương Thái Vi','ThươngTháiVi@gmail.com'),(32,'Lâu Vũ Tình','LâuVũTình@gmail.com'),(33,'Nghê Đa Hỉ','NghêĐaHỉ@gmail.com'),(34,'Cố Tây Tước','CốTâyTước@gmail.com'),(35,'Cố Mạn','CốMạn@gmail.com'),(36,'KRISTI','@gmail.com'),(37,'NguyenVanA','abc@gmail.com');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `delete_date` date DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'    Tâm lý học    ',0,'2024-04-27','2024-04-27','2024-04-27'),(2,'   Tâm linh - tôn giáo   ',0,'2024-04-27','2024-04-27','2024-04-27'),(3,'   Lịch sử Việt Nam   ',1,'2024-04-27','2024-04-27','2024-04-30'),(4,' Ngôn tình ',1,'2024-04-27','2024-04-27','2024-04-27'),(6,'Dân gian',0,'2024-04-30','2024-04-30','2024-04-30');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_details`
--

DROP TABLE IF EXISTS `category_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_details` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  KEY `fk_product_id_category_details` (`product_id`),
  KEY `fk_category_id_category_details` (`category_id`),
  CONSTRAINT `fk_category_id_category_details` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_product_id_category_details` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_details`
--

LOCK TABLES `category_details` WRITE;
/*!40000 ALTER TABLE `category_details` DISABLE KEYS */;
INSERT INTO `category_details` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,3),(22,3),(23,3),(27,3),(39,4),(40,4),(41,4),(42,4),(43,4),(44,4),(45,4),(46,4),(47,4),(48,4),(49,4);
/*!40000 ALTER TABLE `category_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_infoes`
--

DROP TABLE IF EXISTS `delivery_infoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_infoes` (
  `user_info_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ward` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_info_id`),
  KEY `fk_user_id_user_info` (`user_id`),
  CONSTRAINT `fk_user_id_user_info` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_infoes`
--

LOCK TABLES `delivery_infoes` WRITE;
/*!40000 ALTER TABLE `delivery_infoes` DISABLE KEYS */;
INSERT INTO `delivery_infoes` VALUES (1,'customer@sgu.edu.vn','Lữ Quang Minhaaa','0931814480','280 An Dương Vương','TP. Hồ Chí Minh','Quận 5','Phường 03'),(2,'customer@sgu.edu.vn','Tèo Ú aaa','0931814480','273 An Dương Vương','TP. Hồ Chí Minh','Quận 5','Phường 03'),(3,'customer@sgu.edu.vn','Dương Chươnggg','0911311312','280 An Dương Vương','TP. Hồ Chí Minh','Quận 5','Phường 03');
/*!40000 ALTER TABLE `delivery_infoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discounts` (
  `discount_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `discount_value` int NOT NULL,
  `type` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`discount_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES ('SALE50K',50000,'AR','2024-04-01','2025-04-30'),('SALENUAGIA',50,'PR','2024-04-01','2025-04-30');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `function_details`
--

DROP TABLE IF EXISTS `function_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `function_details` (
  `function_id` int NOT NULL,
  `role_id` int NOT NULL,
  `action` tinyint(1) NOT NULL,
  KEY `fk_function_id` (`function_id`),
  KEY `fk_role_id_function` (`role_id`),
  CONSTRAINT `fk_function_id` FOREIGN KEY (`function_id`) REFERENCES `functions` (`id`),
  CONSTRAINT `fk_role_id_function` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `function_details`
--

LOCK TABLES `function_details` WRITE;
/*!40000 ALTER TABLE `function_details` DISABLE KEYS */;
INSERT INTO `function_details` VALUES (1,1,1),(1,2,1),(2,1,1),(2,2,1),(3,1,1),(3,2,1),(4,1,1),(4,2,1),(5,1,1),(5,2,1),(6,1,1),(6,2,1),(7,1,1),(7,2,1),(8,1,1),(8,2,1),(9,1,1),(9,2,1),(10,1,1),(10,2,0);
/*!40000 ALTER TABLE `function_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `functions`
--

DROP TABLE IF EXISTS `functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `functions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `functions`
--

LOCK TABLES `functions` WRITE;
/*!40000 ALTER TABLE `functions` DISABLE KEYS */;
INSERT INTO `functions` VALUES (1,'Quản lý sản phẩm'),(2,'Quản lý đơn hàng'),(3,'Quản lý tài khoản'),(4,'Quản lý danh mục'),(5,'Thống kê và báo cáo'),(6,'Quản lý thông tin giao hàng'),(7,'Quản lý nhà xuất bản'),(8,'Quản lý tác giả'),(9,'Quản lý nhà cung cấp'),(10,'Quản lý phân quyền');
/*!40000 ALTER TABLE `functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goodsreceipt_details`
--

DROP TABLE IF EXISTS `goodsreceipt_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goodsreceipt_details` (
  `product_id` int NOT NULL,
  `goodsreceipt_id` int NOT NULL,
  `quantity` int NOT NULL,
  `input_price` int NOT NULL,
  KEY `fk_product_id_goodsreceipt_details` (`product_id`),
  KEY `fk_goodsreceipt_id_goodsreceipt_details` (`goodsreceipt_id`),
  CONSTRAINT `fk_goodsreceipt_id_goodsreceipt_details` FOREIGN KEY (`goodsreceipt_id`) REFERENCES `goodsreceipts` (`id`),
  CONSTRAINT `fk_product_id_goodsreceipt_details` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goodsreceipt_details`
--

LOCK TABLES `goodsreceipt_details` WRITE;
/*!40000 ALTER TABLE `goodsreceipt_details` DISABLE KEYS */;
INSERT INTO `goodsreceipt_details` VALUES (1,1,100,59000),(2,1,100,119000),(3,1,100,146000),(4,1,100,58000),(5,1,100,108000),(6,1,100,400000),(7,1,100,49000),(8,1,100,25000),(9,1,100,85000),(10,1,100,110000),(11,1,100,98000),(12,1,100,98000),(13,2,100,68000),(14,2,100,88000),(15,2,100,119000),(16,2,100,166000),(17,2,100,9000),(18,2,100,139000),(19,2,100,239000),(20,2,100,49000),(21,3,100,495000),(22,3,100,99000),(23,3,100,209000),(39,4,100,102000),(40,4,100,189000),(41,4,100,85000),(42,4,100,209000),(43,4,100,26000),(44,4,100,36000),(45,4,100,139000),(46,4,100,69000),(47,4,100,129000),(48,4,100,58000),(49,4,100,49000);
/*!40000 ALTER TABLE `goodsreceipt_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goodsreceipts`
--

DROP TABLE IF EXISTS `goodsreceipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goodsreceipts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` double NOT NULL,
  `date_create` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_supplier_id_goodsreceipts` (`supplier_id`),
  KEY `fk_staff_id_goodsreceipts` (`staff_id`),
  CONSTRAINT `fk_staff_id_goodsreceipts` FOREIGN KEY (`staff_id`) REFERENCES `accounts` (`username`),
  CONSTRAINT `fk_supplier_id_goodsreceipts` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goodsreceipts`
--

LOCK TABLES `goodsreceipts` WRITE;
/*!40000 ALTER TABLE `goodsreceipts` DISABLE KEYS */;
INSERT INTO `goodsreceipts` VALUES (1,1,'staff',135500000,'2024-03-10'),(2,1,'staff',87700000,'2024-03-10'),(3,2,'staff',80300000,'2024-03-10'),(4,3,'staff',109100000,'2024-03-10');
/*!40000 ALTER TABLE `goodsreceipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  KEY `fk_order_id_order_details` (`order_id`),
  KEY `fk_product_id_order_details` (`product_id`),
  CONSTRAINT `fk_order_id_order_details` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_product_id_order_details` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1,'Chờ duyệt'),(2,'Đã duyệt');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivery_info_id` int NOT NULL,
  `date_create` date NOT NULL,
  `total_price` double NOT NULL,
  `status_id` int NOT NULL,
  `discount_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status_id_order` (`status_id`),
  KEY `fk_customer_id_order` (`customer_id`),
  KEY `fk_staff_id_order` (`staff_id`),
  KEY `fk_discount_code_order` (`discount_code`),
  KEY `fk_delivery_info_id_order` (`delivery_info_id`),
  CONSTRAINT `fk_customer_id_order` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`username`),
  CONSTRAINT `fk_delivery_info_id_order` FOREIGN KEY (`delivery_info_id`) REFERENCES `delivery_infoes` (`user_info_id`),
  CONSTRAINT `fk_discount_code_order` FOREIGN KEY (`discount_code`) REFERENCES `discounts` (`discount_code`),
  CONSTRAINT `fk_staff_id_order` FOREIGN KEY (`staff_id`) REFERENCES `accounts` (`username`),
  CONSTRAINT `fk_status_id_order` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `publisher_id` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `price` double NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_publisher_id_product` (`publisher_id`),
  CONSTRAINT `fk_publisher_id_product` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'THAO TÚNG CẢM XÚC: LÀM SAO THOÁT KHỎI CHIẾC BẪY VÔ',3,'assets/images/product/image_1.jpg','2024-04-01','2024-04-01',109000,100),(2,'TỰ DO KHÔNG YÊU ĐƯƠNG',4,'assets/images/product/image_2.jpg','2024-04-01','2024-04-01',169000,100),(3,'ĐỪNG THÁCH THỨC NHÂN TÍNH',5,'assets/images/product/image_3.jpg','2024-04-01','2024-04-01',196000,100),(4,'NÓI LUÔN CHO NÓ VUÔNG',6,'assets/images/product/image_4.jpg','2024-04-01','2024-04-01',108000,100),(5,'TRẮC ẨN VỚI CHÍNH MÌNH',7,'assets/images/product/image_5.jpg','2024-04-01','2024-04-01',158000,100),(6,'CON NGƯỜI VÀ BIỂU TƯỢNG',6,'assets/images/product/image_6.jpg','2024-04-01','2024-04-01',450000,100),(7,'DÁM SỐNG HƯỚNG NỘI VÀ CỰC KỲ NHẠY CẢM',6,'assets/images/product/image_7.jpg','2024-04-01','2024-04-01',99000,100),(8,'TỚ ĐÃ TỪNG SỢ HÃI - LỜI KHUYÊN TỪ CHUYÊN GIA TÂM L',5,'assets/images/product/image_8.jpg','2024-04-01','2024-04-01',75000,100),(9,'NGHIÊN CỨU PHÂN TÂM HỌC',6,'assets/images/product/image_9.jpg','2024-04-01','2024-04-01',135000,100),(10,'TƯ DUY NHƯ NHÀ TÂM LÝ HỌC',6,'assets/images/product/image_10.jpg','2024-04-01','2024-04-01',139000,100),(11,'CON QUÁI VẬT TRONG TÂM TRÍ – NHỮNG CA BỆNH TÂM LÝ ',3,'assets/images/product/image_11.jpg','2024-04-01','2024-04-01',148000,100),(12,'LÝ DO ĐỂ SỐNG TIẾP',8,'assets/images/product/image_12.jpg','2024-04-01','2024-04-01',115000,100),(13,'THIỀN ĐỊNH MỖI NGÀY',5,'assets/images/product/image_13.jpg','2024-04-01','2024-04-01',118000,100),(14,'MỌI VIỆC ĐỀU CÓ THỂ GIẢI QUYẾT - THÁO GỠ KHÓ KHĂN ',5,'assets/images/product/image_14.jpg','2024-04-01','2024-04-01',138000,100),(15,'LÀM SAO HỌC HẾT ĐƯỢC NHÂN SINH',5,'assets/images/product/image_15.jpg','2024-04-01','2024-04-01',169000,100),(16,'CHIÊM TINH PHÙ THỦY - ÚM BA LA ... SOI RA TÍNH CÁC',6,'assets/images/product/image_16.jpg','2024-04-01','2024-04-01',216000,100),(17,'BÙA CHÚ - GIẢI THÍCH CÁC TRÒ MẸO VÀ PHÉP BÍ THUẬT ',6,'assets/images/product/image_17.jpg','2024-04-01','2024-04-01',59000,100),(18,'NGÀY TẬN THẾ - LỜI TIÊN TRI VỀ TƯƠNG LAI VÀ THẾ GI',9,'assets/images/product/image_18.jpg','2024-04-01','2024-04-01',189000,100),(19,'TANG LỄ CỦA NGƯỜI AN NAM (BÌA CỨNG)',6,'assets/images/product/image_19.jpg','2024-04-01','2024-04-01',289000,100),(20,'CÁ HỒI - HÀNH TRÌNH TỈNH THỨC',4,'assets/images/product/image_20.jpg','2024-04-01','2024-04-01',99000,100),(21,'Ba Đồn mạn thuật',2,'assets/images/product/image_21.jpg','2024-04-01','2024-04-01',545000,100),(22,'Bộ Sách Hội Kín',2,'assets/images/product/image_22.jpg','2024-04-01','2024-04-01',149000,100),(23,'Chìm nổi ở Sài Gòn – Những cảnh đời bần cùng ở một',2,'assets/images/product/image_23.jpg','2024-04-01','2024-04-01',259000,100),(27,'Tâm lý Dân Tộc An Nam',2,'assets/images/product/image_27.jpg','2024-04-01','2024-04-01',149000,100),(39,'Năm Tháng Tĩnh Lặng, Kiếp Này Bình Yên',10,'assets/images/product/image_39.jpg','2024-04-01','2024-04-01',138000,100),(40,'Eo Thon Nhỏ',11,'assets/images/product/image_40.jpg','2024-04-01','2024-04-01',239000,100),(41,'Mãi Mãi Là Bao Xa',11,'assets/images/product/image_41.jpg','2024-04-01','2024-04-01',135000,100),(42,'Chỉ Muốn Thương Anh, Chiều Anh, Nuôi Anh',8,'assets/images/product/image_42.jpg','2024-04-01','2024-04-01',259000,100),(43,'Bến Xe',8,'assets/images/product/image_43.jpg','2024-04-01','2024-04-01',76000,100),(44,'Thất Tịch Không Mưa',4,'assets/images/product/image_44.jpg','2024-04-01','2024-04-01',86000,100),(45,'Rung Động Chỉ Vì Em',3,'assets/images/product/image_45.jpg','2024-04-01','2024-04-01',189000,100),(46,'All In Love - Ngập Tràn Yêu Thương',4,'assets/images/product/image_46.jpg','2024-04-01','2024-04-01',119000,100),(47,'Yêu Em Từ Cái Nhìn Đầu Tiên',8,'assets/images/product/image_47.jpg','2024-04-01','2024-04-01',179000,100),(48,'Em Vốn Thích Cô Độc, Cho Đến Khi Có Anh',8,'assets/images/product/image_48.jpg','2024-04-01','2024-04-01',108000,100),(49,'Chờ Em Lớn Nhé Được Không?',8,'assets/images/product/image_49.jpg','2024-04-01','2024-04-01',99000,100);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publishers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publishers`
--

LOCK TABLES `publishers` WRITE;
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
INSERT INTO `publishers` VALUES (1,'Nhà Xuất Bản Nhã Nam'),(2,'Nhà Xuất Bản Hội Nhà Văn'),(3,'Nhà Xuất Bản Hà Nội'),(4,'Nhà Xuât Bản Phụ Nữ'),(5,'Nhà Xuất Bản Dân Trí'),(6,'Nhà Xuất Bản Thế Giới'),(7,'Nhà Xuất Bản Tổng Hợp Thành phố Hồ Chí Minh'),(8,'Nhà Xuất Bản Văn Học'),(9,'Nhà Xuất Bản Thông Tấn'),(10,'Nhà Xuất Bản Lao Động'),(11,'Nhà Xuất Bản Thanh Niên');
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'staff'),(3,'customer');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `number_phone` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `delete_date` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'        Nhã Nam        ','      info@nhanam.com  ','   32425325',1,'2024-04-30',NULL,'2024-04-30'),(2,' Omega Plus ',' info@omegaplus.vn ',' 09323299 ',1,NULL,NULL,'2024-04-30'),(3,' Fahasa ',' cskh@fahasa.com.vn ',' 190063646 ',1,NULL,NULL,'2024-04-30'),(4,' abc ',' abc@abc.com ',' 1111111 ',0,'2024-04-30','2024-04-30','2024-04-30');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-30 22:31:20
