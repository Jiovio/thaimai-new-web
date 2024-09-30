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
include_once '../objects/users.php';

$database = new Database();
$db = $database->getConnection();
$form = new Users($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty

if (!empty($data->email)) {

    $form->name = $data->name;
    $form->username = $data->username;
    $form->email = $data->email;
    $form->mobile = $data->mobile;
    $form->usertype = $data->usertype;
    $form->block = $data->block;
    $form->phc = $data->phc;
    $form->hsc = $data->hsc;
    $form->encpassword = $data->encpassword;
    $form->password = $data->password;
          
    $mvaliduser1 = $db->prepare("SELECT * FROM users WHERE email='".$data->email."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum >0) {
        $inserid = $form->editusers();

        // set response code - 201 created
        http_response_code(200);

        echo json_encode(array("success" => "true", "error" => "false", "message" => "User Updated Successfully."));
    } else {
       
        http_response_code(400);

        echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the fields.User not Updated."));        
    }

    } else {
 
    // set response code - 400 bad request

    http_response_code(400);

        echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the fields.User not Updated."));
        
}

?>