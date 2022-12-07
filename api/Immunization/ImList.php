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

$checkvaliduser = $db->prepare("SELECT * from immunization im JOIN ecregister ec on im.picmeNo=ec.picmeno WHERE ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND im.status=1 ORDER BY ec.motheraadhaarname ASC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
$immunization[] = array( "picmeNo" =>$row['picmeNo'],
"doseNo" =>$row['doseNo'],
"doseName" =>$row['doseName'],
"doseDueDate" =>$row['doseDueDate'],
"doseProvidedDate" =>$row['doseProvidedDate'],
"breastFeeding" =>$row['breastFeeding'],
"compliFoodStart" =>$row['compliFoodStart'],
"motherCovidVac1Done" =>$row['motherCovidVac1Done'],
"motherCovidVac1Type" =>$row['motherCovidVac1Type'],
"motherCovidVac1Date" =>$row['motherCovidVac1Date'],
"motherCovidVac2Done" =>$row['motherCovidVac2Done'],
"motherCovidVac2Type" =>$row['motherCovidVac2Type'],
"motherCovidVac2Date" =>$row['motherCovidVac2Date'],
"motherCovidVacBoosterDone" =>$row['motherCovidVacBoosterDone'],
"motherCovidVacBoosterType" =>$row['motherCovidVacBoosterType'],
"motherCovidVacBoosterDate" =>$row['motherCovidVacBoosterDate']

);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "Immunization List" => $immunization , "message" => "Immunization Registered List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "Immunization Data Not Found")
    );
}
?>
