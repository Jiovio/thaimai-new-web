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

$checkvaliduser = $db->prepare("SELECT DISTINCT(av.picmeno),ec.motheraadhaarname,av.symptomsHighRisk from antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno WHERE av.symptomsHighRisk NOT IN('NO','None','Nil') AND av.symptomsHighRisk!='' AND ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND av.picmeno='".$data->picmeno."' AND av.status=1 ORDER BY ec.motheraadhaarname ASC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
$hrarray[] = array( "picmeNo" =>$row['picmeno'],
"motherName" =>$row['motheraadhaarname'],
"highRiskFactor" =>$row['enumvalue']
);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "HighRiskMother" => $hrarray , "message" => "High Risk Mother List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "High Risk Mother Data Not Found")
    );
}
?>
