<?php
include '../include/include.php';
?>
<?php if($_GET['view'] != 1){ ?>
<div class="row" id="animationSandbox">

    <div class="col-sm-12">

        <div class="main-header">

            <div class="media m-b-12">

                <!-- a class="media-left">
                    <img src="../icon/icon15.png" class="media-object">
                </a -->

                <div class="media-body text-left">

                    <!-- h4 class="m-t-5">&nbsp;</h4 -->

                    <h4 class="text-left " style="text-decoration-line:underline">Service Spec</h4>


					<br><br><br>
                    <h5 class="text-left">• Request </h5>

				</div>

			</div>

		</div>

	</div>
	
</div>

<div class="row">

    <form action="../save/save_check.php" method="POST">

	<div class="col-md-12">

        <div class="card">

            <!-- div class="card-header"></div -->
            <div class="card-block">

                <div class="f-right"></div>

                <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                    <div class="showborder">
                        <input type="hidden" name="SERVICE_MANAGE_ID" id="SERVICE_MANAGE_ID" value="<?php echo $_GET['ID'] ;?>">
						<input type="hidden" name="PRIVILEGE_GROUP_ID" id="PRIVILEGE_GROUP_ID" value="<?php echo $_GET['PRIVILEGE_GROUP_ID'] ;?>">
            <input type="hidden" name="SETTING_ID" id="SETTING_ID" value="<?php echo $_GET['SETTING_ID'] ;?>">
                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                            <thead class="bg-primary">

                                <tr class="bg-primary">

									<th style="width: 10%;" class="text-center">
									<input type="checkbox" id="chkall_request" name="checkall_request" value="1"></th>

                                    <th style="width: 10%;" class="text-center">ลำดับ</th>
                                    <th style="width: 30%;" class="text-center">Key</th>
                                    <th style="width: 20%;" class="text-center">Type</th>                              
									<th style="width: 30%;" class="text-center">รายละเอียด</th>

                                </tr>

                            </thead>
                            <tbody>

                               <?php

									$sql = "SELECT * FROM M_SERVICE_REQUEST WHERE SERVICE_MANAGE_ID = '".$_GET['ID']."'";
									$query = db::query($sql);
									$i = 1;
									$PRIVILEGE_GROUP_ID = $_GET['PRIVILEGE_GROUP_ID'];
									while($data = db::fetch_array($query)){

									$chk_eda= " ";
									$a = db::query("SELECT * FROM M_API_SPEC_REQUEST WHERE REQUEST_ID = '".$data['REQUEST_ID']."'AND MAPPING_API_ID = '".$PRIVILEGE_GROUP_ID."' AND API_SETTING_ID = '".$_GET['SETTING_ID']."'");
									$n = db::num_rows($a);
									$x = 0;
									if($n > 0){
									$chk_eda = 'checked';
									$x++;
									}

								?>

								<tr>
									<td class="text-center">
									<input <?php echo $chk_eda; ?> type="checkbox" id="chk_request" name="chk_request[]" value="<?php echo $data['REQUEST_ID'] ?>">
									<td class="text-center"><?php  echo $i; ?></td>
									<td style="width:;" class="text-left"><?php echo $data['REQUEST_NAME'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['REQUEST_TYPE'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['REQUEST_DESC'];?></td>

                                </tr>

										<script>
										
											if(<?php echo $x ?> == 0){
												
												$('[id*=chk_request]').prop('checked',true);
												
											}
											$('#chkall_request').click(function(){

											if($(this).is(':checked',true)){

												$('[id*=chk_request]').prop('checked',true);

												 }else {

															$('[id*=chk_request]').prop('checked',false);

																}

														});
									 </script>

                                <?php

                                   $i++;
								   }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
				<br><br><br>
				<h5 class="text-left">• Response</h5>
				<br>

                <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                    <div class="showborder">

                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                            <thead class="bg-primary">

                                <tr class="bg-primary">

									<th style="width: 10%;" class="text-center">
									<input type="checkbox" id="chkall_response" name="checkall_response" value="1"></th>
									<th style="width: 10%;" class="text-center">ลำดับ<?php echo $set_id;?></th>
                                    <th style="width: 30%;" class="text-center">Key</th>
                                    <th style="width: 20%;" class="text-center">Type</th>
                                    <th style="width: 30%;" class="text-center">รายละเอียด</th>


                                </tr>

                            </thead>
                            <tbody>

                             <?php

                                    $sql = "SELECT * FROM M_SERVICE_RESPONSE WHERE SERVICE_MANAGE_ID = '".$_GET['ID']."'";
									$query = db::query($sql);
									$i = 1;
									$PRIVILEGE_GROUP_ID = $_GET['PRIVILEGE_GROUP_ID'];
									while($data = db::fetch_array($query)){

									$chk_edb= " ";
									$b = db::query("SELECT * FROM M_API_SPEC_RESPONSE WHERE RESPONSE_ID = '".$data['RESPONSE_ID']."'AND MAPPING_API_ID = '".$PRIVILEGE_GROUP_ID."'");
									$n = db::num_rows($a);
									$x = 0;
									if($n > 0){
									$chk_edb = 'checked';
									$x++;
									}


									?>

								<tr>
									<td class="text-center">
									<input <?php echo $chk_edb; ?> type="checkbox" id="chk_response" name="chk_response[]" value="<?php echo $data['RESPONSE_ID']?>"></td>
									<td class="text-center"><?php  echo $i; ?></td>
									<td style="width:;" class="text-left"><?php echo $data['RESPONSE_NAME'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['RESPONSE_TYPE'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['RESPONSE_DESC'];?></td>

                                </tr>

								<script>
											// if(<?php echo $x ?> == 0){
												
												// $('[id*=chk_response]').prop('checked',true);
												
											// }
											$('#chkall_response').click(function(){

											if($(this).is(':checked',true)){

												$('[id*=chk_response]').prop('checked',true);

												 }else {

															$('[id*=chk_response]').prop('checked',false);

																}

														});
									 </script>

                            <?php  $i++; } ?>
                            </tbody>

                        </table>
							<table>

										<div style="text-align: center" class="center">

										<button type="submit" class="btn btn-success waves-effect waves-light">
										<i class="" title="" ></i> บันทึก</button>

										</div>
					</table>
                    </div>
                </div>
				</form>

            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="row" id="animationSandbox">

    <div class="col-sm-12">

        <div class="main-header">

            <div class="media m-b-12">

                <!-- a class="media-left">
                    <img src="../icon/icon15.png" class="media-object">
                </a -->

                <div class="media-body text-left">

                    <!-- h4 class="m-t-5">&nbsp;</h4 -->

                    <h4 class="text-left " style="text-decoration-line:underline">Service Spec</h4>


					<br><br><br>
                    <h5 class="text-left">• Request </h5>

				</div>

			</div>

		</div>

	</div>
	
</div>

<div class="row">

    <form action="../save/save_check.php" method="POST">

	<div class="col-md-12">

        <div class="card">

            <!-- div class="card-header"></div -->
            <div class="card-block">

                <div class="f-right"></div>

                <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                    <div class="showborder">
                        <input type="hidden" name="SERVICE_MANAGE_ID" id="SERVICE_MANAGE_ID" value="<?php echo $_GET['ID'] ;?>">
						<input type="hidden" name="PRIVILEGE_GROUP_ID" id="PRIVILEGE_GROUP_ID" value="<?php echo $_GET['PRIVILEGE_GROUP_ID'] ;?>">
            <input type="hidden" name="SETTING_ID" id="SETTING_ID" value="<?php echo $_GET['SETTING_ID'] ;?>">
                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                            <thead class="bg-primary">

                                <tr class="bg-primary">

                                    <th style="width: 10%;" class="text-center">ลำดับ</th>
                                    <th style="width: 30%;" class="text-center">Key</th>
                                    <th style="width: 20%;" class="text-center">Type</th>                              <th style="width: 30%;" class="text-center">รายละเอียด</th>

                                </tr>

                            </thead>
                            <tbody>

                               <?php
									$sql = "SELECT
												*
											FROM
												M_SERVICE_REQUEST a
											JOIN M_API_SPEC_REQUEST b ON b.REQUEST_ID = a.REQUEST_ID
											WHERE
												a.SERVICE_MANAGE_ID = '".$_GET['ID']."' 
												AND b.MAPPING_API_ID = '".$_GET['PRIVILEGE_GROUP_ID']."'";
									$query = db::query($sql);
									$i = 1;
									$num = db::num_rows($query);
									if( $num > 0 ){
										while($data = db::fetch_array($query)){

										echo "<tr>
												<td class='text-center'>".$i."</td>
												<td style='width:;' class='text-left'>".$data['REQUEST_NAME']."</td>
												<td style='width:;' class='text-left'>".$data['REQUEST_TYPE']."</td>
												<td style='width:;' class='text-left'>".$data['REQUEST_DESC']."</td>
											</tr>";
										
											$i++; 
										}
									}else{
										echo "<tr><td class='text-center' colspan='4'> - ไม่มีข้อมูล - </td></tr>";
									}
									
									?>

                            </tbody>

                        </table>
                    </div>
                </div>
				<br><br><br>
				<h5 class="text-left">• Response</h5>
				<br>

                <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                    <div class="showborder">

                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">

                            <thead class="bg-primary">

                                <tr class="bg-primary">

									<th style="width: 10%;" class="text-center">ลำดับ<?php echo $set_id;?></th>
                                    <th style="width: 30%;" class="text-center">Key</th>
                                    <th style="width: 20%;" class="text-center">Type</th>
                                    <th style="width: 30%;" class="text-center">รายละเอียด</th>


                                </tr>

                            </thead>
                            <tbody>

                             <?php

                                    $sql = "SELECT
												*
											FROM
												M_SERVICE_RESPONSE a
											JOIN M_API_SPEC_RESPONSE b ON b.RESPONSE_ID = a.RESPONSE_ID
											WHERE
												a.SERVICE_MANAGE_ID = '".$_GET['ID']."' 
												AND b.MAPPING_API_ID = '".$_GET['PRIVILEGE_GROUP_ID']."'";
									$query = db::query($sql);
									$i = 1;
									$num = db::num_rows($query);
									if( $num > 0 ){
										while($data = db::fetch_array($query)){

										echo "<tr>
												<td class='text-center'>".$i."</td>
												<td style='width:;' class='text-left'>".$data['RESPONSE_NAME']."</td>
												<td style='width:;' class='text-left'>".$data['RESPONSE_TYPE']."</td>
												<td style='width:;' class='text-left'>".$data['RESPONSE_DESC']."</td>
											</tr>";
										
											$i++; 
										}
									}else{
										echo "<tr><td class='text-center'  colspan='4'> - ไม่มีข้อมูล - </td></tr>";
									}
									
									?>
                            </tbody>

                        </table>
							<table>
					</table>
                    </div>
                </div>
				</form>

            </div>
        </div>
    </div>
</div>
<?php } ?>