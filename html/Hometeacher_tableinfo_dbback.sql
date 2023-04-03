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

--
-- Table structure for table `userreview`
--

DROP TABLE IF EXISTS `userreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userreview` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` int DEFAULT NULL,
  `teacheruid` int DEFAULT NULL,
  `writeuid` int DEFAULT NULL,
  `reviewtext` varchar(255) DEFAULT NULL COMMENT '리뷰 내용',
  `professional` float DEFAULT NULL,
  `lecturepower` float DEFAULT NULL,
  `lectureready` float DEFAULT NULL,
  `lectureontime` float DEFAULT NULL,
  `payment` int DEFAULT NULL,
  `classstartdate` datetime DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COMMENT='유저의 리뷰 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userreview`
--

LOCK TABLES `userreview` WRITE;
/*!40000 ALTER TABLE `userreview` DISABLE KEYS */;
INSERT INTO `userreview` VALUES (7,123,18,17,'rewrwer7777',2.5,4,4,4.5,65,'2022-08-11 00:57:06','2022-08-11 19:33:51'),(8,125,18,33,'fwefwefwef54564',2,5,2.5,3.5,25,'2022-08-11 19:00:44','2022-08-11 19:43:50');
/*!40000 ALTER TABLE `userreview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacherdedatecategorey`
--

DROP TABLE IF EXISTS `teacherdedatecategorey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teacherdedatecategorey` (
  `idx` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherdedatecategorey`
--

LOCK TABLES `teacherdedatecategorey` WRITE;
/*!40000 ALTER TABLE `teacherdedatecategorey` DISABLE KEYS */;
INSERT INTO `teacherdedatecategorey` VALUES (1,'자유로운 애기'),(2,'과외성사'),(3,'이용방법'),(4,'수업교재'),(5,'수업료'),(6,'문제질문'),(7,'수업내용'),(8,'수업진행'),(9,'정보공유'),(10,'기타');
/*!40000 ALTER TABLE `teacherdedatecategorey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjectlist`
--

DROP TABLE IF EXISTS `subjectlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjectlist` (
  `idx` int NOT NULL,
  `subjectgroup` int NOT NULL,
  `subjectname` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjectlist`
--

LOCK TABLES `subjectlist` WRITE;
/*!40000 ALTER TABLE `subjectlist` DISABLE KEYS */;
INSERT INTO `subjectlist` VALUES (1,1,'국어'),(2,1,'영어'),(3,1,'수학'),(4,1,'사회'),(5,1,'과학'),(6,1,'자격증');
/*!40000 ALTER TABLE `subjectlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profileteacher`
--

DROP TABLE IF EXISTS `profileteacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profileteacher` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `getstate` int DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `minpay` int DEFAULT NULL,
  `detailpaystandard` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `character` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `majorsubject` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `university` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `universitychk` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `campusaddress` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `universmajor` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `studentid` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `introduce` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `availabletime` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `subjectdocument` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `classstyle` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `skillappeal` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profileteacher`
--

LOCK TABLES `profileteacher` WRITE;
/*!40000 ALTER TABLE `profileteacher` DISABLE KEYS */;
INSERT INTO `profileteacher` VALUES (14,15,2,1,10,'영어회화 ','[10, 11]','[3, 4]','경희대학교','2','서울캠퍼스	','English Major','16','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(16,18,2,1,25,'영어회화 ','[10, 11]','[0, 1, 2]','한양대학교','2','서울캠퍼스	','English Major','14','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(17,20,2,1,35,'영어회화 ','[10, 11]','[0, 1, 5]','한남대학교','2','서울캠퍼스	','English Major','22','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(18,22,2,2,45,'영어회화 ','[10, 11]','[5]','대전대학교','2','서울캠퍼스	','English Major','13','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(19,26,2,2,120,'영어회화 ','[10, 11]','[2, 4]','연세대학교','2','서울캠퍼스	','English Major','18','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(20,28,2,2,125,'영어회화 ','[10, 11]','[2, 4]','경희대학교','2','서울캠퍼스	','English Major','13','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(21,29,2,2,150,'영어회화 ','[10, 11]','[0, 1, 5]','한양대학교','2','서울캠퍼스	','English Major','15','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(22,32,2,2,75,'영어회화 ','[10, 11]','[1, 2, 5]','서울대학교','2','서울캠퍼스	','English Major','13','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(23,34,2,1,80,'영어회화 ','[10, 11]','[0, 1, 5]','홍익대학교','2','서울캠퍼스	','English Major','05','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(24,36,2,1,90,'영어회화 ','[10, 11]','[0, 3]','서울대학교','2','서울캠퍼스	','English Major','08','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(25,24,2,1,45,'영어회화 ','[10, 11]','[0, 1, 5]','서울대학교','2','서울캠퍼스	','English Major','12','안녕하세요 김지훈입니다.','주 2 ~ 3회','듣기, 말하기, 독해, 보캡 , 문제풀이, 독서 (회화만 편하게 수업가능)','꼼꼼 히 설명해주면서 학생의 공부 스타일을 파악함.\n성적향상도 중요하지만 \n\n','미국에서 4년 거주\n\n영어 + 한국어 모두 유창함'),(58,50,2,1,75,'영어회화 기준','[1, 3, 4, 9]','[1, 4]','고려대학교','2','서울','영문학과','13','안녕하세요','주말 가능','영어 회화, 국어','차분하게','실력어필'),(59,38,2,1,35,'영어회화 기준','[1, 4, 10]','[0, 1, 2]','경희대학교','2','서울','영문학과','01','안녕하세요','주말 가능','영어 회화, 코딩','차분하게','실력어필'),(76,61,2,1,45,'영어 전문가빕니다. 연락주세요. ','[4, 5, 6]','[0, 1, 2]','서울대','2','서울','영어영문','20151111','존잘영어고수','주말가능합니다.','영어 1등급','냉정, 철저','1등급 목표');
/*!40000 ALTER TABLE `profileteacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profilestudent`
--

DROP TABLE IF EXISTS `profilestudent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profilestudent` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `getstate` int DEFAULT NULL,
  `studentages` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `introduce` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `majorsubject` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `maxpay` int DEFAULT NULL,
  `availabletime` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `infotalk` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profilestudent`
--

LOCK TABLES `profilestudent` WRITE;
/*!40000 ALTER TABLE `profilestudent` DISABLE KEYS */;
INSERT INTO `profilestudent` VALUES (13,16,2,'0',1,'국어 위주로 공부하고 싶습니다.','[0, 4]',40,'sdfsdf222','dsvds2222'),(14,17,3,'2',0,'말하기 위주로 공부하고 싶습니다.','[1, 4]',150,'sdfsdf222','dsvds2222'),(15,19,3,'3',1,'회화 위주로 공부하고 싶습니다.','[0, 2]',25,'sdfsdf222','dsvds2222'),(16,21,3,'4',1,'듣기 위주로 공부하고 싶습니다.','[0, 1]',45,'sdfsdf222','dsvds2222'),(17,23,3,'5',2,'외국어 위주로 공부하고 싶습니다.','[2, 3]',35,'sdfsdf222','dsvds2222'),(18,25,3,'7',2,'영어 위주로 공부하고 싶습니다.','[4, 5]',20,'sdfsdf222','dsvds2222'),(19,27,3,'5',2,'말하기 위주로 공부하고 싶습니다.','[2, 3]',10,'sdfsdf222','dsvds2222'),(20,30,3,'9',1,'언어 위주로 공부하고 싶습니다.','[0]',55,'sdfsdf222','dsvds2222'),(21,31,3,'12',2,'수리 위주로 공부하고 싶습니다.','[1, 2]',25,'sdfsdf222','dsvds2222'),(22,33,3,'5',2,'과학 위주로 공부하고 싶습니다.','[2, 5]',15,'sdfsdf222','dsvds2222'),(23,35,3,'4',2,'사회 위주로 공부하고 싶습니다.','[0, 4]',125,'sdfsdf222','dsvds2222'),(25,62,3,'6',0,'영어 잘하고 싶어요.','[0, 1, 2]',50,'주말가능합니다.','잘만 가르쳐주세요. 일등급 목표로합니다.');
/*!40000 ALTER TABLE `profilestudent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profileimg`
--

DROP TABLE IF EXISTS `profileimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profileimg` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `type` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profileimg`
--

LOCK TABLES `profileimg` WRITE;
/*!40000 ALTER TABLE `profileimg` DISABLE KEYS */;
INSERT INTO `profileimg` VALUES (120,17,'/image/profile/','photo1_36770300.jpg',0,'2022-08-11 18:49:34'),(121,17,'/image/profile/','photo1_44401500.jpg',1,'2022-08-11 18:49:49'),(122,15,'/image/profile/','photo1_60980200.jpg',1,'2022-08-11 18:50:45'),(123,16,'/image/profile/','photo1_34442000.jpg',1,'2022-08-11 18:51:23'),(124,18,'/image/profile/','photo2_35349600.jpg',1,'2022-08-11 18:51:23'),(125,19,'/image/profile/','photo3_36027500.jpg',1,'2022-08-11 18:51:23'),(126,20,'/image/profile/','photo4_36656000.jpg',1,'2022-08-11 18:51:23'),(127,21,'/image/profile/','photo5_37239200.jpg',1,'2022-08-11 18:51:23'),(128,22,'/image/profile/','photo1_4065900.jpg',1,'2022-08-11 18:51:46'),(129,23,'/image/profile/','photo2_4912300.jpg',1,'2022-08-11 18:51:46'),(130,24,'/image/profile/','photo3_5548200.jpg',1,'2022-08-11 18:51:46'),(131,25,'/image/profile/','photo4_6309300.jpg',1,'2022-08-11 18:51:46'),(132,26,'/image/profile/','photo5_7039200.jpg',1,'2022-08-11 18:51:46'),(133,27,'/image/profile/','photo1_74221000.jpg',1,'2022-08-11 18:53:25'),(134,28,'/image/profile/','photo2_75011000.jpg',1,'2022-08-11 18:53:25'),(135,29,'/image/profile/','photo3_75647200.jpg',1,'2022-08-11 18:53:25'),(136,30,'/image/profile/','photo4_76414500.jpg',1,'2022-08-11 18:53:25'),(137,31,'/image/profile/','photo5_77077700.jpg',1,'2022-08-11 18:53:25'),(138,32,'/image/profile/','photo6_77682700.jpg',1,'2022-08-11 18:53:25'),(139,33,'/image/profile/','photo7_78341700.jpg',1,'2022-08-11 18:53:25'),(140,34,'/image/profile/','photo8_79335500.jpg',1,'2022-08-11 18:53:25'),(141,35,'/image/profile/','photo9_80043700.jpg',1,'2022-08-11 18:53:25'),(142,36,'/image/profile/','photo10_80835000.jpg',1,'2022-08-11 18:53:25'),(143,38,'/image/profile/','photo11_81554000.jpg',1,'2022-08-11 18:53:25'),(144,50,'/image/profile/','photo12_82120000.jpg',1,'2022-08-11 18:53:25'),(145,17,'/image/profile/','photo13_82742700.jpg',0,'2022-08-11 18:53:25'),(146,17,'/image/profile/','photo14_83548600.jpg',0,'2022-08-11 18:53:25'),(147,53,'/image/profile/','photo1_13867500.jpg',0,'2023-01-14 14:36:43'),(148,53,'/image/profile/','photo2_14960900.jpg',0,'2023-01-14 14:36:43'),(149,53,'/image/profile/','photo1_3266600.jpg',0,'2023-01-14 14:37:41'),(150,53,'/image/profile/','photomain_25030201.jpg',1,'2023-01-14 14:41:44'),(151,54,'/image/profile/','photo1_3758101.jpg',0,'2023-01-14 16:31:03'),(152,54,'/image/profile/','photo2_5109300.jpg',0,'2023-01-14 16:31:03'),(153,55,'/image/profile/','photo1_63471800.jpg',0,'2023-01-14 16:48:21'),(154,56,'/image/profile/','photo1_12044200.jpg',0,'2023-01-14 16:49:45'),(155,57,'/image/profile/','photo1_7252300.jpg',0,'2023-01-14 16:55:18'),(156,58,'/image/profile/','photo1_90673000.jpg',0,'2023-01-15 10:59:33'),(157,58,'/image/profile/','photo2_91555900.jpg',0,'2023-01-15 10:59:33'),(158,58,'/image/profile/','photo3_92346500.jpg',0,'2023-01-15 10:59:33'),(159,59,'/image/profile/','photo1_66537501.jpg',0,'2023-01-15 11:09:15'),(160,59,'/image/profile/','photo2_67502400.jpg',0,'2023-01-15 11:09:15'),(161,59,'/image/profile/','photo3_68213600.jpg',0,'2023-01-15 11:09:15'),(162,60,'/image/profile/','photo1_2468400.jpg',0,'2023-01-15 11:11:16'),(163,61,'/image/profile/','photo1_85076800.jpg',0,'2023-01-15 11:18:09'),(164,61,'/image/profile/','photo2_86333400.jpg',0,'2023-01-15 11:18:09'),(165,62,'/image/profile/','photo1_28469101.jpg',0,'2023-01-15 11:19:41'),(166,62,'/image/profile/','photo2_29328800.jpg',0,'2023-01-15 11:19:41'),(167,61,'/image/profile/','photomain_27915200.jpg',1,'2023-01-15 11:25:54'),(168,62,'/image/profile/','photomain_1325900.jpg',1,'2023-01-15 11:26:01'),(169,61,'/image/profile/','photo1_10907100.jpg',0,'2023-01-15 11:33:10');
/*!40000 ALTER TABLE `profileimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problemlist`
--

DROP TABLE IF EXISTS `problemlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problemlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `problemdocu` varchar(255) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COMMENT='내 과외 과제 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problemlist`
--

LOCK TABLES `problemlist` WRITE;
/*!40000 ALTER TABLE `problemlist` DISABLE KEYS */;
INSERT INTO `problemlist` VALUES (22,130,61,'과제입니다! 이번주까지 안드로이드 공부해서 검사받으세요!','2023-01-14 19:37:44'),(23,130,61,'2주차 과제입니다. php 리눅스 환경에서 작업하세요. 과제 검사 받으시구요','2023-01-14 19:39:16');
/*!40000 ALTER TABLE `problemlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problemimglist`
--

DROP TABLE IF EXISTS `problemimglist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problemimglist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COMMENT='내 과외 과제 이미지 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problemimglist`
--

LOCK TABLES `problemimglist` WRITE;
/*!40000 ALTER TABLE `problemimglist` DISABLE KEYS */;
INSERT INTO `problemimglist` VALUES (11,22,61,'/image/problem/','photo0_93182400.jpg','2023-01-14 19:37:28'),(12,22,61,'/image/problem/','photo1_5880500.jpg','2023-01-14 19:37:28'),(13,22,61,'/image/problem/','photo2_6614201.jpg','2023-01-14 19:37:28'),(14,23,61,'/image/problem/','photo0_12463900.jpg','2023-01-14 19:39:16');
/*!40000 ALTER TABLE `problemimglist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problemcommentimg`
--

DROP TABLE IF EXISTS `problemcommentimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problemcommentimg` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `src` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problemcommentimg`
--

LOCK TABLES `problemcommentimg` WRITE;
/*!40000 ALTER TABLE `problemcommentimg` DISABLE KEYS */;
INSERT INTO `problemcommentimg` VALUES (9,27,62,'/image/problemcomment/','photo0_75134500.jpg','2023-01-14 19:58:27');
/*!40000 ALTER TABLE `problemcommentimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problemcomment`
--

DROP TABLE IF EXISTS `problemcomment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problemcomment` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `likenum` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problemcomment`
--

LOCK TABLES `problemcomment` WRITE;
/*!40000 ALTER TABLE `problemcomment` DISABLE KEYS */;
INSERT INTO `problemcomment` VALUES (27,22,62,'확인하였습니다.',0,'2023-01-14 19:58:27'),(28,22,35,'check me rabbit!213',0,'2023-01-15 12:35:11'),(29,23,35,'check',0,'2023-01-15 12:36:14'),(30,23,62,'넵',0,'2023-01-14 19:59:25'),(31,23,61,'다들 열심히 해주셔서 감사해요',0,'2023-01-14 19:39:49'),(32,23,61,'응원합니다.',0,'2023-01-14 19:39:52');
/*!40000 ALTER TABLE `problemcomment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentdatalist`
--

DROP TABLE IF EXISTS `paymentdatalist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paymentdatalist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` int DEFAULT NULL COMMENT '결제 한 방 idx',
  `getuid` int DEFAULT NULL COMMENT '결제 받은 사람',
  `giveuid` int DEFAULT NULL COMMENT '결제 보낸 사람',
  `price` int DEFAULT NULL COMMENT '결제금액',
  `receiptid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `activate` int DEFAULT NULL COMMENT '승연 여부 1. 승인, 0. 결제 취소',
  `regdate` datetime DEFAULT NULL,
  `cancelregdate` datetime DEFAULT NULL COMMENT '결제 취소 날짜',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COMMENT='결제 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentdatalist`
--

LOCK TABLES `paymentdatalist` WRITE;
/*!40000 ALTER TABLE `paymentdatalist` DISABLE KEYS */;
/*!40000 ALTER TABLE `paymentdatalist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nboardimg`
--

DROP TABLE IF EXISTS `nboardimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nboardimg` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `nid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `maincategorey` int DEFAULT NULL,
  `subcategorey` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `src` varchar(225) CHARACTER SET utf8mb3 DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nboardimg`
--

LOCK TABLES `nboardimg` WRITE;
/*!40000 ALTER TABLE `nboardimg` DISABLE KEYS */;
INSERT INTO `nboardimg` VALUES (89,73,61,1,0,'/image/nboard/','photo0_96001500.jpg','2023-01-14 18:56:58'),(90,73,61,1,0,'/image/nboard/','photo1_96564700.jpg','2023-01-14 18:56:58'),(91,73,61,1,0,'/image/nboard/','photo2_97167900.jpg','2023-01-14 18:56:58'),(92,74,62,0,2,'/image/nboard/','photo0_24092200.jpg','2023-01-14 19:17:16'),(93,74,62,0,2,'/image/nboard/','photo1_24895500.jpg','2023-01-14 19:17:16'),(94,74,62,0,2,'/image/nboard/','photo2_25397400.jpg','2023-01-14 19:17:16'),(95,74,62,0,2,'/image/nboard/','photo3_26100900.jpg','2023-01-14 19:17:16'),(96,74,62,0,2,'/image/nboard/','photo4_26617300.jpg','2023-01-14 19:17:16'),(97,74,62,0,2,'/image/nboard/','photo5_27206700.jpg','2023-01-14 19:17:16'),(98,74,62,0,2,'/image/nboard/','photo6_27833500.jpg','2023-01-14 19:17:16');
/*!40000 ALTER TABLE `nboardimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nboard`
--

DROP TABLE IF EXISTS `nboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nboard` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `maincategorey` int DEFAULT NULL,
  `subcategorey` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `likenum` int DEFAULT NULL,
  `views` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nboard`
--

LOCK TABLES `nboard` WRITE;
/*!40000 ALTER TABLE `nboard` DISABLE KEYS */;
INSERT INTO `nboard` VALUES (1,15,1,1,'과외 팁','다들 새내기때 과외 몇개 정도 하셨나요? 과외를 여러개 하는데 학점관리와 노는것 사이의 밸런스는 어떻게 맞추시나요?',0,2,'2022-06-26 23:35:57'),(2,15,1,1,'수업 진행','중3학생이랑 고등학교 선행을 하게 되면 고등학교 입학 전까지 어디까지 끝내시나요???',0,3,'2022-06-26 23:35:57'),(3,15,1,1,'학생들 성향','학생들 가르치다보면 맞지 않은 학생들이 있는데 다들 어떻게 진행하시나요? ',0,1,'2022-06-26 23:35:57'),(4,15,1,1,'과외 수업료','중학교 학생 수업중인데 과외 수업료 올리도록 말씀드려야하는데 어떻게 하면 좋을까요?',0,3,'2022-06-26 23:35:57'),(5,15,1,1,'과외 질문','앱을 깔아놓기만 하고 적극적으로 구하기 시작한지 4일쯤 지났는데 연락이 없네요.. 언제쯤 과외 성사되나요?',0,1,'2022-06-26 23:35:57'),(6,15,1,1,'날씨가 많이 풀렸네요,','오늘 부터 날씨가 많이 풀렸네요 다들 팟팅입니다~~',0,2,'2022-06-26 23:35:57'),(7,15,1,1,'과외 문의 질문','학생이나 학부모님께 과외 문의가 왔을때 거절하고 싶을때 어떻게 하시나요?',0,1,'2022-06-26 23:35:57'),(8,15,1,1,'프로필 관련','제프로필 어떤 문제가 있나요? 가입한지 꽤 되었고 문의도 여러번 넣었는데 상담요청이 거의 안들어오네요 ㅠㅠㅠ',0,2,'2022-06-26 23:35:57'),(10,16,0,2,'저희 학교 문제','저희학교 이번 사회 문화 시험에서 말 많은데... 이 문제 답이 뭐라고 생각하시나요?',0,0,'2022-06-26 23:35:57'),(11,16,0,2,'문제 질문이요.','두근 사이에는 함숫값만 하면 되나요? 판함 대 다 해야하는건 어느 경우인가요?',0,0,'2022-06-26 23:36:56'),(12,16,0,2,'대학교 입시 질문','저희 학교에 공부잘하는 친구들은 대형 유명학원을 갑니다.. 근데 전 거기까지 갈 실력이 안되서 그냥 동네 학원 다니는데 선생님은 동네학원과 대형학원 중에 뭐가 더 효과가 더 좋다고 생각하시나요?',0,0,'2022-06-26 23:36:56'),(13,16,0,2,'대학교 입시 질문입니다.','고1인데 서울대학교 가려면 어떻게 해야하나요?? ',0,0,'2022-06-26 23:40:05'),(14,16,0,3,'직업 고민','5급 공무원 vs 한의사 중에 선생님들은 어디를 원하시나요?',0,0,'2022-06-26 23:40:27'),(15,50,0,0,'공부 집중문제','뒷심 부족으로 공부습관도 안잡혀있고 공부에 흥미가 안생겨요. 어떻게 해야 생길까요??',0,0,'2022-06-27 11:24:24'),(16,50,0,0,'공부 방법 ','수능 수학 3등급 학생입니다. 수리논술 학교별 기출을 보니까 수능이랑 좀 스타일이 많이 다르기도 하고 몇명 학교는 풀기도 버겁던데요. 올바른공부 방법인지 궁긍합니다. ',0,1,'2022-06-27 11:29:52'),(17,50,0,2,'대학교 관련','대학교 휴학 연속 3학기 가능한가용??',0,0,'2022-06-27 11:34:45'),(18,50,1,5,'성적','중학교 회화 수학성정 안오르는 학생 이유가 뭘까요? 오르게 하는 방법 없을까요??ㅠㅠ',0,7,'2022-06-27 11:35:08'),(19,50,0,2,'재수생 질문','재수생인데 혼자 공부하다 보니까 나태해지고 집중도 안되고 힘들어요.. 학원을 다닐까 하는데 진도문제때문에 못따라 갈까봐 겁이 나네요. 어떻게 하면 좋을까요?',0,0,'2022-06-27 14:36:12'),(20,50,1,0,'경제 분야 쌤들!','경제 분야에 대해서 질문이 있습니다. ',0,2,'2022-06-27 14:36:31'),(21,50,1,8,'과외 시간표','혹시 과외 시간표 관리할때 다들 어디다 적으시나요???',0,0,'2022-06-27 14:37:24'),(22,50,1,7,'고등학교 학생 과외 팁','고등학생 가르치실때 잘 가르치는 팁이 있을까요?? ',0,1,'2022-06-27 14:39:11'),(23,50,0,3,'입시질문','지금 중학교 부터 해야하는 상황인데 뭐부터 해야할지 알려주세요. 저는 지금 고1이에요!',0,2,'2022-06-27 14:40:15'),(24,50,0,0,'수학 문제 질문이요.','이 값을 보고 저기 수식에 값을 어떻게 넣어야 할지 알려주실분 계신가요?',0,1,'2022-06-27 14:40:45'),(25,50,0,2,'이차방정식 질문','2차 방정식에서 이부분 이해가 안가네요.',0,1,'2022-06-27 14:41:30'),(26,50,1,9,'문제 질문','아래 사진 어떤 문제집인지 아시는분 계신가요~~~?',0,2,'2022-06-27 14:43:45'),(27,50,1,6,'고3 국어 시험범위','고 국어 시험과외 할때 뭐하면 좋을까요?',0,5,'2022-06-27 14:46:20'),(28,50,0,3,'국어 공부 질문이요.','제가 국어 공부를 인강은 안듣고 마더텅 검정색 수능 기출 문제집으로 공부를 하고 있습니다. 기출은 시간안에 풀고 다 맞혔다 틀렸다 하는게 의미가 없다고 생각해서 시간이 오래 걸려도 최대한 지문 이해를 해보고 문제를 풀 때도 그냥 풀지 않고 이 선지는 몇 문단에 나와있는지를 판단하면서 문제를 풉니다. 기출분석을 해야하는데 어떻게 할지 모르겠네요, 조언 부탁드립니다. ',0,0,'2022-06-27 14:48:25'),(29,50,0,1,'과학 질문입니다.','체액성 면역과 세포성 면역은 동시에 일어날 수 있나요?',0,0,'2022-06-27 16:17:52'),(30,50,0,0,'이 문제 답을 알려주세요,','답4번 맞을까요?,,,',0,1,'2022-06-27 17:55:18'),(31,16,0,0,'과학질문','방추사가 동원체에 붙는건가요???',0,0,'2022-06-28 14:19:41'),(32,16,0,0,'시험 문제 질문입니다.','이부분 그림으로 설명 부탁드립니다..',0,0,'2022-06-28 14:20:04'),(33,16,0,1,'기초대사량 질문','음식물의 소화 흡수에 필요한 에너지양은 기초대사량인가요?',0,0,'2022-06-28 14:20:10'),(34,50,0,1,'과외 상담','선생님 입장에서 과외 학생보다 나이가 많으면 부담스러울까요?',0,0,'2022-06-28 14:22:07'),(35,50,0,0,'시험문제 질문입니다.','이게 무슨말인가요?? 오늘시험인데..',0,1,'2022-06-28 16:16:35'),(36,50,0,0,'시험문제 질문이용.','이부분 설명부탁드릴게요..!!',0,0,'2022-06-28 16:18:20'),(37,50,0,0,'시험 점수 관련 질문이요','미적 4점짜리 맞히려면 뭘 해야할까요???? 기본 유형으로는 안될거 같은데..',0,0,'2022-06-28 16:37:33'),(38,50,0,1,'수리 문제','이거 연립 어떻게 하나요?????',0,1,'2022-06-28 16:49:40'),(40,50,0,0,'재수생 질문','재수해서 의대 희망하는 학생인데 현우진 커리 질문이있습니다.이번년도에 미적에서 기하로 바꿔가지고 지금 시발점 기하 벡터 초중반부 듣고 있습니다.근데 그 뒤로 시발점 1 2회독,워크북 푼 후 뉴런으로 바로 넘어갈까요 아니면 수분감 먼저 풀고 나서 뉴런으로 넘어가는게 좋을까요?',0,0,'2022-06-30 09:58:08'),(41,50,0,2,'문제풀이','그리스 교는 동물을 이용하면 안된다는 주의죠???',0,1,'2022-06-30 10:26:12'),(42,50,0,3,'질문1 국어 기출n회독은 어떻게 하는건가요?','1회독-문제풀고 정답,오답근거 찾기',0,1,'2022-06-30 10:27:03'),(43,50,0,1,'문제풀이','두근 사이에는 함숫값만 하면 되나요? 판 함 대 다 해야하는건 어느 경우인가요?',0,2,'2022-06-30 10:37:24'),(44,50,0,2,'미적 질문','근데진짜 미적 4점짜리 맞히려면 뭘 해야되나요…? 기본 유형만 풀어선 안될거같은데…<br>\r\n<br>\r\n자신이없어요 지금부터해서 맞힐 ㅠㅠㅠㅠㅠㅠ뉴런이나 드리블같은거 들으면 좀 할만해질까요..?\r\n\r\n아님 확통은 지금부터할만할까여.. 6평 엄청 쉬운거같긴한데 29번까진 풀었어요..',0,5,'2022-06-30 10:57:54'),(45,50,0,0,'문제풀이','이 값을 보고 저기 수식에 값을 어떻게 넣어야할지 알려주실 분 계실까요,,,,?',0,2,'2022-06-30 10:58:21'),(46,50,0,0,'상담','곧 9모가 다가오는데 \r\n모교에서 보거든요 그냥 보지 말까요?<br>\r\n저도 제가 도망치는 거 아는데요 선생님께서 기대하시고 있으셔서 좀 부담스러워요 그리고 점수가 잘 안 나올 것 같아요 지금까지 공부 했는데 점수가 안 나와버린다면 ... ㅠㅡ<br>\r\n저도 제가 너무 한심하네요 요즘 그 생각만 하면 너무 스트레스를 받아서요 주변에 재수한다고 좋은 학교 가겠네 라고 말하시고 ㅠㅜㅠ 9모 점수가 너무 무서워요',0,8,'2022-06-30 11:11:01'),(47,50,0,1,'상담입니당','하 미적 삼도극같은거는 풀리기는 하는데 너무 오래걸려요…오늘 한 6문제 푸는데 몇시간 걸릴 정도로 … 합성함수는 손도 못대구용 … ㄹㅇ 확통 런이 답인가요…\r\n또 미적 조금이라도 한거 생각하면 아쉽긴 한데 삼도극이나 28 30 같은거 시험장 압박때문ㅇ 계산도 잘 못할거같고 ㅠ 근데 확통도 마찬가지일거같고 ㅠ\r\n걍 남은시간 열심히하는거밖에 답 없는거같긴한데 ㄹㅇ 어카죵…',0,8,'2022-06-30 11:13:41'),(48,16,0,1,'수시전략','제가 앞으로 수시전략을 어떻게 짜야할지 공부습관 등등 관련해서 상담 같은걸 받고 싶은데 그런거 해주는 거 없나요?? 입시 컨설팅 카은 유명하고 좋은거 추천해주세요.',0,17,'2022-06-30 13:46:44'),(49,16,0,0,'질문있습니다	','안녕하세욧',0,7,'2022-06-30 21:13:28'),(50,16,0,1,'ㄷㅎㄱㄷㄱㅎ','ㄴㅍㄴㅇㅍㄴㅇㅍ',0,9,'2022-06-30 21:28:04'),(51,16,0,2,'wefweffwfwefwe','ergergergeergr',0,17,'2022-07-01 11:58:04'),(52,18,0,1,'fefefefrrrhhh','efefefefrrhhhh',0,19,'2022-07-19 06:11:36'),(65,18,1,0,'테스트 게시물 입니다.','안녕하세요~\n\n김지훈 입니다.',0,4,'2022-07-21 19:49:58'),(66,16,0,0,'테스트 게시물 입니다.','안녕하세요 테스트 진행 해주세요.\n\n\n- 김지훈',0,41,'2022-07-21 19:53:17'),(67,16,0,0,'858751111','7857858',0,22,'2022-07-27 04:00:07'),(68,17,0,0,'test page','ggegeg',0,23,'2022-07-28 18:00:22'),(73,61,1,0,'선생님 게시판이군요','안녕하세요`~ㄴㅇㄴㅇㄹㄴㅇㄹ',0,1,'2023-01-14 18:56:58'),(74,62,0,2,'고민입니다...','저는 공부할 수 있는 환경이 아닙니다.. 도와주세요',0,2,'2023-01-14 19:17:16');
/*!40000 ALTER TABLE `nboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myclassuserlist`
--

DROP TABLE IF EXISTS `myclassuserlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `myclassuserlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '방고유번호',
  `uid` int DEFAULT NULL COMMENT '유저고유번호',
  `type` int DEFAULT NULL COMMENT '1. 방장, 0. 참여자',
  `invitechk` int DEFAULT NULL COMMENT '1. 초대됨, 2. 참여완료, 3. 거절됨',
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='내과외 유저 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myclassuserlist`
--

LOCK TABLES `myclassuserlist` WRITE;
/*!40000 ALTER TABLE `myclassuserlist` DISABLE KEYS */;
INSERT INTO `myclassuserlist` VALUES (431,'126',18,1,2,'2022-08-18 01:40:56'),(432,'126',17,0,2,'2022-08-18 01:40:56'),(433,'126',35,0,2,'2022-08-18 01:40:56'),(434,'126',31,0,2,'2022-08-18 01:40:56'),(435,'126',33,0,2,'2022-08-18 01:40:56'),(436,'127',20,1,2,'2022-09-01 19:41:30'),(437,'127',17,0,2,'2022-09-01 19:41:30'),(438,'127',35,0,2,'2022-09-01 19:41:30'),(439,'128',18,1,2,'2022-09-02 07:37:52'),(441,'128',17,0,2,'2022-09-02 07:37:52'),(442,'128',19,0,2,'2022-09-02 07:37:52'),(443,'128',21,0,2,'2022-09-02 07:37:52'),(444,'128',35,0,2,'2022-12-27 11:45:40'),(448,'130',61,1,2,'2023-01-14 19:34:29'),(449,'130',62,0,2,'2023-01-14 19:34:29'),(450,'130',35,0,2,'2023-01-14 19:34:29'),(451,'130',21,0,2,'2023-01-14 19:34:29'),(452,'130',17,0,2,'2023-01-14 19:34:29');
/*!40000 ALTER TABLE `myclassuserlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myclassroomlistset`
--

DROP TABLE IF EXISTS `myclassroomlistset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `myclassroomlistset` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '방 고유번호',
  `uid` int DEFAULT NULL COMMENT '유저고유번호',
  `backcolor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '백그라운드 색',
  `basicuri` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='내과외 룸의 개인 세팅';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myclassroomlistset`
--

LOCK TABLES `myclassroomlistset` WRITE;
/*!40000 ALTER TABLE `myclassroomlistset` DISABLE KEYS */;
/*!40000 ALTER TABLE `myclassroomlistset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myclassroomlist`
--

DROP TABLE IF EXISTS `myclassroomlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `myclassroomlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `roomname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '방 이름',
  `maxnum` int DEFAULT NULL COMMENT '최대 인원',
  `payment` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='내과외 룸 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myclassroomlist`
--

LOCK TABLES `myclassroomlist` WRITE;
/*!40000 ALTER TABLE `myclassroomlist` DISABLE KEYS */;
INSERT INTO `myclassroomlist` VALUES (126,'사회',5,1,'2022-08-18 01:40:56'),(127,'영어1등급',4,1,'2022-09-01 19:41:30'),(128,'수학1등급',5,1,'2022-09-02 07:37:52'),(130,'팀노바교육!!!',5,75,'2023-01-14 19:34:29');
/*!40000 ALTER TABLE `myclassroomlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myclasschatreadchklist`
--

DROP TABLE IF EXISTS `myclasschatreadchklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `myclasschatreadchklist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `chatidx` int DEFAULT NULL,
  `rid` double DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `readchk` int DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1080 DEFAULT CHARSET=utf8mb3 COMMENT='나의 수업 채팅 읽음 체크 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myclasschatreadchklist`
--

LOCK TABLES `myclasschatreadchklist` WRITE;
/*!40000 ALTER TABLE `myclasschatreadchklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `myclasschatreadchklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myclasschatlist`
--

DROP TABLE IF EXISTS `myclasschatlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `myclasschatlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `type` int DEFAULT NULL COMMENT '0. 일반, 1. 공지, 2. 질문',
  `message` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imgchk` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1360 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='나의 과외 채팅 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myclasschatlist`
--

LOCK TABLES `myclasschatlist` WRITE;
/*!40000 ALTER TABLE `myclasschatlist` DISABLE KEYS */;
INSERT INTO `myclasschatlist` VALUES (1300,126,18,0,'ffwef',0,'2022-08-18 01:40:58'),(1304,127,20,0,'hi',0,'2022-09-01 19:41:37'),(1305,128,18,0,'gg',0,'2022-09-02 07:37:55'),(1306,126,18,0,'eeee',0,'2022-09-03 00:16:19'),(1307,126,17,0,'123',0,'2022-10-13 06:20:20'),(1308,126,18,0,'hh',0,'2022-11-03 07:36:49'),(1309,126,18,0,'11',0,'2022-11-03 07:41:11'),(1310,126,18,0,'fe',0,'2022-11-29 05:20:58'),(1311,126,18,0,'fe',0,'2022-11-29 05:26:20'),(1312,126,18,0,'111',0,'2022-11-29 05:26:24'),(1313,126,18,0,'5555',0,'2022-11-29 20:57:22'),(1314,126,18,0,'22',0,'2022-11-29 21:03:42'),(1315,126,18,0,'8888',0,'2022-11-29 23:18:43'),(1316,126,18,0,'99',0,'2022-11-29 23:19:15'),(1317,128,19,0,'34',0,'2022-11-29 23:26:45'),(1318,128,19,0,'f11',0,'2022-11-29 23:27:40'),(1319,128,19,0,'333',0,'2022-11-29 23:32:21'),(1320,128,17,0,'55',0,'2022-12-19 08:14:01'),(1321,128,17,0,'tt',0,'2022-12-19 08:14:02'),(1322,128,19,0,'22',0,'2022-12-19 08:14:05'),(1323,128,19,0,'234',0,'2022-12-19 08:14:07'),(1324,128,19,0,'ht',0,'2022-12-19 08:14:14'),(1325,128,19,0,'123',0,'2022-12-19 08:15:02'),(1326,128,35,1,'nava19님이 강제퇴장되었습니다. ',0,'2022-12-29 04:50:55'),(1327,128,18,0,'7777',0,'2022-12-29 04:51:11'),(1328,128,35,1,'nava19님이 초대되었습니다. ',0,'2022-12-27 11:45:40'),(1332,129,20,1,'nava4님이 방을 나갔습니다.',0,'2022-12-27 12:06:29'),(1333,128,19,0,'eeee',0,'2023-01-03 04:17:50'),(1334,128,19,0,'gggg',0,'2023-01-03 04:17:53'),(1335,128,19,0,'123',0,'2023-01-03 04:17:58'),(1336,128,18,0,'123',0,'2023-01-03 04:18:36'),(1337,128,18,0,'1111',0,'2023-01-03 04:21:06'),(1338,128,18,0,'2222',0,'2023-01-03 04:21:10'),(1339,128,18,0,'3333',0,'2023-01-03 04:21:12'),(1340,128,18,0,'3',0,'2023-01-08 14:18:26'),(1341,128,18,0,'5',0,'2023-01-08 14:18:30'),(1342,128,18,0,'44',0,'2023-01-08 14:20:26'),(1343,128,18,0,'5',0,'2023-01-08 14:20:28'),(1344,128,18,0,'6',0,'2023-01-08 14:20:30'),(1345,128,18,0,'54',0,'2023-01-08 14:23:24'),(1346,128,18,0,'76',0,'2023-01-08 14:23:27'),(1347,130,61,0,'안녕하세요 여러분 팀노바 비대면 수업입니다~~',0,'2023-01-14 19:34:49'),(1348,130,61,0,'/image/myclass/photo0_73339400.jpg',1,'2023-01-14 19:34:55'),(1349,130,61,0,'환영합니다~~~~~~!!!',0,'2023-01-14 19:35:03'),(1350,130,62,0,'안녕하세요 팀장님 저는 8기 입니다',0,'2023-01-14 19:55:11'),(1351,130,62,0,'8기 humphrey집니다!',0,'2023-01-14 19:55:27'),(1352,130,35,0,'hi im rabbit!!',0,'2023-01-15 12:32:38'),(1353,130,35,0,'111',0,'2023-01-15 12:32:40'),(1354,130,35,0,'222',0,'2023-01-15 12:32:41'),(1355,130,62,0,'/image/myclass/photo0_65416400.jpg',1,'2023-01-14 19:55:54'),(1356,130,62,0,'제 사진입니다~~',0,'2023-01-14 19:55:59'),(1357,130,62,0,'수업 언제 하나요?',0,'2023-01-14 19:56:10'),(1358,130,62,0,'몇시 시작이죠?',0,'2023-01-14 19:56:15'),(1359,130,62,0,'팀장님 수업 시작해주세요~~',0,'2023-01-14 19:56:38');
/*!40000 ALTER TABLE `myclasschatlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mentoringcategorey`
--

DROP TABLE IF EXISTS `mentoringcategorey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mentoringcategorey` (
  `idx` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mentoringcategorey`
--

LOCK TABLES `mentoringcategorey` WRITE;
/*!40000 ALTER TABLE `mentoringcategorey` DISABLE KEYS */;
INSERT INTO `mentoringcategorey` VALUES (1,'공부상담'),(2,'문제풀이'),(3,'고민상담'),(4,'입시질문');
/*!40000 ALTER TABLE `mentoringcategorey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likeuserlist`
--

DROP TABLE IF EXISTS `likeuserlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likeuserlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `giveuid` int DEFAULT NULL,
  `getuid` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likeuserlist`
--

LOCK TABLES `likeuserlist` WRITE;
/*!40000 ALTER TABLE `likeuserlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `likeuserlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likenboardlist`
--

DROP TABLE IF EXISTS `likenboardlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likenboardlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `giveuid` int DEFAULT NULL,
  `getnid` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likenboardlist`
--

LOCK TABLES `likenboardlist` WRITE;
/*!40000 ALTER TABLE `likenboardlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `likenboardlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likecommentnestedlist`
--

DROP TABLE IF EXISTS `likecommentnestedlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likecommentnestedlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `giveuid` int DEFAULT NULL,
  `getcnid` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='댓글 좋아요 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likecommentnestedlist`
--

LOCK TABLES `likecommentnestedlist` WRITE;
/*!40000 ALTER TABLE `likecommentnestedlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `likecommentnestedlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likecommentlist`
--

DROP TABLE IF EXISTS `likecommentlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likecommentlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `giveuid` int DEFAULT NULL,
  `getcid` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='댓글 좋아요 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likecommentlist`
--

LOCK TABLES `likecommentlist` WRITE;
/*!40000 ALTER TABLE `likecommentlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `likecommentlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferencevodlist`
--

DROP TABLE IF EXISTS `conferencevodlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conferencevodlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `rid` int DEFAULT NULL,
  `basicuri` varchar(100) DEFAULT NULL,
  `src` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COMMENT='화상회의 vod list';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferencevodlist`
--

LOCK TABLES `conferencevodlist` WRITE;
/*!40000 ALTER TABLE `conferencevodlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `conferencevodlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferencejoinuserlist`
--

DROP TABLE IF EXISTS `conferencejoinuserlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conferencejoinuserlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `rid` int DEFAULT NULL,
  `rtcuid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2466 DEFAULT CHARSET=utf8mb3 COMMENT='화상회의 참여자 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferencejoinuserlist`
--

LOCK TABLES `conferencejoinuserlist` WRITE;
/*!40000 ALTER TABLE `conferencejoinuserlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `conferencejoinuserlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferencedocumentlist`
--

DROP TABLE IF EXISTS `conferencedocumentlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conferencedocumentlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `rid` int DEFAULT NULL,
  `docutype` int DEFAULT NULL COMMENT '1. 문서, 2. 이미지, 3. pdf파일',
  `basicuri` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2682 DEFAULT CHARSET=utf8mb3 COMMENT='회의 문서 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferencedocumentlist`
--

LOCK TABLES `conferencedocumentlist` WRITE;
/*!40000 ALTER TABLE `conferencedocumentlist` DISABLE KEYS */;
INSERT INTO `conferencedocumentlist` VALUES (1257,17,126,1,'','','2022-10-13 06:27:46'),(1268,18,126,1,'','','2022-11-03 07:58:03'),(1269,18,126,1,'','','2022-11-03 07:58:04'),(1510,17,129,1,'','','2022-12-27 12:05:54'),(2603,20,127,1,'','','2023-01-12 12:19:57'),(2627,18,128,1,'','','2023-01-11 12:37:41'),(2628,18,128,1,'','','2023-01-11 12:38:32'),(2629,18,128,1,'','','2023-01-11 12:38:36'),(2630,18,128,1,'','','2023-01-11 12:38:50'),(2631,18,128,2,'/image/conferencedocumentimg/','documentimg0_9760500.jpg','2023-01-11 12:39:24'),(2632,18,128,2,'/image/conferencedocumentimg/','documentimg1_10559000.jpg','2023-01-11 12:39:24'),(2633,18,128,2,'/image/conferencedocumentimg/','documentimg2_11226800.jpg','2023-01-11 12:39:24'),(2634,18,128,2,'/image/conferencedocumentimg/','documentimg3_11827700.jpg','2023-01-11 12:39:24'),(2635,18,128,2,'/image/conferencedocumentimg/','documentimg4_12484800.jpg','2023-01-11 12:39:24'),(2636,18,128,2,'/image/conferencedocumentimg/','documentimg5_12967301.jpg','2023-01-11 12:39:24'),(2637,18,128,2,'/image/conferencedocumentimg/','documentimg6_13462100.jpg','2023-01-11 12:39:24'),(2638,18,128,2,'/image/conferencedocumentimg/','documentimg7_14211400.jpg','2023-01-11 12:39:24'),(2639,18,128,2,'/image/conferencedocumentimg/','documentimg8_14779100.jpg','2023-01-11 12:39:24'),(2640,18,128,2,'/image/conferencedocumentimg/','documentimg0_82785600.jpg','2023-01-11 12:40:16'),(2641,18,128,2,'/image/conferencedocumentimg/','documentimg1_83466100.jpg','2023-01-11 12:40:16'),(2642,18,128,2,'/image/conferencedocumentimg/','documentimg2_84084000.jpg','2023-01-11 12:40:16'),(2643,18,128,2,'/image/conferencedocumentimg/','documentimg3_84694300.jpg','2023-01-11 12:40:16'),(2644,18,128,2,'/image/conferencedocumentimg/','documentimg4_85416300.jpg','2023-01-11 12:40:16'),(2645,18,128,2,'/image/conferencedocumentimg/','documentimg5_85873400.jpg','2023-01-11 12:40:16'),(2646,18,128,2,'/image/conferencedocumentimg/','documentimg6_86467600.jpg','2023-01-11 12:40:16'),(2647,18,128,2,'/image/conferencedocumentimg/','documentimg7_87058800.jpg','2023-01-11 12:40:16'),(2648,18,128,2,'/image/conferencedocumentimg/','documentimg8_87750900.jpg','2023-01-11 12:40:16'),(2649,18,128,2,'/image/conferencedocumentimg/','documentimg9_88432600.jpg','2023-01-11 12:40:16'),(2650,21,128,1,'','','2023-01-12 06:48:10'),(2651,20,127,1,'','','2023-01-12 12:30:57'),(2652,20,127,1,'','','2023-01-12 12:31:05'),(2653,20,127,1,'','','2023-01-12 12:31:06'),(2654,18,128,2,'/image/conferencedocumentimg/','documentimg0_72883100.jpg','2023-01-11 12:42:20'),(2655,18,128,2,'/image/conferencedocumentimg/','documentimg0_2316200.jpg','2023-01-11 12:42:44'),(2656,18,128,2,'/image/conferencedocumentimg/','documentimg0_70017800.jpg','2023-01-11 12:42:59'),(2657,18,128,2,'/image/conferencedocumentimg/','documentimg1_70799800.jpg','2023-01-11 12:42:59'),(2658,18,128,2,'/image/conferencedocumentimg/','documentimg2_71370900.jpg','2023-01-11 12:42:59'),(2659,18,128,2,'/image/conferencedocumentimg/','documentimg3_72082700.jpg','2023-01-11 12:42:59'),(2660,18,128,2,'/image/conferencedocumentimg/','documentimg4_72797700.jpg','2023-01-11 12:42:59'),(2661,18,128,2,'/image/conferencedocumentimg/','documentimg5_73343300.jpg','2023-01-11 12:42:59'),(2662,18,128,2,'/image/conferencedocumentimg/','documentimg6_73977900.jpg','2023-01-11 12:42:59'),(2663,18,128,2,'/image/conferencedocumentimg/','documentimg7_74559100.jpg','2023-01-11 12:42:59'),(2664,18,128,2,'/image/conferencedocumentimg/','documentimg8_75147700.jpg','2023-01-11 12:42:59'),(2665,18,128,2,'/image/conferencedocumentimg/','documentimg9_75745600.jpg','2023-01-11 12:42:59'),(2681,61,130,1,'','','2023-01-14 19:49:55');
/*!40000 ALTER TABLE `conferencedocumentlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentnestedimg`
--

DROP TABLE IF EXISTS `commentnestedimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentnestedimg` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT NULL,
  `cnid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `src` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentnestedimg`
--

LOCK TABLES `commentnestedimg` WRITE;
/*!40000 ALTER TABLE `commentnestedimg` DISABLE KEYS */;
INSERT INTO `commentnestedimg` VALUES (28,150,132,61,'/image/commentnested/','photo0_70956900.jpg','2023-01-14 18:48:51'),(29,150,132,61,'/image/commentnested/','photo1_71566000.jpg','2023-01-14 18:48:51'),(31,160,137,61,'/image/commentnested/','photo0_36540200.jpg','2023-01-14 18:59:06'),(32,160,137,61,'/image/commentnested/','photo1_37200400.jpg','2023-01-14 18:59:06'),(33,160,137,61,'/image/commentnested/','photo2_37770500.jpg','2023-01-14 18:59:06');
/*!40000 ALTER TABLE `commentnestedimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentnested`
--

DROP TABLE IF EXISTS `commentnested`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentnested` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `nid` int DEFAULT NULL,
  `cid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `likenum` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentnested`
--

LOCK TABLES `commentnested` WRITE;
/*!40000 ALTER TABLE `commentnested` DISABLE KEYS */;
INSERT INTO `commentnested` VALUES (126,44,142,61,'','','잘하고 계십니다.',0,'2023-01-14 18:45:39'),(127,44,142,62,'','','감사합니다.',0,'2023-01-14 19:05:33'),(128,44,142,61,'','','ㄷㅈㄹㅈㄷㄹㅈㄷㄹㄹㄷㅈ',0,'2023-01-14 18:46:40'),(132,44,150,61,'','','다시 생성되었따!!!',0,'2023-01-14 18:48:51'),(133,74,160,62,'','','제가 이겨낼 수 있을까요? ㅠ',0,'2023-01-14 19:17:50'),(134,74,160,62,'','','저는 희망이 없습니다',0,'2023-01-14 19:17:56'),(135,74,160,61,'','','좌절하지마십시오',0,'2023-01-14 18:58:20'),(137,74,160,61,'','','하하',0,'2023-01-14 18:59:06');
/*!40000 ALTER TABLE `commentnested` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentimg`
--

DROP TABLE IF EXISTS `commentimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentimg` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `src` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentimg`
--

LOCK TABLES `commentimg` WRITE;
/*!40000 ALTER TABLE `commentimg` DISABLE KEYS */;
INSERT INTO `commentimg` VALUES (52,149,61,'/image/comment/','photo0_72937200.jpg','2023-01-14 18:46:55'),(53,149,61,'/image/comment/','photo1_73774300.jpg','2023-01-14 18:46:55'),(54,150,62,'/image/comment/','photo0_73488800.jpg','2023-01-14 19:06:56'),(55,150,62,'/image/comment/','photo1_74036100.jpg','2023-01-14 19:06:56');
/*!40000 ALTER TABLE `commentimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `nid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `basicuri` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  `likenum` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (141,44,61,'','','할수 있습니다!!!',0,'2023-01-14 18:45:04'),(142,44,62,'','','응원합니다~~~',0,'2023-01-14 19:05:03'),(143,44,62,'','','하하하핳',0,'2023-01-14 19:06:02'),(144,44,62,'','','ㅎㅎ햐허ㅐ해',0,'2023-01-14 19:06:05'),(145,44,62,'','','히히힣ㅎ',0,'2023-01-14 19:06:08'),(146,44,61,'','','ㅎㅎㅎㅎㅎ',0,'2023-01-14 18:46:29'),(147,44,61,'','','ㄹㅈㄷㄹㅈㄷㄹㅈㄹㄷㅈㄹㄷ',0,'2023-01-14 18:46:34'),(148,44,61,'','','ㄷㅂㅈㄷㅂㅈㄷ',0,'2023-01-14 18:46:36'),(149,44,61,'','','ㄹㄷㅈㄹㅈㄷㄹㅈㄷㄹㅈㄷㅈㄷ',0,'2023-01-14 18:46:55'),(150,44,62,'','','123123123',0,'2023-01-14 19:06:56'),(160,74,61,'','','학생이 그런환격이군요 이겨내야합니다',0,'2023-01-14 18:57:47'),(164,74,62,'','','122',0,'2023-01-14 19:19:28'),(165,74,62,'','','333',0,'2023-01-14 19:19:29'),(167,24,61,'','','ㅎㅎㅎ',0,'2023-01-14 19:03:24'),(168,18,61,'','','3333',0,'2023-01-14 19:03:29'),(169,16,61,'','','22222',0,'2023-01-14 19:03:33'),(170,35,62,'','','4444',0,'2023-01-14 19:23:54');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classrequestroomlist`
--

DROP TABLE IF EXISTS `classrequestroomlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classrequestroomlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `pid1` int DEFAULT NULL COMMENT '방 만든사람',
  `pid1out` int DEFAULT NULL,
  `pid2` int DEFAULT NULL COMMENT '방 요청받은 사람',
  `pid2out` int DEFAULT NULL,
  `participantnum` int DEFAULT NULL COMMENT '소켓연결 인원',
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='과외 문의 채팅 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classrequestroomlist`
--

LOCK TABLES `classrequestroomlist` WRITE;
/*!40000 ALTER TABLE `classrequestroomlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `classrequestroomlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classrequestchatlist`
--

DROP TABLE IF EXISTS `classrequestchatlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classrequestchatlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `rid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `type` int DEFAULT NULL COMMENT '0. 일반, 1. 공지, 2. 질문',
  `message` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imgchk` int DEFAULT NULL,
  `rid_myclass` int DEFAULT NULL,
  `availablilty` int DEFAULT NULL COMMENT '유효성 / 1. 사용, 2. 예, 3. 아니요',
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='채팅 메세지 박스';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classrequestchatlist`
--

LOCK TABLES `classrequestchatlist` WRITE;
/*!40000 ALTER TABLE `classrequestchatlist` DISABLE KEYS */;
INSERT INTO `classrequestchatlist` VALUES (1168,210,61,0,'123123123',0,0,1,'2023-01-14 19:26:29'),(1169,211,61,0,'333333',0,0,1,'2023-01-14 19:26:38'),(1170,211,35,0,'22222',0,0,1,'2023-01-15 12:23:35'),(1171,211,35,0,'333',0,0,1,'2023-01-15 12:23:36'),(1172,211,35,0,'44',0,0,1,'2023-01-15 12:23:37'),(1173,211,35,0,'55',0,0,1,'2023-01-15 12:23:37'),(1174,211,35,0,'66',0,0,1,'2023-01-15 12:23:38'),(1175,210,62,0,'ㄷㄷ',0,0,1,'2023-01-14 19:46:49'),(1176,210,62,0,'ㄱㄱ',0,0,1,'2023-01-14 19:46:50'),(1177,210,62,0,'ㅅㅅ',0,0,1,'2023-01-14 19:46:52'),(1178,210,62,0,'ㅈㅈ',0,0,1,'2023-01-14 19:46:52'),(1179,210,62,0,'ㅂㅂ',0,0,1,'2023-01-14 19:46:53'),(1180,210,61,0,'12312',0,0,1,'2023-01-14 19:27:13'),(1181,210,61,0,'2324334',0,0,1,'2023-01-14 19:27:14'),(1182,210,61,0,'434343',0,0,1,'2023-01-14 19:27:15'),(1183,211,61,0,'ㄱㄱㄱ',0,0,1,'2023-01-14 19:27:19'),(1184,211,61,0,'ㄷㄷㄷ',0,0,1,'2023-01-14 19:27:20'),(1185,211,61,0,'ㅈㅈㅈ',0,0,1,'2023-01-14 19:27:21'),(1186,211,61,0,'ㅂㅂㅂ',0,0,1,'2023-01-14 19:27:23'),(1187,210,61,0,'2222',0,0,1,'2023-01-14 19:27:34'),(1188,210,61,0,'324234',0,0,1,'2023-01-14 19:27:38'),(1189,210,61,0,'555',0,0,1,'2023-01-14 19:27:40'),(1190,210,61,0,'66',0,0,1,'2023-01-14 19:27:41'),(1191,210,61,0,'77',0,0,1,'2023-01-14 19:27:42'),(1192,210,62,0,'333',0,0,1,'2023-01-14 19:47:35'),(1193,210,62,0,'44',0,0,1,'2023-01-14 19:47:36'),(1194,210,62,0,'55',0,0,1,'2023-01-14 19:47:36'),(1195,210,62,0,'6546546',0,0,1,'2023-01-14 19:47:37'),(1196,210,61,0,'ㅛ56ㅛ',0,0,1,'2023-01-14 19:27:59'),(1197,211,61,0,'11',0,0,1,'2023-01-14 19:28:11'),(1198,211,61,0,'22',0,0,1,'2023-01-14 19:28:12'),(1199,211,61,0,'33',0,0,1,'2023-01-14 19:28:15'),(1200,211,61,0,'44',0,0,1,'2023-01-14 19:28:16'),(1201,211,35,0,'333',0,0,1,'2023-01-15 12:25:03'),(1202,211,35,0,'555',0,0,1,'2023-01-15 12:25:03'),(1203,210,62,0,'/image/requestchat/photo0_365900.jpg',1,0,1,'2023-01-14 19:48:54'),(1204,210,62,0,'/image/requestchat/photo0_6796800.jpg',1,0,1,'2023-01-14 19:48:58'),(1205,210,61,0,'52542',0,0,1,'2023-01-14 19:29:18'),(1206,210,61,0,'4524',0,0,1,'2023-01-14 19:29:18'),(1207,211,61,0,'111',0,0,1,'2023-01-14 19:29:31'),(1208,211,61,0,'414141',0,0,1,'2023-01-14 19:29:33'),(1209,210,61,0,'222',0,0,1,'2023-01-14 19:29:40');
/*!40000 ALTER TABLE `classrequestchatlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatreadchklist`
--

DROP TABLE IF EXISTS `chatreadchklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chatreadchklist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `chatidx` int DEFAULT NULL,
  `rid` double DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `readchk` int DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=825 DEFAULT CHARSET=utf8mb3 COMMENT='채팅 읽음 체크 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatreadchklist`
--

LOCK TABLES `chatreadchklist` WRITE;
/*!40000 ALTER TABLE `chatreadchklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `chatreadchklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `characterlist`
--

DROP TABLE IF EXISTS `characterlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `characterlist` (
  `idx` int NOT NULL,
  `charactername` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characterlist`
--

LOCK TABLES `characterlist` WRITE;
/*!40000 ALTER TABLE `characterlist` DISABLE KEYS */;
INSERT INTO `characterlist` VALUES (1,'지적인'),(2,'차분한'),(3,'유머있는'),(4,'낙천적인'),(5,'내향적인'),(6,'외향적인'),(7,'감성적인'),(8,'상냥한'),(9,'귀여운'),(10,'열정적인'),(11,'듬직한'),(12,'개성있는');
/*!40000 ALTER TABLE `characterlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alertlist`
--

DROP TABLE IF EXISTS `alertlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alertlist` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `nid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `alertuid` int DEFAULT NULL,
  `alertdocu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `click` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb3 COMMENT='알림 리스트';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alertlist`
--

LOCK TABLES `alertlist` WRITE;
/*!40000 ALTER TABLE `alertlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `alertlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03  6:12:12
