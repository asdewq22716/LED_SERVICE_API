
<?php include 'comtop.php';
    include 'include/comtop_user.php';
?>
    <!--::header part start::-->
    <?php include 'header.php';?>
    <!-- Header part end-->

    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>API Documentation</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section id="tabs">
    	<div class="container">
      		<div class="row">
                <div class="col-md-4">
                <?php include 'left_menu.php';?>
                </div>
                <div class="col-md-8">
                    <div class="row">
    					
                        <h4 class="mt-3 mb-3 bold">รายละเอียดของมาตรฐานข้อมูลกรมบังคับคดี ประกอบด้วย</h4>
                        <table>
                            <h5 class="mt-3 mb-2 bold"  align="left">เงื่อนไขและข้อกำหนดการใช้งานเว็บไซต์</h5>
                         
                                <td align="left"><label class="bold">1. ชื่อข้อมูล</label> ชื่อของรายการข้อมูลทั้งภาษาไทยและภาษาอังกฤษ
                                            <br><label class=" bold">2. คำอธิบาย</label> คำชี้แจงขยายรายละเอียดของรายการข้อมูล เพื่อให้เกิดความเข้าใจที่ตรงกัน ทั้งภาษาไทยและภาษาอังกฤษ
                                            <br><label class=" bold">3. ชื่อ XML Tag</label> โครงสร้างข้อมูลรูปแบบ XML ของรายการข้อมูล
                                            <br><label class=" bold">4. ชนิดข้อมูล</label> ชนิดของรายการข้อมูลตามมาตรฐานชนิดข้อมูล (Standard Data Type)
                                            <br><label class=" bold">5. กลุ่มข้อมูล</label> กลุ่มข้อมูลซึ่งเชื่อมโยงรายการข้อมูลที่มีความสัมพันธ์กัน
                                            <br><label class=" bold">6. ความถี่ที่เกิดขึ้น</label> หมายถึง Multiplicity แสดงจำนวนครั้งต่ำสุดถึงสูงสุดของรายการข้อมูลนั้น ตัวเลขทางขวาแสดงตัวเลขต่ำสุดที่รายการข้อมูลนั้นมีได้ และตัวเลขทางซ้ายแสดงตัวเลขสูงสุดที่รายการข้อมูลนั้นมีได้
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;[1…1] รายการข้อมูลดังกล่าวต้องมีอย่างน้อย 1 รายการข้อมูลและมีได้ไม่เกิน 1 รายการข้อมูล
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;[0…1] รายการข้อมูลดังกล่าวอาจจะมีหรือไม่มีก็ได้ หากมีจะมีได้ไม่เกิน 1 รายการ
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;[0…n] รายการข้อมูลดังกล่าวอาจจะมีหรือไม่มีก็ได้ หากมีจะสามารถมีได้ไม่จำกัด
                                            <br><label class=" bold">7. ชนิดข้อมูลร่วม</label> หมายถึง ระดับชนิดของข้อมูลร่วมอัน ได้แก่
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;Basic Core Components (BCC) ชนิดข้อมูลร่วมแบบพื้นฐาน
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;Aggregate Core Components (ACC) ชนิดข้อมูลร่วมแบบมีส่วนประกอบย่อย
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;Associate Core Components (ASCC) ชนิดข้อมูลร่วมสำหรับแสดงความสัมพันธ์
                                                <br>&nbsp;&nbsp;&nbsp;&nbsp;Basic Business Information Entity (BBIE) ชนิดข้อมูลร่วมแบบพื้นฐานที่มีบริบททางธุรกิจ
                                            <br><label class=" bold">8. ระดับของมาตรฐานข้อมูล</label> หมายถึง ระดับของมาตรฐานข้อมูล เช่น มาตรฐานระดับระหว่างประเทศ (IDS) มาตรฐานระดับประเทศ (NDS) มาตรฐานระดับสมาคม (ADS)
                                            <br><label class=" bold">9. ระดับชั้นความลับ</label> เป็นระดับชั้นความลับ เช่น ไม่ลับ ลับที่สุด
                                            <br><label class=" bold">10. รูปแบบการจัดเก็บ</label> เป็นรูปแบบการจัดเก็บข้อมูล เช่น จัดเก็บในรูปแบบเอกสารอิเล็กทรอนิกส์ จัดเก็บในรูปแบบกระดาษ
                                            <br><label class=" bold">11. แหล่งข้อมูลต้นทาง</label> หมายถึง หน่วยงานที่เป็นแหล่งต้นทางของรายการข้อมูล
                                            <br><label class=" bold">12. หน่วยงานเจ้าของข้อมูล</label> หมายถึง หน่วยงานที่เป็นเจ้าของรายการข้อมูล
                                            <br><label class=" bold">13. แหล่งข้อมูลที่เกี่ยวข้อง</label> หมายถึง ชื่อแหล่งข้อมูลที่เกี่ยวข้องที่สามารถศึกษาเพิ่มเติมได้ และตัวอย่าง มาตรฐาน หรือพระราชบัญญัติ, กฎหมาย, ระเบียบ ที่เกี่ยวข้องกับรายการข้อมูล
                                            <br><label class=" bold">14. วันที่ออกแบบข้อมูล</label> เป็นวันที่รายการข้อมูลหรือรายละเอียดต่างๆของรายการข้อมูล ได้ถูกออกแบบขึ้น
                                            <br><label class=" bold">15. วันที่สร้างข้อมูล</label> เป็นวันที่รายการข้อมูลหรือรายละเอียดต่างๆของรายการข้อมูลได้ถูกสร้างขึ้น
                                            <br><label class=" bold">16. วันที่แก้ไขข้อมูล</label> เป็นวันที่รายการข้อมูลหรือรายละเอียดต่างๆของรายการข้อมูลได้ถูกแก้ไข
                                            <br><label class=" bold">17. ผู้แก้ไขข้อมูล</label> เป็นผู้ที่แก้ไขรายการข้อมูลหรือรายละเอียดต่างๆของรายการข้อมูล
                                
                                </td>
                        </table>
                    </div>
                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
