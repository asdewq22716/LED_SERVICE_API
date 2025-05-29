-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: wf
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `frm_condition`
--

DROP TABLE IF EXISTS `frm_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frm_condition` (
  `F_ID` int DEFAULT NULL,
  `WF_MAIN_ID` int DEFAULT NULL,
  `WFD_ID` int DEFAULT NULL,
  `WFR_ID` int DEFAULT NULL,
  `WFS_ID` int DEFAULT NULL,
  `F_TEMP_ID` varchar(50) DEFAULT NULL,
  `F_CREATE_DATE` date DEFAULT NULL,
  `F_CREATE_BY` int DEFAULT NULL,
  `F_UPDATE_DATE` date DEFAULT NULL,
  `F_UPDATE_BY` int DEFAULT NULL,
  `CONDITION_NAME_TH` varchar(500) DEFAULT NULL,
  `CONDITION_NAME_EN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frm_condition`
--

LOCK TABLES `frm_condition` WRITE;
/*!40000 ALTER TABLE `frm_condition` DISABLE KEYS */;
INSERT INTO `frm_condition` VALUES (2,1,0,1,6,'1','2025-02-03',1,'2025-02-03',1,'ผู้ใหญ่อายุไม่เกิน 15 ปี','old'),(1,1,0,1,6,'1','2025-02-03',1,'2025-02-03',1,'เด็กอายุเกิน 30 ปี','young'),(3,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(4,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(5,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(6,1,0,3,6,'3','2025-02-21',1,'2025-02-21',1,'อายุ ฬ 50','old 50'),(7,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'1','1'),(8,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'111','111'),(9,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'11','11'),(10,1,0,5,6,'5','2025-03-06',1,'2025-03-06',1,'d','d'),(11,1,0,7,6,'7','2025-03-19',1,'2025-03-19',1,NULL,NULL),(12,1,0,9,6,'9','2025-05-15',1,'2025-05-15',1,NULL,NULL),(13,1,0,11,6,'11','2025-05-23',1,'2025-05-23',1,NULL,NULL),(14,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL),(15,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL),(16,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL),(2,1,0,1,6,'1','2025-02-03',1,'2025-02-03',1,'ผู้ใหญ่อายุไม่เกิน 15 ปี','old'),(1,1,0,1,6,'1','2025-02-03',1,'2025-02-03',1,'เด็กอายุเกิน 30 ปี','young'),(3,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(4,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(5,1,0,2,6,'2','2025-02-12',1,'2025-02-21',1,'เงื่อนไขการเข้าใช้บริการของลูกค้า',NULL),(6,1,0,3,6,'3','2025-02-21',1,'2025-02-21',1,'อายุ ฬ 50','old 50'),(7,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'1','1'),(8,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'111','111'),(9,1,0,4,6,'4','2025-02-21',1,'2025-02-21',1,'11','11'),(10,1,0,5,6,'5','2025-03-06',1,'2025-03-06',1,'d','d'),(11,1,0,7,6,'7','2025-03-19',1,'2025-03-19',1,NULL,NULL),(12,1,0,9,6,'9','2025-05-15',1,'2025-05-15',1,NULL,NULL),(13,1,0,11,6,'11','2025-05-23',1,'2025-05-23',1,NULL,NULL),(14,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL),(15,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL),(16,1,0,12,6,'12','2025-05-23',1,'2025-05-23',1,NULL,NULL);
/*!40000 ALTER TABLE `frm_condition` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-28 13:16:35
