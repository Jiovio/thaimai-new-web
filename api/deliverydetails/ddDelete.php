<?php
 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/delivery.php';

$database = new Database();
$db = $database->getConnection();
$form = new Delivery($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (!empty($data->picmeno)) {


    // set form property values

    $form->picmeno = $data->picmeno;
    $form->usertype = $data->usertype;

    $mvaliduser1 = $db->prepare("SELECT * FROM deliverydetails WHERE picmeno='".$data->picmeno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum > 0) {
        $delid = $form->deletedeliverydetails();

        // set response code - 201 created

        http_response_code(200);


        echo json_encode(array("success" => "true", "error" => "false", "message" => "Delivery Details Deleted Successfully."));
    
    } else {
       
        http_response_code(400);
    
        echo json_encode(array("success" => "false", "error" => "true","message" => "Delivery Details not Deleted Check the PICME No."));
        
    }
}
else {
    // set response code - 400 bad request
    http_response_code(400);

    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to Delete Delivery Details. "));
}

?>