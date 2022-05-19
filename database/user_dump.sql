-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: user
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `freunde`
--


DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `punkte` int(11) NOT NULL DEFAULT 0,
  `benutzer_typ` varchar(11) COLLATE utf8_german2_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Laurenz','lonzo69420@studzhelp.at','',3,850,NULL,1),(5,'gast','gast@studyhelp.at','d4061b1486fe2da19dd578e8d970f7eb',0,0,NULL,1),(6,'admin','admin@studyhelp.at','21232f297a57a5a743894a0e4a801fc3',0,0,'admin',1);
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

-- Dump completed on 2022-05-19 10:06:55


DROP TABLE IF EXISTS `freunde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freunde` (
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  `friends_since` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id_1`,`user_id_2`),
  KEY `user_id_2` (`user_id_2`),
  CONSTRAINT `freunde_ibfk_1` FOREIGN KEY (`user_id_1`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `freunde_ibfk_2` FOREIGN KEY (`user_id_2`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freunde`
--

LOCK TABLES `freunde` WRITE;
/*!40000 ALTER TABLE `freunde` DISABLE KEYS */;
/*!40000 ALTER TABLE `freunde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gameresults`
--

DROP TABLE IF EXISTS `gameresults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gameresults` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) NOT NULL,
  `punkte` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`game_id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `gameresults_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameresults`
--

LOCK TABLES `gameresults` WRITE;
/*!40000 ALTER TABLE `gameresults` DISABLE KEYS */;
INSERT INTO `gameresults` VALUES (7,2,1300,'2022-05-18 19:39:17'),(8,2,200,'2022-05-18 19:39:17'),(9,2,300,'2022-05-18 19:39:17'),(10,2,200,'2022-05-18 19:39:17'),(11,2,100,'2022-05-18 19:39:17'),(12,2,200,'2022-05-18 19:39:17'),(13,2,300,'2022-05-18 19:39:17'),(14,2,200,'2022-05-18 19:39:17'),(15,2,100,'2022-05-18 19:39:17');
/*!40000 ALTER TABLE `gameresults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--
<<<<<<< HEAD
=======

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `punkte` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Raoul','Raoul.Wograndl@email.at','81dc9bdb52d04dc20036dbd8313ed055 ',0,350),(2,'Paul','Paul.Paul@Paul','81dc9bdb52d04dc20036dbd8313ed055',3,850),(3,'test','test@test','098f6bcd4621d373cade4e832627b4f6',0,0);
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

-- Dump completed on 2022-05-19 10:46:55
>>>>>>> 08a6b60b6ac62fb43388626d6216af79a7db31e3
