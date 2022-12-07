<?php

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

$data = json_decode(file_get_contents("php://input"));


// make sure data is not empty
if (!empty($data->mobile)) {
    $checkvaliduser = $db->prepare("SELECT * FROM `users` WHERE `mobile`=? ORDER BY `id` ASC");
    $checkvaliduser->execute(array($data->mobile));
    $checknum = $checkvaliduser->rowCount();

    if ($checknum == 0) { // new Registertion
        

        
$fields = array(
    "sender_id" => "SAVMOM",
    "message" => 129195,
    "variables_values" => $form->otp,
    "route" => "dlt",
    "numbers" => $data->mobile,
);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 60,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: nJN90tufZ8eamKz5PqwCWBLYo73kyGIihFcgpSMARr4Q2vdxEVlGfVmwrZq5USX79s8K6PA3nIijcLHB",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
 // echo $response;
}
            
        
    } else {
     
    }
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}
?>