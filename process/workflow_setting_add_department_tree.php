<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$USR_TYPE = conText($_GET['USR_TYPE']);
$ACCESS_TYPE = conText($_GET['ACCESS_TYPE']);
$ACESS_REF_ID = conText($_GET['ACESS_REF_ID']);

//if($USR_TYPE== 'D'){
	$sql_d = db::query("SELECT DEP_ID AS ID, DEP_NAME AS NAME FROM USR_DEPARTMENT ");
	$sql_count = db::query("SELECT count(DEP_ID) AS NUMROWS FROM USR_DEPARTMENT ");
	$title = "รายชื่อหน่วยงาน";
	$head = "สิทธิ์รายหน่วยงาน";
//}

function get_menu($m_id){
	global $i;
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
				$chkbox = '';
				$chkbox  = "<div class=\"checkbox-color checkbox-primary col-xs-12\">";
				$chkbox .= "<input type=\"checkbox\" name=\"access_check".$i."\" id=\"access_check".$i."\" value=\"Y\"><label for=\"access_check".$i."\"></label>";
				$chkbox .= "</div>";
				
				//if($M['DEPT_PARENT_ID']!=""){ $flag="folder"; }else{ $flag = "folder"; }
				echo "<li id=\"".$M["DEP_ID"]."\" data-jstree='{\"opened\":true,\"type\":\"".$flag."\"}'>".$chkbox.$M["DEP_NAME"];
				get_menu($M["DEP_ID"]);
				echo "</li>";
				$i++;
			}
		echo "</ul>";
	}
}

if($ACCESS_TYPE == 'WFM'){
	$id='show_permission_';
}else{
	$id='show_permission_d';
}
?>  
<link rel="stylesheet" type="text/css" href="../assets/plugins/tree-view/css/treeview.css">
<div class="row" id="animationSandbox">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		
	</div>
</div>
<form name="form1" id="form_add_dep" method="post" action="workflow_setting_function_add.php" >
	<div class="table-responsive" data-pattern="priority-columns">
		<div id="dragTree">
			<?php get_menu(''); ?>
		</div> 
		<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
			<thead>
				<tr class="bg-primary">
					<th class="text-center" style="width:5%">
						<div class="checkbox-color checkbox-primary col-xs-12">
							<input type="checkbox" name="check_all" id="check_all"  value="Y" onclick="select_all();"><label for="check_all"></label>
						</div>
					</th>
					<th class="text-center" style="width:30%"><?php echo $title; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=1;
				$num_data = db::fetch_array($sql_count);
				if($num_data["NUMROWS"] > 0){
					while($rec_d = db::fetch_array($sql_d)){
						
						if($USR_TYPE== 'U'){
							$rec_d["NAME"] = $rec_d["USR_FNAME"].' '.$rec_d["USR_LNAME"];
						
						}	
						$query_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = '".$ACCESS_TYPE."' AND
						ACCESS_REF_ID = '".$ACESS_REF_ID."' AND USR_TYPE = '".$USR_TYPE."' AND
						USR_REF_ID = '".$rec_d["ID"]."' ");
						$rac_acc = db::fetch_array($query_acc);
						?>
						<tr class="wf_modal_keyword-box">
							<td class="text-center">
								<div class="checkbox-color checkbox-primary col-xs-12">
								<input type="checkbox" name="access_check<?php echo $i; ?>" id="access_check<?php echo $i; ?>"  value="Y" <?php if($rac_acc["ACCESS_ID"] != ''){ echo 'checked';}?>><label for="access_check<?php echo $i;?>"></label>
								</div>
								<input type="hidden" name="ac_id<?php  echo $i; ?>" id="ac_id<?php echo $i; ?>" value="<?php echo $rac_acc["ACCESS_ID"]; ?>"><input type="hidden" name="u_id<?php echo $i;?>" id="u_id<?php echo $i; ?>" value="<?php echo $rec_d["ID"]; ?>">
							</td>
							<td class="wf_keyword"><?php echo $rec_d["NAME"]; ?></td>
						</tr>
						<?php $i++;
					}
					?>
					<tr> 
						<td class="text-center" colspan="2">
							<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
							<input name="process" type="hidden" id="process" value="ADD">
							<input name="ACCESS_TYPE" type="hidden" id="ACCESS_TYPE" value="<?php echo $ACCESS_TYPE;?>">
							<input name="ACCESS_REF_ID" type="hidden" id="ACCESS_REF_ID" value="<?php echo $ACESS_REF_ID;?>">
							<input name="USR_TYPE" type="hidden" id="USR_TYPE" value="<?php echo $USR_TYPE;?>">
							<input name="num_i" type="hidden" id="num_i" value="<?php echo $i; ?>">
						</td>
					</tr>
					<?php 
				}
				?>
			</tbody>
		</table>
	</div>
</form>
<script>
	$(document).ready(function() {
		$("#search-wf_main_modal").on("keyup", function() {
			var g = $(this).val().toLowerCase();
			$(".wf_keyword").each(function() {
				var s = $(this).text().toLowerCase();
				$(this).closest('.wf_modal_keyword-box')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
			});
		});

		// Sortable rows
		$('.sorted_table').sortable({
			containerSelector: 'table',
			itemPath: '> tbody',
			itemSelector: 'tr',
			handle: '.move-td',
			placeholder: '<tr class="placeholder"/>',
			onDrop: function($item, container, _super){
				_super($item, container);
				arrange_row('sorted_table');
			}
		});
	});
	$("#form_add_dep").submit(function(e) {

    var url = "workflow_setting_function_add.php"; // the script where you handle the form input.
    $.ajax({
		type: "POST",
		url: url,
		data: $("#form_add_dep").serialize(), // serializes the form's elements.
		success: function(data)
		{
			var dataString = 'A_TYPE=<?php echo  $ACCESS_TYPE;?>&A_ID=<?php echo $ACESS_REF_ID; ?>';
			$.ajax({
				type: "GET",
				url: "workflow_setting_view_department.php",
				data: dataString,
				cache: false,
				success: function(html){
					$("#<?php echo $id.$ACESS_REF_ID; ?>").html(html);
					$('#bizModal').modal('hide');
				}
			});
		}
    });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
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
			$("#MENU_DETAIL").html('');
		})
		.fail(function () {
			data.instance.refresh();
			$("#MENU_DETAIL").html('');
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
</script>
<?php
db::db_close();
?>