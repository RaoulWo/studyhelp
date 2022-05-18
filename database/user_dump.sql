-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: user
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameresults`
--

LOCK TABLES `gameresults` WRITE;
/*!40000 ALTER TABLE `gameresults` DISABLE KEYS */;
INSERT INTO `gameresults` VALUES (16,1,200,'2022-05-17 08:06:04'),(17,1,200,'2022-05-17 08:09:43'),(18,1,150,'2022-05-17 08:10:29'),(19,1,300,'2022-05-17 08:11:56'),(20,1,300,'2022-05-17 08:14:07'),(21,1,0,'2022-05-17 08:15:53'),(22,1,50,'2022-05-17 08:16:25'),(23,1,300,'2022-05-17 08:16:51'),(24,1,250,'2022-05-17 08:17:56'),(25,1,50,'2022-05-17 08:21:55'),(26,1,50,'2022-05-17 08:22:46'),(27,1,300,'2022-05-17 08:24:02'),(28,1,300,'2022-05-17 08:26:06'),(29,1,100,'2022-05-17 08:26:48'),(30,1,300,'2022-05-17 08:28:17'),(31,1,100,'2022-05-17 08:28:48'),(32,1,300,'2022-05-17 08:30:56'),(33,1,300,'2022-05-17 08:32:04'),(34,1,200,'2022-05-17 08:34:02'),(35,1,50,'2022-05-17 08:36:15'),(36,1,0,'2022-05-17 08:36:38'),(37,1,200,'2022-05-17 08:38:25'),(38,1,300,'2022-05-17 08:38:37'),(39,1,200,'2022-05-17 08:40:32'),(40,1,100,'2022-05-17 08:45:49'),(41,1,200,'2022-05-17 08:46:45'),(42,1,200,'2022-05-17 08:47:15'),(43,1,200,'2022-05-17 08:48:28'),(44,1,300,'2022-05-17 08:49:13');
/*!40000 ALTER TABLE `gameresults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Raoul','Raoul.Wograndl@email.at','81dc9bdb52d04dc20036dbd8313ed055 ',5,500),(2,'Paul','Paul.Paul@Paul','81dc9bdb52d04dc20036dbd8313ed055',3,850);
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

-- Dump completed on 2022-05-18 21:41:34
