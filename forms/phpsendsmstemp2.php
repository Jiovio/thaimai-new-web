<?php

// Authentication key
/*$authKey = "YOUR_AUTH_KEY";*/
$authKey = "SnfxKFPjD4A5m0dgLhJ9XypUwuvrc7Ye2oQVzRI3lBNMsOWbka9nKXSteZrjxFuqP8poHTRUvs3AJ4YC";

// Also add muliple mobile numbers, separated by comma
$phoneNumber = $_POST['phoneno'];

// route4 sender id should be 6 characters long.
$senderId = "SAVMOM";

// POST parameters
$fields = array(
    "sender_id" => $senderId,
//    "message" => (string) $message,
    "message" => 156829,
    "language" => "english",
    "route" => "dlt",
   "numbers" => $phoneNumber,
  //  "numbers" => '7667878400',
    "flash" => "1"
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: ".$authKey,
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
  echo $response; 
}
?>