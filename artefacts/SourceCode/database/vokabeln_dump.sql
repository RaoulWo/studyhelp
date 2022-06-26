-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: vokabeln
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
-- Table structure for table `deutsch_englisch`
--

DROP TABLE IF EXISTS `deutsch_englisch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deutsch_englisch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Deutsch` varchar(127) NOT NULL,
  `Englisch` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deutsch_englisch`
--

LOCK TABLES `deutsch_englisch` WRITE;
/*!40000 ALTER TABLE `deutsch_englisch` DISABLE KEYS */;
INSERT INTO `deutsch_englisch` VALUES (1,'Hallo','Hello'),(2,'Welt','World'),(3,'Hallo','Hello'),(4,'Welt','World'),(5,'Tasse ','cup'),(6,'Brille','glasses'),(7,'Lehrer','teacher'),(8,'Vorhang','curtain'),(9,'Ausbildung','apprenticeship'),(10,'Angestellter','employee'),(11,'Arbeiter','worker'),(12,'Arbeitgeber','employer'),(13,'Beruf (im Handwerk)','trade'),(14,'Beruf (meistens mit Studium)','profession'),(15,'Beruf allgemein','job'),(16,'Besch?ftigung (auch in Freizeit)','occupation'),(17,'eine feste Stelle haben','a regular job'),(18,'eine Firma leiten','to run a firm'),(19,'Er entschied sich f?r den Kellnerberuf.','He took a job as a waiter.'),(20,'Pendler','commuter'),(21,'Besch?ftigung (auch in Freizeit)','occupation'),(22,'Er entschied sich f?r den Kellnerberuf.','He took a job as a waiter.'),(23,'seinen Lebensunterhalt verdienen','to earn one\'s living'),(24,'Womit verdienst du deinen Lebensunterhalt?','What do you do for a living?'),(25,'Ausbildungskurs','training course'),(26,'Azubi, Lehrling','apprentice, trainee'),(27,'Bewerbung','application'),(28,'Bewerbungsformular','application form'),(29,'sich um eine Stelle bewerben','to apply for a job'),(30,'Facharbeiter','skilled worker'),(31,'freie Stelle','vacancy'),(32,'Lebenslauf','CV (curriculum vitae)'),(33,'Lehrstelle, Lehrzeit','apprenticeship'),(34,'Vorstellungsgespr?ch','job interview'),(35,'Arbeitslosenunters?tzung','unemployment benefit, dole money'),(36,'Arbeitslosigkeit','unemployment'),(37,'arbeitslos sein','to be unemployed'),(38,'','to be out of work'),(39,'jemanden k?ndigen','to give somebody notice'),(40,'jemanden rausschmei?en','to fire somebody'),(41,'K?ndigungsfrist','period of notice'),(42,'selbst k?ndigen','to hand in one\'s notice'),(43,'Gehalt','salary'),(44,'Gleitzeit','flexitime'),(45,'Lohn','wages'),(46,'eine Lohnerh?hung bekommen','to get a rise?'),(47,'Lohnforderung','wage demand, claim'),(48,'Lohnfortzahlung','continued payment of wages'),(49,'Lohngruppe','wage group'),(50,'Lohnk?rzung','wage cut'),(51,'Lohnzettel','pay slip'),(52,'in Schichten arbeiten','to work in shifts'),(53,'Teilzeit','a part-time job'),(54,'?berstunden machen','to work overtime'),(55,'Vollzeit','a full-time job');
/*!40000 ALTER TABLE `deutsch_englisch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deutsch_französisch`
--

DROP TABLE IF EXISTS `deutsch_französisch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deutsch_französisch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Deutsch` varchar(127) NOT NULL,
  `Französisch` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deutsch_französisch`
--

LOCK TABLES `deutsch_französisch` WRITE;
/*!40000 ALTER TABLE `deutsch_französisch` DISABLE KEYS */;
/*!40000 ALTER TABLE `deutsch_französisch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deutsch_russisch`
--

DROP TABLE IF EXISTS `deutsch_russisch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deutsch_russisch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Deutsch` varchar(127) NOT NULL,
  `Russisch` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deutsch_russisch`
--

LOCK TABLES `deutsch_russisch` WRITE;
/*!40000 ALTER TABLE `deutsch_russisch` DISABLE KEYS */;
/*!40000 ALTER TABLE `deutsch_russisch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deutsch_spanisch`
--

DROP TABLE IF EXISTS `deutsch_spanisch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deutsch_spanisch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Deutsch` varchar(127) NOT NULL,
  `Spanisch` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deutsch_spanisch`
--

LOCK TABLES `deutsch_spanisch` WRITE;
/*!40000 ALTER TABLE `deutsch_spanisch` DISABLE KEYS */;
/*!40000 ALTER TABLE `deutsch_spanisch` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-16  0:02:28
