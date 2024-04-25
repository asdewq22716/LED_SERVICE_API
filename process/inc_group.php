<?php
$WF_TYPE = "W";
include '../include/comtop_admin.php';
$p_name_main = 'บริหาร Workflow Group';

function get_group($g_id){
	global $WF_TYPE;
	
	if($g_id == "" OR $g_id == "0"){
		$parent = " AND (GROUP_PARENT IS NULL OR GROUP_PARENT = '' OR GROUP_PARENT = '0') ";
	}else{
		$parent = " AND GROUP_PARENT = '".$g_id."' ";
	}
	$sql_wf_group = db::query("SELECT * FROM WF_GROUP WHERE WF_TYPE = '".$WF_TYPE."' AND GROUP_STATUS = 'Y' ".$parent." ORDER BY GROUP_ORDER");
	$rows = db::num_rows($sql_wf_group);
	if($rows > 0){
		echo "<ul>";
			while($M = db::fetch_array($sql_wf_group)){
				$flag = "folder";
				echo "<li id=\"".$M["GROUP_ID"]."\" data-jstree='{\"opened\":true,\"type\":\"".$flag."\"}'>".$M["GROUP_NAME"];
				get_group($M["GROUP_ID"]);
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
							<a href="inc_group.php"><?php echo $p_name_main; ?></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">จัดกลุ่ม Workflow</a>
						</li>
					</ol>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="f-right">
				</div>
			</div>
		</div>
		<!-- Row end -->  
		<!-- Row Starts -->
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header"> 
						<div class="f-right">
							<button id="group_create_g" class="btn btn-success btn-mini" onclick="group_create();" role="button">
								<i class="icofont icofont-ui-add"></i> เพิ่มกลุ่ม Workflow
							</button>
							<button id="group_del" class="btn btn-danger btn-mini" onclick="group_delete();" role="button">
								<i class="icofont icofont-trash"></i> ลบ
							</button>
						</div> 

					</div>
					<div class="card-block">
						<div class="row">
							<div class="col-md-12">
								<div class="dasboard-3-table-scroll">
									<div id="dragTree">
										<?php get_group(''); ?>
									</div>
								</div> 										
							</div>
						</div> 
					</div>
				</div>
			</div>
			
			<div id="GROUP_DETAIL" class="col-md-8"></div>
		</div> 
		<!-- Container-fluid ends -->
	</div>
</div>
<div id="event_result"></div>
<iframe id="wf_target" name="wf_target" style="width:1000px;height:100px;display:none;"></iframe>
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
						"label"				: "กลุ่ม Workflow",
						"action"			: function (data) {
							var inst = $.jstree.reference(data.reference),
								obj = inst.get_node(data.reference);
							inst.create_node(obj, { "text":"กลุ่ม Workflow",type : "folder" }, "last", function (new_node) {
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
		$.get('inc_group_ajax.php', { 'Flag' : 'Move','id' : data.node.id, 'parent_id' : data.parent, 'position' : data.position })
		.done(function (d) {
			data.instance.open_node(data.parent); 
		})
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('rename_node.jstree', function (e, data) {
		$.get('inc_group_ajax.php', { 'Flag' : 'Rename','id' : data.node.id, 'text' : data.text })
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('delete_node.jstree', function (e, data) {
		$.get('inc_group_ajax.php', { 'Flag' : 'Remove','id' : data.node.id })
		.done(function () {
			data.instance.open_node(data.parent); 
			$("#GROUP_DETAIL").html('');
		})
		.fail(function () {
			data.instance.refresh();
			$("#GROUP_DETAIL").html('');
		});
	})
	.on('create_node.jstree', function (e, data) {
		if(!(data.node.id > 0)){ 
			$.get('inc_group_ajax.php', { 'Flag' : 'Add', 'parent_id' : data.node.parent, 'text' : data.node.text, 'type' : data.node.type, 'WF_TYPE' : '<?php echo $WF_TYPE;?>' })
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
		$('#group_create_g').attr('disabled','true');
		$('#group_create_f').attr('disabled','true');
		$('#group_del').removeAttr('disabled');
	}else{
		$('#group_create_g').removeAttr('disabled');
		$('#group_create_f').removeAttr('disabled');
		if(menu_id == ""){
			$('#group_create_f').attr('disabled','true');
			$('#group_del').attr('disabled','true');
		}else{
			$('#group_create_f').removeAttr('disabled');
			$('#group_del').removeAttr('disabled');
		}
	}
	if(menu_id != ""){
		$("#GROUP_DETAIL").html('');
		$.get('inc_group_workflow_list.php', { 'G' : menu_id, 'WF_TYPE' : '<?php echo $WF_TYPE;?>' })
		.done(function (html) { 
			$("#GROUP_DETAIL").html(html);
		});
	}else{
		$("#GROUP_DETAIL").html('');
	}
	//$('#event_result').html('Selected: ' + menu_id+ ':' +menu_type);
});
function group_create() {
	var ref = $('#dragTree').jstree(true),
		sel = ref.get_selected();
	if(!sel.length) {  
		sel = ref.create_node(null, {"text":"กลุ่ม Workflow","type":"folder"}); 
	}else{
		sel = sel[0];
		sel = ref.create_node(sel, {"text":"กลุ่ม Workflow","type":"folder"});
	}
	if(sel) {
		//ref.edit(sel);
	}
};
function group_create_more() {
	var ref = $('#dragTree').jstree(true),
		sel = ref.get_selected();
	if(!sel.length) { return false; }else if(sel.type != "file"){ 
		$('#bizModal').modal('show');
		$('#bizModal .modal-title').text("เพิ่ม Workflow");
		$('#bizModal .modal-body').load('inc_group_workflow_add.php?GROUP_ID='+sel+'&WF_TYPE=<?php echo $WF_TYPE;?>');
		$('#bizModal').modal('show');
	}
};
function group_delete() {
	var ref = $('#dragTree').jstree(true),
		sel = ref.get_selected();
	if(!sel.length) { return false; }
	swal({
		title: "",
		text: "คุณต้องการลบกลุ่มนี้หรือไม่?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "ยืนยันการลบ",
		cancelButtonText: "ยกเลิก",
		closeOnConfirm: true
	},
	function(){
		ref.delete_node(sel);
		$('#group_create_f').attr('disabled','true');
		$('#group_del').attr('disabled','true');
		$("#GROUP_DETAIL").html('');
	});
};

function save_wf_order(){
	var url = "inc_group_ajax.php";
	$.ajax({
		type: "POST",
		url: url,
		data: $("#form_wf_group").serialize(),
		success: function(html)
		{
		if(html == 'Y')
			{
				swal({
					title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
					type: "success",
					allowOutsideClick:true
				});
			}
		}
	});
	e.preventDefault(); // avoid to execute the actual submit of the form.
}
</script>
<?php include '../include/combottom_admin.php'; ?>