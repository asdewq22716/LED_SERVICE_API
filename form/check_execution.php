<?php

//$HIDE_HEADER = 'Y';
include "../include/comtop_user.php";

?>
<style>
.card-header{
    border-bottom:0px;
}
</style>
<div class="content-wrapper">

    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <!-- Row Starts -->
        <div class="row" id="animationSandbox">

            <div class="col-sm-12">

                <div class="main-header">

                    <div class="media m-b-12">

                        <a class="media-left" href=""></a>

                        <div class="media-body">

                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4>ระบบตรวจสอบหมายบังคับคดี</h4>

                        </div>

                    </div>

                    <div class="f-right">

                        <a class="btn btn-danger waves-effect waves-light" href="../workflow/index.php" role="button" title="">
                            <i class="icofont icofont-home"></i> กลับหน้าหลัก
                        </a>

                    </div>

                </div>

            </div>

        </div>
        <!-- Row end -->

        <!--Workflow row start-->
        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <!-- div id="wf_space" class="card-header" -->
                    <div id="wf_space" class="card-header">

                        <form method="get" id="form_wf_search" name="form_wf_search" action="#">

                            <h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>

                            <div class="form-group row"></div>

                            <div class="form-group row">

                                <div id="COURT_CODE_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="COURT_CODE"class="form-control-label wf-right">ศาล</label>
                                
                                </div>

                                <div id="COURT_CODE_BSF_AREA" class="col-md-3  wf-left">
                                    
                                    <select name="COURT_CODE" id="COURT_CODE" class="form-control select2" >
                                        <option value="" disabled selected>กรุณาเลือก</option>
                                    </select>
                                
                                </div>
                            
                            </div>

                            <div class="form-group row">

                                <div id="DEPT_CODE_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="DEPT_CODE"class="form-control-label wf-right">สำนักงานบังคับคดี</label>
                                
                                </div>

                                <div id="DEPT_CODE_BSF_AREA" class="col-md-3 wf-left">
                                    
                                    <select name="DEPT_CODE" id="DEPT_CODE" class="form-control select2">
                                        <option value="" disabled selected>กรุณาเลือก</option>
                                    </select>
                                
                                </div>
                            
                            </div>

                            <div class="form-group row">

                                <div id="_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for=""class="form-control-label wf-right">หมายเลขคดีดำที่</label>
                                
                                </div>

                                <div id="PREFIX_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="PREFIX_BLACK_CASE" id="PREFIX_BLACK_CASE" class="form-control" value="<?php echo $_GET['PREFIX_BLACK_CASE'] == "" ? "" : $_GET['PREFIX_BLACK_CASE']; ?>">
                                    <small id="DUP_PREFIX_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>

                                <div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $_GET['BLACK_CASE'] == "" ? "" : $_GET['BLACK_CASE']; ?>">
                                    <small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>

                                <div id="_BSF_AREA" class="col-md-1 wf-left text-center">
                                    <label for=""class="form-control-label">/</label>
                                </div>

                                <div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $_GET['BLACK_YY'] == "" ? "" : $_GET['BLACK_YY']; ?>">
                                    <small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>
                            
                            </div>
                            
                            <div class="form-group row">

                                <div id="_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for=""class="form-control-label wf-right">หมายเลขคดีแดงที่</label>
                                
                                </div>

                                <div id="PREFIX_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="PREFIX_RED_CASE" id="PREFIX_RED_CASE" class="form-control" value="<?php echo $_GET['PREFIX_RED_CASE'] == "" ? "" : $_GET['PREFIX_RED_CASE']; ?>">
                                    <small id="DUP_PREFIX_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>

                                <div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $_GET['RED_CASE'] == "" ? "" : $_GET['RED_CASE']; ?>">
                                    <small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>

                                <div id="_BSF_AREA" class="col-md-1 wf-left text-center">
                                    <label for=""class="form-control-label">/</label>
                                </div>

                                <div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
                                    
                                    <input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $_GET['RED_YY'] == "" ? "" : $_GET['RED_YY']; ?>">
                                    <small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                
                                </div>
                            
                            </div>

                            <!-- div class="form-group row">

                                <div id="TYPE_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="TYPE"class="form-control-label wf-right">ประเภทสำนวน</label>
                                
                                </div>

                                <div id="TYPE_BSF_AREA" class="col-md-3 wf-left">
                                    
                                    <select name="TYPE" id="TYPE" class="form-control select2" >
                                        <option value="" disabled selected>กรุณาเลือก</option>
                                        <option value="">WS-CIVIL-01-001: civilCaseDetail  </option>
                                        <option value="">WS-BANKRUPT-02-001 : bankruptCaseDetail </option>
                                        <option value="">WS-04-001 : MediateCaseDetail </option>
                                        <option value="">WS-03-001 : DebtRehabilitationCaseDetail</option>
                                    </select>
                                
                                </div>
                            
                            </div -->

                            <div class="form-group row">

                                <div class="col-md-12 text-center">

                                    <button type="submit" name="wf_search" id="wf_search" class="btn btn-info">

                                        <i class="icofont icofont-search-alt-2"></i> ค้นหา

                                    </button>&nbsp;&nbsp;

                                    <button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onclick="window.location.href='check_execution.php';">
                                    
                                        <i class="zmdi zmdi-refresh-alt"></i> Reset
                                    
                                    </button>

                                    <input type="hidden" name="W" id="W" value="51"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">

                                </div>

                            </div>

                        </form>

                    </div>

                    <?php
                    if($_GET['WF_SEARCH'] == "Y"){


                        //FOR API
                        $field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
                        $field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

                        $count_case = 0;
                        $all_case = array();
                        $filter = "";

                        /* 
                        PREFIX_BLACK_CASE=%E0%B8%9C%E0%B8%9A
                        &BLACK_CASE=99881
                        &BLACK_YY=2563
                        &PREFIX_RED_CASE=
                        &RED_CASE=&RED_YY=
                        &wf_search=
                        &W=51
                        &WF_SEARCH=Y# 
                        */

                        

                        if($_GET['PREFIX_BLACK_CASE']){

                            $filter .= " AND PREFIX_BLACK_CASE = '".$_GET['PREFIX_BLACK_CASE']."'";
                            $field['PREFIX_BLACK_CASE'] = $_GET['PREFIX_BLACK_CASE'];

                        }

                        if($_GET['BLACK_CASE']){

                            $filter .= " AND BLACK_CASE = '".$_GET['BLACK_CASE']."'";
                            $field['BLACK_CASE'] = $_GET['BLACK_CASE'];

                        }

                        if($_GET['BLACK_YY']){

                            $filter .= " AND BLACK_YY = '".$_GET['BLACK_YY']."'";
                            $field['BLACK_YY'] = $_GET['BLACK_YY'];

                        }

                        /*

                        if(){
                        }

                        if(){
                        }

                        if(){
                        }

                        COURT_NAME	
                        DEPT_NAME	
                        PREFIX_BLACK_CASE
                        BLACK_CASE	
                        BLACK_YY	
                        PREFIX_RED_CASE
                        RED_CASE	
                        RED_YY	


                        */

                        //WH_CIVIL_CASE
                        $sql_civil = "SELECT * FROM WH_CIVIL_CASE WHERE 1 = 1".$filter;
                        $qry_civil = db::query($sql_civil);
                        $num_civil = db::num_rows($qry_civil);
                        if($num_civil > 0){

                            while($rec_civil = db::fetch_array($qry_civil)){

                                $all_case[$count_case]['NO'] = ++$count_case;
                                $all_case[$count_case]['COURT'] = $rec_civil['COURT_NAME'];
                                $all_case[$count_case]['BLACK'] = $rec_civil['PREFIX_BLACK_CASE'].$rec_civil['BLACK_CASE']."/".$rec_civil['BLACK_YY'];
                                $all_case[$count_case]['RED'] = $rec_civil['PREFIX_RED_CASE'].$rec_civil['RED_CASE']."/".$rec_civil['RED_YY'];

                                for($i = 1;$i <= 3;$i++){

                                    $all_case[$count_case]['PLAINTIFF'][] = $rec_civil['PLAINTIFF'.$i];
                                    $all_case[$count_case]['DEFENDANT'][] = $rec_civil['PLAINTIFF'.$i];
                                    
                                }
            
                            }

                        }else{
                            
                        }

                        //WH_BANKRUPT_CASE_DETAIL
                        $sql_bankrupt = "SELECT * FROM WH_BANKRUPT_CASE_DETAIL WHERE 1 = 1".$filter;
                        $qry_bankrupt = db::query($sql_bankrupt);
                        if($num_bankrupt > 0){

                            while($rec_bankrupt = db::fetch_array($qry_bankrupt)){

                                $all_case[$count_case]['NO'] = ++$count_case;
                                $all_case[$count_case]['COURT'] = $rec_bankrupt['COURT_NAME'];
                                $all_case[$count_case]['BLACK'] = $rec_bankrupt['PREFIX_BLACK_CASE'].$rec_bankrupt['BLACK_CASE']."/".$rec_bankrupt['BLACK_YY'];
                                $all_case[$count_case]['RED'] = $rec_bankrupt['PREFIX_RED_CASE'].$rec_bankrupt['RED_CASE']."/".$rec_bankrupt['RED_YY'];
                                
                                for($i = 1;$i <= 3;$i++){

                                    $all_case[$count_case]['PLAINTIFF'][] = $rec_bankrupt['PLAINTIFF'.$i];
                                    $all_case[$count_case]['DEFENDANT'][] = $rec_bankrupt['PLAINTIFF'.$i];
                                    
                                }
            
                            }

                        }else{
                            
                        }

                        //WH_MEDIATE_CASE
                        //WH_MEDIATE_CASE_DETAIL
                        $sql_mediate = "SELECT * FROM WH_MEDIATE_CASE_DETAIL WHERE 1 = 1".$filter;
                        $qry_mediate = db::query($sql_mediate);
                        if($num_mediate > 0){

                            while($rec_mediate = db::fetch_array($qry_mediate)){

                                $all_case[$count_case]['NO'] = ++$count_case;
                                $all_case[$count_case]['COURT'] = $rec_mediate['COURT_NAME'];
                                $all_case[$count_case]['BLACK'] = $rec_mediate['PREFIX_BLACK_CASE'].$rec_mediate['BLACK_CASE']."/".$rec_mediate['BLACK_YY'];
                                $all_case[$count_case]['RED'] = $rec_mediate['PREFIX_RED_CASE'].$rec_mediate['RED_CASE']."/".$rec_mediate['RED_YY'];
                                
                                for($i = 1;$i <= 3;$i++){

                                    $all_case[$count_case]['PLAINTIFF'][] = $rec_mediate['PLAINTIFF'.$i];
                                    $all_case[$count_case]['DEFENDANT'][] = $rec_mediate['PLAINTIFF'.$i];
                                    
                                }
            
                            }

                        }else{

                        }

                        //WH_REHABILITATION_DEBTOR
                        $sql_debt = "SELECT * FROM WH_REHABILITATION_DEBTOR WHERE 1 = 1".$filter;
                        $qry_debt = db::query($sql_debt);
                        if($num_debt > 0){

                            while($rec_debt = db::fetch_array($qry_debt)){

                                $all_case[$count_case]['NO'] = ++$count_case;
                                $all_case[$count_case]['COURT'] = $rec_debt['COURT_NAME'];
                                $all_case[$count_case]['BLACK'] = $rec_debt['PREFIX_BLACK_CASE'].$rec_debt['BLACK_CASE']."/".$rec_debt['BLACK_YY'];
                                $all_case[$count_case]['RED'] = $rec_debt['PREFIX_RED_CASE'].$rec_debt['RED_CASE']."/".$rec_debt['RED_YY'];
                                
                                for($i = 1;$i <= 3;$i++){

                                    $all_case[$count_case]['PLAINTIFF'][] = $rec_debt['PLAINTIFF'.$i];
                                    $all_case[$count_case]['DEFENDANT'][] = $rec_debt['PLAINTIFF'.$i];
                                    
                                }
            
                            }

                        }else{
                            
                        }

                        //TEST
                        //WH_CIVIL_CASE
                        $sql_civil = "SELECT * FROM WH_CIVIL_CASE WHERE 1 = 1".$filter;
                        $qry_civil = db::query($sql_civil);
                        $num_civil = db::num_rows($qry_civil);
                        if($num_civil > 0){

                            while($rec_civil = db::fetch_array($qry_civil)){

                                $all_case[$count_case]['NO'] = ++$count_case;
                                $all_case[$count_case]['COURT'] = $rec_civil['COURT_NAME'];
                                $all_case[$count_case]['BLACK'] = $rec_civil['PREFIX_BLACK_CASE'].$rec_civil['BLACK_CASE']."/".$rec_civil['BLACK_YY'];
                                $all_case[$count_case]['RED'] = $rec_civil['PREFIX_RED_CASE'].$rec_civil['RED_CASE']."/".$rec_civil['RED_YY'];

                                for($i = 1;$i <= 3;$i++){

                                    $all_case[$count_case]['PLAINTIFF'][] = $rec_civil['PLAINTIFF'.$i];
                                    $all_case[$count_case]['DEFENDANT'][] = $rec_civil['PLAINTIFF'.$i];
                                    
                                }
            
                            }

                        }else{
                            
                        }


                        $curl = curl_init();

                        curl_setopt_array($curl
                            , array(
                                CURLOPT_URL => "http://103.40.146.73/ledservicelaw.php/civilCaseDetail",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS =>"{\r\n    \"USERNAME\" : \"BankruptDt\"\r\n    , \"PASSWORD\" : \"Debtor4321\"\r\n    , \"PREFIX_BLACK_CASE\" : \"ผบ\"\r\n    , \"BLACK_CASE\" : \"98441\"\r\n    , \"BLACK_YY\" : \"2563\"\r\n\r\n}",
                                CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/json",
                                    "Cookie: PHPSESSID=qmt1ho6dir2ut37e17o9llla56"
                                ),
                            )
                        );

                        $response = curl_exec($curl);

                        curl_close($curl);
                        echo $response;







                    ?>

                    <pre>
                    <?php print_r($field); ?>
                    </pre>

                    <div class="card-block">

                        <div class="f-right"> </div>

                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                            <div class="showborder">

                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                                    <thead class="bg-primary">

                                        <tr class="bg-primary">

                                            <th style="width: 5%;" class="text-center">

                                                <nobr>
                                                    <a href="master_main.php?&W=51&wf_order=SERVICE_MANAGE_ID&wf_order_type=ASC"class="">
                                                        ลำดับ <i class="zmdi zmdi-caret-up"></i>
                                                    </a>
                                                </nobr>

                                            </th>

                                            <th style="width:;" class="text-center">ศาล</th>
                                            <th style="width:;" class="text-center">หมายเลขคดีดำที่</th>
                                            <th style="width:;" class="text-center">หมายเลขคดีแดงที่</th>
                                            <th style="width:;" class="text-center">โจทก์</th>
                                            <th style="width:;" class="text-center">จำเลย</th>
                                            <th style="width: 10%;text-align:center;" class="td_remove"></th>

                                        </tr>
                                        
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach($all_case as $key => $val){
                                        ?>

                                        <tr id="tr">

                                            <td style="text-align:center;"><?php echo $val['NO']; ?></td>
                                            <td class=""><?php echo $val['COURT']; ?></td>
                                            <td class=""><?php echo $val['BLACK']; ?></td>
                                            <td class=""><?php echo $val['RED']; ?></td>
                                            <td class=""><?php echo $val['']; ?></td>
                                            <td class=""><?php echo $val['']; ?></td>
                                            <td style="text-align:center;" class="td_remove">

                                                <nobr>
                                                    
                                                    <a href="#!" class="btn btn-info btn-mini"  title="" data-toggle="modal" data-target="#bizModal" onclick="open_modal('../all_modal/modal_response_detail.php?API_NAME=<?php echo $rec['SERVICE_NAME']; ?>', '','')">
                                                        <i class="icofont icofont-ui-add"></i> ดูรายละเอียด

                                                    </a>

                                                </nobr>

                                            </td>

                                        </tr>

                                        <?php
                                        }
                                        ?>


                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                        
                    <?php
                    }
                    ?>

                </div>

            </div>

        </div>
        <!-- Workflow Row end -->

    </div>
    <!-- Container-fluid ends -->

</div>

<!-- Modal -->
<!-- div class="modal fade modal-flex" id="bizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-lg " role="detail">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn-close-modal" data-number="bizModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-close-modal" data-number="bizModal">ปิด</button>
			</div>
		</div>
	</div>
</div -->
<script>
    
    $('button.btn-close-modal').click(function() {
        
        var modal_number = $(this).attr('data-number');
		var modal_id = $(this).parents(':eq(3)').attr('id');
		$('#' + modal_number).modal('hide');
        $('#' + modal_id + ' .modal-title, #' + modal_id + ' .modal-body').html('');
        
    });
    
</script>
<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>