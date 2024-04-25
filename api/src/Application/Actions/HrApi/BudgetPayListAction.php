<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class BudgetPayListAction extends Action
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
		if($request->IdentificationReference!=''){
			$filter .= " AND a.WFR_REFER_ID = '".$request->IdentificationReference."' ";
		}

        if($request->Identification!=''){
			$filter .= " AND a.WFR_ID = '".$request->Identification."' ";
		}
		
		$sql = "SELECT
                    a.*,b.HOSPITAL_NAME_TH,
                    CASE 
                        WHEN c.YEAR_TH IS NULL THEN a.SCHOOL_YEAR
                        ELSE c.YEAR_TH END
                    AS YEAR_TH,
                    d.INS_NAME_MERGE
                FROM
                    FRM_BUDGET_PAY_LIST a
                LEFT JOIN SETUP_HOSPITAL b ON a.HOSPITAL_ID = b.HOSPITAL_ID
                LEFT JOIN M_YEAR c ON a.SCHOOL_YEAR = c.YEAR_ID
                LEFT JOIN SETUP_EDU_INSTITUTE d ON a.INS_ID = d.INS_ID
                WHERE
					1=1 AND a.WF_MAIN_ID = 322 ".$filter;
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){

            $chk_int = Is_Numeric($r['SCHOOL_DEGREE']);

            if($chk_int === true){

                $sql_edu = " SELECT * FROM M_CHK_EDU_LEVEL WHERE EDU_LEVEL_ID = '".$r['SCHOOL_DEGREE']."' ";
                $q_edu = \db::query($sql_edu);
                $n_edu = \db::num_rows($q_edu);
                $r_edu = \db::fetch_array($q_edu);
                
                if($n_edu > 0){
                    if( isset($r_edu['EDU_LEVEL_NAME']) ){
                        $edu_level_n = $r_edu['EDU_LEVEL_NAME'];
                    }else{
                        $edu_level_n = "";
                    }
                    
                }else{
                    $edu_level_n = "";
                }
                

            }else{
                $edu_level_n = $r['SCHOOL_DEGREE'];
            }
            

            $row['FormIdentification'] = $r['F_ID'];
            $row['WfrReference'] = $r['WFR_REFER_ID']; // ถ้าเป็นค่ารักษาพยาบาล Id มาจาก table M_WELFARE_MEDICAL (จ่ายตรง),WFR_REQ_WELFARE_MEDICAL (สำรองจ่าย) บุตรมากจาก table WFR_REQ_WELFARE_EDU
            $row['FormReferenceIdentification'] = $r['F_REFER_ID'];
            $row['WfrReserveBudget'] = $r['WFR_ID']; //มาจาก WFR_RESERVE_BUDGET (จองงบประมาณ)
            

            $row['InvoiceNo'] = $r['INVOICE']; //เลขที่ Invoice
            $row['HospitalNumber'] = $r['HN_NUMBER']; //เลขที่ HN
            $row['RelationshipIdentification'] = $r['SHIP_ID']; //Id ผู้ใช้สิทธิ
            $row['RelationshipFullName'] = $r['SHIP_NAME']; //เบิกให้
            $row['MeducalFullName'] = $r['MEDICAL_NAME']; //ผู้ใช้สิทธิ
            $row['HospitalName'] = $r['HOSPITAL_NAME_TH']; //โรงพยาบาล
            $row['HospitalIdentification'] = $r['HOSPITAL_ID']; //โรงพยาบาล Id
            $row['DiseaseName'] = $r['MEDICAL_DISEASE']; //โรค
            $row['MedicalMoney'] = $r['MEDICAL_AMOUNT']; //จำนวนเงินรักษาพยาบาล

            /*---การศึกษาบุตร--- */
            $row['AcademicYear'] = $r['YEAR_TH']; //ปีการศึกษา	
            $row['SonFullName'] = $r['SON_NAME']; //ชื่อบุตร		
            $row['SchoolName'] = $r['INS_NAME_MERGE']; //สถานศึกษา	
            $row['SonDegree'] = $edu_level_n; //ระดับการศึกษา		
            $row['SchoolMoney'] = $r['SCHOOL_REQ_AMOUNT']; //จำนวนเงินการศึกษาบุตร
            
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>