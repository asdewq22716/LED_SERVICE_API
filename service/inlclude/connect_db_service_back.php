<?php
/*
 * Class Connect Database
 * Created by:  Tawatchai Anuchat
 * Date:  05/05/2017
 * Version:  1.1
 */


Class db2
{
	protected static $_host, $_user, $_password, $_autoIncrement = "Y";
	protected static $_systemConnect, $_systemQuery,$_querySQL, $_systemRecordCount, $_systemResult;
	public static $_dbType = "MYSQL", $_dbName ,$_langDate, $_systemRunType = "LIVE",$_dbOwner;

	/*
	 * ตั้งค่าการเชื่อมต่อฐานข้อมูล
	 * @host		IP หรือชื่อเครื่องฐานข้อมูล
	 * @user		username ที่ใช้เข้าฐานข้อมูล
	 * @password	password ที่ใช้เข้าฐานข้อมูล
	 * @dbName		ชื่อฐานข้อมูล
	 * @dbType		ประเภทฐานข้อมูล (MYSQL, MSSQL, ORACLE)
	 */

	public static function setupDatabase()
	{
		self::connectServer();
	}

	/*
	 * Connect Database
	 */
	protected static function connectServer()
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				try {
					self::$_systemConnect= new PDO("sqlsrv:server=".self::$_host."; Database = ".self::$_dbName, self::$_user, self::$_password);
					self::$_systemConnect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			}catch(PDOException $e) {
					echo $e->getMessage();
				}
				break;
			case 'MYSQL':
				self::$_systemConnect = mysqli_connect(self::$_host, self::$_user, self::$_password, self::$_dbName);
				self::query('SET NAMES \'utf8\'');

				if(mysqli_connect_errno())
				{
					echo "<strong>ไม่สามารถเชื่อมต่อฐานข้อมูลได้: </strong>".mysqli_connect_error();
					exit;
				}
				break;
			case 'ORACLE':
				$db1 = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".self::$_host.")(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME=orcl)))";
				self::$_systemConnect = oci_connect(self::$_user, self::$_password, $db1,"UTF8");
				if(!self::$_systemConnect)
				{
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				self::query('ALTER SESSION SET NLS_DATE_FORMAT = \'YYYY-MM-DD\'');
				self::query('alter session set nls_sort=binary_ci');
				self::query('ALTER SESSION SET NLS_COMP=LINGUISTIC');
				break;
		}

		return self::$_systemConnect;
	}

	/*
	 * เลือกฐานข้อมูลที่เชื่อมต่อ
	 */
	protected static function chooseDBName()
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				mssql_select_db(self::$_dbName);
				break;
			case 'MYSQL':
				mysqli_select_db(self::$_systemConnect, self::$_dbName);
				break;
			case 'ORACLE':
				break;
		}
	}

	/*
	 * Query ข้อมูลโดยรับคำสั่ง SQL เข้ามา
	 */
	public static function query($sql)
	{
		global $show_query;

		if($_GET["show__query"] == "Y")
		{
			echo date("H:i:s")."<br>";
			echo $sql."<hr>";
		}
		if (preg_match("/insert/i",$sql) OR preg_match("/update/i",$sql) OR preg_match("/delete/i",$sql)) {
			$txtdate = date("H:i:s");
			if(getenv(HTTP_X_FORWARDED_FOR))
			{
				$IPn = getenv(HTTP_X_FORWARDED_FOR);
			}
		else
			{
				$IPn = getenv("REMOTE_ADDR");
			}
			$textwrite = "[".$txtdate." ".$IPn."] ".$_SESSION["WF_USERNAME"]." (".$_SESSION["WF_USER_ID"].") :".preg_replace( '/\s+/', ' ', $sql )."\r\n";
			$year = date("Y");
			$y = $year+543;
			$datefile = $y.date("m").date("d").".txt";
			if(!file_exists("../log_process")){ mkdir("../log_process",0777); }
			$fp = fopen("../log_process/".$datefile, 'a+');
			fwrite($fp, $textwrite);
			fclose($fp);

		}
		$error = "N";
		$error_txt = "";
		switch(self::$_dbType)
		{
			case 'MSSQL':
				try {
					self::$_systemQuery=self::$_systemConnect->prepare($sql);
					self::$_systemQuery->execute();
					self::$_querySQL = $sql;
				}catch(PDOException $e) {
					$error_txt = $e->getMessage();
					self::write_log_error($sql, $error_txt);
					echo 'Error: '.$sql.'<hr />'.$e->getMessage();
					exit;
				}
				break;
			case 'MYSQL':
				self::$_systemQuery = mysqli_query(self::$_systemConnect, $sql);
				if(!self::$_systemQuery)
				{
					$error_txt = mysqli_error(self::$_systemConnect);
					self::write_log_error($sql, $error_txt);
					echo "<strong>Error Description: </strong>".$error_txt;
					exit;
				}
				break;
			case 'ORACLE':
				$obj = oci_parse(self::$_systemConnect, $sql);
				$obj2 = @oci_execute($obj);
				self::$_systemQuery = $obj;
				self::$_querySQL = $sql;
				if(!$obj2)
				{
					$error_txt = OCIError($obj);
					self::write_log_error($sql, $error_txt['message']);
					if(self::$_systemRunType=="DEV"){
					echo "<hr /><strong>".$sql."</strong><hr /><strong>Error Description: </strong>".$error_txt['message'];
					exit;
					}
				}
				break;
		}

		return self::$_systemQuery;
	}

	/*
	 * Query ข้อมูลโดยรับคำสั่ง SQL เข้ามาพร้อมจำกัดการแสดงจำนวนแถวข้อมูล
	 * @sql		statement
	 * @offset	เริ่มต้นจาก
	 * @limit	จำนวนที่ต้องการแสดง
	 */
	public static function query_limit($sql, $offset, $limit)
	{
		global $show_query;

		$error = "N";
		$error_txt = "";
		switch(self::$_dbType)
		{
			case 'MSSQL':

				$STOP =  $offset + $limit;
				if($offset != -1)
				{
					$offset = $offset+1;
				}
				$sql_check = ($sql);
				$sql_no_order = explode(" ORDER BY ",$sql_check);
				if($sql_no_order[1] != ''){
					$sql_no_from = explode(" FROM ",$sql_check);
					if(count($sql_no_from) > 2){
						$slen = strlen($sql_no_from[0]);
						$sql_no_from[1] = substr($sql,($slen+5),strlen($sql));

					}


					$sql_no_order2 = explode(" ORDER BY ",$sql_no_from[1]);
					$sql = "
					SELECT C.*
					FROM (
					".$sql_no_from[0]." ,ROW_NUMBER() OVER (ORDER BY ".$sql_no_order[1].") AS RowNum
					FROM ".$sql_no_order2[0]."
					) AS C
					WHERE C.RowNum BETWEEN ".$offset." AND ".$STOP;
				}
				if($_GET['show__query'] == "Y")
				{
					echo date("H:i:s")."<br>";
					echo $sql."<hr>";
				}
				try {
					self::$_systemQuery=self::$_systemConnect->prepare($sql);
					self::$_systemQuery->execute();
					self::$_querySQL = $sql;
				}catch(PDOException $e) {
					echo $e->getMessage();
				}
				break;
			case 'MYSQL':
				$sql_limit = " limit ".$offset.", ".$limit;

				self::$_systemQuery = mysqli_query(self::$_systemConnect, $sql.$sql_limit);
				if(!self::$_systemQuery)
				{
					$error = "Y";
					$error_txt = mysqli_error(self::$_systemConnect);
					echo "<strong>Error Description: </strong>".$error_txt;
				}
				break;
			case 'ORACLE':
				$STOP =  $offset + $limit;
				if($offset != -1)
				{
					$offset = $offset+1;
				}
				$sql_limit = 'select * from ( select a.*, rownum rnum from ( '.$sql.' ) a ) where rnum between '.$offset.' and '.$STOP.' ';


				$obj = oci_parse(self::$_systemConnect, $sql_limit);
				oci_execute($obj);
				self::$_systemQuery = $obj;
				self::$_querySQL = $sql;
				if(!self::$_systemQuery)
				{
					$error = "Y";
					$error_txt = OCIError();
					echo "<strong>Error Description: </strong>".$error_txt;
				}
				break;
		}

		if($error == "Y")
		{
			self::write_log_error($sql, $error_txt);
		}

		return self::$_systemQuery;
	}

	/*
	 * Fetch Array
	 */
	public static function fetch_array($query)
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				self::$_systemResult = $query->fetch(PDO::FETCH_ASSOC);
				break;
			case 'MYSQL':
				self::$_systemResult = mysqli_fetch_array($query);
				break;
			case 'ORACLE':
				self::$_systemResult = @oci_fetch_array($query,OCI_RETURN_NULLS+OCI_RETURN_LOBS);
				break;
		}

		return self::$_systemResult;
	}

	/*
	 * Num Rows
	 */
	public static function num_rows($query)
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				$sql_check = strtoupper(self::$_querySQL);
				$sql_no_order = explode("ORDER BY",$sql_check);
				$obj = self::$_systemConnect->prepare("SELECT COUNT(*) AS NUM FROM (".$sql_no_order[0].") a");
				$obj->execute();
				$record_count = $obj->fetch(PDO::FETCH_ASSOC);
				self::$_systemRecordCount = $record_count['NUM'];
				break;
			case 'MYSQL':
				self::$_systemRecordCount = mysqli_num_rows($query);
				break;
			case 'ORACLE':
				$obj = oci_parse(self::$_systemConnect, "SELECT COUNT(*) AS NUM FROM (".self::$_querySQL.")");
				oci_execute($obj);
				$record_count = oci_fetch_array($obj);
				self::$_systemRecordCount = $record_count['NUM'];
				//self::$_systemRecordCount = oci_num_rows($query);
				break;
		}

		return self::$_systemRecordCount;
	}

	/*
	 * Insert ข้อมูล
	 * @tbName		ชื่อตารางที่จะ Insert
	 * @data		ข้อมูลที่จะ Insert เป็น Array โดย Key คือชื่อ Field, Value คือ ข้อมูลที่จะเพิ่ม
	 * @pk			PK ของตารางที่ต้องการ select max
	 * @outID		ต้องการเลข PK ล่าสุดที่เพิ่ม  ถ้าต้องการใส่ Y
	 */
	public static function db_insert($tbName, $data, $pkSelectMax = "", $outID = "")
	{
		$fieldArray = array();
		$valueArray = array();

		if(self::$_autoIncrement == "N")
		{
			if($pkSelectMax != "")
			{
				if(trim($data[$pkSelectMax]) != '')
				{
					$last_id = $data[$pkSelectMax];
				}
				else
				{
					$get_last_id = self::get_max($tbName, $pkSelectMax);
					$last_id = $get_last_id + 1;
					$data[$pkSelectMax] = $last_id;
				}
			}
		}
		foreach($data as $_key => $_val)
		{
			if($_key != ""){
			array_push($fieldArray, $_key);
			array_push($valueArray, "'".$_val."'");
			}
		}

		$setSQL = "insert into ".$tbName." (".implode(', ', $fieldArray).") values (".implode(', ', $valueArray).")";

		self::query($setSQL);

		if($outID != "")
		{
			switch(self::$_dbType)
			{
				case 'MSSQL':
					$last_id = self::get_max($tbName, $outID);
					break;
				case 'MYSQL':
					//$last_id = mysqli_insert_id(self::$_systemConnect);
					$last_id = self::get_max($tbName, $outID);
					break;
				case 'ORACLE':
					$last_id = self::get_max($tbName, $outID);
					break;
			}
		}

		if(self::$_autoIncrement == "N" || $outID != "")
		{
			return $last_id;
		}
		else
		{
			return null;
		}
	}

	/*
	 * Update ข้อมูล
	 * @tbName		ชื่อตารางที่จะ Update
	 * @data		ข้อมูลที่จะ Update เป็น Array โดย Key คือชื่อ Field, Value คือ ข้อมูลที่จะเพิ่ม
	 * @cond		เงื่อนไข เป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where
	 */
	public static function db_update($tbName, $data, $cond)
	{
		if(count($data)>0){
		$updateData = self::setArray2String($data);
		$condition = self::setArray2String($cond, " and ");

		$setSQL = "update ".$tbName." set ".$updateData." where 1=1 and ".$condition;
		self::query($setSQL);
		}
	}

	/*
	 * Show Field ในตาราง
	 * @tables		ชื่อตารางที่ต้องการ Show Fields
	 */
	public static function show_field($tables)
	{
		$arr_data = array();
		if(strtoupper(self::$_dbType) == 'MYSQL')
		{
			if($tables != ''){
				$tables = strtolower($tables);
				$q_auto = self::query("SHOW FIELDS FROM ".$tables."");
				while($r_auto = self::fetch_array($q_auto))
				{
					array_push($arr_data, $r_auto['Field']);
				}
			}
		}
		elseif(strtoupper(self::$_dbType) == 'ORACLE')
		{

			$tables = strtoupper($tables);
			//$q_auto = self::query("SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '".$tables."' ORDER BY COLUMN_ID");
			$q_auto = self::query("SELECT column_name FROM all_tab_cols WHERE VIRTUAL_COLUMN = 'NO' AND table_name = '".$tables."' AND OWNER = '".strtoupper(self::$_dbName)."'  ORDER BY SEGMENT_COLUMN_ID");
			while($r_auto = self::fetch_array($q_auto))
			{
				array_push($arr_data, $r_auto['COLUMN_NAME']);
			}
		}elseif(strtoupper(self::$_dbType) == 'MSSQL')
		{

			$tables = strtoupper($tables);
			$q_auto = self::query("select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$tables."' ORDER BY ORDINAL_POSITION");
			while($r_auto = self::fetch_array($q_auto))
			{
				array_push($arr_data, $r_auto['COLUMN_NAME']);
			}
		}


		$arr_data = array_unique($arr_data);
		return $arr_data;
	}

	/*
	 * Delete ข้อมูล
	 * @tbName		ชื่อตารางที่จะ Delete
	 * @cond		เงื่อนไข เป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where
	 */
	public static function db_delete($tbName, $cond)
	{
		$condition = self::setArray2String($cond, " and ");

		$setSQL = "delete from ".$tbName." where 1=1 and ".$condition;
		self::query($setSQL);
	}

	/*
	 * Query + Fetch ข้อมูล
	 * @return	ส่งค่ากลับเป็น Array 2 มิติ
	 */
	public static function store_select($sql)
	{
		$data_stored = array();

		switch(self::$_dbType)
		{
			case 'MSSQL':
				break;
			case 'MYSQL':
				$result = self::query($sql);

				while($record = mysqli_fetch_assoc($result))
				{
					$data_stored[] = $record;
				}
				break;
			case 'ORACLE':
				break;
		}
		return $data_stored;
	}

	/*
	 * หาค่ามากสุด
	 * @table		ชื่อตารางที่ต้องการหา
	 * @fieldGetMax	ชื่อฟิลที่ต้องการหา
	 * @cond		เงื่อนไข เป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where
	 */
	public static function get_max($table, $fieldGetMax, $cond = array())
	{
		if(count($cond) > 0)
		{
			$condition = self::setArray2String($cond, " and ");
			$where = " where ".$condition;
		}
		else
		{
			$where = "";
		}

		$sql = "select max(".$fieldGetMax.") as MX from ".$table.$where;
		$res = self::query($sql);
		$rec = self::fetch_array($res);
		return $rec['MX'] > 0 ? $rec['MX'] : '0';
	}


	//query เพื่อหา field จากตาราง
	public static function query_field($sql)
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				$result = self::$_systemConnect->prepare($sql);
				$result->execute();
				$total_column = $result->columnCount();
				$arr_field = array();
				for ($counter = 0; $counter < $total_column; $counter ++) {
					$meta = $result->getColumnMeta($counter);
					$arr_field[] = $meta['name'];
				}
				break;
			case 'MYSQL':
				$res = self::query($sql);
				$ncols = self::fetch_array($res);
				$arr_field = array();
				foreach ($ncols as $key=>$val) {
					if(!is_numeric($key)){
					$arr_field[] = $key;
					}
				}
				break;
			case 'ORACLE':
				$res = self::query($sql);
				$ncols = oci_num_fields($res);
				$arr_field = array();
				for ($i = 1; $i <= $ncols; $i++) {
					$arr_field[] = oci_field_name($res, $i);
				}
				break;
		}


		return $arr_field;
	}

	/*
	 * เก็บ SQL Error
	 * @sql			คำสั่งที่ error
	 * @errorTxt	รายละเอียดที่ error
	 */
	protected static function write_log_error($sql, $errorTxt = "")
	{
		if($errorTxt != "")
		{
			$errorTxt = " (".$errorTxt.")";
		}

		$file_name = date('Ymd').".txt";
		$content = date('H:i:s')."[".$_SESSION['WF_USER_ID']."][".$_SESSION['WF_USER_NAME']."][".$_SERVER['REQUEST_URI']."] : ".$sql.$errorTxt."\n";
		$handle = fopen('../logs_error/'.$file_name, 'a');

		fwrite($handle, $content);
		fclose($handle);
	}

	/*
	 * ปิดการเชื่อมต่อฐานข้อมูล
	 */
	public static function db_close()
	{
		switch(self::$_dbType)
		{
			case 'MSSQL':
				self::$_systemConnect = null;
				break;
			case 'MYSQL':
				mysqli_close(self::$_systemConnect);
				break;
			case 'ORACLE':
				oci_close(self::$_systemConnect);
				break;
		}
	}

	private static function setArray2String($dataArray, $operator = ", ")
	{
		$data = array();

		foreach($dataArray as $_key => $_val)
		{
			if($_key != ""){
			$data[] = $_key." = '".$_val."'";
			}
		}

		return implode($operator, $data);
	}

	/*
	 * ตั้งค่าพาธฐานข้อมูล
	 */
	public static function setHost($txt)
	{
		self::$_host = $txt;
	}

	/*
	 * ตั้งค่า username ฐานข้อมูล
	 */
	public static function setUser($txt)
	{
		self::$_user = $txt;
		self::$_dbOwner = $txt;
	}

	/*
	 * ตั้งค่า password ฐานข้อมูล
	 */
	public static function setPassword($txt)
	{
		self::$_password = $txt;
	}

	/*
	 * ตั้งค่าชื่อฐานข้อมูล
	 */
	public static function setDBName($txt)
	{
		self::$_dbName = $txt;
	}

	/*
	 * ตั้งค่าประเภทฐานข้อมูล
	 */
	public static function setDBType($txt)
	{
		self::$_dbType = strtoupper($txt);
	}

	/*
	 * ตั้งค่า Auto Increment
	 */
	public static function setAutoIncrement($txt)
	{
		self::$_autoIncrement = strtoupper($txt);
	}

	/*
	 * ตั้งค่ารูปแบบเวลา ใน db
	 */
	public static function setLangDate($txt)
	{
		self::$_langDate = strtoupper($txt);
	}

	/*
	 * ตั้งค่ารูปแบบเวลา ใน db
	 */
	public static function setRunType($txt)
	{
		self::$_systemRunType = strtoupper($txt);
	}
}


?>
