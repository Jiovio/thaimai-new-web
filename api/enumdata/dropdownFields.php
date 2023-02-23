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

$checkvaliduser = $db->prepare("SELECT * FROM PhcIdenumdataPhcId WHERE status=1 ORDER BY id ASC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
$ddarray[] = array( 
"enumid" =>$row['enumid'],
"enumvalue" =>$row['enumvalue'],
"type" =>$row['type'],
"doseNo" =>$row['doseNo'],
"Interface" =>$row['Interface'],
"FieldName" =>$row['FieldName'],
"status" =>$row['status']
);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "DropdownFields" => $ddarray , "message" => "Dropdown Fields List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "Dropdown Fields Data Not Found")
    );
}
?>
