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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03  6:04:10
