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
-- Table structure for table `wf_menu`
--

DROP TABLE IF EXISTS `wf_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wf_menu` (
  `MENU_ID` int DEFAULT NULL,
  `MENU_NAME` text,
  `MENU_ORDER` int DEFAULT NULL,
  `MENU_STATUS` varchar(50) DEFAULT NULL,
  `MENU_ICON` text,
  `MENU_PARENT` int DEFAULT NULL,
  `MENU_TYPE` varchar(1) DEFAULT NULL,
  `MENU_URL` text,
  `MENU_TARGET` varchar(20) DEFAULT NULL,
  `MENU_FLAG` varchar(20) DEFAULT NULL,
  `WF_MAIN_ID` int DEFAULT NULL,
  `MENU_SHOW` varchar(20) DEFAULT NULL,
  `MENU_S_ICON` varchar(200) DEFAULT NULL,
  `MENU_NAME_SETTING` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wf_menu`
--

LOCK TABLES `wf_menu` WRITE;
/*!40000 ALTER TABLE `wf_menu` DISABLE KEYS */;
INSERT INTO `wf_menu` VALUES (1,'หมวดเมนู',2,'Y','',0,'','','','',0,'C','custom-layer',''),(3,'โปรแกรม',1,'Y','icon29.png',1,'W','','','file',1,'','','Y'),(4,'Setting',3,'Y','',0,'','','','',0,'C','custom-setting-outline',''),(5,'สกุลเงิน',0,'Y','icon48.png',4,'W','','','file',5,'','','Y'),(6,'บริการ',1,'Y','icon36.png',4,'W','','','file',4,'','','Y'),(7,'สถานที่',2,'Y','icon23.png',4,'W','','','file',9,'','','Y'),(8,'Booking',0,'Y','icon2.png',9,'W','','','file',11,'','','Y'),(9,'Payment',0,'Y','',0,'','','','',0,'C','custom-setting-outline',''),(10,'ประเภทผู้เข้าชม',3,'Y','family.png',4,'W','','','file',14,'','','Y'),(11,'รายงานการจอง',4,'Y','icon10.png',0,'','','','',0,'C','custom-note-1',''),(12,'รายงานการจอง',0,'Y','icon10.png',11,'W','','','file',10,'','','Y'),(13,'รอบการบริการ',4,'Y','icon44.png',4,'W','','','file',8,'','','Y');
/*!40000 ALTER TABLE `wf_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-28 13:16:37
