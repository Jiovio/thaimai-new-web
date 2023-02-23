<?php
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

$checkvaliduser = $db->prepare("SELECT an.motheraadhaarid, an.picmeno, an.picmeRegDate, an.residentType, an.pregnancyTestResult, an.methodofConception, an.gravida, an.para, an.livingChildren, an.abortion, an.childDeath, an.hrPregnancy, an.obstetricCode, an.motherHeight, an.motherWeight, an.bpSys, an.bpDia, an.anRegDate, an.mrmbsEligible,an.MotherAge,an.HusbandAge FROM anregistration an JOIN ecregister ec on ec.motheraadhaarid=an.motheraadhaarid WHERE ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND an.motheraadhaarid='".$data->motheraadhaarid."' AND an.status=1");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
              
$Ararray[] = array(
"motheraadhaarid" =>$row['motheraadhaarid'],
"picmeno" =>$row['picmeno'],
"picmeregdate" =>$row['picmeRegDate'],
"residentType" =>$row['residentType'],
"pregnancyTestResult" =>$row['pregnancyTestResult'],
"methodofConception" =>$row['methodofConception'],
"gravida" =>$row['gravida'],
"para" =>$row['para'],
"livingChildren" =>$row['livingChildren'],
"abortion" =>$row['abortion'],
"childDeath" => $row["childDeath"],
"hrPregnancy" => $row["hrPregnancy"],
"obstetricCode" =>$row['obstetricCode'],
"motherHeight" =>$row['motherHeight'],
"motherWeight" =>$row['motherWeight'],
"bpSys" =>$row['bpSys'],
"bpDia" =>$row['bpDia'],
"anRegDate" =>$row['anRegDate'],
"mrmbsEligible" =>$row['mrmbsEligible'],
"motherage" =>$row['MotherAge'],
"husbandage" =>$row['HusbandAge']
);

    } 
    
    http_response_code(200);

    echo json_encode(
            array("success" => "true", "error"=> "false",  "AntenatalList" => $Ararray , "message" => "Antenatal Registration List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false","error"=>"true", "message" => "Antenatal Registration Data Not Found")
    );
}
?>
