<?php include 'comtop.php';
 include 'include/comtop_user.php';?>
    <!--::header part start::-->
    <?php include 'header.php';
    $wf_page = $_GET['wf_page'];
    $wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    if($wf_page == ''){
        $wf_page = 1;
    }
    $wf_offset = ($wf_page-1)*$wf_limit;
	$filter = "";
	if($_GET['sys_id'] != ''){
		$filter = "AND ANC_TYPE_CIVIL = '".$_GET['sys_id']."'";
	}
    $sql = "SELECT 		A .*, B.COURT_NAME_LAW, C.*, D .FILE_NAME, D .FILE_SAVE_NAME, E .ANC_WEBSITE_NAME 
			FROM 		M_ANC_NOTICE_WEBSITE A 
			LEFT JOIN	M_COURT_CODE_MAP B ON A .COURT_ID = B.COURT_ID 
			LEFT JOIN 	FRM_ANC_NOTICE C ON A .ANC_NOTICE_WEB_ID = C.WFR_ID 
			LEFT JOIN 	WF_FILE D ON C.F_ID = D .WFR_ID 
			LEFT JOIN 	M_ANC_WEBSITE E ON C.ANC_NOTICE_ID = E.ANC_WEBSITE_ID AND D.WFS_FIELD_NAME = 'ANC_NOTICE_FILE' 
			WHERE 		1 = 1 {$filter}";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_api = db::query_limit($sql,$wf_offset,$wf_limit);
    ?>
    <!-- Header part end-->
    <style>
      th {
        color: white;
      }
    </style>
    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>ประกาศเจ้าพนักงานพิทักษ์ทรัพย์</h2>
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
                <div class="col-md-12">
                    <div class="row">
					<h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg> ค้นหา</h4>
                    </div>
					<form method="get" id="form_wf_search" name="form_wf_search" action="#">
					<div class="form-group row">
						<div class="col-md-1  offset-md-3">
							<label for="sys_id" class="form-control-label wf-right">ประเภทคดี</label>
						</div>
						<div class="col-md-3  offset-md-1" align="LEFT">
						  <select class="form-control select2" id="sys_id" name="sys_id">
							<option disabled selected>ทั้งหมด</option>
							<option value="1" <?php echo $_GET['sys_id']==1?"selected":"" ?>>คดีล้มละลาย</option>
							<option value="2" <?php echo $_GET['sys_id']==2?"selected":"" ?>>คดีฟื้นฟูกิจการของลูกหนี้</option>
						  </select>
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" name="wf_search" id="wf_search" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
						</div>
					</div>
					</form>
					</br>
                    <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg" align="center">
                            <tr>
                                <th>ลำดับ </th>
                                <th>รายการประกาศ </th>
                                <th>วันที่ประกาศ</th>
                                <th>เลขคดีแดง</th>
                                <th>เลขคดีดำ</th>
                                <th>ศาล</th>
                                <th>โจทก์</th>
                                <th>ประกาศ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($total > 0){
                                $i = 1;
                                while($row = db::fetch_array($data_api)){ ?>
                                    <tr>
                                        <td align="center"><?php echo $i+$wf_offset;?></td>
                                        <td align="left"><?php echo $row['ANC_WEBSITE_NAME']; ?></td>
                                        <td align="center"><?php echo db2date($row['ANC_DATE']);?></a></td>
                                        <td align="left"><?php echo $row['PREFIX_RED_CASE'].$row['RED_CASE']."/".$row['RED_YEAR'];?></td>
                                        <td align="left"><?php echo $row['PREFIX_BLACK_CASE'].$row['BLACK_CASE']."/".$row['BLACK_YEAR'];?></td>
                                        <td align="left"><?php echo $row['COURT_NAME_LAW'];?></td>
                                        <td align="left"><?php echo $row['PLANTIFF_1'];?></td>
                                        <td align="left"><a href='../attach/w106/<?php echo $row['FILE_SAVE_NAME'];?>'><?php echo $row['FILE_NAME'];?></a></td>
                                    </tr>
                                <?php  $i++; }
                            }else{ ?>
                            <tr><td class="text-center" colspan="7">ไม่พบข้อมูล</td></tr>
                            <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):"";?>
                </div>

                <div class="content">
                    <?php //if (isset($_SESSION['username'])) :?>
                        <!-- <p>Welcome <strong><?php //echo $_SESSION['username'];?> </strong></p> -->
                    <?php //endif ?>
                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
