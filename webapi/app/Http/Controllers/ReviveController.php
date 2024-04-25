<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ReviveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/*ลิงค์ระบบที่น้องแพมเอาข้อมูลไป config ให้ครับ
	103.208.27.224:81/led_service_api
	มี 4 ตารางดังนี้
	M_REVIVE : ระบบข้อมูลกลางระบบฟื้นฟูกิจการ
	M_MEDIATE : ระบบข้อมูลกลางระบบไกล่เกลี่ย
	M_EFILING : ระบบข้อมูลกลางระบบแพ่ง
	M_INSOLVENT : ระบบข้อมูลกลางระบบล้มละลาย*/

	public function revive_001(Request $request)
    {
        $name = $request->input('name');
		
		$data = DB::select('select * from m_revive');


       return response()->json($data);

    }
	
	public function mediate_001(Request $request)
    {
        $name = $request->input('name');
		
		$data = DB::select('select * from m_mediate');


       return response()->json($data);

    }

	public function efiling_001(Request $request)
    {
		$params = [];
		$conds = '';

        if($request->input('black_name')){
			$params[] = $request->input('black_name');
			$conds .= 'and black_name=? ';
		}
		if($request->input('black_num')){
			$params[] = $request->input('black_num');
			$conds .= 'and black_num=? ';
		}
		if($request->input('black_year')){
			$params[] = $request->input('black_year');
			$conds .= 'and black_year=? ';
		}
		if($request->input('court_name')){
			$params[] = '%'.$request->input('court_name').'%';
			$conds .= 'and court_name LIKE ? ';
		}

		$data = DB::select('select * from m_efiling where 1=1 '.$conds,$params);


       return response()->json(['status'=>'success','data'=>$data]);

    }

	public function insolvent_001(Request $request)
    {
        $name = $request->input('name');
		
		$data = DB::select('select * from m_insolvent');


       return response()->json($data);

    }
	
	public function call_api(Request $request){
		try{
			$rows = DB::select('select * from api_requests where api_code=?',[$request->input('api_code')]);
			$arr_config = json_decode($rows['json_config']);
			$this->curl($arr_config['request']);
		}catch(Exception $ex){
			
		}
		return response()->json($data);
	}
	
	/*
	"request": {
		"url": {
			"raw": "http://localhost:3333/api/revive-001/?q1=:q1",
			"protocol": "http",
			"host": [
				"localhost"
			],
			"port": "3333",
			"path": [
				"api",
				"revive-001"
			],
			"query": [
				{
					"key": "q1",
					"value": ":q1",
					"description": "รหัสประจำตัว"
				}
			],
			"variable": []
		},
		"method": "GET",
		"header": [
			{
				"key": "Content-Type",
				"value": "application/json",
				"description": ""
			},
			{
				"key": "Authorization",
				"value": "Bearer ",
				"description": ""
			}
		],
		"body": "",
		"description": ""
	}*/
	
	function curl($request_body = array(), $url, $token = '', $method = "GET", $json = false, $ssl = true){
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $request['url']['raw']);    
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request['method']);
		if($request['method'] == 'POST'){
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		/*
		if($json == true){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json','Authorization: Bearer '.$token,'Content-Length: ' . strlen($request_body)));
		}else{
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request_body));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		}*/
		/*
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLVERSION, 6);
		
		if($ssl == false){
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}*/
		// curl_setopt($ch, CURLOPT_HEADER, 0);     
		$r = curl_exec($ch);    
		if (curl_error($ch)) {
			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$err = curl_error($ch);
			print_r('Error: ' . $err . ' Status: ' . $statusCode);
			// Add error
			$this->error = $err;
		}
		curl_close($ch);
		return $r;
	}
}
