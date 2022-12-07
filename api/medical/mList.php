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

$checkvaliduser = $db->prepare("SELECT * from medicalhistory mh JOIN ecregister ec on mh.picmeNo=ec.picmeno WHERE ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND mh.status=1 ORDER BY ec.motheraadhaarname ASC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
$ddarray[] = array( "picmeno" =>$row['picmeno'],
"lmpdate" =>$row['lmpdate'],
"edddate" =>$row['edddate'],
"reg12weeks" =>$row['reg12weeks'],
"momBGtaken" =>$row['momBGtaken'],
"momBGtype" =>$row['momBGtype'],
"pastillness" =>$row['pastillness'],
"bleedtime" =>$row['bleedtime'],
"clottime" =>$row['clotTime'],
"momVdrlRpr" =>$row['momVdrlRpr'],
"momVdrlRprResult" =>$row['momVdrlRprResult'],
"husVdrlRpr" =>$row['husVdrlRpr'],
"husVdrlRprResult" =>$row['husVdrlRprResult'],
"momhbsag" =>$row['momhbsag'],
"momhbresult" =>$row['momhbresult'],
"hushbsag" =>$row['hushbsag'],
"hushbresult" =>$row['hushbresult'],
"momhivtest" =>$row['momhivtest'],
"momhivtestresult" =>$row['momhivtestresult'],
"hushivtest" =>$row['hushivtest'],
"hushivtestresult" =>$row['hushivtestresult'],
"LastPregnancyComplication" =>$row['LastPregnancyComplication'],
"LastPregnancyOutcome" =>$row['LastPregnancyOutcome'],
"placeDeliveryDistrict" =>$row['placeDeliveryDistrict'],
"deliveryMode" =>$row['deliveryMode'],
"hospitaltype" =>$row['hospitaltype'],
"hospitalname" =>$row['hospitalname']

);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "MedicalHistory" => $ddarray , "message" => "Medical History Registered List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "Medical History Data Not Found")
    );
}
?>
