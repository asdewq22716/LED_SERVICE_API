<?php
include '../include/comtop_admin.php';
$p_name_main = 'บริหาร Menu';
//db::query("DELETE FROM WF_MENU_TEMP");
$sql_load = db::query("SELECT * FROM WF_MENU ORDER BY MENU_ID");
while($M = db::fetch_array($sql_load)){
	$insert_wf = array();
	foreach($M as $key=>$val){
		if(!is_numeric($key)){
		$insert_wf[$key] = $val;
		}
	}
	//db::db_insert("WF_MENU_TEMP", $insert_wf, "MENU_ID");
	unset($insert_wf);
}

function get_menu($m_id){
	if($m_id == "" OR $m_id == "0"){
		$parent = " AND (MENU_PARENT IS NULL OR MENU_PARENT = '' OR MENU_PARENT = '0') ";
	}else{
		$parent = " AND MENU_PARENT = '".$m_id."' ";
	}
	$sql_menu_group = db::query("SELECT * FROM WF_MENU_TEMP WHERE MENU_STATUS = 'Y' ".$parent." ORDER BY MENU_ORDER");
	$rows = db::num_rows($sql_menu_group);
	if($rows > 0){
		echo "<ul>";
			while($M = db::fetch_array($sql_menu_group)){
				echo "<li id=\"".$M["MENU_ID"]."\" data-jstree='{\"opened\":true}'> ".$M["MENU_NAME"];
				get_menu($M["MENU_ID"]);
				echo "</li>";
			}
		echo "</ul>";
	}
}



?>
<!-- Treeview css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/tree-view/css/treeview.css">
	<!-- Range slider css -->
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $p_name_main; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="menu_group_list.php"><?php echo $p_name_main; ?></a>
							</li>
							<li class="breadcrumb-item">
								<a href="">เลือกข้อมูล</a>
							</li>
						</ol>
					</div>
				</div>
				<div class="col-sm-4">
				</div>
			</div>
			<!-- Row end -->
			<form action="<?php echo $p_url; ?>" method="post">
				<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
				<!-- Row Starts -->
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h5 class="card-header-text">
									<i class="icofont icofont-ui-folder"></i> กลุ่มเมนู
								</h5>
								<div class="f-right">
									<a href="#primary" class="btn btn-success btn-mini" onclick="menu_create();" role="button">
										<i class="icofont icofont-ui-add"></i> เพิ่ม
									</a>
									<a href="#primary" class="btn btn-success btn-mini" onclick="menu_create_more();" role="button">
										<i class="icofont icofont-ui-add"></i> เพิ่ม...
									</a>
									<a href="#primary" class="btn btn-danger btn-mini" onclick="menu_delete();" role="button">
										<i class="icofont icofont-trash"></i> ลบ
									</a>
								</div> 

							</div>
							<div class="card-block">

								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div id="dragTree">
											<?php get_menu(''); ?>
										</div>
										<div class="row div col-md-12" id="jstree_json"></div>
									</div>
								</div> 
							</div>
							<div class="card-header">
								<div class="col-md-12 text-center">
								<div id="event_result"></div>
									<input type="hidden" name="menu_json" id="menu_json" value="">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก"/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end -->
			</form>
			<!-- Container-fluid ends -->
		</div>
	</div>
	<div id="event_result"></div>
<?php include '../include/combottom_js.php'; ?>
<script src="../assets/plugins/tree-view/js/jstree.min.js"></script> 
<script>
$( document ).ready(function() {
    $('#dragTree').jstree({
		'core' : {
			'check_callback' : true,
			'themes' : {
				'responsive': true
			}
		},
        'types' : {
            'default' : {
                'icon' : 'icofont icofont-folder'
            },
            'file' : {
                'icon' : 'icofont icofont-file-alt'
            }
        },
        'plugins' : [
	"contextmenu",
	"dnd",
	"massload",
	"search",
	"state",
	"types",
	"changed",
	"conditionalselect"
]

    })
	.on('move_node.jstree', function (e, data) {
		$.get('workflow_menu_ajax.php', { 'Flag' : 'Move','id' : data.node.id, 'parent_id' : data.parent, 'position' : data.position })
			.done(function (d) {
				data.instance.open_node(data.parent); 
			})
			.fail(function () {
				data.instance.refresh();
			});
	})
	.on('rename_node.jstree', function (e, data) {
		$.get('workflow_menu_ajax.php', { 'Flag' : 'Rename','id' : data.node.id, 'text' : data.text })
			.done(function (d) {
				data.instance.set_id(data.node, d.id);
			})
			.fail(function () {
				data.instance.refresh();
			});
	})
	.on('delete_node.jstree', function (e, data) {
		$.get('workflow_menu_ajax.php', { 'Flag' : 'Remove','id' : data.node.id })
			.fail(function () {
				data.instance.refresh();
			});
	})
	.on('create_node.jstree', function (e, data) { 
	if(!(data.node.id > 0)){
		$.get('workflow_menu_ajax.php', { 'Flag' : 'Add', 'parent_id' : data.node.parent, 'text' : data.node.text })
			.done(function (d) {
				data.instance.set_id(data.node, d.id);
			});
	} 
	});

});
  $('#dragTree').on('changed.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).id);
    } 
    $('#event_result').html('Selected: ' + r.join(', '));
  });
  
  function menu_create() {
		var ref = $('#dragTree').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { 
			sel = ref.create_node(null, {"text":"เมนู","opened":"true"}); 
		}else{
			sel = sel[0];
			sel = ref.create_node(sel, {"text":"เมนู","opened":"true"});
		}
		if(sel) {
			ref.edit(sel);
		}
	};
	function menu_create_more() {
		var ref = $('#dragTree').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }else{ 
			$('#bizModal').modal('show');
			$('#bizModal .modal-title').text("เพิ่มเมนู");
			$('#bizModal .modal-body').load('workflow_menu_list.php?MENU_ID='+sel);
			$('#bizModal').modal('show');
		}
	};
	function menu_delete() {
		
		var ref = $('#dragTree').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		if(confirm("คุณต้องการลบรายการนี้หรือไม่?")){
		ref.delete_node(sel);
		}
	};

	/*function jsonify() {
		var $this = $(this);
		return {
			id: $this.attr('id'),
			children: $this.find('ul > li').map(jsonify).get()
		};
	}

	$('#dragTree').click(function(){
		var json_list = $('#dragTree > ul > li').map(jsonify).get();

		var url = "workflow_menu_ajax.php";
		var dataString = {data_json: JSON.stringify(json_list)};
		$.post(url, dataString, function(msg){
			$('#jstree_json').html(msg);
		});

		$('#menu_json').val(JSON.stringify(json_list));
	});

	$(document).ready(function(){
		$('#dragTree').trigger('click');
	});*/
</script>
<?php include '../include/combottom_admin.php'; ?>