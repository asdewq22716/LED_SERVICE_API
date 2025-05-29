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
-- Table structure for table `wf_config`
--

DROP TABLE IF EXISTS `wf_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wf_config` (
  `CONFIG_ID` int DEFAULT NULL,
  `CONFIG_VALUE` text,
  `CONFIG_NAME` text,
  `CONFIG_LABEL` text,
  `CONFIG_TYPE` text,
  `CONFIG_OPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wf_config`
--

LOCK TABLES `wf_config` WRITE;
/*!40000 ALTER TABLE `wf_config` DISABLE KEYS */;
INSERT INTO `wf_config` VALUES (1,'Elephant Nature Park','conf_title','Title bar','1',NULL),(2,'#2C9200','conf_header_bg','สีหลักของระบบ','1',NULL),(3,'googlesans','wf_font','Font หลักของระบบ','4',NULL),(4,NULL,'conf_icon_favicon','Icon favicon','1',NULL),(5,NULL,'conf_login_image','รูป Background หน้า Login','1',NULL),(6,NULL,'conf_login_logo','Logo หน้า Login','1',NULL),(7,NULL,'conf_login_text','label หน้า login','2',NULL),(8,NULL,'conf_header_logo','Logo ส่วน Header','1',NULL),(9,NULL,'conf_footer_text','Text ส่วน Footer','2',NULL),(10,NULL,'conf_icon_favicon_backend','Icon favicon ส่วน backend','1',NULL),(11,NULL,'conf_login_image_backend','รูป Background หน้า Login ส่วน backend','1',NULL),(12,NULL,'conf_login_logo_backend','Logo หน้า Login ส่วน backend','1',NULL),(13,NULL,'conf_login_text_backend','label หน้า login ส่วน backend','2',NULL),(14,NULL,'conf_header_logo_backend','Logo ส่วน Header ส่วน backend','1',NULL),(15,NULL,'2fa','2 Factor Authenticator','3',NULL),(16,'เพิ่มข้อมูล','wf_text_main_add','Text ปุ่มเพิ่มข้อมูลของหน้า workflow','1',NULL),(17,'ดำเนินการ','wf_text_main_process','Text ปุ่มดำเนินการของหน้า workflow','1',NULL),(18,'ขั้นตอนการทำงาน','wf_text_main_process_step','Text ปุ่มขั้นตอนการทำงานของหน้า workflow','1',NULL),(19,'ลบ','wf_text_main_del','Text ปุ่มลบของหน้า workflow','1',NULL),(20,'กลับหน้าหลัก','wf_text_main_back','Text ปุ่มกลับหน้าหลักของหน้า workflow','1',NULL),(21,'กลับหน้าหลัก','wf_text_detail_back','Text ปุ่มกลับหน้าหลักของหน้าบันทึกข้อมูล','1',NULL),(22,'ย้อนขั้นตอน','wf_text_detail_process_back','Text ปุ่มย้อนขั้นตอนของหน้าบันทึกข้อมูล','1',NULL),(23,'บันทึกชั่วคราว','wf_text_detail_save_temp','Text ปุ่มบันทึกชั่วคราวของหน้าบันทึกข้อมูล','1',NULL),(24,'บันทึก','wf_text_detail_save','Text ปุ่มบันทึกของหน้าบันทึกข้อมูล','1',NULL),(25,'ดำเนินการ','wf_text_detail_process','Text ปุ่มดำเนินการของหน้าบันทึกข้อมูล','1',NULL),(26,'Profile','conf_profile','Text Label Link Profile','1',NULL),(27,'Logout','conf_logout','Text Label Link logout','1',NULL),(28,'ค้นหา','conf_search','Text label search','1',NULL),(29,'ล้างค่า','wf_label_reset','Text ล้างค่าค้นหา','1',NULL),(30,'แก้ไข','wf_text_main_edit','Text ปุ่มแก้ไขของหน้า form และ master','1',NULL),(31,'ดูรายละเอียด','wf_text_main_view','Text ปุ่มดูรายละเอียดของหน้า form และ master','1',NULL),(32,NULL,'wf_line_token_access','Line Token Access','2',NULL),(33,'A','wf_show_menu','แสดงเมนู','1',NULL),(34,'vertical','wf_menu_layout','Layout เมนู','4',NULL),(35,'top','wf_menu_profile','Layout Profile','4',NULL),(36,'[##USR_OPTION1!!] ##USR_PREFIX!!##USR_FNAME!!##USR_LNAME!! (##USR_OPTION2!!)','wf_show_user','รูปแบบการแสดงผลของ user','1',NULL),(37,'1','wf_display_column','Default รูปแบบการแสดงผล Column','4',NULL),(38,'ไฟล์เอกสารแนบ','wf_text_detail_attach','ปุ่มเอกสารทั้งหมดของ workflow','1',NULL),(39,'ขั้นตอนปัจจุบัน','wf_text_det_step','Text Label แสดงหัวคอลัมน์ขั้นตอนปัจจุบันในหน้า list รายการ','1',NULL),(40,'ขั้นตอนถัดไป','wf_text_det_next','Text Label แสดงหัวคอลัมน์ขั้นตอนถัดไปในหน้า list รายการ','1',NULL),(41,NULL,'wf_text_main_order','Text label แสดงคอลัมน์ลำดับในหน้า list workflow และ list master','1',NULL),(42,NULL,'wf_list_per_page','จำนวนที่เป็นตัวเลือกในการแสดงผลต่อหน้า (ใส่เป็นคอมม่าคั่น เพื่อให้เป็นหลายตัวเลือก)','1',NULL),(43,NULL,'conf_user_prefix','คำนำหน้าชื่อ','1',NULL),(44,NULL,'wf_sub_menu','Sub Menu','1',NULL),(45,NULL,'wf_split_page','Text แบ่งหน้า','1',NULL),(46,NULL,'wf_select_province','Text เลือกจังหวัด','1',NULL),(47,NULL,'wf_select_amphur','Text เลือกอำเภอ','1',NULL),(48,NULL,'wf_select_tambon','Text เลือกตำบล','1',NULL),(49,NULL,'wf_select_tambon2','Text เลือกแขวง','1',NULL),(50,NULL,'wf_delete_confirm','Text ยืนยันการลบ','1',NULL),(51,NULL,'wf_cancle','Text ยกเลิก','1',NULL),(52,NULL,'wf_save_complete','Text บันทึกตำแหน่งเรียบร้อยแล้ว','1',NULL),(53,NULL,'wf_delete_confirm_list','Text คุณต้องการลบรายการนี้หรือไม่?','1',NULL),(54,NULL,'wf_exist_data','Text ข้อมูลนี้มีอยู่แล้วในระบบ','1',NULL),(55,NULL,'wf_close','Text ปิด','1',NULL),(56,NULL,'wf_select','Text เลือก','1',NULL),(57,NULL,'wf_not_activated','Text ยังไม่เปิดใช้งาน','1',NULL),(58,NULL,'wf_attach','Text เอกสารแนบ','1',NULL),(59,NULL,'wf_more_doc','Text เอกสารเพิ่มเติม','1',NULL),(60,NULL,'wf_agree','Text ตกลง','1',NULL),(61,NULL,'wf_process_back_comfirm','Text คุณต้องการย้อนขั้นตอนหรือไม่?','1',NULL),(62,NULL,'wf_export_pdf','Text ส่งออก PDF','1',NULL),(63,NULL,'wf_export_word','Text ส่งออก word','1',NULL),(64,NULL,'wf_export_excel','Text ส่งออก excel','1',NULL),(65,NULL,'wf_label_date','Text วว/ดด/ปปปป','1',NULL),(66,'Elephant_Nature_Park','conf_system_name','ชื่อระบบ','1',NULL),(67,'Elephant Nature Park','conf_department','หน่วยงาน','1',NULL),(68,NULL,'wf_notification','กระดิ่งแจ้งเตือน','3',NULL),(69,'list','wf_display_department','รูปแบบการแสดงผลหน่วยงาน','4',NULL),(70,'question','wf_icon_confirm','Icon ข้อความยืนยันก่อน Submit','4',NULL),(71,'tinymce','wf_editor','รูปแบบ Text Editor','4',NULL),(84,'http://localhost/enp_parkCopy/','BSF_WF_URL','SITE_URL','999',''),(85,'k3j4k4u4o31583y2q3e4c426k3q3w423h3n5d483y4c4j3b3448424j4q3b4d326o325b374x4p5f456k3x3w4y2n3n5a4a3','BSF_SITE_ID','SITE_ID','999',''),(86,'k3j4k4u4o31583y2q3e4c426k3q3w423h3n5c4x2w4a4b3t3l36453n4v3r353i4u345i4655545w4m4k3j4k4u4o31583y2q3e4c426k3q3w423h3n5c443','BSF_SITE_CODE','SITE_CODE','999',''),(87,'f6ff12dc0eea4e8dd0f1182e58fae44cf6ff12dc0eea4e8dd0f1182e58fae44c','BSF_SITE_TOKEN','SITE_TOKEN','999','');
/*!40000 ALTER TABLE `wf_config` ENABLE KEYS */;
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
