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
-- Table structure for table `wf_file`
--

DROP TABLE IF EXISTS `wf_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wf_file` (
  `FILE_ID` int DEFAULT NULL,
  `WFS_FIELD_NAME` text,
  `WFR_ID` int DEFAULT NULL,
  `FILE_NAME` text,
  `FILE_SAVE_NAME` text,
  `FILE_EXT` varchar(20) DEFAULT NULL,
  `FILE_SIZE` int DEFAULT NULL,
  `FILE_TYPE` varchar(200) DEFAULT NULL,
  `FILE_DATE` date DEFAULT NULL,
  `FILE_TIME` varchar(20) DEFAULT NULL,
  `WF_MAIN_ID` int DEFAULT NULL,
  `USR_ID` int DEFAULT NULL,
  `FILE_STATUS` varchar(2) DEFAULT NULL,
  `DEL_USR` int DEFAULT NULL,
  `DEL_DATE` date DEFAULT NULL,
  `DEL_TIME` varchar(20) DEFAULT NULL,
  `FILE_FULLTEXT` text,
  `FILE_STATUS_PASS` varchar(2) DEFAULT NULL,
  `FILE_PASSWORD` varchar(20) DEFAULT NULL,
  `FILE_SAVE_FOLDER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wf_file`
--

LOCK TABLES `wf_file` WRITE;
/*!40000 ALTER TABLE `wf_file` DISABLE KEYS */;
INSERT INTO `wf_file` VALUES (3,'FILE',3,'PC.NB.03.jpg','f20250203095214_H5Dn8jtw8v.jpg','jpg',106270,'image/jpeg','2025-02-03','09:52:14',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(2,'FILE',2,'PC.NB.02.jpg','f20250203095214_EimBPMsMGh.jpg','jpg',84559,'image/jpeg','2025-02-03','09:52:14',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(1,'FILE',1,'PC.NB.01.jpg','f20250203095214_UBj3Fv5eBz.jpg','jpg',97025,'image/jpeg','2025-02-03','09:52:14',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(4,'FILE',4,'fianl_logo_67.png','f20250211110145_xCynatuEha.png','png',322364,'image/png','2025-02-11','11:01:45',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(5,'FILE',6,'t1.jpg','f20250221093059_e9dDfXAa9r.jpg','jpg',21902,'image/jpeg','2025-02-21','09:30:59',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(6,'FILE',8,'t6.jpg','f20250221110139_c9iVCdHmjr.jpg','jpg',194407,'image/jpeg','2025-02-21','11:01:39',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(7,'FILE',9,'t1.jpg','f20250306105202_ztiZ3rQnjZ.jpg','jpg',21902,'image/jpeg','2025-03-06','10:52:02',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(8,'FILE',10,'t2.jpg','f20250306105210_NYWaustjPW.jpg','jpg',23346,'image/jpeg','2025-03-06','10:52:10',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(9,'FILE',11,'t3.jpg','f20250306105217_GEWy2VKAjN.jpg','jpg',208698,'image/jpeg','2025-03-06','10:52:17',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(10,'FILE',12,'t5.jpg','f20250306105224_aRvuD4Rq67.jpg','jpg',401617,'image/jpeg','2025-03-06','10:52:24',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(11,'FILE',13,'t1.jpg','f20250317090204_DUckvz4yHe.jpg','jpg',21902,'image/jpeg','2025-03-17','09:02:04',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(12,'FILE',14,'t2.jpg','f20250317090212_Pz2YTYnsFF.jpg','jpg',23346,'image/jpeg','2025-03-17','09:02:12',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(13,'FILE',15,'t5.jpg','f20250317090219_Y3thY3Deni.jpg','jpg',401617,'image/jpeg','2025-03-17','09:02:19',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(14,'FILE',16,'t8.jpg','f20250317090227_Yi8vj5MxiR.jpg','jpg',503311,'image/jpeg','2025-03-17','09:02:27',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(15,'FILE',18,'t1.jpg','f20250319141753_66Zds1hv9J.jpg','jpg',21902,'image/jpeg','2025-03-19','14:17:53',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(16,'FILE',19,'t2.jpg','f20250319141802_4XaH2p1BD6.jpg','jpg',23346,'image/jpeg','2025-03-19','14:18:02',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(17,'FILE',20,'t8.jpg','f20250319141811_7BW9ac7FmU.jpg','jpg',503311,'image/jpeg','2025-03-19','14:18:11',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(18,'FILE',21,'t9.png','f20250319141818_GFaWx274XA.png','png',739659,'image/png','2025-03-19','14:18:18',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(19,'FILE',23,'t9.png','f20250326100749_2nQAFgzVaW.png','png',739659,'image/png','2025-03-26','10:07:49',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(20,'FILE',24,'t7.jpg','f20250326100756_Kp47M1135h.jpg','jpg',138730,'image/jpeg','2025-03-26','10:07:56',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(21,'FILE',25,'t5.jpg','f20250326100803_pMgvVBtz6z.jpg','jpg',401617,'image/jpeg','2025-03-26','10:08:03',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(22,'FILE',27,'faamai2.png','f20250515165937_MVP2cmZeMx.png','png',245077,'image/png','2025-05-15','16:59:37',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(23,'FILE',28,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_4th.jpg','f20250520165101_puhKvdS1jZ.jpg','jpg',133447,'image/jpeg','2025-05-20','16:51:01',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(24,'FILE',29,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_2nd.jpg','f20250520172154_aVPcKxiwbi.jpg','jpg',170049,'image/jpeg','2025-05-20','17:21:54',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(25,'FILE',30,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_1st.jpg','f20250520172201_GsiKXxtQwB.jpg','jpg',106661,'image/jpeg','2025-05-20','17:22:01',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(26,'FILE',31,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_4th.jpg','f20250523093905_pcrnYtXmgX.jpg','jpg',133447,'image/jpeg','2025-05-23','09:39:05',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(27,'FILE',32,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_1st.jpg','f20250523093920_UPizpnQ4aC.jpg','jpg',106661,'image/jpeg','2025-05-23','09:39:20',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7'),(28,'FILE',34,'Half-Day-Afternoon-Visit-to-Elephant-Nature-Park_4th.jpg','f20250523105548_DK9g66cG6S.jpg','jpg',133447,'image/jpeg','2025-05-23','10:55:48',7,1,'Y',NULL,NULL,NULL,NULL,NULL,NULL,'../attach/w7');
/*!40000 ALTER TABLE `wf_file` ENABLE KEYS */;
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
