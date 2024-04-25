<?php include '../include/comtop_admin.php'; 
?>
   <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <!-- Main content starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>BizSmartDiagram</h4>
                </div>
            </div>
            <!-- 4-blocks row start -->
            <div class="row">
                    <!-- Quick Note start -->
                    <div class="col-lg-4 grid-item">
                        <div class="card">
                            <div class="card-block txt-white bg-success">
                                <h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <h2 class="f-w-100"><i class="icofont icofont-chart-flow-alt-1"></i> Workflow Design</h2>
								<h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <div class="text-right">
                                    <a href="#"  class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light"  data-toggle="modal" data-target="#bizModal" onclick="open_modal('bsd_add_flow.php','Create New Workflow');">New</a> 
									<a href="workflow.php" class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Quick Note end -->
                    <!-- Resource used start -->
                    <div class="col-lg-4 grid-item">
                        <div class="card">
                            <div class="card-block txt-white bg-warning">
                                <h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <h2 class="f-w-100"><i class="zmdi zmdi-format-list-bulleted"></i> Form Design</h2>
								<h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <div class="text-right">
                                    <a href="#"  class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light"  data-toggle="modal" data-target="#bizModal" onclick="open_modal('bsd_add_form.php','Create New Form');">New</a>  <a href="form.php" class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Resource used end -->
                    <!-- Quick Note start -->
                    <div class="col-lg-4 grid-item">
                        <div class="card">
                            <div class="card-block txt-white bg-danger">
                                <h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <h2 class="f-w-100"><i class="fa fa-table"></i> Master Design</h2>
								<h6 class="m-b-20 txt-white">&nbsp;</h6>
                                <div class="text-right">
                                    <a href="#"  class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light"  data-toggle="modal" data-target="#bizModal" onclick="open_modal('bsd_add_master.php','Create New Master');">New</a>  <a href="master.php" class="btn btn-mini btn-inverse-default quick-save-btn waves-effect waves-light">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Quick Note end -->
                </div>

            <!-- 4-blocks row end -->
			      
        </div>
        <!-- Main content ends -->



        <!-- Container-fluid ends -->
    </div>
</div>


<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
