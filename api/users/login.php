<?php
ini_set("display_errors",'1');
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// get posted data
// $token= "";

// Code for enable getallheaders function 


// if (!function_exists('getallheaders')) {
//     function getallheaders() {
//     $headers = [];
//     foreach ($_SERVER as $name => $value) {
//         if (substr($name, 0, 5) == 'HTTP_') {
//             $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
//         }
//     }
//     return $headers;
//     }
// }

// Code for enable getallheaders function 


// foreach(getallheaders() as $name => $value)
// {
//  if($name=="Token")
//  {
//  $token=$value;    
//  }
// }


$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty

if (!empty($data->email) && !empty($data->password)) {
    
    // check mobile number 
    
    $checkvaliduser = $db->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $checkvaliduser->execute(array($data->email,$data->password));
    $checknum = $checkvaliduser->rowCount();
    
    if (($checknum > 0)) {
        $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC);
        
        http_response_code(200);
        // tell the user
        echo json_encode(array(
            "success" => "true",
            "error" => "false",
             "id" => strval($row['id']),
            "name" => $row['name'],
            "email" => $row['email'],
            "username" => $row['username'],
            "mobile" => $row['mobile'],
           "usertype" => $row['usertype'],
            "block" => $row['BlockId'],
            "phc" => $row['PhcId'],
            "hsc" => $row['HscId'],
            "password" => $row['password'],

         ));
        exit();
    } else {
        http_response_code(400);
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true", "message" => "Check the Email and Password fields"));
        exit();
    }
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to login user. Check the Email and Password."));
    exit();
}
?>