-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: HomeTeacher
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `usertype` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nicname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pointscore` int DEFAULT NULL,
  `classconnectnum` int DEFAULT NULL,
  `loginregdate` datetime DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `views` int DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='유저 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,1,'humphrey1859@gmail.com','2239ab3a53a3cf71e2ee90bdddfd167f80ade7f32b81934f8fe6db5fa0823bd4','humphreye','jojo161',0,0,'2022-06-13 17:06:57','2022-06-13 17:06:57',2),(16,2,'wlgns1858_@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','김지훈','jojo16',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',11),(17,2,'key1@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','고양이','jojo17',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',33),(18,1,'key2@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','수학고수','jojo18',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',30),(19,2,'key3@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','강아지','jojo19',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',22),(20,1,'key4@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','영어고수','jojo20',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',5),(21,2,'key5@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','토끼','jojo21',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',11),(22,1,'key6@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava6','jojo22',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',3),(23,2,'key7@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava7','jojo23',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',6),(24,1,'key8@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava8','jojo24',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',5),(25,2,'key9@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava9','jojo25',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',9),(26,1,'key10@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava10','jojo26',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',0),(27,2,'key11@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava11','jojo27',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',5),(28,1,'key12@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava12','jojo28',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',7),(29,1,'key13@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava13','jojo29',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',4),(30,2,'key14@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava14','jojo30',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',13),(31,2,'key15@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava15','jojo31',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',12),(32,1,'key16@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava16','jojo32',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',7),(33,2,'key17@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava17','jojo33',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',19),(34,1,'key18@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava18','jojo34',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',8),(35,2,'key19@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','다람쥐','jojo35',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',37),(36,1,'key20@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','nava20','jojo36',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',14),(38,1,'key21@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','kim222','jojo37',0,0,'2022-06-16 15:17:59','2022-06-16 15:17:59',18),(50,1,'key22@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','jihun2223','jihun',0,0,'2022-06-23 20:46:07','2022-06-23 20:46:07',27),(61,1,'wlgns1858@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','지훈123','jihun1111',0,0,'2023-01-15 11:16:37','2023-01-15 11:16:37',2),(62,2,'humphrey1858@gmail.com','ddf75455a34020070ee33fd28959b8b121d34214d952120b6483c63e13d0f17e','humphrey444','humphrey',0,0,'2023-01-15 11:18:50','2023-01-15 11:18:50',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03  5:55:36
