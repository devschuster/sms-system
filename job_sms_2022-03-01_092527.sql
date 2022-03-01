-- MySQL dump 10.19  Distrib 10.3.32-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: job_sms
-- ------------------------------------------------------
-- Server version	10.3.32-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `jobName` varchar(255) DEFAULT NULL COMMENT 'Job Name',
  `jobDescription` varchar(255) DEFAULT NULL COMMENT 'Job Description',
  `creationDate` datetime DEFAULT NULL COMMENT 'Job Creation Date',
  `startDate` datetime DEFAULT NULL COMMENT 'Job Start Date',
  `endDate` datetime DEFAULT NULL COMMENT 'Job End Date',
  `jobStatus` varchar(255) DEFAULT NULL COMMENT 'Job Status',
  `jobProgress` varchar(255) DEFAULT NULL COMMENT 'Job Progress Percentage',
  `smsSent` varchar(255) DEFAULT NULL COMMENT 'SMS Sent Percentage',
  `smsDelivered` varchar(255) DEFAULT NULL COMMENT 'SMS Delivered Percentage',
  `smsUndelivered` varchar(255) DEFAULT NULL COMMENT 'SMS Undelivered Percentage',
  `smsFailed` varchar(255) DEFAULT NULL COMMENT 'SMS Failed Percentage',
  PRIMARY KEY (`jobID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms` (
  `snsID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `smsPhone` int(20) DEFAULT NULL COMMENT 'Phone number',
  `smsMessage` varchar(190) DEFAULT NULL COMMENT 'SMS Message',
  `semdDate` datetime DEFAULT NULL COMMENT 'Date Time SMS sent',
  `smsStatus` varchar(190) DEFAULT NULL COMMENT 'SMS Status',
  `jobID` int(11) DEFAULT NULL,
  PRIMARY KEY (`snsID`),
  KEY `jobID` (`jobID`),
  CONSTRAINT `sms_ibfk_1` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`jobID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-01  9:35:16
