<?php
include '../include/comtop_admin.php';

$p_name = "หน่วยงาน";
$p_url = "department";
$sql = db::query("select * from USR_DEPARTMENT ORDER BY DEP_ORDER ASC");

function get_menu($m_id){
	if($m_id == "" OR $m_id == "0"){
		$parent = " AND (DEPT_PARENT_ID IS NULL OR DEPT_PARENT_ID = '' OR DEPT_PARENT_ID = '0') ";
	}else{
		$parent = " AND DEPT_PARENT_ID = '".$m_id."' ";
	}
	$sql_menu_group = db::query("SELECT * FROM USR_DEPARTMENT WHERE DEP_STATUS = 'Y' ".$parent." ORDER BY DEP_ORDER ASC");
	$rows = db::num_rows($sql_menu_group);
	if($rows > 0){
		echo "<ul>";
			while($M = db::fetch_array($sql_menu_group)){
				if($M['DEPT_PARENT_ID']!=""){ $flag="folder"; }else{ $flag = "folder"; }
				echo "<li id=\"".$M["DEP_ID"]."\" data-jstree='{\"opened\":true,\"type\":\"".$flag."\"}'>".$M["DEP_NAME"];
				get_menu($M["DEP_ID"]);
				echo "</li>";
			}
		echo "</ul>";
	}
}
?>
<style>
	.move-td{
		cursor: move;
	}
</style>
	<!-- Range slider css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/tree-view/css/treeview.css">
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $p_name; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $p_url; ?>_list.php">บริหารข้อมูล</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="icofont icofont-ui-folder"></i> <?php echo $p_name; ?>
							</h5>
							<div class="f-right">
								<button id="menu_create_g" class="btn btn-success btn-mini" onclick="menu_create();" role="button">
									<i class="icofont icofont-ui-add"></i> เพิ่มหน่วยงาน
								</button>
								<button id="menu_del" class="btn btn-danger btn-mini" onclick="menu_delete();" role="button">
									<i class="icofont icofont-trash"></i> ลบ
								</button>
							</div> 
						</div>
						<div class="card-block">
							<div class="table-responsive" data-pattern="priority-columns">
								<div id="dragTree">
									<?php get_menu(''); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="DEP_DETAIL" class="col-md-6"></div>
			</div>
			<!-- Row end -->
			<!-- Container-fluid ends -->
		</div>
	</div>
<?php include '../include/combottom_js.php'; ?>
<script src="../assets/plugins/tree-view/js/jstree.min.js"></script> 
<script src='../assets/js/jquery-sortable.js'></script>
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
            'folder' : {
                'icon' : 'icofont icofont-folder'
            },
            'file' : {
                'valid_children' : [],'icon' : 'icofont icofont-file-alt'
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
		],
		'contextmenu' : {
			'items' : function(node) {
				var tmp = $.jstree.defaults.contextmenu.items();
				delete tmp.create.action;
				delete tmp.ccp;
				tmp.create.label = "เพิ่ม";
				tmp.rename.label = "แก้ไข";
				tmp.remove.label = "ลบ";
				tmp.create.submenu = {
					"create_folder" : {
						"separator_after"	: true,
						"label"				: "หน่วยงาน",
						"action"			: function (data) {
							var inst = $.jstree.reference(data.reference),
								obj = inst.get_node(data.reference);
							inst.create_node(obj, { "text":"หน่วยงาน",type : "folder" }, "last", function (new_node) {
								setTimeout(function () { inst.edit(new_node); },0);
							});
						}
					},
					/*"create_file" : {
						"label"				: "เมนู",
						"action"			: function (data) {
							var inst = $.jstree.reference(data.reference),
								obj = inst.get_node(data.reference);
							inst.create_node(obj, { "text":"เมนู",type : "file" }, "last", function (new_node) {
								setTimeout(function () { inst.edit(new_node); },0);
							});
						}
					}*/
				};
				if(this.get_type(node) === "file") {
					delete tmp.create;
				}
				return tmp;
			}
		}
    })
	.on('move_node.jstree', function (e, data) { 
		$.get('department_tree_ajax.php', { 'Flag' : 'Move','id' : data.node.id, 'parent_id' : data.parent, 'position' : data.position })
		.done(function (d) {
			data.instance.open_node(data.parent); 
		})
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('rename_node.jstree', function (e, data) {
		$.get('department_tree_ajax.php', { 'Flag' : 'Rename','id' : data.node.id, 'text' : data.text })
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('delete_node.jstree', function (e, data) {
		$.get('department_tree_ajax.php', { 'Flag' : 'Remove','id' : data.node.id })
		.done(function () {
			data.instance.open_node(data.parent); 
			$("#DEP_DETAIL").html('');
		})
		.fail(function () {
			data.instance.refresh();
			$("#DEP_DETAIL").html('');
		});
	})
	.on('create_node.jstree', function (e, data) { 
		if(!(data.node.id > 0)){ 
			$.get('department_tree_ajax.php', { 'Flag' : 'Add', 'parent_id' : data.node.parent, 'text' : data.node.text, 'type' : data.node.type })
			.done(function (d) { 
				data.instance.set_id(data.node, d.id);
				data.instance.edit(data.node);
			});
		} 
	});
	$(".dasboard-3-table-scroll").slimScroll({
		height: 400,
		size: '10px',
		allowPageScroll: true,
		wheelStep:5,
		color: '#000'
	});

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });
    var elem1 = document.querySelector('.js-dynamic-lg');
    var switchery = new Switchery(elem1, { 
		size: 'small'
    });
});

$('#dragTree').on('changed.jstree', function (e, data) {
	var menu_id = data.node.id;
	var menu_type = data.node.type;
	if(menu_type == "file"){
		//$('#menu_create_g').attr('disabled','true');
		$('#menu_create_f').attr('disabled','true');
		$('#menu_del').removeAttr('disabled');
	}else{
		//$('#menu_create_g').removeAttr('disabled');
		$('#menu_create_f').removeAttr('disabled');
		if(menu_id == ""){
			$('#menu_create_f').attr('disabled','true');
			$('#menu_del').attr('disabled','true');
		}else{
			$('#menu_create_f').removeAttr('disabled');
			$('#menu_del').removeAttr('disabled');
		}
	}
	if(menu_id != ""){
		$("#DEP_DETAIL").html('');
		$.get('department_tree_edit.php', { 'G' : menu_id, 'parent_id' : data.node.parent, 'text' : data.node.text, 'type' : data.node.type })
		.done(function (html) { 
			$("#DEP_DETAIL").html(html);
		});
	}else{
		$("#DEP_DETAIL").html('');
	}
	//$('#event_result').html('Selected: ' + menu_id+ ':' +menu_type);
});

function menu_create() {
	var ref = $('#dragTree').jstree(true),
		sel = ref.get_selected();
	if(!sel.length) {  
		sel = ref.create_node(null, {"text":"หน่วยงานหลัก","type":"folder"}); 
	}else{
		sel = sel[0];
		sel = ref.create_node(sel, {"text":"หน่วยงานหลัก","type":"folder"});
	}
	if(sel) {
		//ref.edit(sel);
	}
};

function menu_delete() {			
	var ref = $('#dragTree').jstree(true),
		sel = ref.get_selected();
	if(!sel.length) { return false; }
	swal({
		title: "",
		text: "คุณต้องการลบหน่วยงานนี้หรือไม่?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "ยืนยันการลบ",
		cancelButtonText: "ยกเลิก",
		closeOnConfirm: true
	},
	function(){
			ref.delete_node(sel);
			$('#menu_create_f').attr('disabled','true');
			$('#menu_del').attr('disabled','true');
			$("#DEP_DETAIL").html('');
	});
};
function save_to_menu(){ //Apply
	var url = "department_tree_ajax.php"; // the script where you handle the form input. 
	$.ajax({
		type: "POST",
		url: url,
		data: {'Flag':'Apply'}, 
		success: function(data)
		{ 
			swal({
			  title: "Apply ข้อมูลเรียบร้อยแล้ว", 
			  type: "success",
			  allowOutsideClick:true
			});
		}
	});
	e.preventDefault(); // avoid to execute the actual submit of the form.
}
</script>
<?php include '../include/combottom_admin.php'; ?>