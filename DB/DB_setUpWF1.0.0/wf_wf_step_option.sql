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
-- Table structure for table `wf_step_option`
--

DROP TABLE IF EXISTS `wf_step_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wf_step_option` (
  `WFSO_ID` int DEFAULT NULL,
  `WFS_ID` int DEFAULT NULL,
  `WFSO_NAME` text,
  `WFSO_VALUE` text,
  `WFSO_ORDER` int DEFAULT NULL,
  `WFSO_TYPE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wf_step_option`
--

LOCK TABLES `wf_step_option` WRITE;
/*!40000 ALTER TABLE `wf_step_option` DISABLE KEYS */;
INSERT INTO `wf_step_option` VALUES (1,3,'อาสาสมัคร','1',1,NULL),(2,3,'ท่องเที่ยว','2',2,NULL),(7,27,'เปิดการใช้งาน','1',1,NULL),(5,21,'เผยแพร่แล้ว','1',1,NULL),(6,21,'ยังไม่เผยแพร่','0',2,NULL),(8,27,'ยกเลิกการใช้งาน','0',2,NULL),(9,28,'ชำระเต็มจำนวน','1',1,NULL),(10,28,'ชำระเปอร์เซ็นมัดจำ','2',2,NULL),(11,30,'ไฟล์รูป','1',1,NULL),(13,30,'Link','2',3,NULL),(16,58,'Phone','1',1,NULL),(17,58,'WhatsApp','2',2,NULL),(18,100,'Deposit Payment','1',1,NULL),(19,100,'Full Payment','2',2,NULL);
/*!40000 ALTER TABLE `wf_step_option` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-28 13:16:36
