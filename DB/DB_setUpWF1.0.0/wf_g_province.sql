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
-- Table structure for table `g_province`
--

DROP TABLE IF EXISTS `g_province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `g_province` (
  `PROVINCE_CODE` varchar(2) DEFAULT NULL,
  `PROVINCE_NAME` varchar(100) DEFAULT NULL,
  `PROVINCE_SHORT` varchar(20) DEFAULT NULL,
  `PROVINCE_NAME_EN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g_province`
--

LOCK TABLES `g_province` WRITE;
/*!40000 ALTER TABLE `g_province` DISABLE KEYS */;
INSERT INTO `g_province` VALUES ('10','กรุงเทพมหานคร','กท','BANGKOK'),('11','สมุทรปราการ','สป','SAMUT PRAKAN'),('12','นนทบุรี','นบ','NONTHABURI'),('13','ปทุมธานี','ปท','PATHUM THANI'),('14','พระนครศรีอยุธยา','อย','PHRA NAKHON SI AYUTTHAYA'),('15','อ่างทอง','อท','ANG THONG'),('16','ลพบุรี','ลบ','LOP BURI'),('17','สิงห์บุรี','สห','SING BURI'),('18','ชัยนาท','ชน','CHAI NAT'),('19','สระบุรี','สบ','SARABURI'),('20','ชลบุรี','ชบ','CHON BURI'),('21','ระยอง','รย','RAYONG'),('22','จันทบุรี','จบ','CHANTHABURI'),('23','ตราด','ตร','TRAT'),('24','ฉะเชิงเทรา','ฉช','CHACHOENGSAO'),('25','ปราจีนบุรี','ปจ','PRACHIN BURI'),('26','นครนายก','นย','NAKHON NAYOK'),('27','สระแก้ว','สก','SA KAEO'),('30','นครราชสีมา','นม','NAKHON RATCHASIMA'),('31','บุรีรัมย์','บร','BURI RAM'),('32','สุรินทร์','สร','SURIN'),('33','ศรีสะเกษ','ศก','SI SA KET'),('34','อุบลราชธานี','อบ','UBON RATCHATHANI'),('35','ยโสธร','ยส','YASOTHON'),('36','ชัยภูมิ','ชย','CHAIYAPHUM'),('37','อำนาจเจริญ','อจ','AMNAT CHAROEN'),('38','บึงกาฬ','บก','BUENG KAN'),('39','หนองบัวลำภู','นภ','NONG BUA LAMPHU'),('40','ขอนแก่น','ขก','KHON KAEN'),('41','อุดรธานี','อด','UDON THANI'),('42','เลย','ลย','LOEI'),('43','หนองคาย','นค','NONG KHAI'),('44','มหาสารคาม','มค','MAHA SARAKHAM'),('45','ร้อยเอ็ด','รอ','ROI ET'),('46','กาฬสินธุ์','กส','KALASIN'),('47','สกลนคร','สน','SAKON NAKHON'),('48','นครพนม','นพ','NAKHON PHANOM'),('49','มุกดาหาร','มห','MUKDAHAN'),('50','เชียงใหม่','ชม','CHIANG MAI'),('51','ลำพูน','ลพ','LAMPHUN'),('52','ลำปาง','ลป','LAMPANG'),('53','อุตรดิตถ์','อต','UTTARADIT'),('54','แพร่','พร','PHRAE'),('55','น่าน','นน','NAN'),('56','พะเยา','พย','PHAYAO'),('57','เชียงราย','ชร','CHIANG RAI'),('58','แม่ฮ่องสอน','มส','MAE HONG SON'),('60','นครสวรรค์','นว','NAKHON SAWAN'),('61','อุทัยธานี','อน','UTHAI THANI'),('62','กำแพงเพชร','กพ','KAMPHAENG PHET'),('63','ตาก','ตก','TAK'),('64','สุโขทัย','สท','SUKHOTHAI'),('65','พิษณุโลก','พล','PHITSANULOK'),('66','พิจิตร','พจ','PHICHIT'),('67','เพชรบูรณ์','พช','PHETCHABUN'),('70','ราชบุรี','รบ','RATCHABURI'),('71','กาญจนบุรี','กจ','KANCHANABURI'),('72','สุพรรณบุรี','สพ','SUPHAN BURI'),('73','นครปฐม','นฐ','NAKHON PATHOM'),('74','สมุทรสาคร','สค','SAMUT SAKHON'),('75','สมุทรสงคราม','สส','SAMUT SONGKHRAM'),('76','เพชรบุรี','พบ','PHETCHABURI'),('77','ประจวบคีรีขันธ์','ปข','PRACHUAP KHIRI KHAN'),('80','นครศรีธรรมราช','นศ','NAKHON SI THAMMARAT'),('81','กระบี่','กบ','KRABI'),('82','พังงา','พง','PHANGNGA'),('83','ภูเก็ต','ภก','PHUKET'),('84','สุราษฎร์ธานี','สฎ','SURAT THANI'),('85','ระนอง','รน','RANONG'),('86','ชุมพร','ชพ','CHUMPHON'),('90','สงขลา','สข','SONGKHLA'),('91','สตูล','สต','SATUN'),('92','ตรัง','ตง','TRANG'),('93','พัทลุง','พท','PHATTHALUNG'),('94','ปัตตานี','ปน','PATTANI'),('95','ยะลา','ยล','YALA'),('96','นราธิวาส','นธ','NARATHIWAT');
/*!40000 ALTER TABLE `g_province` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-28 13:16:34
