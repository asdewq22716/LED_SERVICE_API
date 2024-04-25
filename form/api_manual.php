<?php

//$HIDE_HEADER = 'Y';
include "../include/comtop_user.php";

?>
<style>
    .card-header {
        border-bottom: 0px;
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
                            <h4>ระบบ API Manual</h4>

                        </div>

                    </div>

                    <div class="f-right">
                        <a class="btn btn-primary" href="../form/api_manual_word_all.php?SERVICE_SYSTEM=<?php echo $_GET['SERVICE_SYSTEM']; ?>" role="button" title="" target="_blank">
                            <i class="fa fa-file-word-o"></i> export
                        </a>
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

                                <div id="SERVICE_CODE_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="SERVICE_CODE" class="form-control-label wf-right">SERVICE_CODE</label>

                                </div>

                                <div id="SERVICE_CODE_BSF_AREA" class="col-md-2 wf-left">

                                    <input type="text" name="SERVICE_CODE" id="SERVICE_CODE" class="form-control" value="<?php echo $_GET['SERVICE_CODE'] == "" ? "" : $_GET['SERVICE_CODE']; ?>">
                                    <small id="DUP_SERVICE_CODE_ALERT" class="form-text text-danger" style="display:none"></small>

                                </div>


                                <div id="SERVICE_NAME_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="SERVICE_NAME" class="form-control-label wf-right">ชื่อ SERVICE</label>

                                </div>

                                <div id="SERVICE_NAME_BSF_AREA" class="col-md-2 wf-left">

                                    <input type="text" name="SERVICE_NAME" id="SERVICE_NAME" class="form-control" value="<?php echo $_GET['SERVICE_NAME'] == "" ? "" : $_GET['SERVICE_NAME']; ?>">
                                    <small id="DUP_SERVICE_NAME_ALERT" class="form-text text-danger" style="display:none"></small>

                                </div>

                            </div>

                            <div class="form-group row">

                                <div id="SERVICE_SYSTEM_BSF_AREA" class="col-md-2  offset-md-1">

                                    <label for="SERVICE_SYSTEM" class="form-control-label wf-right">ระบบ</label>

                                </div>

                                <div id="SERVICE_SYSTEM_BSF_AREA" class="col-md-2 wf-left">

                                    <select name="SERVICE_SYSTEM" id="SERVICE_SYSTEM" class="form-control select2">
                                        <option value="" selected disabled>เลือก</option>
                                        <?php
                                        $sql_sys = "SELECT * FROM M_CMD_SYSTEM WHERE CMD_SYSTEM_ID NOT IN (5,6) ORDER BY CMD_SYSTEM_ID ASC";
                                        $qry_sys = db::query($sql_sys);
                                        while ($rec_sys = db::fetch_array($qry_sys)) {
                                        ?>
                                            <option value="<?php echo $rec_sys["CMD_SYSTEM_ID"]; ?>" <?php echo $_GET['SERVICE_SYSTEM'] == $rec_sys["CMD_SYSTEM_ID"] ? "selected" : ""; ?>><?php echo $rec_sys["SERVICE_SYS_NAME"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div id="SERVICE_DESC_BSF_AREA" class="col-md-2 offset-md-1">

                                    <label for="SERVICE_DESC" class="form-control-label wf-right">คำอธิบาย Service</label>

                                </div>

                                <div id="SERVICE_DESC_BSF_AREA" class="col-md-2 wf-left">

                                    <input type="text" name="SERVICE_DESC" id="SERVICE_DESC" class="form-control" value="<?php echo $_GET['SERVICE_DESC'] == "" ? "" : $_GET['SERVICE_DESC']; ?>">
                                    <small id="DUP_SERVICE_DESC_ALERT" class="form-text text-danger" style="display:none"></small>

                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-md-12 text-center">
                                    <?php if ($_GET['devMode'] == 'D') { ?>
                                        <input type="hidden" name="devMode" id="devMode" value="<?php echo $_GET['devMode']; ?>">
                                    <?php } ?>
                                    <button type="submit" name="wf_search" id="wf_search" class="btn btn-info">

                                        <i class="icofont icofont-search-alt-2"></i> ค้นหา

                                    </button>&nbsp;&nbsp;

                                    <button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onclick="window.location.href='api_manual.php';">

                                        <i class="zmdi zmdi-refresh-alt"></i> Reset

                                    </button>

                                    <input type="hidden" name="W" id="W" value="51"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">

                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="card-block">

                        <div class="f-right"> </div>

                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                            <div class="showborder">

                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                                    <thead class="bg-primary">

                                        <tr class="bg-primary">

                                            <th style="width: 5%;" class="text-center">

                                                <nobr>
                                                    <a href="master_main.php?&W=51&wf_order=SERVICE_MANAGE_ID&wf_order_type=ASC" class="">ลำดับ <i class="zmdi zmdi-caret-up"></i></a>
                                                </nobr>
                                            </th>
                                            <th style="width:;" class="text-center">Service Code</th>
                                            <th style="width:;" class="text-center">ชื่อ Service</th>
                                            <th style="width:;" class="text-center">คำอธิบาย Service </th>
                                            <th style="width:;" class="text-center">ระบบงาน</th>
                                            <th style="width: 10%;text-align:center;" class="td_remove"></th>

                                        </tr>

                                    </thead>
                                    <tbody>

                                        <?php

                                        if ($_GET["WF_SEARCH"] == "Y") {

                                            $fileter = "";

                                            if ($_GET['SERVICE_CODE']) {

                                                $filter .= " AND A.SERVICE_CODE LIKE '%" . $_GET['SERVICE_CODE'] . "%'";
                                            }

                                            if ($_GET['SERVICE_NAME']) {

                                                $filter .= " AND A.SERVICE_NAME LIKE '%" . $_GET['SERVICE_NAME'] . "%'";
                                            }

                                            if ($_GET['SERVICE_SYSTEM']) {

                                                $filter .= " AND A.SYS_NAME = '" . $_GET['SERVICE_SYSTEM'] . "'";
                                            }

                                            if (trim($_GET['SERVICE_DESC'])) {

                                                $filter .= " AND A.SERVICE_DESC LIKE '%" . $_GET['SERVICE_DESC'] . "%'";
                                            }
                                        }

                                        $sql =
                                            "SELECT
                                                A.*,B.API_SETTING_ID
                                            FROM
                                                M_SERVICE_MANAGE A
                                                LEFT JOIN M_API_SETTING B ON B.SERVICE_ID = A.SERVICE_MANAGE_ID
                                            WHERE
                                                1 = 1 AND A.SERVICE_STATUS = '1' $filter
                                                AND B.API_STATUS = '1' AND B.EXPORT_REPORT = '1'
                                            ORDER BY 
                                                A.SERVICE_CODE ASC ";

                                        $qry = db::query($sql);
                                        $i = 0;
                                        while ($rec = db::fetch_array($qry)) {
                                        ?>
                                            <tr id="tr">
                                                <td style="text-align:center;"><?php echo ++$i; ?></td>
                                                <td class=""><?php echo $rec["SERVICE_CODE"]; ?></td>
                                                <td class=""><?php echo $rec["SERVICE_NAME"]; ?></td>
                                                <td class=""><?php echo $rec["SERVICE_DESC"]; ?></td>
                                                <td class=""><?php echo getSystem($rec["SYS_NAME"]); ?></td>
                                                <td style="text-align:center;" class="td_remove">
                                                    <nobr>
                                                        <a href="#!" class="btn btn-info btn-mini" title="" data-toggle="modal" data-target="#bizModal" onclick="open_modal('../all_modal/modal_response_detail.php?API_NAME=<?php echo $rec['SERVICE_NAME']; ?>&SETTING_ID=<?php echo $rec['API_SETTING_ID']; ?>', '','')">
                                                            <i class="icofont icofont-ui-search"></i> ดูรายละเอียด
                                                        </a>
                                                        <?php if ($_GET['devMode'] == 'D') { ?>
                                                            <a class="btn btn-success btn-mini" href="../form/api_manual_info.php?SERVICE_ID=<?php echo $rec['SERVICE_MANAGE_ID'] ?>&devMode=D">
                                                                <i class="icofont icofont-ui-edit"></i> จัดการ API
                                                            </a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-success btn-mini" href="../form/api_manual_info.php?SERVICE_ID=<?php echo $rec['SERVICE_MANAGE_ID'] ?>">
                                                                <i class="icofont icofont-ui-edit"></i> จัดการ API
                                                            </a>
                                                        <?php } ?>
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