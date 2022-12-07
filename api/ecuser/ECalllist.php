<?php
//ini_set("display_errors",'1');
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$data = json_decode(file_get_contents("php://input"));
//AND PanchayatId='".$data->panchayat."' AND VillageId='".$data->village."'
$checkvaliduser = $db->prepare("SELECT * FROM ecregister WHERE BlockId='".$data->block."' AND PhcId='".$data->phc."' AND HscId='".$data->hsc."' AND status=1 ORDER BY id ASC");

$checkvaliduser->execute();
$checknum = $checkvaliduser->rowCount();

if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
$Ecarray[] = array( "ecfrno" =>$row['ecfrno'],
"dateecreg" =>$row['dateecreg'],
"picmeNo" =>$row['picmeNo'],
"MotherAadhaarId" =>$row['motheraadhaarid'],
"MotherAadhaarName" =>$row['motheraadhaarname'],
"HusbandAadhaarId" =>$row['husbandaadhaarid'],
"HusbandAadhaarName" =>$row['husbandaadhaarname'],
"MotherFullname" =>$row['motherfullname'],
"MotherDoB" =>$row['motherdob'],
"MotherAge_atECReg" =>$row['motherageecreg'],
"MotherAge_atMarriage" =>$row['motheragemarriage'],
"MotherMobNo" =>$row['mothermobno'],
"MobileOfPerson" =>$row['mobileofperson'],
"MotherEduStatus" =>$row['motheredustatus'],
"HusFullName" =>$row['husfullname'],
"HusDoB" =>$row['husdob'],
"HusAge_atECReg" =>$row['husageecreg'],
"HusAge_atMarriage" =>$row['husagemarriage'],
"HusMobNo" =>$row['husmobno'],
"HusEduStatus" =>$row['husedustatus'],
"Religion" =>$row['religion'],
"Caste" =>$row['caste'],
"Block" =>$row['BlockId'],
"Phc" =>$row['PhcId'],
"Hsc" =>$row['HscId'],
"Panchayat" =>$row['PanchayatId'],
"Village" =>$row['VillageId'],
"Address" =>$row['address'],
"Pincode" =>$row['pincode'],
"Povertystatus" =>$row['povertystatus'],
"Migrantstatus" =>$row['migrantstatus'],
"RationCardType" =>$row['rationcardtype'],
"RationCardNum" =>$row['rationcardnum'],

);
    } 
    
    http_response_code(200);
    echo json_encode(
            array("success" => "true", "error"=> "false",  "Ecouplelist" => $Ecarray , "message" => "Eligible Couple Registered List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);
    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "Eligible Couple Data Not Found")
    );
}
?>
