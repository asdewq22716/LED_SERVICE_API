<?php
	include '../include/comtop_user.php';
	$W = $_GET['W'];
	$WF_SCREEN_NO = "MM#".$W;
	$sql_main = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."'");
	$rec_main = db::fetch_array($sql_main);
	$wf_page = $_GET['wf_page'];
	$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
	if($wf_page == ''){
		$wf_page = 1;
	}
	$wf_offset = ($wf_page-1)*$wf_limit;

	$PRIVILEGE_GROUP_NAME = $_GET['PRIVILEGE_GROUP_NAME'];
	$PRIVILEGE_GROUP_STATUS = $_GET['PRIVILEGE_GROUP_STATUS'];
	$filter = " ";
	if($PRIVILEGE_GROUP_NAME != ''){
		$filter .= "AND PRIVILEGE_GROUP_NAME LIKE '%".$PRIVILEGE_GROUP_NAME."%'";
	}
	if($PRIVILEGE_GROUP_STATUS != ''){
		$filter .= "AND PRIVILEGE_GROUP_STATUS LIKE '%".$PRIVILEGE_GROUP_STATUS."%'";
	}
	$field=" * ";
	$table= " M_PRIVILEGE_GROUP ";
	$wh=" 1=1 {$filter}";
	$orderby=" order by PRIVILEGE_GROUP_ID desc ";

	$sql = "select  ".$field." from ".$table." where ".$wh ." ".$orderby;
	$query = db::query($sql);
	$total_record = db::num_rows($query);
	if($_GET['wf_limit'] == 'all'){ //// กรณี  listbox เลือก ทั้งหมด
		$query_main = db::query($sql);
	}else{
		$query_main = db::query_limit($sql,$wf_offset,$wf_limit);
	}
?>
<style>
	.card-header{
		border-bottom:0px;
	}
</style>
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row" id="animationSandbox">
            <div class="col-sm-12">
                <div class="main-header">
                    <div class="media m-b-12">
						<a class="media-left" href="<?php echo $link_back_home; ?>">
							<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
						</a>
                        <div class="media-body">
                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4><?php echo  $report_name = $rec_main['WF_MAIN_NAME'];?></h4>
                        </div>
                    </div>
                    <div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="../workflow/index.php?G=47" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>  
					</div>
                </div>
            </div>
        </div>
        <!-- Row end -->

        <!--Workflow row start-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div id="wf_space" class="card-header">

						<form method="get" id="form_wf_search" name="form_wf_search" action="<?php echo $_SERVER['PHP_SELF']; ?>">

						<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>

							<div class="form-group row">
								<div class="col-md-2">

								</div>
								<div  class="col-md-3 wf-left">

								</div>
							</div>

						<br>

							<div class="form-group row">

								<div id="PRIVILEGE_GROUP_NAME_BSF_AREA" class="col-md-2 offset-md-1 "><label for="PRIVILEGE_GROUP_NAME" class="form-control-label wf-right">ชื่อหน่วยงาน</label></div>

								<div id="PRIVILEGE_GROUP_NAME_BSF_AREA" class="col-md-2 wf-left">
									<input type="text" name="PRIVILEGE_GROUP_NAME" id="PRIVILEGE_GROUP_NAME" class="form-control" value="<?php echo $PRIVILEGE_GROUP_NAME  ?>" placeholder="กรุณาเลือก">
									<small id="DUP_PRIVILEGE_GROUP_NAME_ALERT" class="form-text text-danger" style="display:none"></small></div>

								<div id="PRIVILEGE_GROUP_STATUS_BSF_AREA" class="col-md-2 "><label for="PRIVILEGE_GROUP_STATUS" class="form-control-label wf-right">สถานะ</label></div>

								<div id="PRIVILEGE_GROUP_STATUS_BSF_AREA" class="col-md-2 wf-left">
									<select name="PRIVILEGE_GROUP_STATUS" id="PRIVILEGE_GROUP_STATUS" class="form-control select2 select2-hidden-accessible" placeholder="ทั้งหมด" tabindex="-1" aria-hidden="true" value="<?php echo $PRIVILEGE_GROUP_STATUS  ?>">
										<option value=" " disabled="" selected="">ทั้งหมด</option>
										<option value="1" <?php if ( $PRIVILEGE_GROUP_STATUS == 1 ) {
													echo "selected" ; } ?>>ใช้งาน</option>
										<option value="0" <?php if ( $PRIVILEGE_GROUP_STATUS == 0 ) {
													echo "selected" ; } ?>>ไม่ใช้งาน</option>
									</select>
									<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 215.7px;"><span class="selection"></div>

								<div class="col-md-12 text-center">

									<button type="submit" name="wf_search" id="wf_search" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
									&nbsp;&nbsp;

									<button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onclick="window.location.href='mapping_api.php';">

                                        <i class="zmdi zmdi-refresh-alt"></i> Reset

                                    </button>

									<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">

								</div>
							</div>
                        </form>
                    </div>

                    <div class="card-block">
                        <div class="f-right"></div>
                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">
                            <div class="showborder">
								<table cellspacing="0"  class="table table-bordered sorted_table">
									<thead class="bg-primary">
										<tr class="bg-primary">
											<th width="5%">ลำดับ</th>
											<th width="30%">ชื่อหน่วยงาน</th>
											<th width="20%">สถานะ</th>
											<th width="5%">รายละเอียด</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$j=0;
										$i = 1;
										while($rec = db::fetch_array($query_main)){

									?>
									<tr>
										<td style="width:;" class="text-center"><?php echo $i;?></td>

										<td style="width:;" class="text-left">
										<?php echo $rec['PRIVILEGE_GROUP_NAME'];?></td>


										<td style="width:;" class="text-center"><?php if ($rec['PRIVILEGE_GROUP_STATUS']== 0 ) {
													echo "ไม่ใช้งาน";
														} else {
															echo "ใช้งาน";
														}
													?></td>


										<td style="width:;" class="text-center"><a href="mapping_api_form.php?W=59&PRIVILEGE_GROUP_ID=<?php echo $rec['PRIVILEGE_GROUP_ID']; ?>"class="btn btn-success btn-mini" title=""
										>
										<i class="icofont icofont-ui-edit"></i> จัดการ</a></td>
									</tr>

										<?php

										$i++;

										}

										?>
									</tbody>
								</table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Workflow Row end -->
    </div>
    <!-- Container-fluid ends -->
</div>
<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php';
?>
