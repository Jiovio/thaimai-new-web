<?php
 include ('require/header.php'); // Menu & Top Search
// Authentication key
/*$authKey = "YOUR_AUTH_KEY";*/
$authKey = "SnfxKFPjD4A5m0dgLhJ9XypUwuvrc7Ye2oQVzRI3lBNMsOWbka9nKXSteZrjxFuqP8poHTRUvs3AJ4YC";

$picmeNo = "";
if(isset($_POST['picmeNo']))
{
 $picmeNo = $_POST['picmeNo'];	
}

//print_r($picmeNo); exit;

$record = mysqli_query($conn, "SELECT * FROM ecregister ec WHERE ec.picmeNo=$picmeNo");
$his = mysqli_fetch_array($record);
$his_mot_name = $his['motheraadhaarname'];

//print_r($his['mothermobno']); exit;

// Also add muliple mobile numbers, separated by comma
$phoneNumber = $his['mothermobno'];

//Template message
$message = $_POST['smstype'];	

//print_r($message); exit;

// route4 sender id should be 6 characters long.
$senderId = "SAVMOM";

//print_r($his['motheraadhaarmarathiname']); exit;

// Patient name to send
$patient = "";
if ($message == '163558') /* if ($message == '163570') Dhule */
{
$record_sms = mysqli_query($conn, "SELECT * FROM sms sm WHERE sm.picmeNo=$picmeNo");
$his_sms = mysqli_fetch_array($record_sms);
$his_sms_mot_name = $his_sms['motheraadhaarmarathiname'];
$patient = $his_sms_mot_name;
//$patient = $his_sms_mot_name."(".$his_sms['picmeNo'].")";
}
else
{
	$patient = $his_mot_name;	
//$patient = $his_mot_name."(".$his['picmeNo'].")";	
}

print_r("mother name".$patient); exit;

// POST parameters
$fields = array(
    "sender_id" => $senderId,
//    "message" => (string) $message,
    "message" => $message,
    "language" => "english",
    "route" => "dlt",
   "numbers" => $phoneNumber,
   "variables_values" => $patient,
  //  "numbers" => '7667878400',
    "flash" => "0"
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