<?php
ini_set("display_errors",'1');
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

$checkvaliduser = $db->prepare("SELECT DISTINCT(ec.picmeNo),ec.motheraadhaarid,ec.motheraadhaarname,av.avdueDate,ec.mothermobno,ec.PhcId,u.name FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno JOIN users u on av.createdBy=u.id WHERE YEAR(av.avdueDate) = YEAR(CURRENT_DATE()) AND MONTH(av.avdueDate) = MONTH(CURRENT_DATE()) AND ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND av.status=1 ORDER BY ec.picmeNo ASC;");
$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();

if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
$anarray[] = array( 
    "motheraadhaarid" =>$row['motheraadhaarid'],   
    "motheraadhaarname" =>$row['motheraadhaarname'],
    "picmeno" =>$row['picmeNo'],
    "avduedate" =>$row['avdueDate'],
    "mothermobno" =>$row['mothermobno'],
    "phc" =>$row['PhcId'],
    "name" =>$row['name']
    
);
 

    } 
    
    
    
    http_response_code(200);


    echo json_encode(
            array("success" => "true", "error"=> "false",  "Antenatalvisit" => $anarray , "message" => "Antenatal Visit Registered List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false", "error"=>"true", "message" => "Antenatal Visit Data Not Found")
    );
}

?>
