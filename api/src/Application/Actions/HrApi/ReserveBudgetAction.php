<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class ReserveBudgetAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/function_for_api.php');
		
		$request = $this->getFormData();
		
		$filter = "";
		if($request->Identification!=''){
			$filter = " AND a.WFR_ID = '".$request->Identification."' ";
		}
		
		$sql = "SELECT
					a.*
				FROM
                   WFR_RESERVE_BUDGET a
				WHERE
					1=1 ".$filter;
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		$array_bdg_type = array('1' => 'ค่ารักษาพยาบาล (จ่ายตรง)', '2' => 'ค่ารักษาพยาบาล (สำรองจ่าย)' ,'3' => 'ค่าเล่าเรียนบุตร' , '4' => 'จ่ายเงินเดือน/ ค่าจ้าง');
	
		$date_t = date('Y-m-d');
		
		$title2 = array('1'=>"หน่วยงานราชการ (เบิกตรงต้นสังกัด/กรมบัญชีกลาง)",'2'=>"เบิกหน่วยงานรัฐวิสาหกิจ",'3'=>"หน่วยงานเอกชน",'4'=>"เบิกประกันสังคม");
		$arr_family_name = array('1'=>"บิดา",'2'=>"มารดา",'3'=>"คู่สมรส",'4'=>"บุตร",'6'=>"พนักงาน");
		$per_t =  array('1'=>'รฟม.','2'=>'สิทธิเบิกตรงกรมบัญชีกลาง/ต้นสังกัด','3'=>'สิทธิเบิกประกันสังคม','4'=>'ประกันตนเอง');
		
		while($r = \db::fetch_array($q)){
			
			$row['ReserveBudgetName'] = $array_bdg_type[$r['REQ_BDG_TYPE']]; //รายการค่าใช้จ่าย
			$row['ReserveBudgetIdentification'] = $r['REQ_BDG_TYPE']; //รายการค่าใช้จ่าย Id
            $row['ReserveBudgetDate'] = $r['REQ_BDG']; //วันที่ทำรายการ
            $row['ReserveBudgetNo'] = $r['REQ_BDG_ON']; //เลขที่ใบจอง
            $row['ThaiFullName'] = $r['PER_NAME']; //ชื่อผู้ดำเนินการ
            $row['Position'] = $r['PER_POSITION']; //ตำแหน่ง
            $row['OrganizationName'] = $r['ORG_NAME4']; //ฝ่าย/สำนัก
            $row['DivisionName'] = $r['ORG_NAME5']; //กอง
            $row['DepartmentName'] = $r['ORG_NAME6']; //แผนก
            $row['ReserveBudgetYear'] = $r['REQ_BDG_YEAR']; //ปีงบประมาณ
            $row['ReserveBudgetListBalance'] = $r['REQ_BDG_LIST_BALANCE']; //รายการ
            $row['ReserveBudgetMoneyBalance'] = $r['REQ_BDG_BALACE']; //จำนวนเงินคงเหลือที่จองได้
            $row['ReserveBudgetMoney'] = $r['REQ_BDG_RESERVE']; //จำนวนเงินที่ขอจอง
            
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>