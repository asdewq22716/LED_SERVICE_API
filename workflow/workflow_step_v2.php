<?php
include '../include/comtop_user.php'; 
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];


	$sql_workflow = "select * from ".$wf_table." where WFR_ID = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	
?>
<link rel="stylesheet" type="text/css" href="../assets/css/jtline.css">
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">

			<!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>">
								<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
							</a>
							<div class="media-body">
								<h4 class="m-t-5"><?php echo $rec_detail["WFD_NAME"]; ?></h4>
								<h5><?php echo $rec_main['WF_MAIN_NAME']; ?></h5>
							</div>
						</div>
						<div class="f-right">
							<?php
							if($rec_detail["WFD_BTN_ADD_STATUS"] == 'Y'){	?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home; ?>" role="button" <?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_BACK;}?>"><i class="icofont icofont-home"></i> <?php echo $WF_TEXT_DETAIL_BACK;?></a>
							<?php }?>
							
						</div>
					</div>
				</div>
			</div>

		 <!-- Row start -->
		 <div class="row">
			 <div class="col-sm-12">
				 <div class="card">
					 <!-- Timeline start -->
					 <?php if(($txt_head1 != "" OR $txt_head2 !="")){ ?><div class="card-header">
						<div align="<?php echo $align_pos[$txt_h_align1]; ?>">
						<h4><?php echo bsf_show_text($W,$WF,$txt_head1); ?></h4>
						</div>
						<div align="<?php echo $align_pos[$txt_h_align2]; ?>">
						<h5><?php echo bsf_show_text($W,$WF,$txt_head2);  ?></h5>
						</div>
					</div><?php } ?>
					 <div class="card-block">
						<div class="myjtline"></div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <!-- Row end -->

     </div>
</div>
<?php include '../include/combottom_js_user.php'; ?>
 <script src="../assets/js/jtline.js"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            var contentText = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.';

            // dataRoot : '/'
            var myMappedObject = [
                  {
                      "isSelected": "true",
                      "taskTitle": "My First Point 1",
                      "taskSubTitle": "January 16th, 2014",
                      "assignDate": "16/01/2014",
                      "taskShortDate": "16 Jan",
                      "taskDetails": "hi <span style=\"color:red\">my html content</span> other text"
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 2",
                      "taskSubTitle": "February 28th, 2014",
                      "assignDate": "16/02/2014",
                      "taskShortDate": "28 Feb",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 3",
                      "taskSubTitle": "March 20th, 2014",
                      "assignDate": "20/04/2014",
                      "taskShortDate": "20 Apr",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 4",
                      "taskSubTitle": "May 20th, 2014",
                      "assignDate": "20/05/2014",
                      "taskShortDate": "20 May",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 5",
                      "taskSubTitle": "July 9th, 2014",
                      "assignDate": "09/07/2014",
                      "taskShortDate": "09 July",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 6",
                      "taskSubTitle": "August 30th, 2014",
                      "assignDate": "30/08/2014",
                      "taskShortDate": "30 Aug",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 7",
                      "taskSubTitle": "September 15th, 2014",
                      "assignDate": "15/09/2014",
                      "taskShortDate": "15 Sep",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 8",
                      "taskSubTitle": "November 1st, 2014",
                      "assignDate": "01/11/2014",
                      "taskShortDate": "01 Nov",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 9",
                      "taskSubTitle": "December 10th, 2014",
                      "assignDate": "10/12/2014",
                      "taskShortDate": "10 Dec",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 10",
                      "taskSubTitle": "January 19th, 2015",
                      "assignDate": "19/01/2015",
                      "taskShortDate": "29 Jan",
                      "taskDetails": contentText
                  },
                  {
                      "isSelected": "",
                      "taskTitle": "My Point 11",
                      "taskSubTitle": "March 3rd, 2015",
                      "assignDate": "03/03/2015",
                      "taskShortDate": "3 Mar",
                      "taskDetails": contentText
                  }
            ];

            var jtLine = $('.myjtline').jTLine({
                callType: 'jsonObject',
                structureObj: myMappedObject,
                map: {
                    "dataRoot": "/",
                    "title": "taskTitle",
                    "subTitle": "taskSubTitle",
                    "dateValue": "assignDate",
                    "pointCnt": "taskShortDate",
                    "bodyCnt": "taskDetails"
                },
                onPointClick: function (e) {
                    console.log(e);
                }
            });
        });
    </script>
<?php include '../include/combottom_user.php'; ?>
