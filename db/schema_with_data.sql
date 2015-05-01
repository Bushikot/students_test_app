-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: students_test
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
-- Table structure for table `characteristic`
--

DROP TABLE IF EXISTS `characteristic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `characteristic` (
  `studentid` bigint(20) unsigned NOT NULL,
  `characteristic` text NOT NULL,
  PRIMARY KEY (`studentid`),
  CONSTRAINT `characteristic_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characteristic`
--

LOCK TABLES `characteristic` WRITE;
/*!40000 ALTER TABLE `characteristic` DISABLE KEYS */;
INSERT INTO `characteristic` VALUES (14,'c2656f7b033abad851327d2731ea1bc1'),(15,'6b0d64e66af0a88529aa40cea648bc12'),(16,'c37bf6da4ece831416e27c3e1aa648b6'),(17,'32eaf957c88ed672d40a89c6df43a78f'),(18,'c4b8aa1ba5bef6e21f0b4d9fae5db18a'),(19,'763a07a116c9615cffb71a0e34c5b906'),(20,'22e29d36c8afabf7a00911fe037d7138'),(21,'5a2a4d01faa969eaf1b8edd3325076dc'),(22,'5b54cc6bbda944b5c6c6ed77820a0914'),(23,'ff22ffd899aa886db2ccfda3f35050da'),(24,'d3a092ecde9f3315c4c26db717d8b449'),(25,'e3704d25d55d6d2f0794ebab9224ce00'),(26,'95e0df5c0a9286ee0654622ebc3d4c6b'),(27,'982d4a96e49b4f15f96071eef26b26dd'),(28,'563d20849fdc893fdc2b57f5c7506b52'),(29,'ac6f0b3dbb5c2794afb37bd7dc062ced');
/*!40000 ALTER TABLE `characteristic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mark` (
  `studentid` bigint(20) unsigned NOT NULL,
  `subjectid` bigint(20) unsigned NOT NULL,
  `mark` decimal(5,2) unsigned NOT NULL,
  PRIMARY KEY (`studentid`,`subjectid`),
  UNIQUE KEY `studentid` (`studentid`,`subjectid`),
  KEY `subjectid` (`subjectid`),
  CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mark`
--

LOCK TABLES `mark` WRITE;
/*!40000 ALTER TABLE `mark` DISABLE KEYS */;
INSERT INTO `mark` VALUES (14,1,96.00),(14,2,95.00),(14,3,75.00),(14,4,46.00),(14,5,30.00),(14,6,40.00),(14,7,20.00),(15,1,44.00),(15,2,73.00),(15,3,9.00),(15,4,84.00),(15,5,18.00),(15,6,65.00),(15,7,69.00),(16,1,27.00),(16,2,36.00),(16,3,70.00),(16,4,90.00),(16,5,5.00),(16,6,23.00),(16,7,36.00),(17,1,25.00),(17,2,5.00),(17,3,98.00),(17,4,98.00),(17,5,87.00),(17,6,99.00),(17,7,37.00),(18,1,92.00),(18,2,8.00),(18,3,73.00),(18,4,57.00),(18,5,90.00),(18,6,99.00),(18,7,62.00),(19,1,84.00),(19,2,41.00),(19,3,37.00),(19,4,39.00),(19,5,54.00),(19,6,93.00),(19,7,85.00),(20,1,7.00),(20,2,40.00),(20,3,61.00),(20,4,67.00),(20,5,47.00),(20,6,99.00),(20,7,28.00),(21,1,82.00),(21,2,19.00),(21,3,89.00),(21,4,16.00),(21,5,97.00),(21,6,82.00),(21,7,33.00),(22,1,37.00),(22,2,72.00),(22,3,34.00),(22,4,39.00),(22,5,100.00),(22,6,79.00),(22,7,100.00),(23,1,83.00),(23,2,70.00),(23,3,55.00),(23,4,90.00),(23,5,85.00),(23,6,85.00),(23,7,91.00),(24,1,95.00),(24,2,43.00),(24,3,72.00),(24,4,97.00),(24,5,3.00),(24,6,97.00),(24,7,36.00),(25,1,29.00),(25,2,2.00),(25,3,36.00),(25,4,47.00),(25,5,39.00),(25,6,98.00),(25,7,80.00),(26,1,32.00),(26,2,45.00),(26,3,4.00),(26,4,91.00),(26,5,91.00),(26,6,90.00),(26,7,72.00),(27,1,68.00),(27,2,81.00),(27,3,72.00),(27,4,95.00),(27,5,56.00),(27,6,62.00),(27,7,15.00),(28,1,26.00),(28,2,91.00),(28,3,6.00),(28,4,64.00),(28,5,22.00),(28,6,100.00),(28,7,94.00),(29,1,96.00),(29,2,87.00),(29,3,57.00),(29,4,49.00),(29,5,34.00),(29,6,60.00),(29,7,33.00);
/*!40000 ALTER TABLE `mark` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `calculate_gpa_after_insert` AFTER INSERT ON `mark`
 FOR EACH ROW BEGIN
	UPDATE student
    SET gpa = (
		SELECT SUM(mark)/COUNT(studentid) AS gpa 
		FROM mark
		WHERE studentid = NEW.studentid
    )
    WHERE studentid = NEW.studentid;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `calculate_gpa_after_update` AFTER UPDATE ON `mark`
 FOR EACH ROW BEGIN
	UPDATE student
    SET gpa = (
		SELECT SUM(mark)/COUNT(studentid) AS gpa 
		FROM mark
		WHERE studentid = NEW.studentid
    )
    WHERE studentid = NEW.studentid;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `studentid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipaddr` varchar(15) NOT NULL,
  `gpa` decimal(5,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`studentid`),
  UNIQUE KEY `studentid` (`studentid`),
  KEY `fname` (`fname`),
  KEY `gpa` (`gpa`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (14,'Максим','Логинов','2010-06-16','maksim@mail.ru','2015-04-30 22:37:09','10.0.2.2',57.43),(15,'Иван','Сусанин','1990-06-14','sussanin.on@mail.ru','2015-04-30 22:49:30','10.0.2.2',51.71),(16,'Дмитрий','Яковлев','1990-06-12','yakovlev@gmail.com','2015-04-30 22:49:56','10.0.2.2',41.00),(17,'Станислав','Кудрявцев','2002-03-06','kudri2002@bk.ru','2015-04-30 22:51:06','10.0.2.2',64.14),(18,'Антонина','Холмогорова','2002-01-14','holmogorova.a@rambler.ru','2015-04-30 22:51:39','10.0.2.2',68.71),(19,'Анна','Ахметшина','2001-07-18','annn56hahah@yandex.ru','2015-04-30 22:52:21','10.0.2.2',61.86),(20,'Оксана','Давыдова','1989-06-15','oksana.dav@ya.ru','2015-04-30 22:52:58','10.0.2.2',49.86),(21,'Алексей','Выстрелов','1989-06-16','vistrelov_na@mail.ru','2015-04-30 22:53:33','10.0.2.2',59.71),(22,'Фёдор','Богодухов','1987-06-17','fedor1987@gmail.com','2015-04-30 22:55:16','10.0.2.2',65.86),(23,'Василий','Стрельников','1989-10-18','ya@strelnikoff.ru','2015-04-30 22:56:00','10.0.2.2',79.86),(24,'Теофан','Великий','1989-10-19','great.teofan@mail.ru','2015-04-30 22:56:28','10.0.2.2',63.29),(25,'Анастасия','Трофимова','1985-08-30','trofimova-nata@bk.ru','2015-04-30 22:57:03','10.0.2.2',47.29),(26,'Тимофей','Маслёнов','1981-01-28','maslenov@timofey.tk','2015-05-01 09:52:55','10.0.2.2',60.71),(27,'Матвей','Остерников','2005-05-17','osternik.mat.way@yahoo.com','2015-05-01 12:04:23','10.0.2.2',64.14),(28,'Федос','Осипович','1909-06-16','fedos@osipovich.ru','2015-05-01 13:14:49','10.0.2.2',57.57),(29,'Максим','Терешков','2019-06-05','tereshkov@mail.ru','2015-05-01 15:30:27','10.0.2.2',59.43);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentmove`
--

DROP TABLE IF EXISTS `studentmove`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentmove` (
  `studentmoveid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studentid` bigint(20) unsigned NOT NULL,
  `termnumber` int(11) NOT NULL,
  `groupnumber` int(11) NOT NULL,
  `iscurrent` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`studentmoveid`),
  UNIQUE KEY `studentmoveid` (`studentmoveid`),
  KEY `studentid` (`studentid`),
  KEY `groupnumber` (`groupnumber`),
  KEY `termnumber` (`termnumber`),
  CONSTRAINT `studentmove_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentmove`
--

LOCK TABLES `studentmove` WRITE;
/*!40000 ALTER TABLE `studentmove` DISABLE KEYS */;
INSERT INTO `studentmove` VALUES (2,14,2,55,1),(3,15,597,65,1),(4,16,665,23,1),(5,17,994,65,1),(6,18,743,34,1),(7,19,123,45,1),(8,20,522,12,1),(9,21,522,1,1),(10,22,73,98,1),(11,23,15,12,1),(12,24,966,32,1),(13,25,576,23,1),(14,26,261,23,1),(15,27,582,43,1),(16,28,547,1,1),(17,29,2,55,1);
/*!40000 ALTER TABLE `studentmove` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `subjectid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`subjectid`),
  UNIQUE KEY `subjectid` (`subjectid`),
  UNIQUE KEY `subject` (`subject`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (2,'Информатика'),(4,'Литература'),(5,'Математика'),(3,'Рисование'),(1,'Русский язык'),(7,'Физика'),(6,'Химия');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-01 16:51:02
