<?php

use Dompdf\FrameDecorator\Page;

function addStatusBankrupt($CONCERN_NAME = "", $WH_ID, $IDCARD)
{
    if ($CONCERN_NAME == "ผู้มีส่วนได้เสีย" || $CONCERN_NAME == "จำเลย" || $CONCERN_NAME == "โจทก์") {
        $sql1 = "SELECT d.RELATE_PROPERTY_NAME FROM WH_BANKRUPT_CASE_DETAIL a 
            JOIN WH_BANKRUPT_CASE_PERSON b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID
            JOIN WH_BANKRUPT_ASSETS c ON a.WH_BANKRUPT_ID =c.WH_BANKRUPT_ID 
            JOIN WH_BANKRUPT_ASSETS_OWNER d ON b.REGISTER_CODE =d.PER_IDCARD AND c.ASSET_ID =d.ASSET_ID 
            WHERE b.REGISTER_CODE ='{$IDCARD}' AND a.WH_BANKRUPT_ID ='{$WH_ID}'";
        $sql = "SELECT c.DOCKET_NAME FROM WH_BANKRUPT_CASE_DETAIL a
            JOIN WH_BANKRUPT_CASE_PERSON b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
            JOIN WH_BANKRUPT_PERSON_CONN c ON b.PER_ID =c.DOP_ID_PK 
            WHERE 1=1
            AND 	 a.WH_BANKRUPT_ID = '{$WH_ID}' 
            AND b.REGISTER_CODE ='{$IDCARD}'";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        return $CONCERN_NAME . bracket($rec['DOCKET_NAME']); //RELATE_PROPERTY_NAME
        //return $sql;
    } else {
        return $CONCERN_NAME;
    }
}
class Asset_
{
    public $CIVIL_CODE; //CODE_API

    public $BANKRUPT_CODE; //CODE_API

    public $SelecterCivil; //select เลือกข้อมูลในเเพ่ง

    public $SelecterCivil_MAP_HOUSE; //ทรัพย์ของสิ่งปลูกสร้าง

    public $SelecterฺBankrupt_ON_LAND; //ทรัพย์ของสิ่งปลูกสร้าง

    public $SelecterฺBankrupt; //select เลือกข้อมูลในล้มละลาย

    public $AssetDataPccCivil; //เก็บarray ข้อมูลแพ่งของต้นทาง

    public $AssetDataBankrupt; //เก็บarray ข้อมูลล้มของต้นทาง

    public function WH_CIVIL_CASE_ASSETS_LAND($Fill, $showQ)
    {
        //ที่ดิน 01
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_LAND xa ON b.ASSET_ID =xa.CFC_LAND_GEN 
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_CIVIL_CASE_ASSETS_BUILDING($Fill, $showQ)
    {
        //สิ่งปลูกสร้าง 02
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_BUILDING xa ON b.ASSET_ID =xa.CFC_HOUSE_GEN 
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_LAND_MAP_HOUSE($Fill, $showQ)
    {
        //สิ่งปลูกสร้างเเละที่ดิน 
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil_MAP_HOUSE . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_BUILDING xa ON b.ASSET_ID =xa.CFC_HOUSE_GEN 
        JOIN WH_LAND_MAP_HOUSE xb ON a.CIVIL_CODE =xb.PCC_CIVIL_GEN AND xa.CFC_HOUSE_GEN =xb.CFC_HOUSE_GEN 
        JOIN WH_CIVIL_CASE_ASSETS_LAND xc ON a.WH_CIVIL_ID =xc.WH_CIVIL_ID AND  xb.CFC_LAND_GEN =xc.CFC_LAND_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_CIVIL_CASE_ASSETS_CONDO($Fill, $showQ)
    {
        //ห้องชุด 03
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_CONDO xa ON b.ASSET_ID =xa.CFC_BUILDING_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_MACHINE($Fill, $showQ)
    {
        //--เครื่องจักร 13
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_MACHINE xa ON b.ASSET_ID =xa.CFC_MACHINE_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_BOND($Fill, $showQ)
    {
        //--พันธบัตร 09
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_BOND xa ON b.ASSET_ID =xa.CFC_BONDS_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_LOTTERY($Fill, $showQ)
    {
        //--สลากออมทรัพย์ 10
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_LOTTERY xa ON b.ASSET_ID =xa.CFC_SAVE_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_GUN($Fill, $showQ)
    {
        //--ปืน 14
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_GUN xa ON b.ASSET_ID =xa.CFC_GUN_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_OTHER($Fill, $showQ)
    {
        //--บัญชีทรัพย์สินอื่นๆ 99
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_OTHER xa ON b.ASSET_ID =xa.CFC_OTHER_CAPTION_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_BUIL_RENT($Fill, $showQ)
    {
        //สิทธิการเช่า ห้องชุด 05
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_BUIL_RENT xa ON b.ASSET_ID =xa.CFC_BUILDING_RENT_RIGHT_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_LAND_RENT($Fill, $showQ)
    {
        //สิทธิการเช่า ที่ดินและสิ่งปลูกสร้าง 04
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_LAND_RENT xa ON b.ASSET_ID =xa.CFC_LAND_RENT_RIGHT_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_CAR($Fill, $showQ)
    {
        //รถ 11
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_CAR xa ON b.ASSET_ID =xa.CFC_VEHICLE_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_CIVIL_CASE_ASSETS_STOCK($Fill, $showQ)
    {
        //หุ้น 08
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_STOCK xa ON b.ASSET_ID =xa.CFC_STOCK_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_BOAT($Fill, $showQ)
    {
        //เรือ 12
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_BOAT xa ON b.ASSET_ID =xa.CFC_BOAT_GEN 
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_CIVIL_CASE_ASSETS_FUND($Fill, $showQ)
    {
        //หน่วยลงทุน สลากออมทรัพย์ 16
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterCivil . " FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        JOIN WH_CIVIL_CASE_ASSETS_FUND xa ON b.ASSET_ID =xa.CFC_FUND_GEN  
        WHERE  1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }


    public function WH_BANKRUPT_ASSETS_LAND($Fill, $showQ)
    {
        //1	ที่ดิน
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_LAND xa ON b.ASSET_ID =xa.LAD_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_BUILDING($Fill, $showQ)
    {
        //2 สิ่งปลูกสร้าง
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_BUILDING xa ON b.ASSET_ID =xa.BUD_ASS_ID_FK 
        LEFT JOIN WH_BUILDING_ON_LAND xb ON a.BANKRUPT_CODE =xb.BRC_ID_PK AND xa.BUD_ID_PK=xb.BOLD_BUD_ID_FK 
    	LEFT JOIN WH_BANKRUPT_ASSETS_LAND xc ON xb.BOLD_LAD_ID_FK =xc.LAD_ID_PK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_CONDO($Fill, $showQ)
    {
        //3	ห้องชุด
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_CONDO xa ON b.ASSET_ID =xa.ROM_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_BANKRUPT_ASSETS_MACHINERY($Fill, $showQ)
    {
        //4	เครื่องจักร
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_MACHINERY xa ON b.ASSET_ID =xa.MAC_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_CAR($Fill, $showQ)
    {
        //5	รถ
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_CAR xa ON b.ASSET_ID =xa.VECL_ASS_ID_FK   
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_BOND($Fill, $showQ)
    {
        //6	พันธบัตร
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_BOND xa ON b.ASSET_ID =xa.BOND_ASS_ID_FK   
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_LOTTERY($Fill, $showQ)
    {
        //7	สลากออมทรัพย์
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_LOTTERY xa ON b.ASSET_ID =xa.LOT_ASS_ID_FK  
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_FIREARM($Fill, $showQ)
    {
        //8	อาวุธปืน
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_FIREARM xa ON b.ASSET_ID =xa.GUN_ASS_ID_FK  
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_STOCK($Fill, $showQ)
    {
        //9	หุ้นบริษัท
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_STOCK xa ON b.ASSET_ID =xa.ASH_ASS_ID_FK    
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_BANKRUPT_ASSETS_COOPERATIVE($Fill, $showQ)
    {
        //10	เงินค่าหุ้นสหกรณ์
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_COOPERATIVE xa ON b.ASSET_ID =xa.CPMN_ASS_ID_FK     
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_BANKRUPT_ASSETS_RENT_RIGHT($Fill, $showQ)
    {
        //11	สิทธิการเช่า
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_RENT_RIGHT xa ON b.ASSET_ID =xa.ARR_ASS_ID_FK     
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_INSURANCE($Fill, $showQ)
    {
        //12	กรมธรรม์
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_INSURANCE xa ON b.ASSET_ID =xa.INSPOL_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_BOOKBANK($Fill, $showQ)
    {
        //13	บัญชีเงินฝากธนาคาร
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_BOOKBANK xa ON b.ASSET_ID =xa.BKA_ASS_ID_FK  
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_OTHER($Fill, $showQ)
    {
        //15	บัญชีทรัพย์สินอื่นๆ
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_OTHER xa ON b.ASSET_ID =xa.OTH_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }


    public function WH_BANKRUPT_ASSETS_INCOME($Fill, $showQ)
    {
        //22	เงิน
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_INCOME xa ON b.ASSET_ID =xa.INCM_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_FUND($Fill, $showQ)
    {
        //23	เงินกบข./เงินกองทุนสำรองเลี้ยงชีพ
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_FUND xa ON b.ASSET_ID =xa.PROVF_ASS_ID_FK 
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }
    public function WH_BANKRUPT_ASSETS_LEGAL_RIGHT($Fill, $showQ)
    {
        //24	สิทธิเรียกร้อง
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt . " FROM WH_BANKRUPT_CASE_DETAIL  a
    	JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
    	JOIN WH_BANKRUPT_ASSETS_LEGAL_RIGHT xa ON b.ASSET_ID =xa.LER_ASS_ID_FK   
    	WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function WH_BUILDING_ON_LAND($Fill, $showQ)
    {
        //21	ที่ดินพร้อมสิ่งปลูกสร้าง
        $AND = "";
        foreach ($Fill as $AA1 => $BB2) {
            $AND .= $BB2;
        }
        $sql = "SELECT " . $this->SelecterฺBankrupt_ON_LAND . " FROM WH_BANKRUPT_CASE_DETAIL  a
         JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID  =b.WH_BANKRUPT_ID
         JOIN WH_BANKRUPT_ASSETS_BUILDING xa ON b.ASSET_ID =xa.BUD_ASS_ID_FK 
         LEFT JOIN WH_BUILDING_ON_LAND xb ON a.BANKRUPT_CODE =xb.BRC_ID_PK AND xa.BUD_ID_PK=xb.BOLD_BUD_ID_FK 
         LEFT JOIN WH_BANKRUPT_ASSETS_LAND xc ON xb.BOLD_LAD_ID_FK =xc.LAD_ID_PK 
         WHERE 1=1 " . $AND . "";
        $query = db::query($sql);
        while ($row = db::fetch_array($query)) {
            $filteredData = array_filter($row, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
            $Asset[] = $filteredData;
        }
        if (!empty($showQ)) {
            return $sql;
        } else {
            return $Asset;
        }
    }

    public function emp_($F, $name, $val)
    {
        return !empty($val) ? "AND {$F}.{$name} ='" . $val . "'" : "AND {$F}.{$name} IS NULL ";
    }

    public function DataAssetCivil()
    { //หาคดีต้นทาง CIVIL_CODE ไปค้นหาทรัพย์ 
        $Data = [];
        $this->SelecterCivil = "a.*,b.TYPE_CODE ,b.TYPE_CODE_NAME,b.*,xa.*";
        $this->SelecterCivil_MAP_HOUSE = "a.*,b.TYPE_CODE ,b.TYPE_CODE_NAME,b.*,xa.*,xc.AMPHUR_NAME ,xc.DISTRICT_NAME ,xc.PROVINCE_NAME ";
        $Fill = [
            'Civil' => "AND a.CIVIL_CODE  ='" . $this->CIVIL_CODE . "'",
        ];
        $showSql = '';
        // 14 table
        $Data['LAND'] = $this->WH_CIVIL_CASE_ASSETS_LAND($Fill, $showSql);
        $Data['BOAT'] = $this->WH_CIVIL_CASE_ASSETS_BOAT($Fill, $showSql);
        $Data['BOND'] = $this->WH_CIVIL_CASE_ASSETS_BOND($Fill, $showSql);
        $Data['BUIL_RENT'] = $this->WH_CIVIL_CASE_ASSETS_BUIL_RENT($Fill, $showSql);
        $Data['BUILDING']  = $this->WH_CIVIL_CASE_ASSETS_BUILDING($Fill, $showSql); //สิ่งปลูกสร้าง
        $Data['MAP_HOUSE'] = $this->WH_LAND_MAP_HOUSE($Fill, $showSql); //สิ่งปลูกสร้างพร้อมที่ดิน
        $Data['CAR'] = $this->WH_CIVIL_CASE_ASSETS_CAR($Fill, $showSql);
        $Data['CONDO'] = $this->WH_CIVIL_CASE_ASSETS_CONDO($Fill, $showSql);
        $Data['FUND'] = $this->WH_CIVIL_CASE_ASSETS_FUND($Fill, $showSql);
        $Data['GUN'] = $this->WH_CIVIL_CASE_ASSETS_GUN($Fill, $showSql);
        $Data['LAND_RENT'] = $this->WH_CIVIL_CASE_ASSETS_LAND_RENT($Fill, $showSql);
        $Data['LOTTERY'] = $this->WH_CIVIL_CASE_ASSETS_LOTTERY($Fill, $showSql);
        $Data['MACHINE'] = $this->WH_CIVIL_CASE_ASSETS_MACHINE($Fill, $showSql);
        $Data['OTHER'] = $this->WH_CIVIL_CASE_ASSETS_OTHER($Fill, $showSql);
        $Data['STOCK'] = $this->WH_CIVIL_CASE_ASSETS_STOCK($Fill, $showSql);
        $this->AssetDataPccCivil = $Data;
        return $Data;
    }

    //ข้อมูลล้มต้นทาง
    public function DataAssetBankrupt()
    {
        $Data = [];
        $this->SelecterฺBankrupt = "a.BANKRUPT_CODE ,a.WH_BANKRUPT_ID,b.*,xa.*";
        $this->SelecterฺBankrupt_ON_LAND = "a.BANKRUPT_CODE ,a.WH_BANKRUPT_ID,b.*,xa.*,xc.LAD_SUBDISTRICT,xc.LAD_DISTRICT,xc.LAD_PROVINCE";
        $Fill = [
            'BANKRUPT_CODE' => "AND a.BANKRUPT_CODE  ='" . $this->BANKRUPT_CODE . "'",
        ];
        $showSql = '';
        //18 table
        $Data['LAND'] = $this->WH_BANKRUPT_ASSETS_LAND($Fill, $showSql); //1	ที่ดิน
        $Data['BUILDING'] = $this->WH_BANKRUPT_ASSETS_BUILDING($Fill, $showSql); //2	สิ่งปลูกสร้าง
        $Data['CONDO'] = $this->WH_BANKRUPT_ASSETS_CONDO($Fill, $showSql); //3 ห้องชุด	
        $Data['MACHINERY'] = $this->WH_BANKRUPT_ASSETS_MACHINERY($Fill, $showSql); //4 เครื่องจักร	
        $Data['CAR'] = $this->WH_BANKRUPT_ASSETS_CAR($Fill, $showSql); //5	รถ
        $Data['BOND'] = $this->WH_BANKRUPT_ASSETS_BOND($Fill, $showSql); //6	พันธบัตร
        $Data['LOTTERY'] = $this->WH_BANKRUPT_ASSETS_LOTTERY($Fill, $showSql); //7	สลากออมทรัพย์
        $Data['FIREARM'] = $this->WH_BANKRUPT_ASSETS_FIREARM($Fill, $showSql); //8	อาวุธปืน
        $Data['STOCK'] = $this->WH_BANKRUPT_ASSETS_STOCK($Fill, $showSql); //9	หุ้นบริษัท
        $Data['COOPERATIVE'] = $this->WH_BANKRUPT_ASSETS_COOPERATIVE($Fill, $showSql); //10	เงินค่าหุ้นสหกรณ์
        $Data['RENT_RIGHT'] = $this->WH_BANKRUPT_ASSETS_RENT_RIGHT($Fill, $showSql); //11	สิทธิการเช่า
        $Data['INSURANCE'] = $this->WH_BANKRUPT_ASSETS_INSURANCE($Fill, $showSql); //12	กรมธรรม์
        $Data['BOOKBANK'] = $this->WH_BANKRUPT_ASSETS_BOOKBANK($Fill, $showSql); //13	บัญชีเงินฝากธนาคาร
        $Data['OTHER'] = $this->WH_BANKRUPT_ASSETS_OTHER($Fill, $showSql); //15	บัญชีทรัพย์สินอื่นๆ	
        $Data['INCOME'] = $this->WH_BANKRUPT_ASSETS_INCOME($Fill, $showSql); //22	เงิน
        $Data['FUND'] = $this->WH_BANKRUPT_ASSETS_FUND($Fill, $showSql); //23 เงินกบข./เงินกองทุนสำรองเลี้ยงชีพ
        $Data['LEGAL_RIGHT'] = $this->WH_BANKRUPT_ASSETS_LEGAL_RIGHT($Fill, $showSql); //24	สิทธิเรียกร้อง

        $Data['ON_LAND'] = $this->WH_BUILDING_ON_LAND($Fill, $showSql); // บ้านพร้อมที่ดิน

        $this->AssetDataBankrupt = $Data;
        return $Data;
    }

    //ล้มไปล้ม
    public function searchDataBankruptToCivil()
    {

        $AssetBankruptBrc = $this->AssetDataBankrupt; //คดีต้นทางที่ได้จาก PccCivil
        $this->SelecterฺBankrupt = "b.*";
        $this->SelecterฺBankrupt_ON_LAND = "b.*"; //ของสิ่งปลูกสร้าง
        $showSql = '';
    }
    public function searchDataBankruptToBankrupt()
    {

        $AssetBankruptBrc = $this->AssetDataBankrupt; //คดีต้นทางที่ได้จาก PccCivil
        $this->SelecterฺBankrupt = "b.*";
        $this->SelecterฺBankrupt_ON_LAND = "b.*"; //ของสิ่งปลูกสร้าง
        $showSql = '';
        foreach ($AssetBankruptBrc['LAND'] as $key => $value) { //1 ที่ดิน
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'FIND_DOCUMENT_TYPE'    => $this->emp_('xa', 'FIND_DOCUMENT_TYPE', $value['FIND_DOCUMENT_TYPE']), //ประเภทตามเอกสารสิทธิ์
                'LAD_REG_NUMBER'        => $this->emp_('xa', 'LAD_REG_NUMBER', $value['LAD_REG_NUMBER']), //เลขที่โฉนด
                'LAD_LAND_NUMBER'       => $this->emp_('xa', 'LAD_LAND_NUMBER', $value['LAD_LAND_NUMBER']), //เลขที่ดิน
                'LAD_REG_VOLUME'        => $this->emp_('xa', 'LAD_REG_VOLUME', $value['LAD_REG_VOLUME']), //เล่มที่
                'LAD_REG_PAGE'          => $this->emp_('xa', 'LAD_REG_PAGE', $value['LAD_REG_PAGE']), //เลขหน้า
                'LAD_SUBDISTRICT'       => $this->emp_('xa', 'LAD_SUBDISTRICT', $value['LAD_SUBDISTRICT']), //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'LAD_DISTRICT'          => $this->emp_('xa', 'LAD_DISTRICT', $value['LAD_DISTRICT']), //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'LAD_PROVINCE'          => $this->emp_('xa', 'LAD_PROVINCE', $value['LAD_PROVINCE']), //จังหวัด(ตามเอกสารสิทธิ์)
            ];
            $Data['LAND'][] = $this->WH_BANKRUPT_ASSETS_LAND($Fill, $showSql);
        }

        foreach ($AssetBankruptBrc['BUILDING'] as $key => $value) { //2 สิ่งปลูกสร้าง
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'                 => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'FIND_ASSET_TYPE_DETAIL'    => $this->emp_('xa', 'FIND_ASSET_TYPE_DETAIL', $value['FIND_ASSET_TYPE_DETAIL']), //ชนิด
                'BUD_BD_REG_NUMBER'         => $this->emp_('xa', 'BUD_BD_REG_NUMBER', $value['BUD_BD_REG_NUMBER']), //ทะเบียนเลขที่
                'FIND_BUILD_A_MODEL'        => $this->emp_('xa', 'FIND_BUILD_A_MODEL', $value['FIND_BUILD_A_MODEL']), //ปลูกสร้างแบบ
                'FIND_LAND_TYPE'            => $this->emp_('xa', 'FIND_LAND_TYPE', $value['FIND_LAND_TYPE']), //ประเภทที่ดิน
                'BUD_LD_REG_NUMBER'         => $this->emp_('xa', 'BUD_LD_REG_NUMBER', $value['BUD_LD_REG_NUMBER']), //เลขที่
                'BUD_LD_PROVINCE'           => $this->emp_('xa', 'BUD_LD_PROVINCE', $value['BUD_LD_PROVINCE']), //จังหวัด
                'BUD_LD_DISTRICT'           => $this->emp_('xa', 'BUD_LD_DISTRICT', $value['BUD_LD_DISTRICT']), //เขต/อำเภอ
                'BUD_LD_SUBDISTRICT'        => $this->emp_('xa', 'BUD_LD_SUBDISTRICT', $value['BUD_LD_SUBDISTRICT']), //แขวง/ตำบล 
                'BUD_BD_NUM_FLOOR'          => $this->emp_('xa', 'BUD_BD_NUM_FLOOR', $value['BUD_BD_NUM_FLOOR']), //จำนวนชั้น
                'BUD_WIDTH'                 => $this->emp_('xa', 'BUD_WIDTH', $value['BUD_WIDTH']), //กว้าง (เมตร)
                'BUD_HEIGHT'                => $this->emp_('xa', 'BUD_HEIGHT', $value['BUD_HEIGHT']), //ยาว (เมตร)
            ];
            $Data['BUILDING'][] = $this->WH_BANKRUPT_ASSETS_BUILDING($Fill, $showSql);
        }
        foreach ($AssetBankruptBrc['CONDO'] as $key => $value) { //3 ห้องชุด
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'ROM_RM_NUMBER'         => $this->emp_('xa', 'ROM_RM_NUMBER', $value['ROM_RM_NUMBER']), //ห้องชุดเลขที่
                'ROM_BU_REG_NUMBER'     => $this->emp_('xa', 'ROM_BU_REG_NUMBER', $value['ROM_BU_REG_NUMBER']), //ทะเบียนอาคารชุดเลขที่
                'ROM_BU_NAME'           => $this->emp_('xa', 'ROM_BU_NAME', $value['ROM_BU_NAME']), //ชื่ออาคารชุด
                'ROM_FLOOR'             => $this->emp_('xa', 'ROM_FLOOR', $value['ROM_FLOOR']), //ชั้นที่
                'ROM_BU_NUMBER'         => $this->emp_('xa', 'ROM_BU_NUMBER', $value['ROM_BU_NUMBER']), //อาคารเลขที่
                'FIND_LAND_TYPE'        => $this->emp_('xa', 'FIND_LAND_TYPE', $value['FIND_LAND_TYPE']), //ประเภทที่ดิน
                'ROM_LD_REG_NUMBER'     => $this->emp_('xa', 'ROM_LD_REG_NUMBER', $value['ROM_LD_REG_NUMBER']), //เลขที่
                'ROM_LD_PROVINCE'       => $this->emp_('xa', 'ROM_LD_PROVINCE', $value['ROM_LD_PROVINCE']), //จังหวัด
                'ROM_LD_DISTRICT'       => $this->emp_('xa', 'ROM_LD_DISTRICT', $value['ROM_LD_DISTRICT']), //เขต/อำเภอ
                'ROM_LD_SUBDISTRICT'    => $this->emp_('xa', 'ROM_LD_SUBDISTRICT', $value['ROM_LD_SUBDISTRICT']), //แขวง/ตำบล
            ];
            $Data['CONDO'][] = $this->WH_BANKRUPT_ASSETS_CONDO($Fill, $showSql);
        }

        foreach ($AssetBankruptBrc['MACHINERY'] as $key => $value) { //4 เครื่องจักร	
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'MAC_REG_NUMBER'        => $this->emp_('xa', 'MAC_REG_NUMBER', $value['MAC_REG_NUMBER']), //เลขทะเบียนเครื่องจักร
                'MAC_NAME'              => $this->emp_('xa', 'MAC_NAME', $value['MAC_NAME']), //ชื่อเครื่องจักร
                'MAC_SERIAL_NUMBER'     => $this->emp_('xa', 'MAC_SERIAL_NUMBER', $value['MAC_SERIAL_NUMBER']), //หมายเลขเครื่องจักร 
                'MAC_LD_PROVINCE'       => $this->emp_('xa', 'MAC_LD_PROVINCE', $value['MAC_LD_PROVINCE']), //จังหวัด
                'MAC_LD_DISTRICT'       => $this->emp_('xa', 'MAC_LD_DISTRICT', $value['MAC_LD_DISTRICT']), //เขต/อำเภอ 
                'MAC_LD_SUBDISTRICT'    => $this->emp_('xa', 'MAC_LD_SUBDISTRICT', $value['MAC_LD_SUBDISTRICT']), //แขวง/ตำบล
            ];
            $Data['MACHINERY'][] = $this->WH_BANKRUPT_ASSETS_MACHINERY($Fill, $showSql);
        }

        foreach ($AssetBankruptBrc['CAR'] as $key => $value) { //5 รถ ยานพาหนะ
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'FIND_VEHICLE_TYPE'     => $this->emp_('xa', 'FIND_VEHICLE_TYPE', $value['FIND_VEHICLE_TYPE']), //ประเภทพาหนะ 
                'VECL_REGISTER_NUMBER'  => $this->emp_('xa', 'VECL_REGISTER_NUMBER', $value['VECL_REGISTER_NUMBER']), //เลขทะเบียน 
                'FIND_VECL_REG_PRV'     => $this->emp_('xa', 'FIND_VECL_REG_PRV', $value['FIND_VECL_REG_PRV']), //จังหวัด 
                'VECL_CAR_NUMBER'       => $this->emp_('xa', 'VECL_CAR_NUMBER', $value['VECL_CAR_NUMBER']), //เลขตัวรถ  
                'VECL_PROVINCE_NAME'    => $this->emp_('xa', 'VECL_PROVINCE_NAME', $value['VECL_PROVINCE_NAME']), //จังหวัด
                'VECL_DISTRICT_NAME'    => $this->emp_('xa', 'VECL_DISTRICT_NAME', $value['VECL_DISTRICT_NAME']), //เขต/อำเภอ 
                'VECL_SUBDISTRICT_NAME' => $this->emp_('xa', 'VECL_SUBDISTRICT_NAME', $value['VECL_SUBDISTRICT_NAME']), //แขวง/ตำบล
            ];
            $Data['CAR'][] = $this->WH_BANKRUPT_ASSETS_CAR($Fill, $showSql);
        }
        foreach ($AssetBankruptBrc['BOND'] as $key => $value) { //6	พันธบัตร
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
                'FIND_BOND_TYPE'        => $this->emp_('xa', 'FIND_BOND_TYPE', $value['FIND_BOND_TYPE']), //ประเภทพันธบัตร 
                'BOND_REG_NBR'          => $this->emp_('xa', 'BOND_REG_NBR', $value['BOND_REG_NBR']), //ทะเบียนเลขที่ 
                'BOND_AMOUNT'           => $this->emp_('xa', 'BOND_AMOUNT', $value['BOND_AMOUNT']), //จำนวนหน่วย 
                'BOND_PRICE_PER_UNIT'   => $this->emp_('xa', 'BOND_PRICE_PER_UNIT', $value['BOND_PRICE_PER_UNIT']), //ราคาหน่วยละ (บาท) 
                'BOND_NAME'             => $this->emp_('xa', 'BOND_NAME', $value['BOND_NAME']), //ชื่อพันธบัตร 
                'BOND_NBR'              => $this->emp_('xa', 'BOND_NBR', $value['BOND_NBR']), //เลขที่ตั้งแต่* 
                'BOND_NBR_EXT'          => $this->emp_('xa', 'BOND_NBR_EXT', $value['BOND_NBR_EXT']), //เลขที่ถึง 

                'BOND_PROVINCE'    => $this->emp_('xa', 'BOND_PROVINCE', $value['BOND_PROVINCE']), //จังหวัด
                'BOND_DISTRICT'    => $this->emp_('xa', 'BOND_DISTRICT', $value['BOND_DISTRICT']), //เขต/อำเภอ 
                'BOND_SUBDISTRICT' => $this->emp_('xa', 'BOND_SUBDISTRICT', $value['BOND_SUBDISTRICT']), //แขวง/ตำบล
            ];
            $Data['BOND'][] = $this->WH_BANKRUPT_ASSETS_BOND($Fill, $showSql);
        }

        foreach ($AssetBankruptBrc['LOTTERY'] as $key => $value) { //7	สลากออมทรัพย์
            unset($Fill);
            //เสร็จ
            $Fill = [
                'Not_BrcId'             => "AND a.BANKRUPT_CODE  !='" . $this->BANKRUPT_CODE . "'",
            ];
            $Data['LOTTERY'][] = $this->WH_BANKRUPT_ASSETS_LOTTERY($Fill, $showSql);
        }
    }

    //แพ่งหาในล้ม
    public function searchDataCivilToBankrupt()
    {
        // $AssetCivilPcc = $this->DataAssetCivil(); //คดีต้นทางที่ได้จาก PccCivil
        $AssetCivilPcc = $this->AssetDataPccCivil; //คดีต้นทางที่ได้จาก PccCivil
        $this->SelecterฺBankrupt = "b.*";
        $this->SelecterฺBankrupt_ON_LAND = "b.*"; //ของสิ่งปลูกสร้าง
        $showSql = '';
        foreach ($AssetCivilPcc['LAND'] as $key => $value) { //1 ที่ดิน
            unset($Fill);
            //ไม่ตรง 3 fill
            $Fill = [
                'FIND_DOCUMENT_TYPE'     => $this->emp_('xa', 'FIND_DOCUMENT_TYPE', $value['LAND_TYPE']), //ประเภทตามเอกสารสิทธิ์
                'LAD_REG_NUMBER'       => $this->emp_('xa', 'LAD_REG_NUMBER', $value['DEED_NO']), //เลขที่โฉนด
                'LAD_LAND_NUMBER'       => $this->emp_('xa', 'LAD_LAND_NUMBER', $value['LAND_NO']), //เลขที่ดิน
                'LAD_REG_VOLUME'       => $this->emp_('xa', 'LAD_REG_VOLUME', $value['BOOK_NO']), //เล่มที่
                'LAD_REG_PAGE'       => $this->emp_('xa', 'LAD_REG_PAGE', $value['PAGE_NO']), //เลขหน้า
                'LAD_DEALING_FILE_NUMBER'        => $this->emp_('xa', 'LAD_DEALING_FILE_NUMBER', $value['SURVEY']), //หน้าสำรวจ
                //'DOC_BOOK_NO'   => $this->emp_('xa', 'DOC_BOOK_NO', $value['DOC_BOOK_NO']), //สารบบเล่ม
                //'DOC_PAGE_NO'   => $this->emp_('xa', 'DOC_PAGE_NO', $value['DOC_PAGE_NO']), //สารบบหน้าที่
                //'MOO_NO'        => $this->emp_('xa', 'MOO_NO', $value['MOO_NO']), //หมู่ที่
                'LAD_SUBDISTRICT' => $this->emp_('xa', 'LAD_SUBDISTRICT', $value['DISTRICT_NAME']), //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'LAD_DISTRICT'   => $this->emp_('xa', 'LAD_DISTRICT', $value['AMPHUR_NAME']), //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'LAD_PROVINCE' => $this->emp_('xa', 'LAD_PROVINCE', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
            ];
            $Data['LAND'][] = $this->WH_BANKRUPT_ASSETS_LAND($Fill, $showSql);
        }


        foreach ($AssetCivilPcc['BUILDING'] as $key => $value) {  //สิ่งปลูกสร้าง
            unset($Fill);
            //ครบ
            $Fill = [
                'BUD_BD_REG_NUMBER'      => $this->emp_('xa', 'BUD_BD_REG_NUMBER', $value['ADDR_NO']), //ADDR_NO บ้านเลขที่
                'BUD_BD_NAME'      => $this->emp_('xa', 'BUD_BD_NAME', $value['VILLAGE_NAME']), //ชื่อหมู่บ้าน/โครงการ 
            ];
            $Data['BUILDING'][] = $this->WH_BANKRUPT_ASSETS_BUILDING($Fill, $showSql); // 
        }
        foreach ($AssetCivilPcc['MAP_HOUSE'] as $key => $value) {  //2 ที่ดินเเละสิ่งปลูกสร้าง
            unset($Fill);
            //ครบ
            $Fill = [
                'BUD_BD_REG_NUMBER'      => $this->emp_('xa', 'BUD_BD_REG_NUMBER', $value['ADDR_NO']), //ADDR_NO บ้านเลขที่
                'BUD_BD_NAME'      => $this->emp_('xa', 'BUD_BD_NAME', $value['VILLAGE_NAME']), //ชื่อหมู่บ้าน/โครงการ 
                'LAD_SUBDISTRICT'              => $this->emp_('xc', 'LAD_SUBDISTRICT', $value['AMPHUR_NAME']), //เขต/อำเภอ(ตามเอกสารสิทธิ์)
                'LAD_DISTRICT'              => $this->emp_('xc', 'LAD_DISTRICT', $value['DISTRICT_NAME']), //แขวง/ตำบล(ตามเอกสารสิทธิ์)
                'LAD_PROVINCE'              => $this->emp_('xc', 'LAD_PROVINCE', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
            ];
            $Data['MAP_HOUSE'][] = $this->WH_BUILDING_ON_LAND($Fill, $showSql); //WH_BANKRUPT_ASSETS_BUILDING
        }
        foreach ($AssetCivilPcc['CONDO'] as $key => $value) {  //ห้องชุด อาคารชุด 03
            unset($Fill);
            //ครบ
            $Fill = [
                'ROM_BU_NAME'     => $this->emp_('xa', 'ROM_BU_NAME', $value['BUILDING_NAME']), //ชื่ออาคารชุด
                'ROM_BU_NUMBER'       => $this->emp_('xa', 'ROM_BU_NUMBER', $value['BUILDING_NO']), //อาคารเลขที่
                'ROM_BU_REG_NUMBER'        => $this->emp_('xa', 'ROM_BU_REG_NUMBER', $value['LICENSE_NO']), //ทะเบียนอาคารชุดเลขที่
                'ROM_FLOOR'             => $this->emp_('xa', 'ROM_FLOOR', $value['FLOOR']), //ชั้นที่
                'ROM_LD_PROVINCE'     => $this->emp_('xa', 'ROM_LD_PROVINCE', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
                'ROM_LD_SUBDISTRICT'       => $this->emp_('xa', 'ROM_LD_SUBDISTRICT', $value['AMPHUR_NAME']), //เขต/อำเภอ(ตามเอกสารสิทธิ์)
                'ROM_LD_DISTRICT'     => $this->emp_('xa', 'ROM_LD_DISTRICT', $value['DISTRICT_NAME']), //แขวง/ตำบล(ตามเอกสารสิทธิ์)
            ];
            $Data['CONDO'][] = $this->WH_BANKRUPT_ASSETS_CONDO($Fill, $showSql); //WH_CIVIL_CASE_ASSETS_CONDO
        }

        foreach ($AssetCivilPcc['MACHINE'] as $key => $value) { //เครื่องจักร 4
            unset($Fill);
            //ครบ
            $Fill = [
                'MAC_NAME' => $this->emp_('xa', 'MAC_NAME', $value['MACHINE_NAME']),  //ชื่อเครื่องจักร
                'MAC_REG_NUMBER'  => $this->emp_('xa', 'MAC_REG_NUMBER', $value['LICENSE_NO']), //เลขทะเบียนเครื่องจักร
                //'MAC_SERIAL_NUMBER'  => $this->emp_('xa', 'MAC_SERIAL_NUMBER', $value['']), //หมายเลขเครื่องจักร
            ];
            $Data['MACHINE'][] = $this->WH_BANKRUPT_ASSETS_MACHINERY($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['CAR'] as $key => $value) {  //รถ 5
            //ครบ
            unset($Fill);
            $Fill = [
                'FIND_VEHICLE_TYPE'      => $this->emp_('xa', 'FIND_VEHICLE_TYPE', $value['VEHICLE_TYPE']), //ประเภทยานยนต์
                // 'PLATE_NO1'         => $this->emp_('xa', 'PLATE_NO1', $value['PLATE_NO1']), //หมวด
                'VECL_REGISTER_NUMBER'         => $this->emp_('xa', 'VECL_REGISTER_NUMBER', $value['PLATE_NO2']), //เลขที่ทะเบียน
                'FIND_VECL_REG_PRV'     => $this->emp_('xa', 'FIND_VECL_REG_PRV', $value['LICENSE_PLACE']), //จังหวัด
                'VECL_CAR_NUMBER'           => $this->emp_('xa', 'VECL_CAR_NUMBER', $value['BODY_NO']), //เลขตัวรถ
                'VECL_BRAND'   => $this->emp_('xa', 'VECL_BRAND', $value['BRAND_TYPE_NAME']), //ยี่ห้อรถ
            ];
            $Data['CAR'][] = $this->WH_BANKRUPT_ASSETS_CAR($Fill, $showSql);
        }

        //WH_CIVIL_CASE_ASSETS_BOAT
        foreach ($AssetCivilPcc['BOAT'] as $key => $value) { //เรือ
            //ขาด จังหวัด
            unset($Fill);
            $Fill = [
                'FIND_VEHICLE_TYPE'      => $this->emp_('xa', 'FIND_VEHICLE_TYPE', "เรือ"), //ประเภท
                'VECL_REGISTER_NUMBER'       => $this->emp_('xa', 'VECL_REGISTER_NUMBER', $value['BOAT_ID']), // ทะเบียนเรือ
            ];
            $Data['BOAT'][] = $this->WH_BANKRUPT_ASSETS_CAR($Fill, $showSql);
        }

        //
        foreach ($AssetCivilPcc['BOND'] as $key => $value) { //พันธบัตร
            //ครบ
            unset($Fill);
            $Fill = [
                //'BONDS_PERSON_GEN'      => $this->emp_('xa', 'BONDS_PERSON_GEN', $value['BONDS_PERSON_GEN']), //หน่วยงานที่ออกพันธบัตร
                'BOND_REG_NBR'              => $this->emp_('xa', 'BOND_REG_NBR', $value['BONDS_ID']), //เลขทะเบียน
                'BOND_NBR'              => $this->emp_('xa', 'BOND_NBR', $value['BONDS_NO']), //พันธบัตรเลขที่ต้น
                'BOND_NBR_EXT'           => $this->emp_('xa', 'BOND_NBR_EXT', $value['BONDS_NO_TO']), //พันธบัตรเลขท้าย
            ];
            $Data['BOND'][] = $this->WH_BANKRUPT_ASSETS_BOND($Fill, $showSql);
        }

        //WH_CIVIL_CASE_ASSETS_LOTTERY
        foreach ($AssetCivilPcc['LOTTERY'] as $key => $value) { //สลากออมทรัพย์ 7
            unset($Fill);
            //ในล้มต้องการข้อมูลมากกว่านี้
            $Fill = [
                'LOT_NBR'        => $this->emp_('xa', 'LOT_NBR', $value['SAVE_NO_FR']),  //ตั้งแต่ เลขที่สลากออมทรัพย์
                'LOT_NBR_EXT'        => $this->emp_('xa', 'LOT_NBR_EXT', $value['SAVE_NO_TO']),  //ถึง เลขที่สลากออมทรัพย์
                'LOT_REG_NAME'        => $this->emp_('xa', 'LOT_REG_NAME', $value['SAVE_BOOK_NO']),  //เลขทะเบียน
            ];
            $Data['LOTTERY'][] = $this->WH_BANKRUPT_ASSETS_LOTTERY($Fill, $showSql);
        }

        //WH_CIVIL_CASE_ASSETS_GUN
        foreach ($AssetCivilPcc['GUN'] as $key => $value) { //ปืน 14
            //ครบ
            unset($Fill);
            $Fill = [
                'GUN_NO'      => $this->emp_('xa', 'GUN_NO', $value['GUN_NO']), //หมายเลขประจำปืน
            ];
            $Data['GUN'][] = $this->WH_BANKRUPT_ASSETS_FIREARM($Fill, $showSql);
        }

        //WH_CIVIL_CASE_ASSETS_STOCK
        foreach ($AssetCivilPcc['STOCK'] as $key => $value) { //หุ้น 08
            //ขาด
            unset($Fill);
            $Fill = [
                'FIND_STOCK_FORM'        => $this->emp_('xa', 'FIND_STOCK_FORM', $value['STOCK_TYPE']), //ประเภทหุ้น
                'ASH_OWN_COMP_NAME'       => $this->emp_('xa', 'ASH_OWN_COMP_NAME', $value['COMPANY_GEN']), //นิติบุคคลผู้ออกหุ้น บริษัทเจ้าของหุ้น
                'ASH_STK_NO'     => $this->emp_('xa', 'ASH_STK_NO', $value['STOCK_ID_FROM']), //เลขต้น
                'ASH_TO'       => $this->emp_('xa', 'ASH_TO', $value['STOCK_ID_TO']), //ถึงเลขที่ใบหุ้น
            ];
            $Data['STOCK'][] = $this->WH_BANKRUPT_ASSETS_STOCK($Fill, $showSql);
        }

        //WH_CIVIL_CASE_ASSETS_BUIL_RENT
        foreach ($AssetCivilPcc['BUIL_RENT'] as $key => $value) {  //สิทธิการเช่า ห้องชุด 05,พื้นที่ในอาคาร
            //ครบ
            unset($Fill);
            $Fill = [
                'FIND_LEASEHOLD_RIGHTS_TYPE'         => $this->emp_('xa', 'FIND_LEASEHOLD_RIGHTS_TYPE', $value['RENT_TYPE']), //ประเภททรัพย์ที่เช่า
                'ARR_PROP_DISTRICT'     => $this->emp_('xa', 'ARR_PROP_DISTRICT', $value['DISTRICT_NAME']), //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'ARR_PROP_SUBDISTRICT'       => $this->emp_('xa', 'ARR_PROP_SUBDISTRICT', $value['AMPHUR_NAME']), //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'ARR_PROP_PROVINCE'     => $this->emp_('xa', 'ARR_PROP_PROVINCE', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
                // 'CONTACT_NO'        => $this->emp_('xa', 'CONTACT_NO', $value['CONTACT_NO']), //สัญญาเช่าเลขที่
            ];
            $Data['BUIL_RENT'][] = $this->WH_BANKRUPT_ASSETS_RENT_RIGHT($Fill, $showSql);
        }


        //ส่งกลับข้อมูลทรัพย์ที่ตรวจพบ
        return $Data;
    }

    //แพ่งหาในแเพ่ง
    public function searchDataCivilToCivil()
    {
        $Data = [];
        // $AssetCivilPcc = $this->DataAssetCivil(); //คดีต้นทางที่ได้จาก PccCivil
        $AssetCivilPcc = $this->AssetDataPccCivil;
        $this->SelecterCivil = "a.*,b.*";
        $this->SelecterCivil_MAP_HOUSE = "a.*,b.*";
        $showSql = '';
        foreach ($AssetCivilPcc['LAND'] as $key => $value) { //ที่ดิน
            unset($Fill);
            //ครบ
            $Fill = [
                'Not_Civil'     => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'LAND_TYPE'     => $this->emp_('xa', 'LAND_TYPE', $value['LAND_TYPE']), //ชนิดเอกสารสิทธิ์
                'DEED_NO'       => $this->emp_('xa', 'DEED_NO', $value['DEED_NO']), //เลขที่โฉนด
                'LAND_NO'       => $this->emp_('xa', 'LAND_NO', $value['LAND_NO']), //เลขที่ดิน
                'BOOK_NO'       => $this->emp_('xa', 'BOOK_NO', $value['BOOK_NO']), //เล่มที่
                'PAGE_NO'       => $this->emp_('xa', 'PAGE_NO', $value['PAGE_NO']), //เลขหน้า
                'SURVEY'        => $this->emp_('xa', 'SURVEY', $value['SURVEY']), //หน้าสำรวจ
                'DOC_BOOK_NO'   => $this->emp_('xa', 'DOC_BOOK_NO', $value['DOC_BOOK_NO']), //สารบบเล่ม
                'DOC_PAGE_NO'   => $this->emp_('xa', 'DOC_PAGE_NO', $value['DOC_PAGE_NO']), //สารบบหน้าที่
                'MOO_NO'        => $this->emp_('xa', 'MOO_NO', $value['MOO_NO']), //หมู่ที่
                'DISTRICT_NAME' => $this->emp_('xa', 'DISTRICT_NAME', $value['DISTRICT_NAME']), //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'AMPHUR_NAME'   => $this->emp_('xa', 'AMPHUR_NAME', $value['AMPHUR_NAME']), //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'PROVINCE_NAME' => $this->emp_('xa', 'PROVINCE_NAME', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
            ];
            //  $Data['LAND'][] = $this->WH_CIVIL_CASE_ASSETS_LAND($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_LAND($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['BOAT'] as $key => $value) { //เรือ
            //ขาด จังหวัด
            unset($Fill);
            $Fill = [
                'Not_Civil'     => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'BOAT_ID'       => $this->emp_('xa', 'BOAT_ID', $value['BOAT_ID']), // ทะเบียนเรือ
            ];
            //$Data['BOAT'][] = $this->WH_CIVIL_CASE_ASSETS_BOAT($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_BOAT($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['BOND'] as $key => $value) { //พันธบัตร
            //ครบ
            unset($Fill);
            $Fill = [
                'Not_Civil'             => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'BONDS_PERSON_GEN'      => $this->emp_('xa', 'BONDS_PERSON_GEN', $value['BONDS_PERSON_GEN']), //หน่วยงานที่ออกพันธบัตร
                'BONDS_ID'              => $this->emp_('xa', 'BONDS_ID', $value['BONDS_ID']), //เลขทะเบียน
                'BONDS_NO'              => $this->emp_('xa', 'BONDS_NO', $value['BONDS_NO']), //พันธบัตรเลขที่
                'BONDS_NO_TO'           => $this->emp_('xa', 'BONDS_NO_TO', $value['BONDS_NO_TO']), //พันธบัตรเลขท้าย
            ];
            //$Data['BOND'][] = $this->WH_CIVIL_CASE_ASSETS_BOND($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_BOND($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['BUIL_RENT'] as $key => $value) {  //สิทธิการเช่า ห้องชุด 05
            //ครบ
            unset($Fill);
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'RENT_TYPE'         => $this->emp_('xa', 'RENT_TYPE', $value['RENT_TYPE']), //ประเภททรัพย์ที่เช่า
                'DISTRICT_NAME'     => $this->emp_('xa', 'DISTRICT_NAME', $value['DISTRICT_NAME']), //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'AMPHUR_NAME'       => $this->emp_('xa', 'AMPHUR_NAME', $value['AMPHUR_NAME']), //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'PROVINCE_NAME'     => $this->emp_('xa', 'PROVINCE_NAME', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
                'CONTACT_NO'        => $this->emp_('xa', 'CONTACT_NO', $value['CONTACT_NO']), //สัญญาเช่าเลขที่
            ];
            //$Data['BUIL_RENT'][] = $this->WH_CIVIL_CASE_ASSETS_BUIL_RENT($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_BUIL_RENT($Fill, $showSql);
        }

        foreach ($AssetCivilPcc['BUILDING'] as $key => $value) {  //สิ่งปลูกสร้าง
            unset($Fill);
            //ครบ
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'ADDR_NO'      => $this->emp_('xa', 'ADDR_NO', $value['ADDR_NO']), //ADDR_NO บ้านเลขที่
                'VILLAGE_NAME'      => $this->emp_('xa', 'VILLAGE_NAME', $value['VILLAGE_NAME']), //ชื่อหมู่บ้าน/โครงการ 
                'MOO_NO'            => $this->emp_('xa', 'MOO_NO', $value['MOO_NO']), //หมู่
                'SOI'               => $this->emp_('xa', 'SOI', $value['SOI']), //ซอย
                'ROAD'              => $this->emp_('xa', 'ROAD', $value['ROAD']), //ถนน
            ];
            // $Data['BUILDING'][] = $this->WH_CIVIL_CASE_ASSETS_BUILDING($Fill, $showSql); // 
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_BUILDING($Fill, $showSql);
        }


        foreach ($AssetCivilPcc['MAP_HOUSE'] as $key => $value) {  //ที่ดินเเละสิ่งปลูกสร้าง
            unset($Fill);
            //ครบ
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'ADDR_NO'      => $this->emp_('xa', 'ADDR_NO', $value['ADDR_NO']), //ADDR_NO บ้านเลขที่
                'VILLAGE_NAME'      => $this->emp_('xa', 'VILLAGE_NAME', $value['VILLAGE_NAME']), //ชื่อหมู่บ้าน/โครงการ 
                'MOO_NO'            => $this->emp_('xa', 'MOO_NO', $value['MOO_NO']), //หมู่
                'SOI'               => $this->emp_('xa', 'SOI', $value['SOI']), //ซอย
                'ROAD'              => $this->emp_('xa', 'ROAD', $value['ROAD']), //ถนน
                'AMPHUR_NAME'              => $this->emp_('xc', 'AMPHUR_NAME', $value['AMPHUR_NAME']), //เขต/อำเภอ(ตามเอกสารสิทธิ์)
                'DISTRICT_NAME'              => $this->emp_('xc', 'DISTRICT_NAME', $value['DISTRICT_NAME']), //แขวง/ตำบล(ตามเอกสารสิทธิ์)
                'PROVINCE_NAME'              => $this->emp_('xc', 'PROVINCE_NAME', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)

            ];
            //$Data['MAP_HOUSE'][] = $this->WH_LAND_MAP_HOUSE($Fill, $showSql); //WH_CIVIL_CASE_ASSETS_BUILDING 
            //$Data[$value['CFC_CAPTION_GEN']][] = $this->WH_LAND_MAP_HOUSE($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['CAR'] as $key => $value) {  //รถ 11
            //ครบ
            unset($Fill);
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'VEHICLE_TYPE'      => $this->emp_('xa', 'VEHICLE_TYPE', $value['VEHICLE_TYPE']), //ประเภทรถ
                'PLATE_NO1'         => $this->emp_('xa', 'PLATE_NO1', $value['PLATE_NO1']), //หมวด
                'PLATE_NO2'         => $this->emp_('xa', 'PLATE_NO2', $value['PLATE_NO2']), //เลขที่ทะเบียน
                'LICENSE_PLACE'     => $this->emp_('xa', 'LICENSE_PLACE', $value['LICENSE_PLACE']), //จังหวัด
                'BODY_NO'           => $this->emp_('xa', 'BODY_NO', $value['BODY_NO']), //เลขตัวรถ
                'BRAND_TYPE_NAME'   => $this->emp_('xa', 'BRAND_TYPE_NAME', $value['BRAND_TYPE_NAME']), //ยี่ห้อรถ
            ];
            //$Data['CAR'][] = $this->WH_CIVIL_CASE_ASSETS_CAR($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_CAR($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['CONDO'] as $key => $value) {  //ห้องชุด อาคารชุด 03
            unset($Fill);
            //ขาด เลขที่ปลูกสร้าง
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'FLOOR'             => $this->emp_('xa', 'FLOOR', $value['FLOOR']), //ชั้นที่
                'BUILDING_NO'       => $this->emp_('xa', 'BUILDING_NO', $value['BUILDING_NO']), //อาคารเลขที่
                'BUILDING_NAME'     => $this->emp_('xa', 'BUILDING_NAME', $value['BUILDING_NAME']), //ชื่ออาคารชุด
                'LICENSE_NO'        => $this->emp_('xa', 'LICENSE_NO', $value['LICENSE_NO']), //ทะเบียนอาคารชุดเลขที่
                'DEED_NO'           => $this->emp_('xa', 'DEED_NO', $value['DEED_NO']), //ตั้งอยู่บนเอกสารสิทธิ์เลขที่
                'PROVINCE_NAME'     => $this->emp_('xa', 'PROVINCE_NAME', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
                'AMPHUR_NAME'       => $this->emp_('xa', 'AMPHUR_NAME', $value['AMPHUR_NAME']), //เขต/อำเภอ(ตามเอกสารสิทธิ์)
                'DISTRICT_NAME'     => $this->emp_('xa', 'DISTRICT_NAME', $value['DISTRICT_NAME']), //แขวง/ตำบล(ตามเอกสารสิทธิ์)
            ];
            //$Data['CONDO'][] = $this->WH_CIVIL_CASE_ASSETS_CONDO($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_CONDO($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['FUND'] as $key => $value) { //หน่วยลงทุน  16
            unset($Fill);
            //mapไม่ได้
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'MANAGER_FUND_NAME' => $this->emp_('xa', 'MANAGER_FUND_NAME', $value['MANAGER_FUND_NAME']), //หน่วยงานที่ออกสลาก
                'FUND_NAME'         => $this->emp_('xa', 'FUND_NAME', $value['FUND_NAME']),  //ชื่อหน่วยลงทุน
            ];
            //$Data['FUND'][] = $this->WH_CIVIL_CASE_ASSETS_FUND($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_FUND($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['GUN'] as $key => $value) { //ปืน 14
            //ครบ
            unset($Fill);
            $Fill = [
                'Not_Civil'   => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'GUN_NO'      => $this->emp_('xa', 'GUN_NO', $value['GUN_NO']), //หมายเลขประจำปืน
            ];
            //$Data['GUN'][] = $this->WH_CIVIL_CASE_ASSETS_GUN($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_GUN($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['LAND_RENT'] as $key => $value) { //สิทธิการเช่า ที่ดินและสิ่งปลูกสร้าง 04
            //ครบ
            unset($Fill);
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'RENT_TYPE'         => $this->emp_('xa', 'RENT_TYPE', $value['RENT_TYPE']),  //ประเภททรัพย์ที่เช่า เช่น  ที่ดินพร้อมสิ่งปลูกสร้าง, แผงลอย
                'DISTRICT_NAME'     => $this->emp_('xa', 'DISTRICT_NAME', $value['DISTRICT_NAME']),  //ตำบล/แขวง(ตามเอกสารสิทธิ์)
                'AMPHUR_NAME'       => $this->emp_('xa', 'AMPHUR_NAME', $value['AMPHUR_NAME']),  //อำเภอ/เขต(ตามเอกสารสิทธิ์)
                'PROVINCE_NAME'     => $this->emp_('xa', 'PROVINCE_NAME', $value['PROVINCE_NAME']), //จังหวัด(ตามเอกสารสิทธิ์)
                'CONTACT_NO'        => $this->emp_('xa', 'CONTACT_NO', $value['CONTACT_NO']),  //สัญญาเช่าเลขที่

            ];
            //$Data['LAND_RENT'][] = $this->WH_CIVIL_CASE_ASSETS_LAND_RENT($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_LAND_RENT($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['LOTTERY'] as $key => $value) { //สลากออมทรัพย์ 10
            unset($Fill);
            //mapไม่ได้ คือหน้าคนหาไม่มีให้map //map ฟิลเอง
            $Fill = [
                'Not_Civil'   => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'SAVE_NO_FR'        => $this->emp_('xa', 'SAVE_NO_FR', $value['SAVE_NO_FR']),  //ตั้งแต่ เลขที่สลากออมทรัพย์
                'SAVE_NO_TO'        => $this->emp_('xa', 'SAVE_NO_TO', $value['SAVE_NO_TO']),  //ถึง เลขที่สลากออมทรัพย์
                'SAVE_RUN_NO'        => $this->emp_('xa', 'SAVE_RUN_NO', $value['SAVE_RUN_NO']),  //เลขที่สลาก
                'SAVE_BOOK_NO'        => $this->emp_('xa', 'SAVE_BOOK_NO', $value['SAVE_BOOK_NO']),  //เลขทะเบียน
            ];
            // $Data['LOTTERY'][] = $this->WH_CIVIL_CASE_ASSETS_LOTTERY($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_LOTTERY($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['MACHINE'] as $key => $value) { //เครื่องจักร 13
            unset($Fill);
            //ครบ
            $Fill = [
                'Not_Civil'   => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'MACHINE_NAME' => $this->emp_('xa', 'MACHINE_NAME', $value['MACHINE_NAME']),  //ชื่อเครื่องจักร
                'LICENSE_NO'  => $this->emp_('xa', 'LICENSE_NO', $value['LICENSE_NO']), //หมายเลขเครื่องจักร เลขทะเบียนเครื่องจักร
            ];
            //$Data['MACHINE'][] = $this->WH_CIVIL_CASE_ASSETS_MACHINE($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_MACHINE($Fill, $showSql);
        }

        foreach ($AssetCivilPcc['MACHINE'] as $key => $value) { //บัญชีทรัพย์สินอื่นๆ 99
            //ขาด จังหวัด อำเภอ ตำบล
            unset($Fill);
            $Fill = [
                'Not_Civil'     => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'CAP_NAME'      => $this->emp_('xa', 'CAP_NAME', $value['CAP_NAME']), //รายละเอียด
                'ADDR_NO'       => $this->emp_('xa', 'ADDR_NO', $value['ADDR_NO']), //ตั้งอยู่เลขที่
                'MOO_NO'        => $this->emp_('xa', 'MOO_NO', $value['MOO_NO']), //หมู่ที่
                'SOI'           => $this->emp_('xa', 'SOI', $value['SOI']), //ซอย
                'ROAD'          => $this->emp_('xa', 'ROAD', $value['ROAD']), //ถนน
            ];
            //$Data['MACHINE'][] = $this->WH_CIVIL_CASE_ASSETS_OTHER($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_OTHER($Fill, $showSql);
        }
        foreach ($AssetCivilPcc['STOCK'] as $key => $value) { //หุ้น 08
            //ขาด
            unset($Fill);
            $Fill = [
                'Not_Civil'         => "AND a.CIVIL_CODE  !='" . $this->CIVIL_CODE . "'",
                'STOCK_TYPE'        => $this->emp_('xa', 'STOCK_TYPE', $value['STOCK_TYPE']), //ประเภทหุ้น
                'COMPANY_GEN'       => $this->emp_('xa', 'COMPANY_GEN', $value['COMPANY_GEN']), //นิติบุคคลผู้ออกหุ้น
                'STOCK_ID_FROM'     => $this->emp_('xa', 'STOCK_ID_FROM', $value['STOCK_ID_FROM']), //STOCK_ID_FROM
                'STOCK_ID_TO'       => $this->emp_('xa', 'STOCK_ID_TO', $value['STOCK_ID_TO']), //ถึงเลขที่ใบหุ้น
            ];
            //$Data['STOCK'][] = $this->WH_CIVIL_CASE_ASSETS_STOCK($Fill, $showSql);
            $Data[$value['CFC_CAPTION_GEN']][] = $this->WH_CIVIL_CASE_ASSETS_STOCK($Fill, $showSql);
        }

        //ส่งกลับข้อมูลทรัพย์ที่ตรวจพบ
        return $Data;
    }
}

class checkMain
{

    public $Report = [];
    public $statusWork;
    public function time_function($function, ...$args)
    {
        if (!empty($this->statusWork)) {
            $start = microtime(true);

            // เรียกใช้ฟังก์ชันหรือโค้ดที่ต้องการจับเวลาการทำงาน
            $result = call_user_func_array($function, $args);

            $end = microtime(true);
            $executionTime = $end - $start;

            // สร้างอาร์เรย์ผลลัพธ์ที่มีข้อมูลเวลาการทำงานและผลลัพธ์ที่คืนมาจากฟังก์ชัน
            $this->Report[$function] = [
                'execution_time' => $executionTime,
                'result' => $result
            ];
        }
    }
    public function report_function()
    {
        if (!empty($this->statusWork)) {
            return $this->Report;
        }
    }


    public static function NotInCaseMyself($CodeApi, $SEND_TO, $sys)
    {
        /* start ไม่เอาคดีตัวเอง */
        $filter1 = "";
        if ($CodeApi != "" && $SEND_TO == '1' && $sys == 'Civil') { //ไม่เอาคดีตัวเองในเเพ่ง
            $sqlSelectData = "	SELECT 	b.WH_CIVIL_ID
                            FROM 	WH_CIVIL_CASE a
                            JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . "  b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                            WHERE 	CIVIL_CODE = '" . $CodeApi  . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 = "AND TB.WH_ID !='" . $rec_PCC['WH_CIVIL_ID'] . "' ";
        }
        if ($CodeApi != "" && $SEND_TO == '2' && $sys == 'Bankrupt') { //ไม่เอาคดีตัวเองในล้มละลาย
            $sqlSelectData = "	SELECT a.WH_BANKRUPT_ID  FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.BANKRUPT_CODE  = '" . $CodeApi . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 = "AND (TB.WH_ID !='" . $rec_PCC['WH_BANKRUPT_ID'] . "') ";
        }
        if ($CodeApi != "" && $SEND_TO == '3'  && $sys == 'Revive') { //ไม่เอาคดีตัวเองในฟื้นฟู
            $sqlSelectData = "	SELECT a.WH_REHAB_ID FROM WH_REHABILITATION_CASE_DETAIL a  where a.REHAB_CODE='" . $CodeApi . "' ";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 = "AND (TB.WH_ID !='" . $rec_PCC['WH_REHAB_ID'] . "') ";
        }
        if ($CodeApi != "" && $SEND_TO == '4'  && $sys == 'Mediate') { //ไม่เอาคดีตัวเองในไกล่เกลี่ย
            $sqlSelectData = "	SELECT a.WH_MEDAITE_ID FROM WH_MEDIATE_CASE a WHERE a.REF_WFR_ID = '" .  $CodeApi  . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 = "AND (TB.WH_ID !='" . $rec_PCC['WH_MEDAITE_ID'] . "') ";
        }
        return $filter1;
        /* stop ไม่เอาคดีตัวเอง */
    }
    public static function REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, $CONCERN_NAME, $NOTCONCERN_NAME)
    { //ส่งรหัสคดีPCC_CIVIL_GEN,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
        $FILL = "";
        if ($CONCERN_NAME != '') {
            $FILL .= "  AND a.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
        }

        if ($NOTCONCERN_NAME != '') {
            $FILL .= "  AND a.CONCERN_NAME NOT IN (" . result_array($NOTCONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น

            /* ตรวจโจทก์เป็น ผู้รับจำนอง start */
            $sql = "";
            $IDCARD1 = "";
            $sql = "SELECT a.REGISTER_CODE
			FROM " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a 
			JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
			WHERE 	1=1 
			AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "' 
			AND a.REGISTER_CODE IS NOT NULL   
			AND a.CONCERN_NAME IN ('ผู้รับจำนอง')
			AND a.REGISTER_CODE IN (SELECT xx.REGISTER_CODE FROM " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " xx 
			JOIN WH_CIVIL_CASE xa ON xx.WH_CIVIL_ID =xa.WH_CIVIL_ID 
			WHERE 	1=1 AND xa.CIVIL_CODE= '" . $PCC_CIVIL_GEN . "' 
			AND xx.REGISTER_CODE IS NOT NULL   
			AND xx.CONCERN_NAME IN ('โจทก์','เจ้าหนี้')
			)";
            $query = db::query($sql);
            while ($rec = db::fetch_array($query)) {
                $IDCARD1 .= $rec["REGISTER_CODE"] . ","; //13หลัก โจทก์ เจ้าหนี้
            }
            if (!empty($IDCARD1)) {
                $FILL .= "AND a.REGISTER_CODE NOT IN (" . result_array(cut_last_comma($IDCARD1)) . ")";
            }

            /* ตรวจโจทก์เป็น ผู้รับจำนอง stop */
        }


        $sql_WH_PERSON = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
			,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
			FROM " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a 
			JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
			WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "' AND a.REGISTER_CODE IS NOT NULL {$FILL}
			";
        $REGISTERCODE = '';
        $queryWH_PERSON = db::query($sql_WH_PERSON);
        while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
            $REGISTERCODE .= $rec_WH["REGISTER_CODE"] . ",";
        }
        //return $sql_WH_PERSON;
        return cut_last_comma($REGISTERCODE);
    }
    public static function REGISTER_CODE_13_BANKRUPT($brcID, $CONCERN_NAME, $NOTCONCERN_NAME)
    { //ส่งรหัสคดีbrcID,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
        $FILL = "";
        if ($CONCERN_NAME != '') {
            $FILL = "  AND a.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
        }
        if ($NOTCONCERN_NAME != '') {
            $FILL .= "  AND a.CONCERN_NAME NOT IN (" . result_array($NOTCONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น

            /* ตรวจโจทก์เป็น ผู้รับจำนอง start */
            $sql = "";
            $IDCARD1 = "";
            $sql = "SELECT *FROM WH_BANKRUPT_CASE_PERSON a
            JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
            WHERE 1=1
            AND a.REGISTER_CODE IS NOT NULL
            AND b.BANKRUPT_CODE= '" . $brcID . "'
            AND a.CONCERN_NAME IN ('ผู้รับจำนอง')
            AND a.REGISTER_CODE IN (SELECT xa.REGISTER_CODE FROM WH_BANKRUPT_CASE_PERSON xa
            JOIN WH_BANKRUPT_CASE_DETAIL b ON xa.WH_BANKRUPT_ID =xb.WH_BANKRUPT_ID 
            WHERE 1=1
            AND xa.REGISTER_CODE IS NOT NULL
            AND xb.BANKRUPT_CODE= '" . $brcID . "'
            AND xa.CONCERN_NAME IN ('โจทก์','เจ้าหนี้'))
            ";
            $query = db::query($sql);
            while ($rec = db::fetch_array($query)) {
                $IDCARD1 .= $rec["REGISTER_CODE"] . ","; //13หลัก โจทก์ เจ้าหนี้
            }
            if (!empty($IDCARD1)) {
                $FILL .= "AND a.REGISTER_CODE NOT IN (" . result_array(cut_last_comma($IDCARD1)) . ")";
            }

            /* ตรวจโจทก์เป็น ผู้รับจำนอง stop */
        }

        $sql_WH_PERSON_COUPLE1 = "  SELECT *FROM WH_BANKRUPT_CASE_PERSON a
								JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
								WHERE 1=1
								AND a.REGISTER_CODE IS NOT NULL
								AND b.BANKRUPT_CODE= '" . $brcID . "'{$FILL}
								";
        $REGISTERCODE_C1 = '';
        $queryWH_PERSON_COUPLE1 = db::query($sql_WH_PERSON_COUPLE1);
        while ($rec_WH = db::fetch_array($queryWH_PERSON_COUPLE1)) {
            $REGISTERCODE_C1 .= $rec_WH["REGISTER_CODE"] . ",";
        }
        return cut_last_comma($REGISTERCODE_C1);
    }
    public static function REGISTER_CODE_13_REVIVE($WFR_API, $CONCERN_NAME, $NOTCONCERN_NAME)
    { //ส่งรหัสคดีPCC_CIVIL_GEN,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
        $FILL = "";
        if ($CONCERN_NAME != '') {
            $FILL = "  AND b.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
        }
        if ($NOTCONCERN_NAME != '') {
            $FILL .= "  AND b.CONCERN_NAME NOT IN (" . result_array($NOTCONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น

            /* ตรวจโจทก์เป็น ผู้รับจำนอง start */
            /*  $sql = "";
            $IDCARD1 = "";
            $sql = "SELECT b.* FROM WH_REHABILITATION_CASE_DETAIL a
             JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
             WHERE  a.REHAB_CODE ='" . $WFR_API . "' 
             AND b.REGISTER_CODE IS NOT NULL
             AND b.CONCERN_NAME IN ('ผู้รับจำนอง')
             AND b.REGISTER_CODE IN (
                SELECT xb.REGISTER_CODE FROM WH_REHABILITATION_CASE_DETAIL xa
             JOIN WH_REHABILITATION_PERSON xb ON xa.WH_REHAB_ID =xb.WH_REHAB_ID 
             WHERE  xa.REHAB_CODE ='" . $WFR_API . "' 
             AND xb.REGISTER_CODE IS NOT NULL
             AND xb.CONCERN_NAME IN ('โจทก์','เจ้าหนี้')
             )";

            $query = db::query($sql);
            while ($rec = db::fetch_array($query)) {
                $IDCARD1 .= $rec["REGISTER_CODE"] . ","; //13หลัก โจทก์ เจ้าหนี้
            }
            if (!empty($IDCARD1)) {
                $FILL .= "AND a.REGISTER_CODE NOT IN (" . result_array(cut_last_comma($IDCARD1)) . ")";
            } */
            /* ตรวจโจทก์เป็น ผู้รับจำนอง stop */
        }
        $sql_WH_PERSON = "SELECT b.* FROM WH_REHABILITATION_CASE_DETAIL a
        JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
        WHERE  a.REHAB_CODE ='" . $WFR_API . "' AND b.REGISTER_CODE IS NOT NULL {$FILL}";
        $REGISTERCODE = '';
        $queryWH_PERSON = db::query($sql_WH_PERSON);
        while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
            $REGISTERCODE .= $rec_WH["REGISTER_CODE"] . ",";
        }
        return cut_last_comma($REGISTERCODE);
    }
    public static function REGISTER_CODE_13_MEDIATE($WFR_API, $CONCERN_NAME, $NOTCONCERN_NAME)
    { //ส่งรหัสคดีPCC_CIVIL_GEN,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
        $FILL = "";
        if ($CONCERN_NAME != '') {
            $FILL = "  AND b.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
        }
        if ($NOTCONCERN_NAME != '') {
            $FILL .= "  AND b.CONCERN_NAME NOT IN (" . result_array($NOTCONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
        }
        $sql_WH_PERSON = "SELECT *FROM WH_MEDIATE_CASE a 
				LEFT JOIN WH_MEDIATE_PERSON b  ON a.WH_MEDAITE_ID =b.WH_MEDIATE_ID 
				WHERE a.REF_WFR_ID  = '" . $WFR_API . "' AND b.REGISTER_CODE IS NOT NULL  {$FILL}";
        $REGISTERCODE = '';
        $queryWH_PERSON = db::query($sql_WH_PERSON);
        while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
            $REGISTERCODE .= $rec_WH["REGISTER_CODE"] . ",";
        }
        return cut_last_comma($REGISTERCODE);
    }

    public static function check_bank_CIVIL($input_array, $PAGE_CODE) //เอาธนาคารออกหรือไม่
    {
        $data_Arr = "";
        $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        $querycheck_bank = db::query($sql_check_bank);
        $data_check = db::fetch_array($querycheck_bank);
        if ($data_check['DATA_BANK'] == 'YES') {
            return $input_array;
        } else {
            $arr = [];
            $arr = explode(",", trim($input_array, ","));
            $num_arr = count($arr);
            $ii = 1;
            foreach ($arr as $sh1) {
                $sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
                $queryNum_bank = db::query($sql_num_bank);
                $dataNum_bank  = db::fetch_array($queryNum_bank);
                if ($dataNum_bank['TOTAL_BANK'] == '0') {
                    $ii++;
                    $data_Arr .=  $sh1 . ",";
                } else {
                    $ii--;
                }
            }
            return cut_last_comma($data_Arr);
        }
    }
    public static function check_bank_Bankrupt($input_array, $PAGE_CODE)
    {
        $data_Arr = "";
        $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE_BANKRUPT  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        $querycheck_bank = db::query($sql_check_bank);
        $data_check = db::fetch_array($querycheck_bank);
        if ($data_check['DATA_BANK'] == 'YES') {
            return $input_array;
        } else {
            $arr = [];
            $arr = explode(",", trim($input_array, ","));
            $num_arr = count($arr);
            $ii = 1;
            foreach ($arr as $sh1) {
                $sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
                $queryNum_bank = db::query($sql_num_bank);
                $dataNum_bank  = db::fetch_array($queryNum_bank);
                if ($dataNum_bank['TOTAL_BANK'] == '0') {
                    $ii++;
                    $data_Arr .=  $sh1 . ",";
                } else {
                    $ii--;
                }
            }
            return cut_last_comma($data_Arr);
        }
    }
    public static function check_bank_Revive($input_array, $PAGE_CODE) //เอาธนาคารออกหรือไม่
    {
        $data_Arr = "";
        $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE_REVIVE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        $querycheck_bank = db::query($sql_check_bank);
        $data_check = db::fetch_array($querycheck_bank);
        if ($data_check['DATA_BANK'] == 'YES') {
            return $input_array;
        } else {
            $arr = [];
            $arr = explode(",", trim($input_array, ","));
            $num_arr = count($arr);
            $ii = 1;
            foreach ($arr as $sh1) {
                $sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
                $queryNum_bank = db::query($sql_num_bank);
                $dataNum_bank  = db::fetch_array($queryNum_bank);
                if ($dataNum_bank['TOTAL_BANK'] == '0') {
                    $ii++;
                    $data_Arr .=  $sh1 . ",";
                } else {
                    $ii--;
                }
            }
            return cut_last_comma($data_Arr);
        }
    }
    public static  function check_bank_Mediate($input_array, $PAGE_CODE) //เอาธนาคารออกหรือไม่
    {
        $data_Arr = "";
        $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE_MEDIATE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        $querycheck_bank = db::query($sql_check_bank);
        $data_check = db::fetch_array($querycheck_bank);
        if ($data_check['DATA_BANK'] == 'YES') {
            return $input_array;
        } else {
            $arr = [];
            $arr = explode(",", trim($input_array, ","));
            $num_arr = count($arr);
            $ii = 1;
            foreach ($arr as $sh1) {
                $sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
                $queryNum_bank = db::query($sql_num_bank);
                $dataNum_bank  = db::fetch_array($queryNum_bank);
                if ($dataNum_bank['TOTAL_BANK'] == '0') {
                    $ii++;
                    $data_Arr .=  $sh1 . ",";
                } else {
                    $ii--;
                }
            }
            return cut_last_comma($data_Arr);
        }
    }
}
class Paging
{
    //ถ้าเป็นค่าว่างจะเท่ากับDefeal
    //กำหนดชื่อ page
    /*  unset($Array);
    $Array = [
        "name_page" => "page_rount", //หน้าที่เเสดง
        "name_page_size" => "page_size_rount", //จำนวนrowที่ต้องเเสดง
        "stylePage" => "Y", //สำหรับหน้าที่Bootstarpชนให้ใส่ Y
    ];
    $Func->ControllerPaging($Array);
    $Func->__GET_PAGE($_GET[$Func->name_page], $_GET[$Func->name_page_size], '10'); */
    /*  <div class="row">
            <?php echo $Func->endPaging("frm-input", $Func->Total_DATA_CIVIL_ROUTE); ?>
        </div> */
    public $name_page;
    public $name_page_size;
    public $Page;
    public $Page_size;
    public $offset; //ค่าเริ่มต้น
    public $limit; //คา่สิ้นสุด

    public $arrPage = array("20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");



    public function stylePage()
    {
?>
        <style>
            /* กำหนดสไตล์สำหรับ Pagination */
            .pagination {
                display: flex;
                list-style: none;
                padding: 0;
                margin: 20px 0;
                justify-content: center;
            }

            /* กำหนดสไตล์สำหรับรายการหน้า */
            .pagination li {
                margin: 0 0px;
                display: flex;
            }

            /* กำหนดสไตล์สำหรับลิงค์ของหน้า */
            .pagination li a {
                text-decoration: none;
                color: #333;
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            /* กำหนดสไตล์สำหรับลิงค์ของหน้า (เมื่อนอกเนื้อหาปัจจุบัน) */
            .pagination li a:hover {
                background-color: #f4f4f4;
            }

            /* กำหนดสไตล์สำหรับลิงค์ของหน้าปัจจุบัน */
            .pagination li.active a {
                background-color: #007bff;
                color: #fff;
            }
        </style>
    <?php
    }
    public function ControllerPaging($Array)
    {
        $this->name_page = $Array['name_page'];
        $this->name_page_size = $Array['name_page_size'];
        if (!empty($Array['name_page'])) {
            //สำหรับหน้าที่Bootstarpชนให้ใส่ Y
            $this->stylePage();
        };
    }
    public function __construct()
    {
        $this->offset = ($this->Page * $this->Page_size) - ($this->Page_size - 1);
        $this->limit = $this->Page * $this->Page_size;
    }
    public function __GET_PAGE($page, $page_size, $max)
    {
        $this->Page = (empty($page) ? "1" : $page);
        $this->Page_size = (empty($page_size) ? $max : $page_size);

        $this->__construct();
        $this->input();
        $this->PageArrayDetail($max);
    }
    public function input()
    { ?>
        <input type="hidden" id="<?php echo $this->name_page; ?>" name="<?php echo $this->name_page; ?>" value="<?php echo $this->Page; ?>">
        <input type="hidden" id="<?php echo $this->name_page_size; ?>" name="<?php echo $this->name_page_size; ?>" value="<?php echo $this->Page_size; ?>">
    <?php
    }
    public function ROWNUM($sql = "")
    {
        return 'select * from ( select AAAA.*, rownum rnum from ( ' . $sql . ' ) AAAA ) where rnum between ' . $this->offset . ' and ' . $this->limit . ' ';
    }
    public function PageArrayDetail($start)
    {
        if ($start == '5') {
            $this->arrPage = array("5" => "5", "10" => "10", "20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");
        } else if ($start == '10') {
            $this->arrPage = array("10" => "10", "20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");
        } else {
        }
    }
    public function endPaging($form, $total_record)
    {
        $total_page = ceil($total_record / $this->Page_size);
        $max_page = ($total_page > 4) ? 4 : $total_page;

        $start_page = ($this->Page == "") ? 1 : $this->Page - 2;
        $start_page = ($start_page <= 0) ? 1 : $start_page;

        $end_page = ($max_page + $start_page);
        $end_page = ($end_page > $total_page) ? $total_page : $end_page;

        $start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
        $start_page = ($start_page <= 0) ? 1 : $start_page;
        /*         echo "start_page" . $start_page . "<br>";
        echo "end_page" . $end_page . "<br>"; */
        $startClass = ($this->Page == 1) ? " class=\"disabled\" " : "";
        $endClass = ($this->Page == $total_page) ? " class=\"disabled\" " : "";

        $html = "<div class=\"col-sm-6 hidden-xs\">
                    <div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                        <div class=\"input-group\">
                            <span class=\"input-group-btn\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                    แสดง " . $this->arrPage[$this->Page_size] . "
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">";
        foreach ($this->arrPage as $key => $val) {
            $html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page_size . "').val('" . $key . "'); $('#" . $this->name_page . "').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">แสดง " . $val . "</a></li>";
        }
        $html .= "</ul>
                            </span>
                            <span class=\"input-group-addon\"> / หน้า จำนวน " . $total_record . " รายการ</span>
                        </div>
                    </div>
                </div>
                <div class=\"col-xs-12 col-sm-6\">
                    <ul class=\"pagination pull-right\">";
        if ($this->Page == 1) {
            $html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
        } else {
            $html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page . "').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page . "').val('" . ($this->Page - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
        }
        for ($i = $start_page; $i <= $end_page; $i++) {
            $active = ($i == $this->Page) ? " class=\"active\" " : "";
            $html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page . "').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
        }
        if ($this->Page == $total_page) {
            $html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
        } else {
            $html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page . "').val('" . ($this->Page + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->name_page . "').val('" . $total_page . "'); $('#" . $form . "').submit();\">&raquo;</a></li>";
        }
        $html .= "</ul>
                </div>";

        return $html;
    }
}

class PagingMain
{

    public $default = 20; //ไม่ต้อง
    public $page_size; //ไม่ต้อง
    public $arrPage = array("20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");
    public $page; //ไม่ต้อง
    public $goto;
    public $namePage;
    public $pageSize;


    public function __construct($page, $page_size, $namePage, $pageSize)
    {
        $this->namePage = $namePage;
        $this->pageSize = $pageSize;

        $this->page_size = ($page_size == "") ? $this->default : $page_size; //$page_size = ($page_size == "") ? $default : $page_size;
        $this->page = ($page == "") ? 1 : $page; //$page =  ($_REQUEST['page'] == "") ? 1 : $_REQUEST['page'];
        $this->goto = ($this->page_size * ($this->page - 1));  // $goto = ($page_size * ($page - 1));
    }

    public function endPaging($form, $total_record)
    {
        $total_page = ceil($total_record / $this->page_size);
        $max_page = ($total_page > 4) ? 4 : $total_page;

        $start_page = ($this->page == "") ? 1 : $this->page - 2;
        $start_page = ($start_page <= 0) ? 1 : $start_page;

        $end_page = ($max_page + $start_page);
        $end_page = ($end_page > $total_page) ? $total_page : $end_page;

        $start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
        $start_page = ($start_page <= 0) ? 1 : $start_page;
        /*         echo "start_page" . $start_page . "<br>";
        echo "end_page" . $end_page . "<br>"; */
        $startClass = ($this->page == 1) ? " class=\"disabled\" " : "";
        $endClass = ($this->page == $total_page) ? " class=\"disabled\" " : "";

        $html = "<div class=\"col-sm-6 hidden-xs\">
                    <div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                        <div class=\"input-group\">
                            <span class=\"input-group-btn\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                    แสดง " . $this->arrPage[$this->page_size] . "
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">";
        foreach ($this->arrPage as $key => $val) {
            $html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->pageSize . "').val('" . $key . "'); $('#" . $this->namePage . "').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">แสดง " . $val . "</a></li>";
        }
        $html .= "</ul>
                            </span>
                            <span class=\"input-group-addon\"> / หน้า จำนวน " . $total_record . " รายการ</span>
                        </div>
                    </div>
                </div>
                <div class=\"col-xs-12 col-sm-6\">
                    <ul class=\"pagination pull-right\">";
        if ($this->page == 1) {
            $html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
        } else {
            $html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->namePage . "').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->namePage . "').val('" . ($this->page - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
        }
        for ($i = $start_page; $i <= $end_page; $i++) {
            $active = ($i == $this->page) ? " class=\"active\" " : "";
            $html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->namePage . "').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
        }
        if ($this->page == $total_page) {
            $html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
        } else {
            $html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->namePage . "').val('" . ($this->page + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#" . $this->namePage . "').val('" . $total_page . "'); $('#" . $form . "').submit();\">&raquo;</a></li>";
        }
        $html .= "</ul>
                </div>";

        return $html;
    }
    //วิธีการเรียก
    /* <div class="row">
    <?php
        $requestPage = $_REQUEST['pageCivil'];
        $RequestPageSize = $_REQUEST['page_size_Civil'];
        $pageCivilFunc = new PagingMain($requestPage, $RequestPageSize,"pageCivil","page_size_Civil");
        echo $pageCivilFunc->endPaging("frm-input", count($array_raw[$k])); ?>
    </div> 
    */
    public static function input_get() // ส่วนของ input
    {
    ?>
        <input type="hidden" id="pageCivil" name="pageCivil" value="<?php echo $_GET['pageCivil']; ?>">
        <input type="hidden" id="pageBankrupt" name="pageBankrupt" value="<?php echo $_GET['pageBankrupt']; ?>">
        <input type="hidden" id="pageRevive" name="pageRevive" value="<?php echo $_GET['pageRevive']; ?>">
        <input type="hidden" id="pageMediate" name="pageMediate" value="<?php echo $_GET['pageMediate']; ?>">

        <input type="hidden" id="page_size_Civil" name="page_size_Civil" value="<?php echo $_GET['page_size_Civil']; ?>">
        <input type="hidden" id="page_size_Bankrupt" name="page_size_Bankrupt" value="<?php echo $_GET['page_size_Bankrupt']; ?>">
        <input type="hidden" id="page_size_Revive" name="page_size_Revive" value="<?php echo $_GET['page_size_Revive']; ?>">
        <input type="hidden" id="page_size_Mediate" name="page_size_Mediate" value="<?php echo $_GET['page_size_Mediate']; ?>">
<?php
    }
    public static function page_get() //ส่วนของ รับค่า GET
    {
        $_GET['pageCivil'] = (empty($_GET['pageCivil']) ? "1" : $_GET['pageCivil']);
        $_GET['page_size_Civil'] = (empty($_GET['page_size_Civil']) ? "20" : $_GET['page_size_Civil']);

        $_GET['pageBankrupt'] = (empty($_GET['pageBankrupt']) ? "1" : $_GET['pageBankrupt']);
        $_GET['page_size_Bankrupt'] = (empty($_GET['page_size_Bankrupt']) ? "20" : $_GET['page_size_Bankrupt']);

        $_GET['pageRevive'] = (empty($_GET['pageRevive']) ? "1" : $_GET['pageRevive']);
        $_GET['page_size_Revive'] = (empty($_GET['page_size_Revive']) ? "20" : $_GET['page_size_Revive']);

        $_GET['pageMediate'] = (empty($_GET['pageMediate']) ? "1" : $_GET['pageMediate']);
        $_GET['page_size_Mediate'] = (empty($_GET['page_size_Mediate']) ? "20" : $_GET['page_size_Mediate']);
    }
}

class func
{
    public function CASE_TYPE_PERSON($Array)
    {
        $AND = "";
        if (!empty($Array['CMD_TYPE_CODE'])) {
            $AND = "AND A.CMD_TYPE_CODE ='" . $Array['CMD_TYPE_CODE'] . "'";
        }
        $sql = "SELECT DISTINCT
			CMD_TYPE_NAME,CMD_TYPE_CODE
		   FROM M_SERVICE_CMD A
		   LEFT JOIN M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
		   LEFT JOIN M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
		   WHERE
			A.CMD_TYPE_ID = '" . $Array['CMD_TYPE_ID'] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $Array["SYSTEM_ID"] . "
		  {$AND}
		   ORDER BY A.CMD_TYPE_NAME ASC";
        return $sql;
    }
    public function CMD_TYPE($Array)
    {
        $AND = "";
        if (!empty($Array['CMD_TYPE_ID'])) {
            $AND .= "AND B.CMD_TYPE_ID ='" . $Array['CMD_TYPE_ID'] . "'";
        }
        if (!empty($Array['SYSTEM_ID'])) {
            $AND .= "AND c.CMD_SYSTEM_ID ='" . $Array['SYSTEM_ID'] . "'";
        }
        $sql = "SELECT DISTINCT
        CMD_GRP_NAME,B.CMD_TYPE_ID
        FROM
        M_CMD_TYPE A
        LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
        LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
        WHERE GRP_NOTI_FLAG = '1'
        AND CMD_STATUS='1'
        {$AND}
        ORDER BY
        A.CMD_GRP_NAME ASC";
        return $sql;
    }

    public function M_CMD_TYPE($Array)
    {
        $fill = "";
        //ถ้าเป็นรายการอื่นๆนอกจากล้มจะเป็นสอบถามความประสงค์
        if ($Array['SYSTEM_ID'] == '1') {
            $fill = "AND B.CMD_TYPE_ID ='2'";
        } else if ($Array['SYSTEM_ID'] == '6') {
            $fill = "AND B.CMD_TYPE_ID ='2'";
        }
        $sql = "SELECT DISTINCT CMD_GRP_NAME,B.CMD_TYPE_ID FROM M_CMD_TYPE A
        LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
        LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
        WHERE GRP_NOTI_FLAG = '1'
        AND CMD_STATUS='1'
        {$fill}
        ORDER BY
        A.CMD_GRP_NAME ASC";
        return $sql;
    }

    public function M_SERVICE_CMD($Array)
    {
        $fill = "";
        //$fill .= !empty($Array['CMD_TYPE_ID']) ? "  AND A.CMD_TYPE_ID = '" . $Array['CMD_TYPE_ID'] . "'" : "";
        //$fill .= !empty($Array['SYSTEM_ID']) ? "  AND b.CMD_SYSTEM_ID = " . $Array['SYSTEM_ID'] . "" : "";
        $fill .= "  AND A.CMD_TYPE_ID = '" . $Array['CMD_TYPE_ID'] . "'";
        $fill .= "  AND b.CMD_SYSTEM_ID = " . $Array['SYSTEM_ID'] . "";
        $sql2 = "SELECT DISTINCT
        CMD_TYPE_NAME,CMD_TYPE_CODE
        FROM M_SERVICE_CMD A
        LEFT JOIN M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
        LEFT JOIN M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
        WHERE 1=1
        AND CMD_STATUS = 1 
        {$fill}
        ORDER BY A.CMD_TYPE_NAME ASC";
        return $sql2;
    }
    public function BankruptAssets($codeApi)
    {
        $Array = [];
        $sql = "SELECT * FROM WH_BANKRUPT_CASE_DETAIL a 
        JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
        WHERE a.BANKRUPT_CODE ='" . $codeApi . "'";
        $query = db::query($sql);
        while ($rec = db::fetch_array($query)) {
            $Array[] = $rec;
        }
        return $Array;
    }
    public function DataAsset($MData, $Array)
    {
        $filter = "";
        if ($Array["PREFIX_CASE_BLACK"] != "") {
            $filter .= " and b.PREFIX_BLACK_CASE = '" . $Array['PREFIX_CASE_BLACK'] . "'	";
        }
        if ($Array["CASE_BLACK"] != "") {
            $filter .= " and b.BLACK_CASE = '" . $Array['CASE_BLACK'] . "'	";
        }
        if ($Array["CASE_BLACK_YEAR"] != "") {
            $filter .= " and b.BLACK_YY = '" . $Array['CASE_BLACK_YEAR'] . "'	";
        }
        if ($Array["PREFIX_CASE_RED"] != "") {
            $filter .= " and b.PREFIX_RED_CASE = '" . $Array['PREFIX_CASE_RED'] . "'	";
        }
        if ($Array["CASE_RED"] != "") {
            $filter .= " and b.RED_CASE = '" . $Array['CASE_RED'] . "'	";
        }
        if ($Array["CASE_RED_YEAR"] != "") {
            $filter .= " and b.RED_YY = '" . $Array['CASE_RED_YEAR'] . "'	";
        }
        if ($Array["COURT_CODE"] != "" && $Array["SYSTEM_ID"] != 6) {
            if ($Array["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                $filter .= " and b.COURT_ID = '" . $Array['COURT_CODE'] . "'	";
            } else {
                $filter .= " and b.COURT_CODE = '" . $Array['COURT_CODE'] . "'	";
            }
        }

        if ($Array['SYSTEM_ID'] == '1') { //ระบบงานบังคับคดีแพ่ง
            $sql = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
            from 		WH_CIVIL_CASE_ASSETS a 
            inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
            where 		1=1 
            AND ASSET_ID IS NOT NULL
            {$filter}";
        } else  if ($Array['SYSTEM_ID'] == '2') { //ระบบงานบังคับคดีล้มละลาย
            $sql = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
            from 		WH_BANKRUPT_ASSETS a 
            inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
            where 		1=1 
            --AND ASSET_ID IS NOT NULL
              {$filter}";
        } else  if ($Array['SYSTEM_ID'] == '6') {
            $sql = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
            from 		WH_DEBTOR_ASSETS a
            where 		1=1 AND PROP_TITLE is not null 
            AND WH_ASSET_ID IS NOT NULL  
            {$filter}";
        }
        return $sql;
    }

    public function DataPersonCivil($MData, $Array)
    {
        $filter = "";
        $filter1 = "";
        if ($Array['PREFIX_CASE_BLACK'] != "") {
            $filter .= " and PREFIX_BLACK_CASE = '" . $Array['PREFIX_CASE_BLACK']  . "'	";
            $filter1 .= " and xx.PREFIX_BLACK_CASE = '" . trim($Array['PREFIX_CASE_BLACK']) . "'	";
        }
        if ($Array['CASE_BLACK'] != "") {
            $filter .= " and BLACK_CASE = '" . $Array['CASE_BLACK'] . "'	";
            $filter1 .= " and xx.BLACK_CASE = '" . trim($Array['CASE_BLACK']) . "'	";
        }
        if ($Array['CASE_BLACK_YEAR'] != "") {
            $filter .= " and BLACK_YY = '" . $Array['CASE_BLACK_YEAR'] . "'	";
            $filter1 .= " and xx.BLACK_YY = '" . trim($Array['CASE_BLACK_YEAR']) . "'	";
        }
        if ($Array['PREFIX_CASE_RED'] != "") {
            $filter .= " and PREFIX_RED_CASE = '" . $Array['PREFIX_CASE_RED'] . "'	";
            $filter1 .= " and xx.PREFIX_RED_CASE = '" . trim($Array['PREFIX_CASE_RED']) . "'	";
        }
        if ($Array['CASE_RED'] != "") {
            $filter .= " and RED_CASE = '" . $Array['CASE_RED'] . "'	";
            $filter1 .= " and xx.RED_CASE = '" . trim($Array['CASE_RED']) . "'	";
        }
        if ($Array['CASE_RED_YEAR']  != "") {
            $filter .= " and RED_YY = '" . $Array['CASE_RED_YEAR']  . "'	";
            $filter1 .= " and xx.RED_YY = '" . trim($Array['CASE_RED_YEAR']) . "'	";
        }

        if (!empty(trim($Array['COURT_CODE']))) {
            if (trim($Array['COURT_CODE']) == '010030' || trim($Array['COURT_CODE']) == '050') {
                $filter .= " and (COURT_CODE = '010030'	or COURT_CODE = '050')";
                $filter1 .= "and xx.COURT_CODE = '" . trim($Array['COURT_CODE']) . "'	";
            } else {
                $filter .= " and COURT_CODE = '" . $Array['COURT_CODE'] . "'";
                $filter1 .= "and xx.COURT_CODE = '" . trim($Array['COURT_CODE']) . "'	";
            }
        }
        //ถ้ามาจากการตอบกลับจะเเสดงรายการคนตามคำสั่งข้างต้นที่เลือกมา
        if ($MData["REF_ID"] != "") {
            $filter .= " and REGISTER_CODE in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $MData['REF_ID'] . "')	";
        }
        $fill = "AND NOT EXISTS  (
            SELECT
                xx.WH_PERSON_ID
            FROM
            " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " xx
            WHERE 1=1
            {$filter1}
                AND xx.WH_PERSON_ID=a.WH_PERSON_ID
                AND xx.CONCERN_CODE='11')"; //ไม่เอาผู้ถือกรรมสิทธ์ ที่มี13หลักซ้ำกับโจทก์เเละจำเลย
        $A = "SELECT x1.REGISTER_CODE,x1.PREFIX_NAME,x1.FIRST_NAME,x1.LAST_NAME,x1.CONCERN_CODE,x1.CONCERN_NAME FROM (";
        $B = ") x1 GROUP BY x1.REGISTER_CODE,x1.PREFIX_NAME,x1.FIRST_NAME,x1.LAST_NAME,x1.CONCERN_CODE,x1.CONCERN_NAME";
        $sql = "	select 		a.WH_PERSON_ID,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE
                            from 		" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a
                            where 		1=1 {$filter}{$fill}
                            order by 	CONCERN_CODE asc
                            ";
        return $A . $sql . $B;
    }

    public function DataPersonBankrupt($MData, $Array)
    {
        $filter = "";
        $filter .= !empty($Array['PREFIX_CASE_BLACK']) ? " and PREFIX_BLACK_CASE = '" . $Array['PREFIX_CASE_BLACK']  . "'" : "";
        $filter .= !empty($Array['CASE_BLACK']) ? " and BLACK_CASE = '" . $Array['CASE_BLACK'] . "'	" : "";
        $filter .= !empty($Array['CASE_BLACK_YEAR']) ? " and BLACK_YY = '" . $Array['CASE_BLACK_YEAR'] . "'	" : "";
        $filter .= !empty($Array['PREFIX_CASE_RED']) ? " and PREFIX_RED_CASE = '" . $Array['PREFIX_CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED']) ? " and RED_CASE = '" . $Array['CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED_YEAR']) ? " and RED_YY = '" . $Array['CASE_RED_YEAR']  . "'	" : "";
        if (($Array['COURT_CODE']) == '010030' || ($Array['COURT_CODE']) == '050') {
            $filter .= " and (COURT_CODE = '010030'	or COURT_CODE = '050')";
        } else {
            $filter .= " and COURT_CODE = '" . $Array['COURT_CODE'] . "'";
        }
        if ($MData["REF_ID"] != "") {
            $filter .= " and REGISTER_CODE in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $MData['REF_ID'] . "')	";
        }
        $sql = "	select 	a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE
        from 		WH_BANKRUPT_CASE_PERSON a 
        where 		1=1 {$filter}
        order by 	CONCERN_CODE asc";
        return $sql;
    }
    public function DataPersonRevive($MData, $Array)
    {
        $filter = "";
        $filter .= !empty($Array['PREFIX_CASE_BLACK']) ? " and PREFIX_BLACK_CASE = '" . $Array['PREFIX_CASE_BLACK']  . "'" : "";
        $filter .= !empty($Array['CASE_BLACK']) ? " and BLACK_CASE = '" . $Array['CASE_BLACK'] . "'	" : "";
        $filter .= !empty($Array['CASE_BLACK_YEAR']) ? " and BLACK_YY = '" . $Array['CASE_BLACK_YEAR'] . "'	" : "";
        $filter .= !empty($Array['PREFIX_CASE_RED']) ? " and PREFIX_RED_CASE = '" . $Array['PREFIX_CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED']) ? " and RED_CASE = '" . $Array['CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED_YEAR']) ? " and RED_YY = '" . $Array['CASE_RED_YEAR']  . "'	" : "";
        if (($Array['COURT_CODE']) == '010030' || ($Array['COURT_CODE']) == '050') {
            $filter .= " and (COURT_CODE = '010030'	or COURT_CODE = '050')";
        } else {
            $filter .= " and COURT_CODE = '" . $Array['COURT_CODE'] . "'";
        }
        if ($MData["REF_ID"] != "") {
            $filter .= " and REGISTER_CODE in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $MData['REF_ID'] . "')	";
        }
        $sql = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE
        from 		WH_REHABILITATION_PERSON a
        where 		1=1 {$filter}
        order by 	CONCERN_CODE asc";
        return $sql;
    }
    public function DataPersonMediate($MData, $Array)
    {
        $filter = "";
        $filter .= !empty($Array['PREFIX_CASE_BLACK']) ? " and PREFIX_BLACK_CASE = '" . $Array['PREFIX_CASE_BLACK']  . "'" : "";
        $filter .= !empty($Array['CASE_BLACK']) ? " and BLACK_CASE = '" . $Array['CASE_BLACK'] . "'	" : "";
        $filter .= !empty($Array['CASE_BLACK_YEAR']) ? " and BLACK_YY = '" . $Array['CASE_BLACK_YEAR'] . "'	" : "";
        $filter .= !empty($Array['PREFIX_CASE_RED']) ? " and PREFIX_RED_CASE = '" . $Array['PREFIX_CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED']) ? " and RED_CASE = '" . $Array['CASE_RED'] . "'	" : "";
        $filter .= !empty($Array['CASE_RED_YEAR']) ? " and RED_YY = '" . $Array['CASE_RED_YEAR']  . "'	" : "";
        if (($Array['COURT_CODE']) == '010030' || ($Array['COURT_CODE']) == '050') {
            $filter .= " and (COURT_CODE = '010030'	or COURT_CODE = '050')";
        } else {
            $filter .= " and COURT_CODE = '" . $Array['COURT_CODE'] . "'";
        }
        if ($MData["REF_ID"] != "") {
            $filter .= " and REGISTER_CODE in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $MData['REF_ID'] . "')	";
        }
        $sql = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE
        from 		WH_MEDIATE_PERSON a
        where 		1=1 {$filter}
        order by 	CONCERN_CODE asc";
        return $sql;
    }
    public function DataPersonBackoffcie($MData, $Array)
    {

        if ($MData["GET_PER_TYPE"] == '1') { // บุคลากร 
            $filter = "";
            if ($MData["GET_PER_CASE"] != "") {
                $filter = "AND USR_OPTION9 in (SELECT ID_CARD FROM M_CMD_PERSON WHERE ID_CARD = '" . $MData['GET_PER_CASE'] . "')	";
            }
            $sql = "SELECT 	USR_OPTION9 as REGISTER_CODE,
                            USR_PREFIX as PREFIX_NAME,
                            USR_FNAME as FIRST_NAME,
                            USR_LNAME as LAST_NAME,
                            '' as CONCERN_CODE,
                            '' as CONCERN_NAME,
                            USR_OPTION9 as REGISTER_CODE,
                            '' as PREFIX_BLACK_CASE,
                            '' as BLACK_CASE,
                            '' as BLACK_YY,
                            '' as PREFIX_RED_CASE,
                            '' as RED_CASE,
                            '' as RED_YY,
                            '' as COURT_NAME,
                            '' as COURT_CODE,
                            '' as ADDRESS,
                            '' as TUM_NAME,
                            '' as AMP_NAME,
                            '' as PROV_NAME,
                            '' as ZIP_CODE,
                            'Backoffice' as SYSTEM_TYPE
                    FROM 		USR_MAIN a
                    WHERE 		1=1 {$filter}";
        } else if ($MData["GET_PER_TYPE"] == '2') { // เจ้าหนี้
            $filter = "";
            if ($MData["GET_PER_CASE"] != "") {
                $filter = "AND WH_CREDITOR_ID_CARD in (SELECT ID_CARD FROM M_CMD_PERSON WHERE ID_CARD = '" . $MData['GET_PER_CASE'] . "')	";
            }
            $sql = "SELECT 	WH_CREDITOR_ID_CARD as REGISTER_CODE,
                            WH_CREDITOR_PREFIX as PREFIX_NAME,
                            WH_CREDITOR_FNAME as FIRST_NAME,
                            WH_CREDITOR_LNAME as LAST_NAME,
                            '' as CONCERN_CODE,
                            WH_CREDITOR_ID_CARD as CONCERN_NAME,
                            WH_CREDITOR_ID_CARD as REGISTER_CODE,
                            '' as PREFIX_BLACK_CASE,
                            '' as BLACK_CASE,
                            '' as BLACK_YY,
                            '' as PREFIX_RED_CASE,
                            '' as RED_CASE,
                            '' as RED_YY,
                            '' as COURT_NAME,
                            '' as COURT_CODE,
                            '' as ADDRESS,
                            '' as TUM_NAME,
                            '' as AMP_NAME,
                            '' as PROV_NAME,
                            '' as ZIP_CODE,
                            'Backoffice' as SYSTEM_TYPE
                        FROM 		WH_CREDITOR a
                        WHERE 		1=1 {$filter}";
        }
        return $sql;
    }


    public static function getSelecter($Array)
    {   // sql 
        // name_id =ชื่อเเละid
        // Fill_vale ข้อมูลที่ต้องการ vale
        // Fill_name ข้อมูลที่ต้องการโชว์
        // Selected ข้อมูลที่ต้องการเลือก
        // process การทำงานเพิ่มเติม

        // $ArrayPerson = [
        //	'sql' => "select * from M_PERSON_TYPE WHERE 1=1 AND PERSON_CODE IN (01,02)", // sql
        //	'name' => 'REQ_PERSON_TYPE', // name_id =ชื่อเเละid
        //	'id' => 'REQ_PERSON_TYPE', // id
        //	'Fill_vale' => 'PERSON_CODE',   // Fill_vale ข้อมูลที่ต้องการ vale
        //	'Fill_name' => 'PERSON_NAME_TH',  // Fill_name ข้อมูลที่ต้องการโชว์
        //	'process' => $PERSON_TYPE, // กำการทำงานเป็น text
        //	'Selected' => $PERSON_TYPE, // Selected ข้อมูลที่ต้องการเลือก
        //  'textAler' => $กรุณาเลือก, //คำพูดก่อนเลือกรายการ
        //];
        //$REQ_PERSON_TYPE = ($Func->getSelecter($ArrayPerson)); //ประเภทบุคคล*

        $testAlert = "";
        if (!empty($Array['textAler'])) {
            $testAlert = " <option disabled selected value=''>" . $Array['textAler'] . "</option>";
        }
        $html = "";
        $query = db::query($Array['sql']);
        $html .= "<select " . $Array['process'] . " name=\"" . $Array['name'] . "\" id=\"" . $Array['id'] . "\">";
        $html .= $testAlert;
        while ($rec = db::fetch_array($query)) {
            $html .= "<option value=\"" . $rec[$Array['Fill_vale']] . "\" " . (($rec[$Array['Fill_vale']] == $Array['Selected']) ? "selected " : "") . ">" . $rec[$Array['Fill_name']] . "</option>";
        }
        $html .= "</select>";

        return $html;
    }
    public static function unique_Array($ArrayData)
    {
        // รวมข้อมูลเข้าด้วยกันเป็นสตริงและใช้เป็นคีย์ของ array_unique
        $keys = array_map(function ($item) {
            return $item['WH_ID'] . $item['REGISTER_CODE'] . $item['CONCERN_NAME'] . $item['PREFIX_BLACK_CASE'] . $item['BLACK_CASE'] .
                $item['BLACK_YY'] . $item['PREFIX_RED_CASE'] . $item['RED_CASE'] . $item['RED_YY'];
        }, $ArrayData);

        // ลบแถวที่มีคีย์ที่ซ้ำกัน
        $unique_keys = array_unique($keys);

        // สร้างอาร์เรย์ใหม่โดยใช้คีย์ที่ไม่ซ้ำกัน
        $result = array_intersect_key($ArrayData, $unique_keys);
        return $result;
    }
    public static function getTambon($data)
    {
        $sql = "SELECT a.TAMBON_NAME_BOF  FROM M_TAMBON_MAP a ";
        $query = db::query($sql);
        $Tambon = "";
        while ($row = db::fetch_array($query)) {
            if (strstr($data, $row['TAMBON_NAME_BOF']) !== false) {
                $Tambon = $row['TAMBON_NAME_BOF'];
            }
        }
        return $Tambon;
    }
    public static function getAmphur($data)
    {
        $sql = "SELECT a.AMPHUR_NAME_BOF  FROM M_APHUR_MAP a";
        $query = db::query($sql);
        $Amphur = "";
        while ($row = db::fetch_array($query)) {
            if (strstr($data, $row['AMPHUR_NAME_BOF']) !== false) {
                $Amphur = $row['AMPHUR_NAME_BOF'];
            }
        }
        return $Amphur;
    }
    public static function getProvince($data) //text ที่มีจังหวัดเช่น กรุงเทพบนที่ดิน =>กรุงเทพ
    {
        $sql = "SELECT a.PROVINCE_NAME_BOF FROM  M_PROVINCE_MAP a ";
        $query = db::query($sql);
        $PROVINCE = "";
        while ($row = db::fetch_array($query)) {
            if (strstr($data, $row['PROVINCE_NAME_BOF']) !== false) {
                $PROVINCE = $row['PROVINCE_NAME_BOF'];
            }
        }
        return $PROVINCE;
    }

    public static function conWhere($A = "")
    {
        $array = explode(" ", $A);
        $fill = "";
        foreach ($array as $key => $value) {
            if (is_string($value) && strpos($value, "ตำบล") !== false) {
                $DISTRICT = str_replace("ตำบล", "", $value);
                //$fill .= "AND b.DISTRICT_NAME like '%" . $DISTRICT . "%'";
                $fill .= "AND a.TABLE_DETAIL like '%" . self::getTambon($DISTRICT) . "%'";
            }
            if (is_string($value) && strpos($value, "อำเภอ") !== false) {
                $AMPHUR_NAME = str_replace("อำเภอ", "", $value);
                //$fill .= "AND b.AMPHUR_NAME like '%" . $AMPHUR_NAME . "%'";
                $fill .= "AND a.TABLE_DETAIL like '%" . self::getAmphur($AMPHUR_NAME) . "%'";
            }
            if (is_string($value) && strpos($value, "จังหวัด") !== false) {
                $PROVINCE_NAME = str_replace("จังหวัด", "", $value);
                //$fill .= "AND b.	 like'%" . $PROVINCE_NAME . "%'";
                $fill .= "AND a.TABLE_DETAIL like'%" . self::getProvince($PROVINCE_NAME) . "%'";
            }
        }
        return $fill;
    }
    public static function get_E_and_D($namePage, $STATUS_ENCRTPT, $DATA) //namePage='ส่งมาจากไฟล์ใหน',STATUS_ENCRTPT สถานะการเข้ารหัส E=เข้ารหัส,D=ถอดรหัส,$DATA ข้อมูลที่เข้ารหัส
    {
        $sql = "SELECT a.STATUS_ENCRYPT ,a.STATUS_DECODE FROM M_ENCRYPT a WHERE a.NAME_FILE='" . $namePage . "'";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        if (count($rec) > 0) {
            if ($STATUS_ENCRTPT == 'E' || $STATUS_ENCRTPT == 'e') {
                if ($rec['STATUS_ENCRYPT'] == 'Y') {
                    return self::base64url_encode($DATA);
                } else {
                    return "1=1" . $DATA;
                }
            } else if ($STATUS_ENCRTPT == 'D' || $STATUS_ENCRTPT == 'd') {
                if ($rec['STATUS_DECODE'] == 'Y') {
                    $data = "";
                    $n = 0;
                    foreach ($DATA as $aData => $bData) {
                        $data = $aData;
                        if ($aData == "TO_PERSON_ID" || $aData == "SEND_TO") {
                            $n++;
                        }
                    }
                    if ($n > 0) {
                        return $DATA;
                    } else {
                        return self::base64url_decode($data);
                    }
                } else {
                    return "1=1" . $DATA;
                }
            } else {
                return "สถานะการเข้ารหัสมี2เเบบคือ E,D";
            }
        } else {
            return "ไม่มีหน้าpage" . $namePage . "ในระบบ";
        }
    }

    // ฟังก์ชันเข้ารหัสข้อมูลเป็น base64url
    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    // ฟังก์ชันถอดรหัส base64url เป็นข้อมูลต้นฉบับ
    public static function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public static function sendHttpPostRequest($url, $postData)
    {
        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        // Execute cURL session and capture the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Return the response
        return json_decode($response, true);
    }

    public static function api_request($url, $token, $content = null)
    {

        $headers = [
            'Authorization: Token ' . $token,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        // return json_decode($result, true);
    }
    function convert_idcode($inputString)
    { //1-1111-11-11 to 11111111
        $numbers = explode("-", $inputString);
        $convertedNumber = implode("", $numbers);
        return $convertedNumber;
    }
    public static function convertSystem($A) //รับเข้าBANKRUPTหรือBankrupt => 2
    {
        if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
            $B = '2';
        }
        if ($A == 'CIVIL' || $A == 'Civil') {
            $B = '1';
        }
        if ($A == 'MEDIATE' || $A == 'Mediate') {
            $B = '4';
        }
        if ($A == 'REVIVE' || $A == 'Revive') {
            $B = '3';
        }
        return $B;
    }
    public static function ConvertSystemToThai($A)
    {

        if ($A == 'BANKRUPT' || $A == '2') {
            $B = 'ล้มละลาย';
        }
        if ($A == 'CIVIL' || $A == '1') {
            $B = 'แพ่ง';
        }
        if ($A == 'MEDIATE' || $A == '4') {
            $B = 'ไกล่เกลี่ย';
        }
        if ($A == 'REVIVE' || $A == '3') {
            $B = 'ฟื้นฟู';
        }
        if ($A == '.BACKOFFICE' || $A == '5') {
            $B = 'Backoffice';
        }
        return $B;
    }
}


function cut_prefix($fullname) //ส่งชื่อมา ส่ง13หลักกลับไป
{
    $fullNameArray = explode(" ", $fullname);
    $sql = "SELECT a.PREFIX_NAME FROM WH_BACKOFFICE_PERSON a WHERE a.PREFIX_NAME IS NOT NULL GROUP BY a.PREFIX_NAME";
    $qry = db::query($sql);
    $array_prefix = array();
    while ($rec = db::fetch_array($qry)) {
        $array_prefix[] = $rec['PREFIX_NAME'];
    }
    $array_prefix[] = "สาว";
    //return $array_prefix;
    foreach ($array_prefix as $key => $value) {
        //return $value;
        if (strpos($fullNameArray[0], $value) !== false) {
            // ใช้ str_replace เพื่อลบคำนำหน้า
            $fullNameArray[0] = str_replace($value, "", $fullNameArray[0]);
        }
    }
    $sql_idcard = "  SELECT a.REGISTER_CODE FROM WH_BACKOFFICE_PERSON a WHERE a.FIRST_NAME ='" . $fullNameArray[0] . "' AND a.LAST_NAME ='" . $fullNameArray[1] . "'";
    $qry_idcard = db::query($sql_idcard);
    $rec = db::fetch_array($qry_idcard);
    return empty($rec['REGISTER_CODE']) ? '' : $rec['REGISTER_CODE'];
    // return $sql_idcard;


}
//(cut_prefix('นางสาวกชพร รุ่งทวีชัย'));

/* format date input 2019-11-01 return ค่าเป็นอาเรย์ */
function convertSystem($A) //รับเข้าBANKRUPTหรือBankrupt => 2
{
    if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
        $B = '2';
    }
    if ($A == 'CIVIL' || $A == 'Civil') {
        $B = '1';
    }
    if ($A == 'MEDIATE' || $A == 'Mediate') {
        $B = '4';
    }
    if ($A == 'REVIVE' || $A == 'Revive') {
        $B = '3';
    }
    return $B;
}

function convertSystemThai($A) //รับเข้าBANKRUPTหรือBankrupt => 2
{
    if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
        $B = 'ระบบงานบังคับคดีล้มละลาย';
    }
    if ($A == 'CIVIL' || $A == 'Civil') {
        $B = 'ระบบงานบังคับคดีแพ่ง';
    }
    if ($A == 'MEDIATE' || $A == 'Mediate') {
        $B = 'ระบบงานไกล่เกลี่ยข้อพิพาท';
    }
    if ($A == 'REVIVE' || $A == 'Revive') {
        $B = 'ระบบงานฟื้นฟูกิจการของลูกหนี้';
    }
    return $B;
}

function CONVERT_GET($decodedCode = []) //$ID13=111111&phone=0123123 เป็นตัวแปลในรูปเเบบ $GET
{
    $decodedCode = str_replace('&', '##', $decodedCode);
    $segments = explode("##", trim($decodedCode, "##"));
    $data = [];
    foreach ($segments as $segment) {
        list($key, $value) = explode("=", $segment, 2);
        $data[$key] = $value;
        $_GET[$key] = $value;
    }
    return $_GET;
}
function check_function($functionName)
{
    $reflection = new ReflectionFunction($functionName);
    $filename = $reflection->getFileName();
    return $filename;
}
function print_r_pre($a = "")
{
    echo "<br><br><br><br><br><pre>";
    print_r($a);
    echo "</pre>";
}

function cut_last_comma($input = "")
{
    //ข้อมูลนำเข้า 11111,22222,3333,
    //ข้อมูลออก 11111,22222,3333
    $string = $input;
    $substring = ",";
    $position = strrpos($string, $substring);
    if ($position !== false && $position === strlen($string) - strlen($substring)) {
        return substr($string, 0, $position);
    }
}

function sort_array($data_array)
{
    /* ข้อมูลน้ำเข้า
    $_GET['data']=[
        '0'=>'ข้อมูล1',
        '1'=>'ข้อมูล2',
        '2'=>'ข้อมูล3',
    ] 
    ข้อมูลขาออก
    'ข้อมูล1','ข้อมูล2','ข้อมูล3'
    */
    $text_N = 1;
    $result_case = "";
    foreach ($data_array as $A1) {
        $result_case .= "'" . $A1 . "'" . (count($data_array) == $text_N ? "" : ",");
        $text_N++;
    }
    return $result_case;
}
function result_array($X = '')
{
    /* ข้อมูลนำเข้า 1111111111,222222222,33333333 */
    /* ข้อมูลขาออก '1111111111','222222222','33333333' */
    $arrayData_registerCode = explode(",", str_replace('-', '', $X));
    $result_registerCode = "'" . implode("','", $arrayData_registerCode) . "'";
    return $result_registerCode;
}


function ctext($txt, $converted = 0)
{
    $strOut = strip_tags($txt);
    $strOut = htmlspecialchars($strOut, ENT_QUOTES);
    $strOut = stripslashes($strOut);
    $strOut = str_replace("'", " ", $strOut);
    $strOut = trim($strOut);
    return ($converted == 0) ? $strOut : iconv("utf-8", "tis-620", $strOut);
}


function date_AK($date)
{
    //จาก 20/07/2565 -> 2022-07-20
    $strDay = substr("$date", 0, 2);
    $strMonth = substr("$date", 3, 2);
    $strYear = substr("$date", 6, 4);
    $data_date = ($strYear - 543) . "-" . $strMonth . "-" . $strDay;
    return $data_date;
}
function date_AK_year($date)
{
    //input 2023-01-18
    //out 18 มกราคม 2566
    $date = new DateTime($date);
    $thai_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $str_day = $date->format('d');
    $str_month = $date->format('m');
    $str_year = $date->format('Y') + 543;
    $output_date = $str_day . " " .  $thai_month[intval($str_month)] . " " . $str_year;
    return $output_date;
}

function date_AK65($date)
{
    if ($date == "") {
        return  false;
    }
    //จาก  2022-07-20 ->20/07/2565 
    $strYear = substr("$date", 0, 4);
    $strMonth = substr("$date", 5, 2);
    $strDay = substr("$date", 8, 2);
    $data_date = $strDay . "/" .  $strMonth . "/" . ($strYear + 543);
    return $data_date;
}
//แปลงค่าวันที่ ลง DB