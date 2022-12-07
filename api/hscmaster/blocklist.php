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

$masterdata = $db->prepare("SELECT * FROM hscmaster WHERE BlockId='".$data->BlockId."' ORDER BY id ASC");

$masterdata->execute();

$checknum = $masterdata->rowCount();


if ($checknum >0) {
     while ( $row = $masterdata->fetch(PDO::FETCH_ASSOC)) 
     {

        


     
      
$barray[] = array( 
    "PhcName" =>$row['PhcName'],
    "HscName" =>$row['HscName'],
    "type"=>$row['rutype']
);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "BlockIdwisedata" => $barray , "message" => "BlockIdwise VillageId and HscId Data List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
        array("success" => "false", "error"=>"true", "message" => "Data Not Found. Check the Fields")
);
}
?>
