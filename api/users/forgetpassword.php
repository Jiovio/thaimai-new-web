<?php
//ini_set("display_errors",'1');
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

if (!empty($data->mobile)) {

     
    // $form->mobile = $data->mobile;
    $mvaliduser1 = $db->prepare("SELECT * FROM users WHERE PhcIdmobilePhcId='".$data->mobile."' AND status=1 ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
    if ($mvalidchecknum >0) {
        $form->mobile = $data->mobile;
if(!empty($data->encpassword) && !empty($data->password)) {
    

    $mvalidusers = $db->prepare("SELECT * FROM users WHERE PhcIdmobilePhcId='".$data->mobile."' AND status=1 ORDER BY id ASC");
    $mvalidusers->execute(array());
    $mvalidcheck = $mvalidusers->rowCount();
    if($mvalidcheck >0) {

        $form->encpassword = $data->encpassword;
        $form->password = $data->password; 
         $inserid = $form->editpassword();
            
              // set response code - 201 created
          http_response_code(200);

        echo json_encode(array("success" => "true", "error" => "false", "message" => "User Password Updated Successfully."));


    } else {
       
        http_response_code(400);

        echo json_encode(array("success" => "false", "error" => "true","message" => "User Password Not Update."));        
    }

    
    
    
} 


    // } else {
 
    // // set response code - 400 bad request

    // http_response_code(400);

    //     echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the Mobile Number"));
        
}
} else {
   // set response code - 400 bad request

    http_response_code(400);

        echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the Mobile Number"));
     
}

?>