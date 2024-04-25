<?php 

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$ID = $_POST['ID'];

$sql = "SELECT * FROM M_SERVICE WHERE SERVICE_ID  = '".$ID."'";
$qry = db::query($sql);
$rec = db::fetch_array($qry);

?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_service_detail"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row" id="animationSandbox">
                    <div class="col-sm-12">
                        <div class="main-header">
                            <div class="media m-b-12">
                                <!-- a class="media-left">
                                    <img src="../icon/icon15.png" class="media-object"> 
                                </a -->
                                <div class="media-body text-left">
                                    <!-- h4 class="m-t-5">&nbsp;</h4 -->
                                    <h4 class="text-left">รายละเอียดบริการของ ฐานข้อมูล</h4>

                                    <br><br><br>
                                    
                                    <h5 class="text-left">• ค้นหาด้วยเลขประจำตัวประชาชน</h5>
                                     
                                    รูปแบบ 
                                    <label class="label bg-primary">5000 [0]</label>
                                    <label class="label bg-success">T [0]</label>
                                    <label class="label bg-warning">Office ID [0]</label>
                                    <label class="label bg-danger">Service Version [0]</label>
                                    <label class="label bg-info">Service ID [0]</label>
                                    <label class="label bg-inverse">PID [0]</label>

                                    <br><br><br>

                                    <h5 class="text-left">• พจนานุกรมข้อมูลที่ตอบกลับ</h5>
                                    
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- div class="card-header">
                            </div -->
                            <div class="card-block">

                                <div class="f-right">
                                </div>

                                <div class="table-responsive" data-pattern="priority-columns" id="export_data">
                                    <div class="showborder">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                            <thead class="bg-primary">
                                                <tr class="bg-primary">
                                                    <th style="width: 5%;" class="text-center">ลำดับ</th>
                                                    <th style="width:;" class="text-center">Key</th>
                                                    <th style="width:;" class="text-center">Type</th>
                                                    <th style="width:;" class="text-center">รายละเอียด</th>
                                                </tr>
                                            </thead> 
                                            <tbody id="body_<?php echo $ID; ?>">
                                            </tbody>                                                                                             
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        
        $.ajax({

            type: "POST",
            url: "../api/services/<?php echo $rec['SERVICE_URL']; ?>",
            data: "data",
            dataType: "JSON",
            success: function (res) {

                var html = "";
                var no = 0;

                for(var k in res.response) {

                    no++;

                    html += '<tr>';
                    html += '    <td class="text-center">'+no+'</td>';
                    html += '    <td class="text-left">data.'+k+'</td>';
                    html += '    <td class="text-left">'+res.response[k].TYPE+'</td>';
                    html += '    <td class="text-left">'+res.response[k].DESC+'</td>';
                    html += '</tr>';
            
                }

                $('#body_<?php echo $ID; ?>').html(html);

            }
        });

    });

</script>

<?php
//include '../include/combottom_user.php';
//include '../include/combottom_js_user.php';
?>
