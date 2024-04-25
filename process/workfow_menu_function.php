<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "WF_MENU";
$pk_name = "MENU_ID";
$pk_id =  conText($_REQUEST['id']);

$url_back = "menu_group_list.php";
$MENU_NAME = conText($_POST['MENU_NAME']);
$MENU_STATUS = conText($_POST['MENU_STATUS']);
$MENU_ORDER = conText($_POST['MENU_ORDER']);
$MENU_ICON = conText($_POST['MENU_ICON']);

function get_wf_name($id)
{
	$sql_main = db::query("SELECT WF_MAIN_NAME, WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$id."'");
	$rec_main = db::fetch_array($sql_main);

	$a_data['name'] = $rec_main['WF_MAIN_NAME'];
	$a_data['type'] = $rec_main['WF_TYPE'];

	return $a_data;
}

function gen_sql_menu_tree($source, $parent = '', $data = array())
{
	foreach($source as $_key => $_val)
	{
		$ex_id = explode('_', $_val['id']);
		$id = count($ex_id) == 1 ? $ex_id[0] : $ex_id[1];

		echo "SELECT WF_MAIN_NAME, WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$id."' <br>";
		$sql_main = db::query("SELECT WF_MAIN_NAME, WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$id."'");
		$rec_main = db::fetch_array($sql_main);

		$a_data['MENU_NAME'] = $rec_main['WF_MAIN_NAME'];
		$a_data['MENU_PARENT'] = "";
		$a_data['MENU_TYPE'] = $rec_main['WF_TYPE'];

		if(count($_val['children']) > 0)
		{
			$build_data[] = $a_data;
			return gen_sql_menu_tree($_val['children'], '', $build_data);
		}
		else
		{
			$build_data[] = $a_data;
		}
	}
//	print_pre($build_data);
	echo '<hr>';
	print_pre($source);

	return true;
}

if($process == "add")
{
	$a_data['MENU_NAME'] = $MENU_NAME;
	$a_data['MENU_STATUS'] = $MENU_STATUS;
	$a_data['MENU_ORDER'] = $MENU_ORDER;
	$a_data['MENU_ICON'] = $MENU_ICON;
	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['MENU_NAME'] = $MENU_NAME;
	$a_data['MENU_STATUS'] = $MENU_STATUS;
	$a_data['MENU_ORDER'] = $MENU_ORDER;
	$a_data['MENU_ICON'] = $MENU_ICON;

	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);
}
elseif($process == "re_order")
{
	
	for($i=1; $i<$_POST['total_row']; $i++)
	{
		$MENU_STATUS = conText($_POST['MENU_STATUS'.$i]);
		$MENU_ORDER = conText($_POST['MENU_ORDER'.$i]);
		$M_MAIN = conText($_POST['M_MAIN'.$i]);

		$a_data['MENU_STATUS'] = $MENU_STATUS;
		$a_data['MENU_ORDER'] = $MENU_ORDER;
		$a_data['MENU_PARENT'] = $M_MAIN;
		
		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}
elseif($process == "setting")
{

	$MENU_ID = conText($_POST['MENU_ID']);
	$num_rows = conText($_POST['num_rows']);
	if(count($_POST['WF_SELECT'] > 0)){
		$a_data1['WF_MENU'] = '';
		$a_cond1['WF_MENU'] = $MENU_ID;
		db::db_update('WF_MAIN', $a_data1, $a_cond1);
		
		for($i=0; $i<$num_rows; $i++)
		{
			
			$WF_MAIN_ID = conText($_POST['WF_SELECT'][$i]);
			$a_data['WF_MENU'] = $MENU_ID;
			$a_cond['WF_MAIN_ID'] = $WF_MAIN_ID;
			db::db_update('WF_MAIN', $a_data, $a_cond);
		}
	}
}
elseif($process == "menu_tree")
{
	$json = json_decode($_POST['menu_json'], true);

	//$a = gen_sql_menu_tree($json[0]['children']);

	echo '<hr>';
	print_pre($json);

	$j=0;
	foreach($json[0]['children'] as $_key => $_val	)
	{
		$get_wf = get_wf_name($_val['id']);

		$a_data[$j]['MENU_NAME'] = $get_wf['name'];
		$a_data[$j]['MENU_ORDER'] = $j;
		$a_data[$j]['MENU_STATUS'] = "Y";
		$a_data[$j]['MENU_PARENT'] = "";
		$a_data[$j]['MENU_TYPE'] = $get_wf['type'];
		$a_data[$j]['MENU_URL'] = "";

		if(count($_val['children']) > 0)
		{
			foreach($_val['children'] as $_item)
			{
				$get_wf = get_wf_name(substr($_item['id'], 3));

				$a_data[$j]['MENU_NAME'] = $get_wf['name'];
				$a_data[$j]['MENU_ORDER'] = $j;
				$a_data[$j]['MENU_STATUS'] = "Y";
				$a_data[$j]['MENU_PARENT'] = "";
				$a_data[$j]['MENU_TYPE'] = $get_wf['type'];
				$a_data[$j]['MENU_URL'] = "";

				if(count($_item['children']) > 0)
				{
					foreach($_item['children'] as $_sub)
					{
						$get_wf = get_wf_name(substr($_sub['id'], 3));

						$a_data[$j]['MENU_NAME'] = $get_wf['name'];
						$a_data[$j]['MENU_ORDER'] = $j;
						$a_data[$j]['MENU_STATUS'] = "Y";
						$a_data[$j]['MENU_PARENT'] = "";
						$a_data[$j]['MENU_TYPE'] = $get_wf['type'];
						$a_data[$j]['MENU_URL'] = "";

						$j++;
					}
				}

				$j++;
			}
		}

		$j++;
	}

	print_pre($a_data);

	exit;
}




db::db_close();
redirect($url_back);
?>