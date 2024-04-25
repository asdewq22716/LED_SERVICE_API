<?php 

if($WF['REQUEST'] != 'verifyPerson' && $WF['REQUEST'] != 'insert_cmd_noti' ){ 
    // print_r($WF);
    ?>
 </div></div>
        
    <br>
     
            <div class="table-responsive" data-pattern="priority-columns" id="export_data">
            <h6>REQUEST</h6>
                <div  class="col-md-12 wf-left " >
                    <table class="table table-bordered sorted_table">
                        <thead class="bg-primary">
                            <tr class="bg-primary">
                                <th width="3%">ลำดับ</th>
                                <th width="5%">REQUEST_NAME</th>
                                <th width="15%">REQUEST_DATA</th>
                            </tr>
                        </thead>  
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM M_LOG_REQUEST WHERE LOG_ID = '".$WF['LOG_ID']."'";
                                $query = db::query($sql);
                                $i = 0;
                                while($data = db::fetch_array($query)){ 
                                        $i++;
                                    
                                    ?>
                                    <tr>
                                        <td style="width:;" class="text-center"><?php echo $i;?></td>
                                        <td style="width:;" class="text-left"><?php echo $data['REQUEST_NAME'];?></td>
                                        <td style="width:;" class="text-left"><?php echo $data['REQUEST_DATA'];?></td>
                                    </tr>
                                <?php 
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <h6>RESPONSE</h6>

            <div class="table-responsive" data-pattern="priority-columns" id="export_data" align="center" >
                <div  class="col-md-12 wf-left " >
                    <table class="table table-bordered sorted_table">
                        <thead class="bg-primary">
                            <tr class="bg-primary">
                                <th width="3%">ลำดับ</th>
                                <th width="5%">RESPONSE_NAME</th>
                                <th width="15%">RESPONSE_DATA</th>
                            </tr>
                        </thead>  
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM M_LOG_RESPONSE WHERE LOG_ID = '".$WF['LOG_ID']."'";
                                $query = db::query($sql);
                                $num = db::num_rows($sql);
                                $i = 0;
                                if($num > 0){
                                    while($data = db::fetch_array($query)){ 
                                            $i++;
                                        
                                        ?>
                                        <tr>
                                            <td style="width:;" class="text-center"><?php echo $i;?></td>
                                            <td style="width:;" class="text-left"><?php echo $data['RESPONSE_NAME'];?></td>
                                            <td style="width:;" class="text-left"><?php echo $data['RESPONSE_DATA'];?></td>
                                        </tr>
                                    <?php 
                                    } 
                                } else { ?>

                                        <tr>
                                            <td align="center" colspan="3"><b>ไม่พบข้อมูล</b></td>
                                        </tr>


                                    <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
    <?php  
} 
?>


