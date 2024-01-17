<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/filter.php'); // Top Filter 
}else if(($usertype == 2)) {
    include ('require/Bfilter.php');
}else if(($usertype == 3) || ($usertype == 4)) {
    include ('require/Pfilter.php');   
}
?>

<?php

// Authentication key
/*$authKey = "YOUR_AUTH_KEY";*/
$authKey = "SnfxKFPjD4A5m0dgLhJ9XypUwuvrc7Ye2oQVzRI3lBNMsOWbka9nKXSteZrjxFuqP8poHTRUvs3AJ4YC";

// Also add muliple mobile numbers, separated by comma
//$phoneNumber = $_POST['phoneno'];
//$phoneNumber = array("9790367929","8668092102");

// route4 sender id should be 6 characters long.
$senderId = "SAVMOM";

// Patient name to send
//$patient = $_POST['patient'];
//$patient = array("Abi","Banu");

    $patient = array();
	$phoneNumber = array();
							 
	$listQry = "SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.id,mh.edddate,ec.mothermobno,mh.createdBy,ec.BlockId,u.name, ec.PhcId,ec.HscId FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy WHERE 
                NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = mh.picmeno) AND
                str_to_date(mh.edddate, '%Y-%m-%d') < CURRENT_DATE() AND mh.status!=0";

    $ExeQuery = mysqli_query($conn,$listQry);
    
    if($ExeQuery) 
	{
     $cnt=0;
     while($row = mysqli_fetch_array($ExeQuery)) 
	 {
	  $patient[0] = $row['motheraadhaarname'];
	  $phoneNumber[0] = $row['mothermobno'];
	  $cnt++;
     } 
	}			
	
//	print_r("Here".$patient[0]); exit;

$patient = array("Sethu", "Nithya");
$phoneNumber = array("9790367929","8668092102");


$patient_tot = "";
$phoneNumber_tot = "";
for($i=0; $i <= 1; $i++) 
{	

if ($i == 1)
{
$patient_tot = $patient_tot.$patient[$i];
$phoneNumber_tot = $phoneNumber_tot.$phoneNumber[$i];
}
else
{
$patient_tot = $patient_tot.$patient[$i]."|";
$phoneNumber_tot = $phoneNumber_tot.$phoneNumber[$i].",";
}
}
//$patient_val = substr($patient_tot, ','));
//print_r($patient_tot.$phoneNumber_tot); exit;


// POST parameters
$fields = array(
    "sender_id" => $senderId,
//    "message" => (string) $message,
    "message" => 162768,
    "language" => "english",
    "route" => "dlt",
  "numbers" => "$phoneNumber_tot",
   "variables_values" => "patient", 
 // "numbers" => "9790367929,8668092102",
    "flash" => "1"
);
//	}

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